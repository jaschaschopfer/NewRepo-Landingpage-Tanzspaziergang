

# Unterwegs – Landing Page für Tanzspaziergang

Dieses Repository enthält eine responsive Landing Page für „Unterwegs“, eine Reihe geführter Tanzspaziergänge, die Bewegung und Natur an mehreren Terminen im Jahr 2026 verbinden. Die Seite fokussiert sich auf die Anmeldung zu Erinnerungs-E-Mails für ausgewählte Termine sowie eine optionale Anmeldung für zukünftige Veranstaltungen, eingebettet in ein flüssiges, filmisches Scrolling-Erlebnis.

## Projektbeschreibung

Die Website ist als Onepager konzipiert und dient als Marketing- und Anmeldeplattform für den Tanzspaziergang „Unterwegs“. Sie besteht aus zwei identischen Anmeldebereichen (oben und unten), mehreren Informationssektionen und atmosphärischen Bildbereichen, die den Charakter der Veranstaltung visuell unterstützen. Nutzer*innen wählen ihre Wunschtermine über ein benutzerdefiniertes Checkbox-Dropdown, tragen Name und E-Mail ein und senden das Formular, das per PHP-Backend in einer MySQL-Datenbank gespeichert wird.

## Setup und Installation

### Frontend

- `index.html` im Browser öffnen – hier werden Google Fonts, `styles.css` und `script.js` eingebunden und alle Inhalte (Formulare, Textbereiche, Bilder) strukturiert.
- Die Seite nutzt Playfair Display, Poppins und Baumans als Webfonts, um eine Mischung aus theatralischem Ausdruck und guter Lesbarkeit zu erreichen.

### Backend

- In `db_config.php` die eigenen Datenbank-Zugangsdaten (Server, Benutzername, Passwort, Datenbankname) eintragen; die Verbindung erfolgt per PDO mit UTF‑8-Unterstützung und einfacher Fehlerbehandlung.
- `submit_form.php` auf einem Server mit PHP-Unterstützung bereitstellen; das Script bindet `db_config.php` ein, validiert die POST-Daten und liefert JSON-Antworten für das Frontend.
- In der Datenbank Tabellen für `users` und `selecteddates` anlegen, die zu den INSERT-Statements in `submit_form.php` passen.

### Projekt starten

- Das Projekt über einen lokalen oder entfernten Webserver bereitstellen (z. B. Apache, Nginx oder den eingebauten PHP-Server), damit der Fetch-Aufruf `fetch('submit_form.php', ...)` für die AJAX-Formularübertragung korrekt funktioniert.

## Frontend-Features

### HTML-Struktur und Inhalte

- Zwei Anmeldesektionen („Erinnerung erhalten“) mit identischen Formularen am Seitenanfang und -ende, jeweils mit:
  - Pflichtfeldern für Name und E-Mail.
  - Auswahl eines oder mehrerer Termine, gruppiert in „Premiere“, „Frühsommer“ und „Spätsommer“.
  - Optionalem Checkbox-Feld für weitere Veranstaltungs-Updates.
- Weitere Inhaltsbereiche:
  - Einführungssektion mit Erläuterung der Tanzspaziergänge (Dauer, Zielgruppe, Ablauf).
  - Infobereich mit praktischen Hinweisen.
  - Statement-/Testimonial-Sektion mit Zitaten von Teilnehmenden.
  - Mehrere „hanging pictures“-Bildbereiche, die abwechselnd gegenüber den Textkarten positioniert werden, um beim Scrollen eine links–rechts-Rhythmik zu erzeugen.
- Footer mit einem Instagram-Link, der über ein eingebettetes SVG-Icon dargestellt wird.

### CSS-Design und Besonderheiten

- Moderner CSS-Reset (inkl. `box-sizing`, `scroll-behavior`, `color-scheme` und angepasster Formelemente) für ein konsistentes Erscheinungsbild in verschiedenen Browsern.
- Theming über CSS-Custom-Properties:
  - Farb-Variablen für Hintergründe, Neutraltöne und bühnenhafte Akzentfarben (kräftiger Pflaume-/Burgundton und Gold) für Überschriften und Call-to-Actions.
  - Schriftfamilien für Überschriften (Baumans) und Fließtext (Poppins) sowie globale Variablen für Schriftgröße, Zeilenhöhe, Abstände, Übergänge und Schatten.
- Layout:
  - Kartenartige Sektionen mit weichen Schatten und asymmetrischen, abgerundeten Ecken: Textbereiche sind eher links ausgerichtet, Bildbereiche („hanging pictures“) rechts, was an gerahmte Plakate oder Fotografien erinnert.
  - Responsives Verhalten über max. 80 % Seitenbreite und automatische Ränder, sodass die versetzte Ausrichtung auch auf schmalen Viewports gut lesbar bleibt.
