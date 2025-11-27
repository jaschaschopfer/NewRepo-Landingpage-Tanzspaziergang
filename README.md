# Unterwegs – Landing Page für Tanzspaziergang

Dieses Repository enthält eine responsive Landing Page für „Unterwegs“, eine Reihe geführter Tanzspaziergänge, die Bewegung und Natur an mehreren Terminen im Jahr 2026 verbinden. Die Seite fokussiert sich auf die Anmeldung zu Erinnerungs-E-Mails für ausgewählte Vorstellungen sowie eine optionale Anmeldung für zukünftige Veranstaltungen, eingebettet in ein flüssiges, flussiges Scrolling-Erlebnis.

## Projektbeschreibung

Die Website ist als Onepager konzipiert und dient als Marketing- und Anmeldeplattform für den Tanzspaziergang „Unterwegs“. Sie besteht aus zwei identischen Anmeldebereichen (oben und unten), mehreren Informationssektionen, atmosphärischen Bildbereichen sowie einem dynamischen Hinweisbanner, das über ein kleines Admin-Interface gepflegt werden kann und aktuelle Infos (z. B. Wetterentscheidungen) anzeigt. Nutzer*innen wählen ihre Wunschvorstellungen über ein benutzerdefiniertes Checkbox-Dropdown, tragen Name und E-Mail ein und senden das Formular, das per PHP-Backend in einer MySQL-Datenbank gespeichert wird.

## Setup und Installation

### Frontend

- `index.php` im Browser öffnen – hier werden Google Fonts, `styles.css` und `script.js` eingebunden und alle Inhalte (Hinweisbanner, Formulare, Textbereiche, Bilder, Footer) strukturiert.
- Die Seite nutzt Playfair Display, Poppins und Baumans als Webfonts, um eine Mischung aus theatralischem Ausdruck und guter Lesbarkeit zu erreichen.
- Die Seite verlinkt auf eine separate `privacy.html`, in der die Datenschutzerklärung hinterlegt ist; im Formular wird explizit darauf hingewiesen.

### Backend

- In `db_config.php` (separat, nicht im Repo-Auszug gezeigt) die eigenen Datenbank-Zugangsdaten (Server, Benutzername, Passwort, Datenbankname) eintragen; die Verbindung erfolgt per PDO mit UTF‑8-Unterstützung und Fehlerbehandlung.
- `submit_form.php` auf einem Server mit PHP-Unterstützung bereitstellen; das Script bindet die DB-Konfiguration ein, validiert die POST-Daten und liefert JSON-Antworten für das Frontend.
- `admin.php` zum Verwalten des Hinweisbanners deployen; diese Seite ist mit Passwortschutz (über `password.php`), CSRF-Token und Honeypot-Feld abgesichert und schreibt den Bannertext in eine Datei `banner.txt`.
- In der Datenbank Tabellen für `users` und `selecteddates` anlegen, die zu den INSERT-Statements in `submit_form.php` passen (inkl. `subscribedtoupdates`-Feld und Fremdschlüsselbeziehung).

### Projekt starten

- Das Projekt über einen lokalen oder entfernten Webserver bereitstellen (z. B. Apache, Nginx oder den eingebauten PHP-Server), damit PHP-Dateien (`index.php`, `submit_form.php`, `admin.php`) ausgeführt und die Fetch-Requests korrekt verarbeitet werden können.
- Sicherstellen, dass `banner.txt` vom Webserver beschreibbar ist, damit Änderungen über `admin.php` im Frontend-Banner erscheinen.

## Frontend-Features

### HTML/PHP-Struktur und Inhalte

- Dynamisches Hinweisbanner:
  - `index.php` liest optionalen Bannertext aus `banner.txt` und blendet eine Banner-Sektion nur ein, wenn Text vorhanden ist (z. B. „Heute 18:00 Entscheidung wegen Wetter. Update ab 12:00“).
  - Text wird HTML-sicher ausgegeben und Zeilenumbrüche werden übernommen, wodurch kurze Service-Hinweise platziert werden können.
- Zwei Anmeldesektionen („Erinnerung erhalten“) mit identischen Formularen am Seitenanfang und -ende, jeweils mit:
  - Pflichtfeldern für Name und E-Mail.
  - Auswahl einer oder mehrerer Vorstellungen, gruppiert in „Premiere“, „Frühsommer“ und „Spätsommer“.
  - Optionalem Checkbox-Feld für weitere Veranstaltungs-Updates.
  - Kurzem Hinweistext, dass mit Klick auf „Anmelden“ der Datenschutzerklärung zugestimmt wird, verlinkt auf `privacy.html`.
