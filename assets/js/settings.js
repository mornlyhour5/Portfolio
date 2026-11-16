// Settings drop-down in the navigation: colour, stars and language. It opens from the round gear button.
// Each choice is a styled list. The native select under it still holds the value, and a choice fires the same
// change event as before, so the colour, stars and language scripts do not need to change.
(() => {
  const root = document.documentElement;
  const button = document.getElementById('settings-toggle');
  const panel = document.getElementById('settings-panel');
  if (!button || !panel) return;

  const drops = [];

  function setOpen(open) {
    panel.hidden = !open;
    button.setAttribute('aria-expanded', String(open));
    if (!open) drops.forEach((d) => d.close());
  }

  // A choice shows its Khmer name on the Khmer page, when it has one
  function labelOf(option) {
    if (!option.dataset.en) return option.textContent;
    return root.lang === 'km' ? option.dataset.km : option.dataset.en;
  }

  function makeDrop(select) {
    const label = document.querySelector(`label[for="${select.id}"]`);
    const wrap = document.createElement('div');
    wrap.className = 'dd';

    const trigger = document.createElement('button');
    trigger.type = 'button';
    trigger.className = 'dd-trigger';
    trigger.id = `${select.id}-button`;
    trigger.setAttribute('aria-haspopup', 'listbox');
    trigger.setAttribute('aria-expanded', 'false');
    trigger.innerHTML = '<span class="dd-value"></span>'
      + '<svg class="dd-caret" viewBox="0 0 12 12" aria-hidden="true"><path d="M2.5 4.5 6 8l3.5-3.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>';

    const menu = document.createElement('ul');
    menu.className = 'dd-menu glass';
    menu.id = `${select.id}-menu`;
    menu.setAttribute('role', 'listbox');
    menu.hidden = true;
    trigger.setAttribute('aria-controls', menu.id);
    if (label) label.htmlFor = trigger.id;

    const items = [...select.options].map((option) => {
      const li = document.createElement('li');
      li.setAttribute('role', 'option');
      li.tabIndex = -1;
      li.addEventListener('click', () => pick(option.value));
      menu.append(li);
      return li;
    });

    wrap.append(trigger, menu);
    select.hidden = true;
    select.insertAdjacentElement('afterend', wrap);

    // Show the current choice on the button and mark it in the list
    function render() {
      const current = select.options[select.selectedIndex];
      trigger.querySelector('.dd-value').textContent = current ? labelOf(current) : '';
      items.forEach((li, i) => {
        const option = select.options[i];
        const on = option.value === select.value;
        li.textContent = labelOf(option);
        li.setAttribute('aria-selected', String(on));
        li.classList.toggle('is-selected', on);
      });
    }

    function isOpen() {
      return !menu.hidden;
    }

    function close() {
      if (menu.hidden) return;
      menu.hidden = true;
      trigger.setAttribute('aria-expanded', 'false');
    }

    function open() {
      drops.forEach((d) => d.close());
      menu.hidden = false;
      trigger.setAttribute('aria-expanded', 'true');
      const current = items.find((li) => li.getAttribute('aria-selected') === 'true') || items[0];
      current.focus();
    }

    function pick(value) {
      if (select.value !== value) {
        select.value = value;
        select.dispatchEvent(new Event('change'));
      }
      render();
      close();
      trigger.focus();
    }

    trigger.addEventListener('click', () => (menu.hidden ? open() : close()));
    trigger.addEventListener('keydown', (e) => {
      if (e.key === 'ArrowDown' && menu.hidden) {
        e.preventDefault();
        open();
      }
    });
    menu.addEventListener('keydown', (e) => {
      const index = items.indexOf(document.activeElement);
      const last = items.length - 1;
      if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
        e.preventDefault();
        const next = e.key === 'ArrowDown' ? Math.min(last, index + 1) : Math.max(0, index - 1);
        items[next].focus();
      } else if (e.key === 'Home' || e.key === 'End') {
        e.preventDefault();
        items[e.key === 'Home' ? 0 : last].focus();
      } else if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        if (index >= 0) pick(select.options[index].value);
      } else if (e.key === 'Tab') {
        close();
      }
    });
    select.addEventListener('change', render);

    const drop = { wrap, trigger, close, isOpen, render };
    drops.push(drop);
    render();
    return drop;
  }

  button.addEventListener('click', () => setOpen(panel.hidden));

  // A click outside the menu closes it, and a click outside a list closes that list
  document.addEventListener('click', (e) => {
    if (panel.hidden) return;
    if (!e.target.closest('.settings')) {
      setOpen(false);
      return;
    }
    drops.forEach((d) => {
      if (!d.wrap.contains(e.target)) d.close();
    });
  });

  // Escape closes an open list first (focus goes back to its button), then the menu
  document.addEventListener('keydown', (e) => {
    if (e.key !== 'Escape' || panel.hidden) return;
    const openDrop = drops.find((d) => d.isOpen());
    if (openDrop) {
      openDrop.close();
      openDrop.trigger.focus();
      return;
    }
    setOpen(false);
    button.focus();
  });

  ['theme-select', 'star-select', 'lang-select'].forEach((id) => {
    const select = document.getElementById(id);
    if (select) makeDrop(select);
  });

  // Menu labels follow the page language
  function sync() {
    const km = root.lang === 'km';
    panel.querySelectorAll('option[data-en]').forEach((option) => {
      option.textContent = km ? option.dataset.km : option.dataset.en;
    });
    const label = km ? 'ការកំណត់' : 'Settings';
    button.setAttribute('aria-label', label);
    button.title = label;
    drops.forEach((d) => d.render());
  }
  document.addEventListener('langchange', sync);
  sync();
})();
