const currentPath = window.location.pathname;
const mLinks = document.getElementById('menu-links');
const anchorElements = mLinks.getElementsByTagName('a');

for (let i = 0; i < anchorElements.length; i++) {
  const link = anchorElements[i];
  const linkPath = link.pathname;

  if (linkPath === currentPath) {
    link.classList.add('active');
    break;
  }
}