- Weitere Inhaltsbereiche:
  - Einführungssektion mit Erläuterung des Formats (Spaziergang in Begleitung von Tanz und Musik, Dauer, Ort Utzigen etc.).
  - Info-Sektion mit klaren Blöcken „Wo?“, „Wann?“, „Weiteres“ inkl. Anreise, Wetterabhängigkeit und rechtlichen Hinweisen (Versicherung, Barrierefreiheit).
  - Statement-/Zitatbereich mit Foto und Text von Projektleitung Christina Schöpfer.
  - Mehrere „hanging pictures“-Bildbereiche (vier Bilder), die abwechselnd links und rechts zu den Textkarten platziert sind.
- Footer:
  - Link zur Datenschutzerklärung (`privacy.html`).
  - Instagram-Link mit inline SVG-Icon.

### CSS-Design und Besonderheiten

- Moderner CSS-Reset (inkl. `box-sizing`, `scroll-behavior`, `color-scheme` und neutralisierter Formelemente) für ein konsistentes Erscheinungsbild in verschiedenen Browsern.
- Theming über CSS-Custom-Properties:
  - Farb-Variablen für Hintergründe, Neutraltöne und bühnenhafte Akzentfarben (kräftiger Pflaume-/Burgundton und Gold) für Überschriften, Buttons und Hervorhebungen.
  - Schriftfamilien für Überschriften (Baumans) und Fließtext (Poppins) sowie Basisvariablen für Schriftgröße, Zeilenhöhe, Abstände, Übergänge und Schatten.
- Layout:
  - Kartenartige Sektionen mit weichen Schatten und asymmetrischen, abgerundeten Ecken; Textbereiche (Intro, Info, Zitat) sind als `.left-section`/`.right-section` umgesetzt, Bildbereiche als `.hanging-pictures`.
  - Responsives Verhalten über max. 80 % Breite im Content-Bereich, Auto-Margins und angepasste Rundungen, sodass die versetzte Ausrichtung auch auf Desktop ruhig wirkt; in größeren Breakpoints werden Schatten zurückgenommen und Breiten reduziert.
- Individuell gestaltetes Dropdown:
  - Vollbreiter Dropdown-Button (`.dropdown-toggle`), der einem nativen Select ähnelt, inklusive eingebettetem SVG-Pfeil über eine Data-URI.
  - Absolut positionierte Dropdown-Liste (`.dropdown-list`) mit begrenzter Höhe, Scrollbarkeit, Abschnittsüberschriften, Hover-Effekten auf Listeneinträge und per `accent-color` gestalteten Checkboxen.
- Animationskonzept:
  - Bildbereiche mit Klassennamen `.animate-picture` starten mit reduzierter Deckkraft und kleinerem Scale, abgerundeten Ecken und weichen Übergängen; im aktiven Zustand vergrößern sie sich leicht und werden vollständig sichtbar.
  - Textsektionen mit `.animated-text-section` sind entweder links- oder rechts-ausgerichtet und sliden mit Fade-in-Effekt aus der jeweiligen Richtung in den Viewport.
  - Typewriter-Effekt für zentrale Überschriften mit `.typewriter`, der beim ersten Sichtbarwerden der Sektion gestartet wird.
- Zustandsanimationen für Formular und Danke-Bereich:
  - `.newsletter-section.hidden` blendet die Formularbereiche mit einer Kombination aus `opacity`, `max-height`, Padding und Margin aus, sodass sie visuell kollabieren.
  - `.thank-you-section.visible` blendet die Danke-Nachricht ein und erweitert sie mit denselben Eigenschaften für einen klaren Bestätigungszustand.

## JavaScript-Verhalten

### Dropdown-Logik

- `script.js` findet alle `.checkbox-dropdown-container`, damit die Funktionalität für das obere wie auch untere Formular identisch ist.
- Ein Klick auf den Toggle-Button öffnet/schließt die zugehörige `.dropdown-list`, aktualisiert `aria-expanded` und stoppt Event-Bubbling, damit Klicks außerhalb die Liste schließen.
- Die Button-Beschriftung passt sich dynamisch an: „Vorstellungen auswählen“, „1 Vorstellung ausgewählt“ oder „X Vorstellungen ausgewählt“, je nach Anzahl aktivierter Checkboxen.
- Ein globaler `click`-Listener auf `document` schließt offene Dropdowns, wenn Nutzer*innen außerhalb des Containers klicken.

