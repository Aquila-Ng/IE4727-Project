export function navbar() {
  const toggleMenu = () => {
    const menu = document.querySelector(".navbar-menu");
    menu.classList.toggle("active");
  };

  document.querySelector(".navbar-menu").addEventListener("click", toggleMenu);
}
