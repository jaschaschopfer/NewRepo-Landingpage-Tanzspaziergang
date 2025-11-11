// script.js

document.addEventListener('DOMContentLoaded', () => {
    // --- DROPDOWN LOGIC ---
    // This logic needs to apply to both forms on the page (top and bottom)
    const allDropdownContainers = document.querySelectorAll('.checkbox-dropdown-container');

    allDropdownContainers.forEach(container => {
        const toggleButton = container.querySelector('.dropdown-toggle');
        const dropdownList = container.querySelector('.dropdown-list');
        const checkboxes = dropdownList.querySelectorAll('input[type="checkbox"]');

        function toggleDropdown(show) {
            const shouldShow = (show === undefined) ? !dropdownList.classList.contains('active') : show;
            if (shouldShow) {
                dropdownList.classList.add('active');
                toggleButton.setAttribute('aria-expanded', 'true');
            } else {
                dropdownList.classList.remove('active');
                toggleButton.setAttribute('aria-expanded', 'false');
            }
        }

        function updateButtonText() {
            const checkedCount = dropdownList.querySelectorAll('input[type="checkbox"]:checked').length;
            if (checkedCount === 0) {
                toggleButton.textContent = 'Termine auswählen';
            } else if (checkedCount === 1) {
                toggleButton.textContent = '1 Termin ausgewählt';
            } else {
                toggleButton.textContent = `${checkedCount} Termine ausgewählt`;
            }
        }

        toggleButton.addEventListener('click', (event) => {
            event.stopPropagation();
            toggleDropdown();
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateButtonText);
        });
        
        updateButtonText(); // Set initial button text
    });
    
    // Global listener to close dropdowns when clicking outside
    document.addEventListener('click', (event) => {
        const activeDropdown = document.querySelector('.dropdown-list.active');
        if (activeDropdown && !event.target.closest('.checkbox-dropdown-container')) {
            activeDropdown.classList.remove('active');
            activeDropdown.previousElementSibling.setAttribute('aria-expanded', 'false');
        }
    });


    // // --- SCROLL ANIMATION LOGIC ---
    // const selectorList = [
    //     'section:not(:first-child)', 'main h1', 'main h2', 'main p',
    //     'main blockquote', 'section.hanging-pictures .image', 'main form'
    // ];
    // const animatedElements = document.querySelectorAll(selectorList.join(', '));
    // if (animatedElements.length > 0) {
    //     const observer = new IntersectionObserver((entries, observer) => {
    //         entries.forEach(entry => {
    //             if (entry.isIntersecting) {
    //                 entry.target.classList.add('is-visible');
    //                 observer.unobserve(entry.target);
    //             }
    //         });
    //     }, { threshold: 0.05, rootMargin: "0px 0px -30px 0px" });
    //     animatedElements.forEach(element => observer.observe(element));
    // }

    
    // -----------------------------------------------------------------
    // --- NEW: FORM SUBMISSION (AJAX with Fetch) ---
    // -----------------------------------------------------------------
    const allForms = document.querySelectorAll('.newsletter-form');
    const thankYouSection = document.querySelector('.thank-you-section');

    allForms.forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Stop the default page reload

            const submitButton = form.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.textContent;
            submitButton.textContent = 'Sending...';
            submitButton.disabled = true;

            // Create a FormData object from the submitted form
            const formData = new FormData(form);

            // Send the form data to the PHP script
            fetch('submit_form.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())       
            .then(data => {
                if (data.success) {
                    // On success, hide both form sections and show the thank you message
                    document.querySelectorAll('.newsletter-section').forEach(section => {
                        section.classList.add('hidden');
                    });
                    
                    // --- NEW: Update the thank you message dynamically ---
                    const thankYouMessageElement = thankYouSection.querySelector('h2');
                    if (thankYouMessageElement) {
                        thankYouMessageElement.textContent = data.message; // Use message from server
                    }
                    
                    thankYouSection.classList.add('visible');
                } else {
                    // On failure, show an alert with the error from the server
                    alert('Error: ' + data.message);
                    submitButton.textContent = originalButtonText;
                    submitButton.disabled = false;
                }
            })
            .catch(error => {
                // Handle network errors
                console.error('Submission error:', error);
                alert('A network error occurred. Please try again.');
                submitButton.textContent = originalButtonText;
                submitButton.disabled = false;
            });
        });
    });
});


// Animation

document.addEventListener('DOMContentLoaded', () => {
  const pictures = document.querySelectorAll('.animate-picture');
  const textSections = document.querySelectorAll('.animated-text-section');
  const typewriters = document.querySelectorAll('.typewriter');

  let lastScrollY = window.scrollY || 0;

  function getVisiblePercent(el) {
    const rect = el.getBoundingClientRect();
    const windowHeight = window.innerHeight || document.documentElement.clientHeight;
    const topVisible = Math.min(rect.bottom, windowHeight) - Math.max(rect.top, 0);
    return (topVisible > 0 ? (topVisible / rect.height) * 100 : 0);
  }

  // Picture animation logic with scroll direction and visibility thresholds
  function animatePictures(scrollDown) {
    pictures.forEach(picture => {
      const section = picture.closest('section') || picture.parentElement;
      const rect = section.getBoundingClientRect();
      const windowHeight = window.innerHeight || document.documentElement.clientHeight;

      if (scrollDown) {
        // Scrolling down:
        // Show when 33% of section enters from top
        // Hide when top 66% of section scrolled past (out of viewport)
        const topPercentVisible = ((rect.bottom - 0) / rect.height) * 100; // % of section below top of viewport (may be > 100)
        if (topPercentVisible >= 33 && rect.top < windowHeight) {
          picture.classList.add('active');
          picture.classList.remove('fading-out');
        } else if (rect.top < -0.66 * rect.height) { // top 66% out of view
          picture.classList.add('fading-out');
          picture.classList.remove('active');
        }
      } else {
        // Scrolling up:
        // Show when bottom 33% of section enters viewport
        // Hide when bottom 66% is out of view (above viewport)
        const bottomVisible = rect.bottom;
        if (bottomVisible > windowHeight * (1 - 0.33) && bottomVisible <= windowHeight) {
          picture.classList.add('active');
          picture.classList.remove('fading-out');
        } else if (bottomVisible <= windowHeight * (1 - 0.66)) {
          picture.classList.add('fading-out');
          picture.classList.remove('active');
        }
      }
    });
  }

  // Animate text sections once, slide/fade in from their alignment side
  function animateTextSections() {
    textSections.forEach(section => {
      const visiblePercent = getVisiblePercent(section);
      if (visiblePercent >= 33 && !section.classList.contains('active')) {
        section.classList.add('active');
        const heading = section.querySelector('.typewriter');
        if (heading && !heading.classList.contains('typed')) {
          // Restart typewriter animation reflow trick
          heading.style.animation = 'none';
          heading.offsetHeight; // reflow
          heading.style.animation = null;
          heading.classList.add('typed'); // mark so it doesn't repeat
        }
      }
    });
  }

  // Main scroll handler
  function onScroll() {
    const currentScrollY = window.scrollY || 0;
    const scrollDown = currentScrollY > lastScrollY;
    animatePictures(scrollDown);
    animateTextSections();
    lastScrollY = currentScrollY;
  }

  // Initial run
  onScroll();

  // Debounce scroll events for performance
  let scrollTimeout = null;
  window.addEventListener('scroll', () => {
    if (!scrollTimeout) {
      scrollTimeout = setTimeout(() => {
        onScroll();
        scrollTimeout = null;
      }, 100);
    }
  });
});