- Individuell gestaltetes Dropdown:
  - Vollbreiter Dropdown-Button (`.dropdown-toggle`), der einem nativen Select ähnelt, inklusive eingebettetem SVG-Pfeil über eine Data-URI.
  - Absolut positionierte Dropdown-Liste (`.dropdown-list`) mit begrenzter Höhe, Scrollbarkeit, Abschnittsüberschriften, Hover-Effekten auf den Listeneinträgen und per `accent-color` gestalteten Checkboxen.
- Animationskonzept:
  - Sektionen und zentrale Elemente starten mit `opacity: 0` und horizontaler Verschiebung (Textkarten von links, Bildbereiche von rechts) und gehen bei aktivierter Klasse `.is-visible` in eine volle Sichtbarkeit und ihre natürliche Position über.
  - Bildbereiche „poppen“ sowohl beim Herunterscrollen als auch beim Hochscrollen ins Bild – der `IntersectionObserver` löst die Animation immer dann aus, wenn ein Element in den Viewport eintritt, unabhängig von der Scrollrichtung.
  - Sanfte Übergänge mit `transition` auf Deckkraft und Transform, kombiniert mit einer Ease-Kurve für einen ruhigen, filmischen Scroll-Effekt.
- Zustandsanimationen für Formular und Danke-Bereich:
  - `.newsletter-section.hidden` blendet die Formularbereiche mit einer Kombination aus `opacity`, `max-height`, Padding und Margin aus, sodass sie visuell kollabieren.
  - `.thank-you-section.visible` blendet die Danke-Nachricht mit denselben Eigenschaften ein und sorgt so für eine klare und animierte Bestätigung nach dem Absenden.

### JavaScript-Verhalten

- Custom-Multiselect-Dropdown für Termine:
  - `script.js` findet alle `.checkbox-dropdown-container`, sodass die Funktionalität sowohl im oberen als auch im unteren Formular identisch ist.
  - Ein Klick auf den Toggle-Button öffnet/schließt die zugehörige `.dropdown-list`, setzt `aria-expanded` und verhindert Event-Bubbling, damit Klicks außerhalb zum Schließen genutzt werden können.
  - Die Button-Beschriftung passt sich dynamisch an: „Termine auswählen“, „1 Termin ausgewählt“ oder „X Termine ausgewählt“, je nach Anzahl aktivierter Checkboxen.
  - Ein globaler `click`-Listener auf `document` schließt offene Dropdowns, wenn Nutzer*innen außerhalb klicken.

- Scrollgesteuerte Reveal-Animationen:
  - Ein `IntersectionObserver` beobachtet eine kombinierte Auswahl aus Sektionen, Überschriften, Absätzen, Blockquotes, Bildbereichen und Formularen.
  - Sobald ein beobachtetes Element die definierte Sichtbarkeitsschwelle überschreitet, erhält es die Klasse `.is-visible` und wird anschließend nicht weiter beobachtet; dadurch entsteht ein einmaliger Slide-in-Effekt pro Element.
  - Der Observer arbeitet bidirektional: Elemente (insbesondere die Bilder) werden sowohl beim Scrollen nach unten als auch beim Scrollen nach oben beim Eintritt in den Viewport animiert.

- AJAX-Formularversand mit Fetch:
  - Alle `.newsletter-form`-Elemente erhalten einen `submit`-Handler, der:
    - Das Standardverhalten (Seitenreload) verhindert.
    - Den Submit-Button deaktiviert und den Buttontext temporär in einen „Sende“-Status ändert.
    - Ein `FormData`-Objekt erstellt und per `fetch('submit_form.php', { method: 'POST', body: formData })` an den Server sendet.
  - Verarbeitung der JSON-Antwort:
    - `success: true`: Beide `.newsletter-section`-Bereiche erhalten `.hidden`, die Danke-Sektion `.visible`, und die Überschrift im Danke-Bereich wird mit der vom Server gelieferten Nachricht aktualisiert.
    - `success: false`: Eine Fehlermeldung wird per `alert` ausgegeben, und der Button wird wieder aktiviert und auf den ursprünglichen Text zurückgesetzt.
  - Netzwerkfehler werden in der Konsole protokolliert und mit einer generischen Fehlermeldung an die Nutzer*innen kommuniziert; auch hier wird der Button-Zustand zurückgesetzt.

## Backend und Datenmodell

### Datenbankverbindung

