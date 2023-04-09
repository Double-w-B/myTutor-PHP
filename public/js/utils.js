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

export class UserProgress {
  totalSections;
  completedSections;
  currentProgress = 0;
  isUpdating = false;
  queue = [];

  constructor(total, completed) {
    this.totalSections = total;
    this.completedSections = completed;
  }

  countProgress() {
    return (this.completedSections.length / this.totalSections.length) * 100;
  }

  updateProgress(percentageElm, lineElm, value = this.countProgress()) {
    const finalProgress = value === 0 ? 2 : value;
    const progressDecimals = value !== 0 ? value.toFixed(1) : value;

    const animate = () => {
      this.isUpdating = true;

      const animation = setInterval(() => {
        if (finalProgress >= this.currentProgress) {
          this.currentProgress += 1;
        } else {
          this.currentProgress -= 1;
        }

        percentageElm.textContent = this.currentProgress + "%";
        lineElm.style.background = `conic-gradient(hsl(0, 100%, 74%) ${this.currentProgress}%, rgba(255, 255, 255) ${this.currentProgress}%)`;

        if (Math.floor(finalProgress) == this.currentProgress) {
          clearInterval(animation);
          this.isUpdating = false;

          if (this.currentProgress !== value) {
            percentageElm.textContent = progressDecimals + "%";
          }

          if (this.queue.length > 0) {
            const next = this.queue.shift();
            this.updateProgress(next.percentageElm, next.lineElm, next.value);
          }
        }
      }, 20);
    };

    if (this.isUpdating) {
      this.queue.push({ percentageElm, lineElm, value });
    } else {
      animate();
    }
  }
}
