const menuButton = document.getElementById('menu');
const menuLinks = document.getElementById('menu-links');

menuButton.addEventListener('keydown', function (event) {
  if (event.key === 'Enter' || event.key === ' ') {
    event.preventDefault();
    toggleMenu();
  }
});
menuButton.addEventListener('click', function () {
    toggleMenu();
    menuButton.classList.toggle('open');
  });

function toggleMenu() {
  const isOpen = menuButton.getAttribute('aria-expanded') === 'true';

  if (isOpen) {
    menuButton.setAttribute('aria-expanded', 'false');
    menuLinks.classList.remove('open');
  } else {
    menuButton.setAttribute('aria-expanded', 'true');
    menuLinks.classList.add('open');
  }
}