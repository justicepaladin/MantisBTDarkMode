(function () {
  function placeToggle() {
    var toggle = document.getElementById('mantisbt-darkmode-toggle');
    var menu = document.querySelector('#navbar .user-menu');
    if (!toggle || !menu) {
      return;
    }

    var item = document.createElement('li');
    item.className = 'mantisbt-darkmode-menu-item';
    menu.insertBefore(item, menu.querySelector('li.divider'));
    item.appendChild(toggle);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', placeToggle);
  } else {
    placeToggle();
  }
}());
