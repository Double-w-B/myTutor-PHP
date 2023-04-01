const nav = document.querySelector("nav");
const main = document.querySelector("main");
const header = document.querySelector("header");
const headerMenuIcon = header.querySelector("button img");

function showMenu() {
  nav.classList.toggle("active");
  main.classList.toggle("active-nav");
  header.classList.toggle("active-nav");

  if (nav.classList.contains("active")) {
    headerMenuIcon.src = "../assets/icon-close.svg";
  } else {
    headerMenuIcon.src = "../assets/icon-bars-menu.svg";
  }
}

headerMenuIcon.addEventListener("click", showMenu);

