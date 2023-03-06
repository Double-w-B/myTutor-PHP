const trialReminderForm = document.querySelector("article.trial form");
const requestOptions = {};

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

trialReminderForm?.addEventListener("submit", handleReminder);
