/**
 * Powder Testing Properties interactive chart.
 * Extracted verbatim from the Elementor HTML widget on the FT4 product page.
 */
( function () {
'use strict';
const container = document.querySelector('.container');
    const primaryCircles = document.querySelectorAll('.primary-circle');
    const secondaryCircles = document.querySelectorAll('.secondary-circle');

    let activeCategory = null;
    let timers = [];

    function clearTimers() {
      timers.forEach((t) => clearTimeout(t));
      timers = [];
    }

    function hideAllSecondary() {
      clearTimers();
      secondaryCircles.forEach((s) => s.classList.remove('visible'));
      primaryCircles.forEach((p) => p.setAttribute('aria-expanded', 'false'));
      activeCategory = null;
    }

    function showCategory(category) {
      clearTimers();

      // Toggle close if same category (helpful for mobile)
      if (activeCategory === category) {
        hideAllSecondary();
        return;
      }

      activeCategory = category;

      secondaryCircles.forEach((s) => s.classList.remove('visible'));

      const relevant = document.querySelectorAll(`[data-parent="${category}"]`);
      relevant.forEach((circle, index) => {
        const t = setTimeout(() => circle.classList.add('visible'), index * 80);
        timers.push(t);
      });

      primaryCircles.forEach((p) => p.setAttribute('aria-expanded', 'false'));
      const activePrimary = document.querySelector(`.primary-circle[data-category="${category}"]`);
      if (activePrimary) activePrimary.setAttribute('aria-expanded', 'true');
    }

    // Make primaries behave like buttons (hover + click/tap + keyboard)
    primaryCircles.forEach((primary) => {
      primary.setAttribute('role', 'button');
      primary.setAttribute('tabindex', '0');
      primary.setAttribute('aria-expanded', 'false');

      const category = primary.dataset.category;

      const activate = () => showCategory(category);

      primary.addEventListener('mouseenter', activate);
      primary.addEventListener('focus', activate);

      primary.addEventListener('click', (e) => {
        e.preventDefault();
        activate();
      });

      primary.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          activate();
        }
        if (e.key === 'Escape') hideAllSecondary();
      });
    });

    // Keep relevant secondaries visible when hovering/focusing on a secondary
    secondaryCircles.forEach((secondary) => {
      const parent = secondary.dataset.parent;

      const keepOpen = () => {
        if (!parent) return;
        const relevant = document.querySelectorAll(`[data-parent="${parent}"]`);
        relevant.forEach((c) => c.classList.add('visible'));
        activeCategory = parent;
      };

      secondary.addEventListener('mouseenter', keepOpen);
      secondary.addEventListener('focus', keepOpen);
    });

    // Hide when leaving container (desktop)
    container.addEventListener('mouseleave', hideAllSecondary);

    // Hide on outside click (mobile)
    document.addEventListener('click', (e) => {
      if (!container.contains(e.target)) hideAllSecondary();
    });

    // Escape closes anywhere
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') hideAllSecondary();
    });
} )();
