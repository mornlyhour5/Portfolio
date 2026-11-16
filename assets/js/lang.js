// Language: English or Khmer. Both copies are in the page and only the chosen one is shown.
// The small script in the page head picks the starting language before anything is painted.
(() => {
  const root = document.documentElement;
  const select = document.getElementById('lang-select');
  const KEY = 'portfolio-lang';

  // The menu and form placeholders follow the current language
  function sync() {
    const km = root.lang === 'km';
    select.value = km ? 'km' : 'en';
    document.querySelectorAll('[data-ph-en]').forEach((el) => {
      el.placeholder = km ? el.dataset.phKm : el.dataset.phEn;
    });
  }

  select.addEventListener('change', () => {
    const next = select.value === 'km' ? 'km' : 'en';
    root.lang = next;
    try {
      localStorage.setItem(KEY, next);
    } catch (err) {
      // Storage blocked (private window): the choice lasts for this visit only
    }
    sync();
    document.dispatchEvent(new Event('langchange'));
  });

  sync();
})();
