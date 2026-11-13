// Theme: light and dark mode. Saves the choice on the page and tells the galaxy when it changes.
(() => {
  const root = document.documentElement;
  const toggle = document.getElementById('theme-toggle');
  const darkQuery = window.matchMedia('(prefers-color-scheme: dark)');

  function currentTheme() {
    const explicit = root.getAttribute('data-theme');
    if (explicit === 'light' || explicit === 'dark') return explicit;
    return darkQuery.matches ? 'dark' : 'light';
  }

  // Sun while in dark mode (click for light), moon while in light mode (click for dark)
  const ICON_SUN = '<svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/></svg>';
  const ICON_MOON = '<svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg>';

  // Button labels in each language; "dark" is the action shown while the page is in dark mode
  const ACTION = {
    en: { dark: 'Switch to light mode', light: 'Switch to dark mode' },
    km: { dark: 'ប្តូរទៅរបៀបភ្លឺ', light: 'ប្តូរទៅរបៀបងងឹត' },
  };

  function labelToggle() {
    const dark = currentTheme() === 'dark';
    const lang = root.lang === 'km' ? 'km' : 'en';
    const action = ACTION[lang][dark ? 'dark' : 'light'];
    toggle.innerHTML = dark ? ICON_SUN : ICON_MOON;
    toggle.setAttribute('aria-label', action);
    toggle.title = action;
  }

  // The galaxy reads the current theme through this function
  window.currentTheme = currentTheme;

  toggle.addEventListener('click', () => {
    root.setAttribute('data-theme', currentTheme() === 'dark' ? 'light' : 'dark');
    labelToggle();
    document.dispatchEvent(new Event('themechange'));
  });
  darkQuery.addEventListener('change', () => {
    labelToggle();
    document.dispatchEvent(new Event('themechange'));
  });
  document.addEventListener('langchange', labelToggle);

  labelToggle();
})();