### Scrollgesteuerte Animationen

- Bild-Animationen:
  - Alle `.animate-picture`-Elemente werden über eine eigene Logik animiert, die eine „aktive Zone“ in der Mitte des Viewports definiert.
  - Ein Bild wird aktiv, wenn sowohl die Oberkante des zugehörigen Abschnitts einen bestimmten Abstand unterhalb des Viewport-Oberrands als auch die Unterkante einen bestimmten Abstand oberhalb des Viewport-Unterrands einnimmt; so entsteht eine mittige Zone, in der das Bild „poppt“.
  - Die Logik ist explizit unabhängig von der Scrollrichtung – Bilder werden beim Hineinscrollen sowohl von oben als auch von unten in diese Zone animiert (Ein- und Ausblenden über `.active` und `.fading-out`).
- Text-Animationen:
  - `.animated-text-section`-Elemente werden anhand eines berechneten Sichtbarkeitsprozents animiert; ab ca. einem Drittel Sichtbarkeit wird die Klasse `.active` gesetzt, was einen Slide/Fade-in von der jeweiligen Seite auslöst.
  - Typewriter-Überschriften innerhalb einer aktiven Textsektion erhalten einmalig die Klasse `.typed`, wodurch die Schreibmaschinen-Animation gestartet und anschließend nicht wiederholt wird.
- Performance:
  - Scroll-Events werden über ein einfaches Debouncing (Timeout) gebündelt, um Layout-Berechnungen und DOM-Updates effizienter auszuführen.

### AJAX-Formularversand

- Alle `.newsletter-form`-Elemente erhalten einen `submit`-Handler, der:
  - Das Standardverhalten (Seitenreload) verhindert.
  - Den Submit-Button deaktiviert, den Labeltext temporär auf einen Sende-Status umstellt und ein `FormData`-Objekt erstellt.
  - Das Formular per `fetch('submit_form.php', { method: 'POST', body: formData })` an den Server sendet.
- Verarbeitung der JSON-Antwort:
  - `success: true`: Alle `.newsletter-section`-Bereiche erhalten `.hidden`, die Danke-Sektion `.visible`, und die Überschrift im Danke-Bereich wird mit der vom Server gelieferten Nachricht aktualisiert; zusätzlich wird zum Seitenanfang gescrollt.
  - `success: false`: Eine Fehlermeldung wird per `alert` ausgegeben, der Button wird wieder aktiviert und auf den ursprünglichen Text gesetzt, und es wird zum Seitenanfang gescrollt.
- Netzwerkfehler:
  - Fehler werden in der Konsole protokolliert, den Nutzer*innen wird eine generische Fehlermeldung angezeigt, und der Button-Zustand wird zurückgesetzt.

## Backend und Datenmodell

### Datenbankverbindung und Formularverarbeitung

- Die DB-Anbindung erfolgt über PDO mit `utf8mb4`-Zeichensatz und Exception-Modus; bei Verbindungsfehlern wird eine JSON-Fehlermeldung mit HTTP-Status 500 zurückgegeben.
- `submit_form.php`:
  - Akzeptiert ausschließlich POST-Anfragen und antwortet mit JSON; andere HTTP-Methoden erhalten Status 405.
  - Säubert und validiert die Eingaben (`name`, `email`, `dates[]`, `subscribeupdates`); ungültige Anfragen führen zu HTTP-Status 400.
  - Nutzt eine feste Liste erlaubter Veranstaltungstermine, um nur bekannte Daten zu speichern.
  - Führt eine transaktionale Verarbeitung aus:
    - Sucht Nutzer*in per E-Mail in `users`; bei Treffer werden Name und `subscribedtoupdates` aktualisiert, sonst wird ein neuer Datensatz angelegt.
    - Fügt ausgewählte Termine in `selecteddates` ein (`INSERT IGNORE`), verknüpft über `userid`, um Dubletten zu vermeiden.
    - Gibt bei Erfolg ein JSON mit `success: true` und unterschiedlicher Dankesnachricht für Neu- oder Bestandsnutzer*innen zurück.
  - Bei Datenbankfehlern wird ein Rollback ausgeführt, der Fehler geloggt und eine JSON-Fehlermeldung mit HTTP-Status 500 zurückgegeben.

### Admin-Interface für Banner

