import * as utils from "./utils.js";

const form = document.querySelector("form");
const formInputs = form.querySelectorAll("input");

function handleButtonClick(e) {
  if (e.target.tagName !== "BUTTON" && e.target.type !== "submit") return;

  const allInputsFilled = Array.from(formInputs).every((input) => input.value);

  if (!allInputsFilled) return;

  form.addEventListener("submit", (e) => e.preventDefault());

  utils.addLoadingAnimation(e.target);

  setTimeout(() => {
    form.submit();
  }, 500);
}

form.addEventListener("click", handleButtonClick);
