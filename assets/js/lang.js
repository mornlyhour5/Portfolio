// Language switch: English or Khmer. Both copies are in the page and only the chosen one is shown.
// The small script in the page head picks the starting language before anything is painted.
(() => {
  const root = document.documentElement;
  const toggle = document.getElementById('lang-toggle');
  const KEY = 'portfolio-lang';

  // Button text and labels, and form placeholders, follow the current language
  function sync() {
    const km = root.lang === 'km';
    toggle.textContent = km ? 'EN' : 'KH';
    const action = km ? 'ប្តូរទៅភាសាអង់គ្លេស' : 'Switch language to Khmer';
    toggle.setAttribute('aria-label', action);
    toggle.title = action;
    document.querySelectorAll('[data-ph-en]').forEach((el) => {
      el.placeholder = km ? el.dataset.phKm : el.dataset.phEn;
    });
  }

  toggle.addEventListener('click', () => {
    const next = root.lang === 'km' ? 'en' : 'km';
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
