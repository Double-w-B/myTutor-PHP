const tutorialDesc = document.querySelector("#desc");
const btn = document.querySelector("#show-more");
const id = window.location.search.split("=")[1];
const checkButtons = document.querySelectorAll("article form");
const requestOptions = {};

let responseDesc;

async function handleOnload() {
  try {
    const response = await fetch(`/my-tutorials/user-tutorial-data?id=${id}`);
    const data = await response.json();
    responseDesc = data.tutorial.tutorial_desc;
  } catch (error) {
    console.log(error);
  }
}

function handleBtn() {
  if (btn.textContent === "Show More") {
    tutorialDesc.textContent = responseDesc;
    btn.textContent = "Show Less";
  } else {
    tutorialDesc.textContent = `${responseDesc.substr(0, 200)} ...`;
    btn.textContent = "Show More";
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
      await fetch(`/my-tutorials/user-tutorial-data?id=${id}`, requestOptions);

      if (button.classList.contains("checked")) {
        button.classList.remove("checked");
        return;
      }
      button.classList.add("checked");
    } catch (error) {
      console.log(error);
    }
  }

  form.addEventListener("submit", submitForm);
});

window.addEventListener("load", handleOnload);
btn?.addEventListener("click", handleBtn);
