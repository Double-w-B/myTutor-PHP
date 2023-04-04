import * as utils from "./utils.js";

const tutorialDesc = document.querySelector("#desc");
const buttonShowMore = document.querySelector("#show-more");
const formEnrollNow = document.querySelector("section form");
const buttonEnrollNow = formEnrollNow.querySelector("button");
const id = window.location.search.split("=")[1];
const requestOptions = {};

let responseDesc;

async function handleOnload() {
  try {
    const response = await fetch(`/tutorials/tutorial-data?id=${id}`);
    const data = await response.json();
    responseDesc = data.tutorial.tutorial_desc;
  } catch (error) {
    console.log(error);
  }
}

function handleShowMore() {
  if (buttonShowMore.textContent === "Show More") {
    tutorialDesc.textContent = responseDesc;
    buttonShowMore.textContent = "Show Less";
  } else {
    tutorialDesc.textContent = `${responseDesc.substr(0, 200)} ...`;
    buttonShowMore.textContent = "Show More";
  }
}

function handleEnrollNow() {
  utils.addLoadingAnimation(buttonEnrollNow);
}

async function handleSubmitEnrollNow(e) {
  e.preventDefault();

  const formData = new FormData(this);
  requestOptions.method = "POST";
  requestOptions.body = formData;

  try {
    await fetch("/tutorials/tutorial-data", requestOptions);

    setTimeout(() => {
      window.location.assign(`/tutorials-user/tutorial-user?id=${id}`);
    }, 500);
  } catch (error) {
    console.log(error);
  }
}

window.addEventListener("load", handleOnload);
buttonShowMore?.addEventListener("click", handleShowMore);
buttonEnrollNow.addEventListener("click", handleEnrollNow);
formEnrollNow.addEventListener("submit", handleSubmitEnrollNow);
