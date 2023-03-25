export function createLoadingAnimation() {
  const container = document.createElement("span");
  container.className = "loading";

  for (let i = 0; i < 4; i++) {
    const span = document.createElement("span");
    container.append(span);
  }

  return container;
}

export function createCallToAction() {
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
  link.setAttribute("href", "/tutorials");

  pElmLink.append(pElmLinkTextNode, link);

  container.append(heading, pElm, pElmLink);
  main.append(container);
}

export function addLoadingAnimation(elm) {
  const loadingAnimation = createLoadingAnimation();
  elm.textContent = "";
  elm.append(loadingAnimation);
}