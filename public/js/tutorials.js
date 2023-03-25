import * as utils from "./utils.js";

const section = document.querySelector("section");

const requestOptions = {};

function handleSection(e) {
  if (e.target.tagName !== "BUTTON" && e.target.type !== "submit") return;

  const loadingAnimation = utils.createLoadingAnimation();
  e.target.textContent = "";
  e.target.append(loadingAnimation);

  e.target.closest("form").addEventListener("submit", async function (e) {
    e.preventDefault();

    const button = e.target.querySelector("button");

    const formData = new FormData(this);
    requestOptions.method = "POST";
    requestOptions.body = formData;

    try {
      await fetch("/tutorials", requestOptions);

      setTimeout(() => {
        button.firstElementChild.remove();
        button.textContent = "in progress";
        button.classList.add("active");
      }, 1000);
    } catch (error) {
      console.log(error);
    }
  });
}

section?.addEventListener("click", handleSection);
