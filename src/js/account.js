import * as utils from "./utils.js";
const dataUpdateForm = document.querySelector("form.data-update");
const dataInputs = dataUpdateForm.querySelectorAll("div input:nth-child(1)");
const dataUpdateInputs = dataUpdateForm.querySelectorAll(
  "div input:nth-child(2)"
);
const deleteAccountForm = document.querySelector("form.account-delete");

const requestOptions = {};

function addLoadingAnimation(elm) {
  const loadingAnimation = utils.createLoadingAnimation();
  elm.textContent = "";
  elm.append(loadingAnimation);
}

async function handleDataUpdateForm(e) {
  e.preventDefault();

  const submitButton = e.target.querySelector("button[type='submit']");
  const allInputEmpty = Array.from(dataUpdateInputs).every(
    (input) => !input.value
  );
  let isError = false;

  function showError(p, img) {
    p.classList.add("active");
    img.classList.add("active");

    setTimeout(() => {
      p.classList.remove("active");
      img.classList.remove("active");
      isError = false;
    }, 1500);
  }

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
      (input.value.length < 3 || input.value.length > 20)
    ) {
      infoElm.textContent = "Must be between 3 and 20 characters";
      isError = true;
      showError(infoElm, infoIcon);
      submitButton.textContent = "save";
    }

    if (
      input.value &&
      input.name === "email" &&
      !input.value.match(/^[^ ]+@[^ ]+\.[a-z]{2,3}$/)
    ) {
      infoElm.textContent = "Provide valid email";
      isError = true;
      showError(infoElm, infoIcon);
      submitButton.textContent = "save";
    }
  });

  const formData = new FormData(this);
  requestOptions.method = "POST";
  requestOptions.body = formData;

  if (!isError) {
    addLoadingAnimation(submitButton);

    try {
      const response = await fetch("account.logic.php", requestOptions);

      if (!response.ok) {
        setTimeout(() => {
          submitButton.textContent = "save";
        }, 1000);
        return;
      }

      setTimeout(() => {
        dataUpdateInputs.forEach((input, index) => {
          if (input.value && input.name !== "password") {
            if (input.name === "name" || input.name === "lastName") {
              dataInputs[index].value =
                input.value.slice(0, 1).toUpperCase() + input.value.slice(1);
            } else {
              dataInputs[index].value = input.value;
            }
          }
          input.value = "";
        });
        submitButton.textContent = "save";
      }, 1000);
    } catch (error) {
      console.log(error);
    }
  }
}

async function handleDeleteAccount(e) {
  e.preventDefault();

  const deleteButton = e.target.querySelector("button[type='submit']");
  addLoadingAnimation(deleteButton);

  const formData = new FormData(this);
  requestOptions.method = "POST";
  requestOptions.body = formData;

  try {
    await fetch("account.logic.php", requestOptions);

    setTimeout(() => {
      document.location.href = "index.php";
    }, 1000);
  } catch (error) {
    console.log(error);
  }
}

dataUpdateForm.addEventListener("submit", handleDataUpdateForm);
deleteAccountForm.addEventListener("submit", handleDeleteAccount);
