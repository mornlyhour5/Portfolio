// Colour: follow the device, or light or dark. The choice is remembered on this device.
// The page head applies a saved light or dark choice before anything is painted.
(() => {
  const root = document.documentElement;
  const select = document.getElementById('theme-select');
  const darkQuery = window.matchMedia('(prefers-color-scheme: dark)');
  const KEY = 'portfolio-theme';

  function currentTheme() {
    const explicit = root.getAttribute('data-theme');
    if (explicit === 'light' || explicit === 'dark') return explicit;
    return darkQuery.matches ? 'dark' : 'light';
  }

  // The galaxy reads the current theme through this function
  window.currentTheme = currentTheme;

  function apply(choice) {
    if (choice === 'light' || choice === 'dark') root.setAttribute('data-theme', choice);
    else root.removeAttribute('data-theme');
    document.dispatchEvent(new Event('themechange'));
  }

  select.addEventListener('change', () => {
    const choice = select.value;
    try {
      localStorage.setItem(KEY, choice);
    } catch (err) {
      // Storage blocked (private window): the choice lasts for this visit only
    }
    apply(choice);
  });
  darkQuery.addEventListener('change', () => document.dispatchEvent(new Event('themechange')));

  // Show the saved choice in the menu
  let saved = 'system';
  try {
    saved = localStorage.getItem(KEY) || 'system';
  } catch (err) {
    // Storage blocked: follow the device
  }
  select.value = saved === 'light' || saved === 'dark' ? saved : 'system';
})();
