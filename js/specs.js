document.addEventListener('click', function (e) {
  const tab = e.target.closest('.mp-specs__tab');
  if (!tab) return;

  const root = tab.closest('.mp-specs');
  if (!root) return;

  const tabs = root.querySelectorAll('.mp-specs__tab');
  const panels = root.querySelectorAll('.mp-specs__panel');
  const idx = tab.getAttribute('data-tab');

  tabs.forEach(t => {
    const active = (t === tab);
    t.classList.toggle('is-active', active);
    t.setAttribute('aria-selected', active ? 'true' : 'false');
    t.setAttribute('tabindex', active ? '0' : '-1');
  });

  panels.forEach(p => {
    const active = (p.getAttribute('data-panel') === idx);
    p.classList.toggle('is-active', active);
    if (active) p.removeAttribute('hidden');
    else p.setAttribute('hidden', '');
  });
});
