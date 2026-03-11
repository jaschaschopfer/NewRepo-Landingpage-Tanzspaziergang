  <?php
  // read banner text from a flat file
  $bannerFile = __DIR__ . '/banner.txt';
  $bannerText = is_readable($bannerFile) ? trim(file_get_contents($bannerFile)) : '';
  ?>

  <!DOCTYPE html>
  <html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Ein 120-minütiger Rundgang durch Natur und Schlosspark Utzigen mit Tanz, Live-Musik und Text. Alle Termine und Informationen finden Sie hier." />
    <meta property="og:title" content="unterwegs – Tanz, Musik und Text in Utzigen" />
    <meta property="og:description" content="Ein 120-minütiger Rundgang durch Natur und Schlosspark Utzigen mit Tanz, Live-Musik und Text. Alle Termine und Informationen finden Sie hier." />
    <meta property="og:image" content="assets/images/20250623-DSC_0443.jpg" />
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="https://use.typekit.net/tdi4xtq.css">
    <title>unterwegs - Tanz, Musik und Text in Utzigen</title>
  </head>
  <body>

  <main>

  <header>
    <?php if ($bannerText !== ''): ?>
      <section class="banner" role="region" aria-label="Aktuelle Mitteilung">
        <div class="banner-text"><?= nl2br(htmlspecialchars($bannerText, ENT_QUOTES, 'UTF-8')) ?></div>
      </section>
    <?php endif; ?>
  </header>

    <section class="newsletter-section animated-text-section" id="top">
      <div class="h1-container">
        <h1 class="typewriter">Erinnerung erhalten</h1>
      </div>
      <p>Wir informieren Sie am Aufführungstag um 12:00 Uhr, ob die Vorstellung stattfindet.</p>
      <div class="credentials-box">
        <form class="newsletter-form">
          <label for="name-top">Name:</label>
          <input type="text" id="name-top" name="name" required>
          <label for="email-top">E-Mail:</label>
          <input type="email" id="email-top" name="email" required>
          <input type="text" name="middle_name" class="middle-name" tabindex="-1" autocomplete="off">

          <div class="date-selection">
            <label>Wählen Sie Ihre Vorstellungen:</label>
              <div class="checkbox-dropdown-container">
              <button type="button" class="dropdown-toggle" aria-expanded="false" aria-controls="date-checkbox-list-top">
                Vorstellungen auswählen
              </button>
              <div id="date-checkbox-list-top" class="dropdown-list">
                <ul>
                <li><h4 class="category-header">Mai</h4></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-05-01"> Fr, 01.05.2026 17:00 Uhr</label></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-05-29"> Fr, 29.05.2026 18:00 Uhr</label></li>
                <li><h4 class="category-header">Juni</h4></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-06-05"> Fr, 05.06.2026 19:00 Uhr</label></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-06-19"> Fr, 19.06.2026 19:00 Uhr</label></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-06-26"> Fr, 26.06.2026 19:00 Uhr</label></li>
                <li><h4 class="category-header">August</h4></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-08-14"> Fr, 14.08.2026 18:00 Uhr</label></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-08-21"> Fr, 21.08.2026 18:00 Uhr</label></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-08-28"> Fr, 28.08.2026 18:00 Uhr</label></li>
                <li><h4 class="category-header">September</h4></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-09-04"> Fr, 04.09.2026 17:00 Uhr</label></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-09-11"> Fr, 11.09.2026 17:00 Uhr</label></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-09-18"> Fr, 18.09.2026 17:00 Uhr</label></li>
                </ul>
              </div>
              </div>
          </div>

          <!-- NEW: Subscription Checkbox -->
          <div class="subscription-checkbox">
              <label>
                  <input type="checkbox" name="subscribe_updates" value="1">
                  Ja, ich möchte über weitere Veranstaltungen informiert werden.
              </label>
          </div>
          <div class="submit-button-container">
            <p class="acknowledge">Mit Klick auf "Anmelden" stimmen Sie der <a href="privacy.html" rel="noopener noreferrer">Datenschutzerklärung</a> zu.</p>
            <button type="submit">Anmelden</button>
          </div>
          </div>
        </form>
      </div>
    </section>

    <section class="thank-you-section animated-text-section">
      <h2><span class="typewriter">Erinnerung eingerichtet!</span></h2>
      <p>Wir freuen uns, Sie bald begrüssen zu dürfen.</p>
    </section>

    <section class="hanging-pictures right">
        <img src="assets/images/20250623-DSC_0443.jpg" alt="Tanzspaziergang Bild 1" class="image animate-picture">
    </section>

    <section class="introduction-section left-section animated-text-section left-aligned">
        <h2>Tanz, Musik und Text</h2>
        <p>unterwegs lädt ein, Schritt für Schritt mitzuziehen: Gemeinsam vorwärts, aufwärts, schlosswärts. Gemeinsam Kunst erleben. Tanz, Musik und Text.</p>
        <p>Für 120 Minuten wird die Umgebung in Utzigen zum wechselnden Bühnenbild mit Künstler:innen mehrerer Generationen. In Begleitung von Live-Musik und gesprochenen Texten führt die TanzbeWEGung Boll das Publikum  durch Natur und Schlosspark.</p> 
    </section>

    <section class="hanging-pictures left">
        <img src="assets/images/20250623-DSC_0056.jpg" alt="Tanzspaziergang Bild 2" class="image animate-picture">
    </section>

    <section id="infos" class="info-section right-section animated-text-section right-aligned flex-grid">
      <div class="info-item location-info">
        <h2>Wo?</h2>
        <ul>
          <li>• <a href="https://maps.app.goo.gl/g2g4BBGDXumMSFyd7" target="_blank" rel="noopener noreferrer">Startpunkt Weier 109g, 3068 Utzigen</a></li>
          <li>• ÖV (empfohlen): Station Aebnit</li>
          <li>• Velo: Beim Startpunkt Platz für Velos</li>
          <li>• Auto: Wenige Parkplätze beim Pflegeheim Utzigen</li>
          <li>• Jegliches Parkieren ausserhalb ist untersagt.</li>
        </ul>
      </div>
      <div class="info-item time-info">
        <h2>Wann?</h2>
        <ul>
          <li>• <a href="#alle-vorstellungen">Mai bis September</a></li>
          <li>• Nur bei schönem Wetter</li> 
          <li>• Allfällige Absagen am Vorstellungstag um 12:00 Uhr</li>
          <li>• Aktueller Status auf der Webseite oder als E-Mail-Benachrichtigung</li>
        </ul>
      </div>
      <div class="info-item additional-info">
        <h2>Weiteres</h2>
        <ul>
          <li>• 120 Minuten Rundgang zu Fuss</li>
          <li>• Keine Anmeldung nötig</li>
          <li>• Kollekte</li>
          <li>• Nicht rollstuhlgängig</li>
          <li>• Versicherung ist Sache der Teilnehmenden</li>
        </ul>
      </div>
    </section>

    <section class="hanging-pictures right">
        <img src="assets/images/20250623-DSC_0130.jpg" alt="Tanzspaziergang Bild 3" class="image animate-picture">
    </section>

    <section class="statement-section left-section animated-text-section left-aligned">
      <div class="quote-header">
        <img src="assets/images/christina/20250727_160617.jpg" alt="Was Teilnehmer sagen" class="quote-image">
        <p>Christina Schopfer, Tanzlehrerin TanzbeWEGung Boll</p>
        </div>
        <p class="quote-text">«Sowohl beim Unterrichten als auch hier in Utzigen ist es mir ein Herzensanliegen, Kunst gemeinsam zu erschaffen und zu erleben. Draussen in der Natur verbindet der Tanz, der Text und die Musik uns Menschen und lässt den Moment zu einem kleinen Wunder werden.»</p>
    
    </section>

    <section class="hanging-pictures left">
        <img src="assets/images/20250623-DSC_0433.jpg" alt="Tanzspaziergang Bild 4" class="image animate-picture">
    </section>

    <section class="info-section right-section animated-text-section right-aligned" id="alle-vorstellungen">
      <h2>Vorstellungen</h2>
      <div class="flex">
            <div class="info-item mai-dates">
              <h3>Mai</h3>
              <ul>
              <li>• Fr, 01.05.2026 17:00 Uhr</li> <!-- Matches dropdown -->
              <li>• Fr, 29.05.2026 18:00 Uhr</li> <!-- Matches dropdown -->
              </ul>
            </div>

          <div class="info-item juni-dates">
          <h3>Juni</h3>
          <ul>
            <li>• Fr, 05.06.2026 19:00 Uhr</li> <!-- Matches dropdown -->
            <li>• Fr, 19.06.2026 19:00 Uhr</li> <!-- Matches dropdown -->
            <li>• Fr, 26.06.2026 19:00 Uhr</li> <!-- Matches dropdown -->
          </ul>
            </div>
            <div class="info-item august-dates">
          <h3>August</h3>
          <ul>
            <li>• Fr, 14.08.2026 18:00 Uhr</li> <!-- Matches dropdown -->
            <li>• Fr, 21.08.2026 18:00 Uhr</li> <!-- Matches dropdown -->
            <li>• Fr, 28.08.2026 18:00 Uhr</li> <!-- Matches dropdown -->
          </ul>
            </div>
            <div class="info-item september-dates">
          <h3>September</h3>
          <ul>
            <li>• Fr, 04.09.2026 17:00 Uhr</li> <!-- Matches dropdown -->
            <li>• Fr, 11.09.2026 17:00 Uhr</li> <!-- Matches dropdown -->
            <li>• Fr, 18.09.2026 17:00 Uhr</li> <!-- Matches dropdown -->
          </ul>
        </div>
      </div>  
    
    </section>

    <section class="hanging-pictures right">
        <img src="assets/images/20250623-DSC_0298.jpg" alt="Tanzspaziergang Bild 3" class="image animate-picture">
    </section>

    <section class="newsletter-section newsletter-section-bottom animated-text-section" id="bottom">
      <div>
        <h1>Erinnerung erhalten</h1>
      </div>
      <p>Wir informieren Sie am Aufführungstag um 12:00 Uhr, ob die Vorstellung stattfindet.</p>
      <div class="credentials-box">
        <form class="newsletter-form">
          <label for="name-bottom">Name:</label>
          <input type="text" id="name-bottom" name="name" required>
          <label for="email-bottom">E-Mail:</label>
          <input type="email" id="email-bottom" name="email" required>
          <input type="text" name="middle_name" class="middle-name" tabindex="-1" autocomplete="off">

          <div class="date-selection">
            <label>Wählen Sie Ihre Vorstellungen:</label>
            <div class="checkbox-dropdown-container">
              <button type="button" class="dropdown-toggle" aria-expanded="false" aria-controls="date-checkbox-list-bottom">
                Vorstellungen auswählen
              </button>
              <div id="date-checkbox-list-bottom" class="dropdown-list">
                <ul>
                <li><h4 class="category-header">Mai</h4></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-05-01"> Fr, 01.05.2026 17:00 Uhr</label></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-05-29"> Fr, 29.05.2026 18:00 Uhr</label></li>
                <li><h4 class="category-header">Juni</h4></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-06-05"> Fr, 05.06.2026 19:00 Uhr</label></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-06-19"> Fr, 19.06.2026 19:00 Uhr</label></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-06-26"> Fr, 26.06.2026 19:00 Uhr</label></li>
                <li><h4 class="category-header">August</h4></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-08-14"> Fr, 14.08.2026 18:00 Uhr</label></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-08-21"> Fr, 21.08.2026 18:00 Uhr</label></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-08-28"> Fr, 28.08.2026 18:00 Uhr</label></li>
                <li><h4 class="category-header">September</h4></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-09-04"> Fr, 04.09.2026 17:00 Uhr</label></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-09-11"> Fr, 11.09.2026 17:00 Uhr</label></li>
                <li class="date-item"><label><input type="checkbox" name="dates[]" value="2026-09-18"> Fr, 18.09.2026 17:00 Uhr</label></li>
                </ul>
              </div>
            </div>
          </div>

          <!-- NEW: Subscription Checkbox -->
          <div class="subscription-checkbox">
              <label>
                  <input type="checkbox" name="subscribe_updates" value="1">
                  Ja, ich möchte über weitere Veranstaltungen informiert werden.
              </label>
          </div>
          <div class="submit-button-container">
            <p class="acknowledge">Mit Klick auf "Anmelden" stimmen Sie der <a href="privacy.html" rel="noopener noreferrer">Datenschutzerklärung</a> zu.</p>
            <button type="submit">Anmelden</button>
          </div>
        </form>
      </div>
    </section>

    <footer>
      <a href="privacy.html" class="privacy-link">Datenschutzerklärung</a>
      <div class="social-media">
        <a href="https://www.instagram.com/tanzbewegung.boll" target="_blank" rel="noopener noreferrer" aria-label="Follow us on Instagram">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM12 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
        </svg>
        </a>
      </div>
    </footer>

  </main>

  <script src="script.js"></script>
  </body>
  </html>
