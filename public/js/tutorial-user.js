import * as utils from "./utils.js";

const tutorialDesc = document.querySelector("#desc");
const buttonShowMore = document.querySelector("#show-more");
const tutorialId = window.location.search.split("=")[1];
const buttonDeleteTutorial = document.querySelector("button.delete");
const checkButtons = document.querySelectorAll("article form");

const modalBackdrop = document.querySelector(".modal__backdrop");
const modalDeleteTutorial = modalBackdrop.querySelector(
  ".modal__remove-tutorial"
);
const modalDeleteQ = modalDeleteTutorial.querySelector("p span");
const reqInputData = modalDeleteTutorial.querySelector("input[type='hidden']");
const modalDeleteButton = modalDeleteTutorial.querySelector("button");
const modalDeleteForm = modalDeleteTutorial.querySelector("form");
const modalButtonClose = modalDeleteTutorial.querySelector("img");

const progressCircle = document.querySelector(".progress");
const progressPercentage = document.querySelector(".percentage");
const userProgress = new utils.UserProgress();

const requestOptions = {};
let tutorialDescription;

async function handleOnload() {
  try {
    const response = await fetch(
      `/tutorials-user/tutorial-user-data?id=${tutorialId}`
    );
    const data = await response.json();

    tutorialDescription = data.tutorial_desc;

    userProgress.totalSections = data.sections;
    userProgress.completedSections = data.sections_completed;

    if (data.sections_completed.length > 0) {
      userProgress.updateProgress(progressPercentage, progressCircle);
    }
  } catch (error) {
    console.log(error);
  }
}

function handleModal(boolean) {
  modalBackdrop.classList.toggle("show", boolean);
  modalDeleteTutorial.classList.toggle("show", boolean);
}

function handleBackdropClick(e) {
  if (e.target !== modalBackdrop) return;
  handleModal(false);
}

function handleShowMore() {
  if (buttonShowMore.textContent === "Show More") {
    tutorialDesc.textContent = tutorialDescription;
    buttonShowMore.textContent = "Show Less";
  } else {
    tutorialDesc.textContent = `${tutorialDescription.substr(0, 250)} ...`;
    buttonShowMore.textContent = "Show More";
  }
}

checkButtons.forEach((form) => {
  async function submitForm(e) {
    e.preventDefault();

    const button = form.querySelector("button");

    const formData = new FormData(this);
    requestOptions.method = "POST";
    requestOptions.body = formData;

    try {
      await fetch(
        `/tutorials-user/tutorial-user-data?id=${tutorialId}`,
        requestOptions
      );

      if (button.classList.contains("checked")) {
        button.classList.remove("checked");
        userProgress.completedSections.pop();
        userProgress.updateProgress(progressPercentage, progressCircle);
        return;
      }
      button.classList.add("checked");
      userProgress.completedSections.push(0);
      userProgress.updateProgress(progressPercentage, progressCircle);
    } catch (error) {
      console.log(error);
    }
  }

  form.addEventListener("submit", submitForm);
});

function handleButtonDeleteTutorial() {
  utils.addLoadingAnimation(buttonDeleteTutorial);
  reqInputData.value = tutorialId;
  setTimeout(() => {
    handleModal(true);
    const title = document.querySelector("section h1");
    modalDeleteQ.textContent = title.textContent;
    buttonDeleteTutorial.textContent = "delete tutorial";
  }, 250);
}

function handleModalDeleteButton() {
  utils.addLoadingAnimation(modalDeleteButton);
}

async function handleRemoveTutorial(e) {
  e.preventDefault();

  const formData = new FormData(this);
  requestOptions.method = "POST";
  requestOptions.body = formData;

  try {
    const response = await fetch(
      "/tutorials-user/tutorial-user-data",
      requestOptions
    );

    if (response.ok) {
      setTimeout(() => {
        window.location.assign(`/tutorials-user`);
      }, 500);
    }
  } catch (error) {
    console.log(error);
  }
}

window.addEventListener("load", handleOnload);
buttonShowMore?.addEventListener("click", handleShowMore);
buttonDeleteTutorial.addEventListener("click", handleButtonDeleteTutorial);
modalBackdrop.addEventListener("click", handleBackdropClick);
modalButtonClose.addEventListener("click", () => handleModal(false));
modalDeleteForm.addEventListener("submit", handleRemoveTutorial);
modalDeleteButton.addEventListener("click", handleModalDeleteButton);
