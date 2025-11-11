Projektidee, Setup, Screenshots

# Tanzspaziergang Newsletter Landing Page

## Projektidee
Diese Website ist eine moderne Landing Page zur Anmeldung für einen Tanzspaziergang-Newsletter. Nutzer können ihre Kontaktdaten angeben, ausgewählte Veranstaltungstermine wählen und erhalten Informationen per E-Mail. Die Seite bietet ein ansprechendes Design mit scrollbasierten Animationen für Bilder und Texte zur Verbesserung der Benutzererfahrung.

## Projektaufbau und Installation
### Voraussetzungen
- Webserver mit PHP-Unterstützung
- MySQL-Datenbank
- Moderne Browser für CSS3 und JS

### Einrichtung
1. Repository klonen
2. Datenbank konfigurieren
- Passen Sie `db_config.php` mit Ihren Datenbankzugangsdaten an.
3. Dateien auf den Webserver hochladen
4. Öffnen Sie die `index.html` im Browser.

### Entwicklung
- CSS-Stile in `styles.css`
- JavaScript-Logik in `script.js`
- PHP-Back-End in `submit_form.php` für Formularverarbeitung

## Features
- Responsive, mobile-first Design
- Scrollbasierte Bild- und Textanimationen (Fade, Slide, Typewriter-Effekt)
- Newsletter-Anmeldung via AJAX mit Bestätigungsnachricht
- Mehrfachauswahl von Terminen per Dropdown



### Datenbank-Setup
SQL Befehl für die Datenbank:

-- Create `users` table
CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `submission_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subscribed_to_updates` BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create `selected_dates` table
CREATE TABLE `selected_dates` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `event_date` DATE NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_fk` (`user_id`),
  CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  UNIQUE KEY `user_event_unique` (`user_id`, `event_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
