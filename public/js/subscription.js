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
    const articleButton = e.target.lastElementChild;
    const subscriptionPlan = e.target.closest("article.plan");
    const allSubscriptionPlans = document.querySelectorAll("article.plan");
    const trial = document.querySelector("article.trial");
    const trialCloseButton = trial?.querySelector("button");

    const formData = new FormData(this);
    requestOptions.method = "POST";
    requestOptions.body = formData;

    try {
      await fetch("/subscription", requestOptions);

      setTimeout(() => {
        if (trial == null) {
          const article = document.createElement("article");
          article.className = "trial";
          const trialPElm = document.createElement("p");
          const pElmTextNode = document.createTextNode(
            "Good choice! Now it's time to find your next "
          );
          const link = document.createElement("a");
          link.setAttribute("href", "/tutorials");
          link.textContent = "tutor";
          trialPElm.append(pElmTextNode, link);
          article.append(trialPElm);

          setTimeout(() => {
            main.classList.add("active-trial");
            main.insertBefore(article, section);
          }, 0);
        }

        if (trial !== null) {
          const trialPElm = document.querySelector(".trial p");
          trialPElm.textContent = "";
          const pElmTextNode = document.createTextNode(
            "Good choice! Now it's time to find your next "
          );
          const link = document.createElement("a");
          link.setAttribute("href", "/tutorials");
          link.textContent = "tutor";
          trialPElm.append(pElmTextNode, link);
          trialCloseButton?.closest("form").remove();
        }

        allSubscriptionPlans.forEach((plan) => {
          const planButton = plan.querySelector("button[type='submit']");

          planButton.textContent = "select";
          planButton.classList.remove("active");
          plan.classList.remove("active");
        });

        subscriptionPlan.classList.add("active");
        articleButton.textContent = "my plan";
        articleButton.classList.add("active");
      }, 1000);
    } catch (error) {
      console.log(error);
    }
  });
}
section.addEventListener("click", handleSection);