- `db_config.php` definiert Konstanten für Server, Benutzername, Passwort und Datenbankname und erzeugt eine PDO-Instanz mit Exception-Modus und `utf8mb4`-Zeichensatz.
- Bei fehlgeschlagener Verbindung wird eine JSON-Fehlermeldung mit HTTP-Status 500 zurückgegeben, und das Skript wird beendet.

### Formularverarbeitung (`submit_form.php`)

- Akzeptiert ausschließlich POST-Anfragen und antwortet mit JSON; andere HTTP-Methoden erhalten Status 405 und eine Fehlermeldung.
- Säubert die Eingaben (`name`, `email`, `dates[]`, `subscribeupdates`) und prüft, ob Name gesetzt und E-Mail syntaktisch gültig ist; ungültige Anfragen führen zu HTTP-Status 400.
- Nutzt eine feste Liste erlaubter Veranstaltungstermine, um Eingaben zu normalisieren und nur bekannte Termine zu speichern.
- Transaktionaler Ablauf:
  - Sucht in `users` nach einer bestehenden E-Mail; wenn vorhanden, werden Name und `subscribedtoupdates` aktualisiert, andernfalls wird ein neuer User mit diesen Werten angelegt.
  - Fügt ausgewählte Termine mittels `INSERT IGNORE` in `selecteddates` ein, jeweils verknüpft über `userid`, um Dubletten zu vermeiden.
  - Bestätigt die Transaktion bei Erfolg und gibt ein JSON-Objekt mit `success: true` und einer lokalisierten Dankesnachricht zurück, die je nach Neu- oder Bestandsnutzer*in variiert.
- Bei Datenbankfehlern wird ein Rollback ausgeführt, der Fehler wird geloggt und als JSON-Antwort mit HTTP-Status 500 zurückgegeben.

## Feature-Übersicht

| Bereich    | Kern-Features                                                                                                                                      |
|-----------|-----------------------------------------------------------------------------------------------------------------------------------------------------|
| Content   | Zwei Anmeldeformulare, Einführungs-, Info- und Testimonial-Sektionen sowie Bildbereiche, die den Charakter des Tanzspaziergangs transportieren.    |
| Design    | Themenspezifische Farbwelt, Custom-Fonts, asymmetrische Kartenlayouts, individuelles Dropdown und bidirektionale Scroll-Reveal-Effekte für Bilder. |
| JavaScript| Multi-Select-Dropdown mit dynamischem Buttontext, IntersectionObserver-Animationen (beim Scrollen nach oben und unten) und AJAX-Formularversand.   |
| Backend   | PDO-basierte MySQL-Anbindung mit User-Deduplizierung, transaktionalen Inserts und JSON-API-Antworten.                                              |



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

### Daten-Export
Hier ist die Kurzanleitung auf Deutsch, passend zu deinen Screenshots:

### **Schritt 1: SQL-Abfrage ausführen**

1.  Klicke in phpMyAdmin auf den Reiter **SQL**.
2.  Füge den folgenden Code in das Textfeld ein. **Wichtig:** Ersetze `'2026-05-01'` durch das Datum, das du abfragen möchtest.
    ```sql
    SELECT DISTINCT users.name, users.email
    FROM users
    JOIN selected_dates ON users.id = selected_dates.user_id
    WHERE selected_dates.event_date = '2026-05-01'
    ```
3.  Klicke rechts unten auf **OK**.

> **Tipp (Speichern):** Damit du den Code nicht immer neu tippen musst, gib unten bei **"SQL-Abfrage speichern"** einen Namen ein (z. B. "Suche nach Datum") und klicke auf "OK". Beim nächsten Mal findest du dies direkt im Bereich "Gespeicherte SQL-Abfrage".

-----

### **Schritt 2: Ergebnisse exportieren**

1.  Die Seite zeigt nun die Liste der Namen und E-Mails für das gewählte Datum an.
2.  Scrolle unter die Tabelle zum Kasten **"Operationen für das Abfrageergebnis"**.
3.  Klicke auf den Link **Exportieren**.

-----

### **Schritt 3: Als CSV herunterladen**

1.  Du befindest dich nun im Export-Menü.
2.  Wähle im Dropdown-Menü bei **Format** die Option **CSV for MS Excel**.
3.  Klicke auf **OK**, um die Datei herunterzuladen.

> **Tipp (Vorlage):** Wenn du spezielle Einstellungen vornimmst (z. B. unter "Angepasst"), kannst du diese oben bei **"Neue Vorlage"** benennen und auf **"Anlegen"** klicken. Beim nächsten Export wählst du einfach diese Vorlage aus, um Zeit zu sparen.
