<?php
// submit_form.php (Updated to handle subscription checkbox)

header('Content-Type: application/json');

require_once 'db_config.php';

$allAvailableDates = [
    '2026-05-01', '2026-05-29', '2026-06-05', 
    '2026-06-19', '2026-06-26', '2026-08-14',
    '2026-08-21', '2026-08-28', '2026-09-04', 
    '2026-09-11', '2026-09-18'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $selectedDates = $_POST['dates'] ?? [];
    $isSubscribed = isset($_POST['subscribe_updates']) ? 1 : 0;

    // BOT-SCHUTZ: Prüft den getarnten Honeypot
if (!empty($_POST['middle_name'])) {
    
    // 1. Bot-Versuch in der Datenbank registrieren
    try {
        $pdo->query("INSERT INTO bot_stats () VALUES ()");
    } catch (Exception $e) {
        // Falls das Loggen fehlschlägt, ignorieren wir es lautlos
    }

    // 2. Den Bot anlügen (Fake Success)
    echo json_encode(['success' => true, 'message' => 'Vielen Dank für Ihre Anmeldung!']);
    exit; 
}

    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Bitte Name und gültige E-Mail angeben.']);
        exit;
    }

    // 2. KORREKTUR & SICHERHEIT:
    // Wir nehmen nur Daten an, die AUCH in unserer $allAvailableDates Liste stehen.
    // Alles andere wird vom Bot/Nutzer ignoriert (array_intersect).
    if (!empty($selectedDates)) {
        $datesToInsert = array_intersect($selectedDates, $allAvailableDates);
    } else {
        $datesToInsert = $allAvailableDates;
    }

    // Falls nach der Filterung kein einziges gültiges Datum übrig bleibt:
    if (empty($datesToInsert)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Keine gültigen Termine ausgewählt.']);
        exit;
    }

    $isNewUser = true;

    try {
        $pdo->beginTransaction();

        $stmtCheck = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmtCheck->execute([':email' => $email]);
        $existingUser = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            // --- USER EXISTS ---
            $userId = $existingUser['id'];
            $isNewUser = false;
            
            // MODIFIED: Update the user's name AND subscription status
            $stmtUpdate = $pdo->prepare("UPDATE users SET name = :name, subscribed_to_updates = :subscribed WHERE id = :id");
            $stmtUpdate->execute([':name' => $name, ':subscribed' => $isSubscribed, ':id' => $userId]);

        } else {
            // --- NEW USER ---
            // MODIFIED: Insert the user with their subscription status
            $sqlUser = "INSERT INTO users (name, email, subscribed_to_updates) VALUES (:name, :email, :subscribed)";
            $stmtUser = $pdo->prepare($sqlUser);
            $stmtUser->execute([':name' => $name, ':email' => $email, ':subscribed' => $isSubscribed]);
            $userId = $pdo->lastInsertId();
        }

        $sqlDates = "INSERT IGNORE INTO selected_dates (user_id, event_date) VALUES (:user_id, :event_date)";
        $stmtDates = $pdo->prepare($sqlDates);

        foreach ($datesToInsert as $date) {
            $stmtDates->execute([':user_id' => $userId, ':event_date' => $date]);
        }

        $pdo->commit();

        $message = $isNewUser ? 'Vielen Dank für Ihre Anmeldung!' : 'Ihre Daten wurden erfolgreich aktualisiert!';
        echo json_encode(['success' => true, 'message' => $message]);

    } catch (PDOException $e) {
        $pdo->rollBack();
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'A database error occurred. Please try again.']);
        // error_log($e->getMessage());
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
}
?>
