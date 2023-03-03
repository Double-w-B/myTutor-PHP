const trialReminderForm = document.querySelector("article form");
const section = document.querySelector("section");
const sectionForms = section?.querySelectorAll("form");

const requestOptions = {};

function createLoadingAnimation() {
  const container = document.createElement("span");
  container.className = "loading";
  for (let i = 0; i < 4; i++) {
    const span = document.createElement("span");
    container.append(span);
  }
  return container;
}

function createCallToAction() {
  const container = document.createElement("div");
  container.className = "cta";
  const heading = document.createElement("h1");
  heading.textContent = "Hurry Up, time is ticking!";
  const pElm = document.createElement("p");
  pElm.innerText = `Start, switch or advance your career and degrees
     from world-class universities and companies.`;

  const pElmLink = document.createElement("p");
  const pElmLinkTextNode = document.createTextNode("Go and find your ");
  const link = document.createElement("a");
  link.textContent = "tutor";
  link.setAttribute("href", "home-page.php");

  pElmLink.append(pElmLinkTextNode, link);

  container.append(heading, pElm, pElmLink);
  main.append(container);
}

async function handleReminder(e) {
  e.preventDefault();

  const formData = new FormData(this);
  requestOptions.method = "POST";
  requestOptions.body = formData;

  try {
    await fetch("user-tutors.php", requestOptions);
    trialReminderForm.closest("article").remove();
    main.removeAttribute("style");
  } catch (error) {
    console.log(error);
  }
}

function handleSection(e) {
  if (e.target.tagName !== "BUTTON" && e.target.type !== "submit") return;

  const loadingAnimation = createLoadingAnimation();
  e.target.textContent = "";
  e.target.append(loadingAnimation);

  e.target.closest("form").addEventListener("submit", async function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    requestOptions.method = "POST";
    requestOptions.body = formData;

    try {
      await fetch("user-tutors.php", requestOptions);

      setTimeout(async () => {
        e.target.closest(".tutorial").remove();

        if (section.children.length === 0) {
          section.remove();
          createCallToAction();
        }
      }, 1000);
    } catch (error) {
      console.log(error);
    }
  });
}

trialReminderForm?.addEventListener("submit", handleReminder);
section?.addEventListener("click", handleSection);
