import * as utils from "./utils.js";

const modalBackdrop = document.querySelector(".modal__backdrop");
const modalDeleteAcc = modalBackdrop.querySelector(".modal__delete-account");

const deleteAccBtn = document.querySelector("div.account-delete button");
const deleteAccForm = modalDeleteAcc.querySelector("form");
const deleteAccInput = deleteAccForm.querySelector("input");
const deleteAccCloseBtn = modalDeleteAcc.querySelector("img");
const deleteAccDeleteBtn = modalDeleteAcc.querySelector(
  "button[type='submit']"
);

const requestOptions = {};
let isError = false;

function showError(p, img) {
  isError = true;
  p.classList.add("active");
  img.classList.add("active");

  setTimeout(() => {
    p.classList.remove("active");
    img.classList.remove("active");
    isError = false;
  }, 1500);
}

function handleModalDelete(boolean) {
  deleteAccInput.value = "";
  modalBackdrop.classList.toggle("show", boolean);
  modalDeleteAcc.classList.toggle("show", boolean);
}

function handleBackdropClick(e) {
  if (e.target !== modalBackdrop) return;
  handleModalDelete(false);
}

async function handleDeleteAcc(e) {
  e.preventDefault();

  const infoElm = deleteAccForm.querySelector("p");
  const infoIcon = deleteAccForm.querySelector("img");
  const input = deleteAccForm.querySelector("input");

  const formData = new FormData(this);
  requestOptions.method = "POST";
  requestOptions.body = formData;

  if (!input.value) {
    infoElm.textContent = "Please provide value";
    showError(infoElm, infoIcon);
  }

  if (!isError) {
    utils.addLoadingAnimation(deleteAccDeleteBtn);

    try {
      const response = await fetch("account.logic.php", requestOptions);

      if (!response.ok) {
        setTimeout(() => {
          deleteAccDeleteBtn.textContent = "delete";
          if (response.status === 401) {
            infoElm.textContent = "Invalid credentials";
            showError(infoElm, infoIcon);
          }
        }, 1000);

        return;
      }

      setTimeout(() => {
        window.location.assign("index.php");
      }, 1000);
    } catch (error) {
      console.log(error);
    }
  }
}

modalBackdrop.addEventListener("click", handleBackdropClick);
deleteAccForm.addEventListener("submit", handleDeleteAcc);
deleteAccBtn.addEventListener("click", () => handleModalDelete(true));
deleteAccCloseBtn.addEventListener("click", () => handleModalDelete(false));
