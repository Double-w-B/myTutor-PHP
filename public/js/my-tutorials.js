import * as utils from "./utils.js";

const section = document.querySelector("section");
const modalBackdrop = document.querySelector(".modal__backdrop");
const modalRemoveTutorial = modalBackdrop.querySelector(
  ".modal__remove-tutorial"
);
const removeTutorialQ = modalRemoveTutorial.querySelector("p span");
const reqInputData = modalRemoveTutorial.querySelector("input[type='hidden']");
const buttonDelete = modalRemoveTutorial.querySelector("button");
const buttonClose = modalRemoveTutorial.querySelector("img");
const requestOptions = {};

let tutorialId = "";

function handleModal(boolean) {
  modalBackdrop.classList.toggle("show", boolean);
  modalRemoveTutorial.classList.toggle("show", boolean);
}

function handleBackdropClick(e) {
  if (e.target !== modalBackdrop) return;
  handleModal(false);
}

function handleSectionClick(e) {
  if (e.target.tagName !== "BUTTON") return;

  const tutorial = e.target.closest(".tutorial");
  const tutorialTitle = tutorial.querySelector(".tutorial-details__content h4");
  tutorialId = tutorial.id;
  removeTutorialQ.textContent = tutorialTitle.textContent;
  reqInputData.value = tutorial.id;
  handleModal(true);
}

async function handleDeleteButton(e) {
  e.preventDefault();

  utils.addLoadingAnimation(buttonDelete);

  const formData = new FormData(this);
  requestOptions.method = "POST";
  requestOptions.body = formData;

  try {
    const allTutorials = document.querySelectorAll(".tutorial");
    const response = await fetch("/my-tutorials", requestOptions);

    if (!response.ok) {
      buttonDelete.textContent = "delete";
      return;
    }

    setTimeout(() => {
      Array.from(allTutorials)
        .find((tutor) => tutor.id === tutorialId)
        .remove();
    }, 500);

    setTimeout(() => {
      if (section.children.length === 0) {
        section.remove();
        utils.createCallToAction();
      }

      handleModal(false);
      buttonDelete.textContent = "delete";
    }, 1000);
  } catch (error) {
    console.log(error);
  }
}

section.addEventListener("click", handleSectionClick);
modalBackdrop.addEventListener("click", handleBackdropClick);
buttonDelete.closest("form").addEventListener("submit", handleDeleteButton);
buttonClose.addEventListener("click", () => handleModal(false));
