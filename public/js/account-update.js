import * as utils from "./utils.js";

const dataUpdateForm = document.querySelector("form.data-update");
const userDataInputs = dataUpdateForm.querySelectorAll(
  "div input:nth-child(1)"
);
const dataUpdateInputs = dataUpdateForm.querySelectorAll(
  "div input:nth-child(2)"
);
const dataUpdateSubmitBtn = dataUpdateForm.querySelector(
  "button[type='submit']"
);

const modalBackdrop = document.querySelector(".modal__backdrop");
const modalUpdateData = modalBackdrop.querySelector(".modal__update-account");

const updateAccForm = modalUpdateData.querySelector("form");
const updateAccInput = updateAccForm.querySelector("input");
const updateAccCloseBtn = modalUpdateData.querySelector("img");
const updateAccDeleteBtn = modalUpdateData.querySelector(
  "button[type='submit']"
);
const emailRegExp = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
const requestOptions = {};
const inputsToUpdate = [];

let isError = false;
let isAuthorized = true;

function showSuccess(p) {
  p.textContent = "Updated!";
  p.classList.add("active", "success");

  setTimeout(() => {
    p.classList.remove("active", "success");
  }, 1500);
}

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

function handleModalUpdate(boolean) {
  updateAccInput.value = "";
  modalBackdrop.classList.toggle("show", boolean);
  modalUpdateData.classList.toggle("show", boolean);
}

function handleBackdropClick(e) {
  if (e.target !== modalBackdrop) return;
  handleModalUpdate(false);
}

function updateUserData(elm) {
  setTimeout(() => {
    dataUpdateInputs.forEach((input, index) => {
      if (input.value && input.name !== "password") {
        if (input.name === "name" || input.name === "lastName") {
          userDataInputs[index].value =
            input.value.slice(0, 1).toUpperCase() + input.value.slice(1);
        } else {
          userDataInputs[index].value = input.value;
        }
      }
      input.value = "";
    });

    dataUpdateInputs.forEach((input) => {
      const infoElm = input.parentElement.querySelector("p");
      if (inputsToUpdate.includes(input.name)) {
        showSuccess(infoElm);
      }
    });

    inputsToUpdate.length = 0;
    elm.textContent = "save";
    isAuthorized = true;

    if (elm === updateAccDeleteBtn) handleModalUpdate(false);
  }, 1000);
}

async function handleDataUpdateForm(e) {
  e.preventDefault();

  const dataUpdateInputsArray = Array.from(dataUpdateInputs);
  const allInputEmpty = dataUpdateInputsArray.every((input) => !input.value);

  if (allInputEmpty) {
    isError = true;
  } else {
    isError = false;
  }

  dataUpdateInputs.forEach((input) => {
    const infoElm = input.parentElement.querySelector("p");
    const infoIcon = input.parentElement.querySelector("img");

    if (
      input.value &&
      input.name !== "email" &&
      input.name !== "password" &&
      (input.value.length < 3 || input.value.length > 20)
    ) {
      infoElm.textContent = "Must be between 3 and 20 characters";
      showError(infoElm, infoIcon);
    }

    if (
      input.value &&
      input.name === "password" &&
      (input.value.length < 6 || input.value.length > 20)
    ) {
      infoElm.textContent = "Must be between 6 and 20 characters";
      showError(infoElm, infoIcon);
    }

    if (
      input.value &&
      input.name === "email" &&
      !input.value.match(emailRegExp)
    ) {
      infoElm.textContent = "Provide valid email";
      showError(infoElm, infoIcon);
    }

    if (input.name === "email" && input.value) isAuthorized = false;
    if (input.name === "password" && input.value) isAuthorized = false;
  });

  if (!isError && !isAuthorized) {
    handleModalUpdate(true);
  }

  if (!isError && isAuthorized) {
    const formData = new FormData(this);
    requestOptions.method = "POST";
    requestOptions.body = formData;

    for (const pair of formData.entries()) {
      if (pair[1]) inputsToUpdate.push(pair[0]);
    }

    utils.addLoadingAnimation(dataUpdateSubmitBtn);

    try {
      const response = await fetch("account.logic.php", requestOptions);

      if (!response.ok) {
        setTimeout(() => {
          dataUpdateSubmitBtn.textContent = "save";
        }, 1000);
        return;
      }

      updateUserData(dataUpdateSubmitBtn);
    } catch (error) {
      console.log(error);
    }
  }
}

async function handleDataUpdateConfirm(e) {
  e.preventDefault();

  const infoElm = updateAccInput.parentElement.querySelector("p");
  const infoIcon = updateAccInput.parentElement.querySelector("img");

  if (!updateAccInput.value) {
    infoElm.textContent = "Please provide value";
    showError(infoElm, infoIcon);
  }

  if (!isError) {
    const formData = new FormData();
    dataUpdateInputs.forEach((input) =>
      formData.append(input.name, input.value)
    );
    formData.append(updateAccInput.name, updateAccInput.value);
    requestOptions.method = "POST";
    requestOptions.body = formData;

    for (const pair of formData.entries()) {
      if (pair[1] !== "") inputsToUpdate.push(pair[0]);
    }

    utils.addLoadingAnimation(updateAccDeleteBtn);

    try {
      const response = await fetch("account.logic.php", requestOptions);

      if (!response.ok) {
        setTimeout(() => {
          updateAccDeleteBtn.textContent = "save";

          if (response.status === 401) {
            infoElm.textContent = "Invalid credentials";
            showError(infoElm, infoIcon);
          }
        }, 1000);
        return;
      }

      updateUserData(updateAccDeleteBtn);
    } catch (error) {
      console.log(error);
    }
  }
}

modalBackdrop.addEventListener("click", handleBackdropClick);
dataUpdateForm.addEventListener("submit", handleDataUpdateForm);
updateAccForm.addEventListener("submit", handleDataUpdateConfirm);
updateAccCloseBtn.addEventListener("click", () => handleModalUpdate(false));
