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

  function labelToggle() {
    toggle.textContent = currentTheme() === 'dark' ? 'Light mode' : 'Dark mode';
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

  labelToggle();
})();