- `admin.php` ermöglicht das Bearbeiten des Hinweisbanners ohne direkte Dateizugriffe:
  - Passwortschutz über `password.php` mit Hash-Vergleich (`hash_equals`).
  - CSRF-Schutz über ein Session-Token und ein verstecktes Formularfeld.
  - Honeypot-Feld `website` als einfache Bot-Abwehr.
  - Sanitizing des Bannertextes (Entfernen von Steuerzeichen, Erlauben von Zeilenumbrüchen) und Speichern in `banner.txt` mit Datei-Sperre (`LOCK_EX`).
  - Minimalistisches Backend-Layout mit Hinweisen zur Eingabe (nur Text, Zeilenumbrüche werden übernommen) und Link zurück zur Hauptseite (`index.php`).

### Datenschutzseite

- `privacy.html` enthält die Datenschutzerklärung und wird:
  - Im Formular-Hinweistext verlinkt, bevor Nutzer*innen auf „Anmelden“ klicken.
  - Im Footer nochmals als eigenständiger Link („Datenschutzerklärung“) angeboten.

## Feature-Übersicht

| Bereich    | Kern-Features                                                                                                                                                                                                 |
|-----------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Content   | Zwei Anmeldeformulare, Hinweisbanner, Einführungs-, Info- und Testimonial-Sektionen sowie Bildbereiche, die den Charakter des Tanzspaziergangs transportieren.                                                 |
| Design    | Themenspezifische Farbwelt, Custom-Fonts, asymmetrische Kartenlayouts, individuelles Dropdown und bidirektionale Scroll-Reveal-/Pop-in-Effekte für Bilder und Text.                                           |
| JavaScript| Multi-Select-Dropdown mit dynamischem Buttontext, bildzentrierte Active-Zone-Logik, Slide/Fade-in-Textanimationen, Typewriter-Effekt, Debouncing von Scroll-Events und AJAX-Formularversand mit JSON-Handling. |
| Backend   | PDO-basierte MySQL-Anbindung, transaktionale Verarbeitung von Nutzer*innen und Terminen, JSON-API, Admin-Interface für Bannerpflege mit Passwort-/CSRF-/Honeypot-Schutz sowie separate Datenschutzerklärungsseite. |


### Daten-Export
Um die Daten für den E-Mail-Versand zu exportieren, gehst du wie folgt vor:

### **Schritt 1: SQL-Abfrage ausführen**

<img width="1506" height="807" alt="Bildschirmfoto 2025-11-27 um 14 29 06" src="https://github.com/user-attachments/assets/4d5d8f78-2d44-4e4a-8245-f22a0d911005" />

1.  Klicke in phpMyAdmin auf den Reiter **SQL**.
2.  Füge den folgenden Code in das Textfeld ein. **Wichtig:** Ersetze `'2026-05-01'` durch das Datum, das du abfragen möchtest.
    ```
    SELECT DISTINCT users.name, users.email
    FROM users
    JOIN selected_dates ON users.id = selected_dates.user_id
    WHERE selected_dates.event_date = '2026-05-01'
    ```
3.  Klicke rechts unten auf **OK**.

> **Tipp (Speichern):** Damit du den Code nicht immer neu tippen musst, gib unten bei **"SQL-Abfrage speichern"** einen Namen ein (z. B. "Suche nach Datum") und klicke auf "OK". Beim nächsten Mal findest du dies direkt im Bereich "Gespeicherte SQL-Abfrage".

-----

### **Schritt 2: Ergebnisse exportieren**

<img width="1510" height="736" alt="Bildschirmfoto 2025-11-27 um 14 33 52" src="https://github.com/user-attachments/assets/d0f7d84c-40ce-49b0-a528-6c2a63ccccae" />

1.  Die Seite zeigt nun die Liste der Namen und E-Mails für das gewählte Datum an.
2.  Scrolle unter die Tabelle zum Kasten **"Operationen für das Abfrageergebnis"**.
3.  Klicke auf den Link **Exportieren**.

-----

### **Schritt 3: Als CSV herunterladen**

<img width="1507" height="806" alt="Bildschirmfoto 2025-11-27 um 14 44 20" src="https://github.com/user-attachments/assets/dcd392ab-d7b2-4355-9b24-2be49ae63ea7" />

1.  Du befindest dich nun im Export-Menü.
2.  Wähle im Dropdown-Menü bei **Format** die Option **CSV for MS Excel**.
3.  Klicke auf **OK**, um die Datei herunterzuladen.

> **Tipp (Vorlage):** Wenn du spezielle Einstellungen vornimmst (z. B. unter "Angepasst"), kannst du diese oben bei **"Neue Vorlage"** benennen und auf **"Anlegen"** klicken. Beim nächsten Export wählst du einfach diese Vorlage aus, um Zeit zu sparen.
