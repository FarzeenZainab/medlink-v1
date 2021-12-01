const formEle = document.querySelector("#add-new-med");
const divStep1Ele = document.querySelector("#step-1");

// daily form variables
const divDailyELe = document.querySelector(".daily-frequency");
const nextBtnDailyELe = document.querySelector(".btn-next-daily");
const divTimeDaily = document.querySelector(".time-freq-div");
const timeDailyFreq = document.querySelector(".time-daily-frequency");
const btnBackTimeEle = document.querySelector(".btn-back-time");
const addMedsFooter = document.querySelector(".add-med-footer");
const addMedsBtn = document.querySelector("#add-medicines");

const radioDailyFreqEle = document.querySelectorAll(
  '[name="med-frequency-daily"]'
);

const freq = ["First", "Second", "Third"];

const label1 = document.createElement("label");
const inputEle1 = document.createElement("input");
const labelTextNode1 = document.createTextNode(
  `Select time for ${freq[0]} dose `
);

const label2 = document.createElement("label");
const inputEle2 = document.createElement("input");
const labelTextNode2 = document.createTextNode(
  `Select time for ${freq[1]} dose `
);

const label3 = document.createElement("label");
const inputEle3 = document.createElement("input");
const labelTextNode3 = document.createTextNode(
  `Select time for ${freq[2]} dose `
);

// next button event
nextBtnDailyELe.addEventListener("click", function () {
  const medName = document.querySelector("#med-name-input");
  const medStrength = document.querySelector("#strength");

  // validation
  if (medName.value !== "" && medStrength.value !== "") {
    hideError();
    // Show next form and add time slots
    if (radioDailyFreqEle[0].checked == true) {
      // add one time's input
      appendDailyTimeNodes(
        timeDailyFreq,
        label1,
        labelTextNode1,
        inputEle1,
        `freq--1`,
        `freq--1`,
        `freq--1`,
        divStep1Ele,
        divTimeDaily
      );
    } else if (radioDailyFreqEle[1].checked == true) {
      appendDailyTimeNodes(
        timeDailyFreq,
        label1,
        labelTextNode1,
        inputEle1,
        `freq--1`,
        `freq--1`,
        `freq--1`,
        divStep1Ele,
        divTimeDaily
      );
      appendDailyTimeNodes(
        timeDailyFreq,
        label2,
        labelTextNode2,
        inputEle2,
        `freq--2`,
        `freq--2`,
        `freq--2`,
        divStep1Ele,
        divTimeDaily
      );
    } else if (radioDailyFreqEle[2].checked == true) {
      // add three time's inputs
      appendDailyTimeNodes(
        timeDailyFreq,
        label1,
        labelTextNode1,
        inputEle1,
        `freq--1`,
        `freq--1`,
        `freq--1`,
        divStep1Ele,
        divTimeDaily
      );
      appendDailyTimeNodes(
        timeDailyFreq,
        label2,
        labelTextNode2,
        inputEle2,
        `freq--2`,
        `freq--2`,
        `freq--2`,
        divStep1Ele,
        divTimeDaily
      );
      appendDailyTimeNodes(
        timeDailyFreq,
        label3,
        labelTextNode3,
        inputEle3,
        `freq--3`,
        `freq--3`,
        `freq--3`,
        divStep1Ele,
        divTimeDaily
      );
    } else {
      showError("Please select dose frequency");
    }
    if (divTimeDaily.classList.contains("form-active")) {
      addMedsFooter.classList.remove("form-hidden");
    }
  } else {
    showError("Please provide medicine name and strength");
  }
});

// Back button Event
btnBackTimeEle.addEventListener("click", function () {
  // remove all child elements in .time-daily-frequency
  const timeDailyFreqChildren = document.querySelectorAll(".freq");

  for (i = 0; i < timeDailyFreqChildren.length; i++) {
    if (timeDailyFreqChildren[i].classList.contains("freq")) {
      timeDailyFreqChildren[i].remove();
    } else {
      break;
    }
  }

  addMedsFooter.classList.add("form-hidden");
  showPrev(divTimeDaily, divStep1Ele);

  hideError();
});

// Add Medicine Button event
addMedsBtn.addEventListener("click", function () {
  // validate date --> time-slots, date, dose quantity
  const timeSlots = document.querySelectorAll(".freq input");
  const reminderDatesSlot = document.querySelector("#reminder-dates");
  const doseQuantity = document.querySelector("#dose-quantity");

  if (doseQuantity.value === "") {
    showError("Please enter dose quantity");
  }

  if (reminderDatesSlot.value === "") {
    showError("Please select end date of reminders");
  }

  for (i = 0; i < timeSlots.length; i++) {
    if (timeSlots[i].value === "") {
      showError("Please select time for each frequency");
    }
  }
});

//Show next Step / form
function showNext(activeDivEle, nextDivEle) {
  // Hide previous inputs
  activeDivEle.classList.add("form-hidden");
  activeDivEle.classList.remove("form-active");

  // display next inputs
  nextDivEle.classList.remove("form-hidden");
  nextDivEle.classList.add("form-active");
}

// Show Previous Step
function showPrev(activeDivEle, prevDivEle) {
  // Hide active inputs
  activeDivEle.classList.add("form-hidden");
  activeDivEle.classList.remove("form-active");

  // display Prev inputs
  prevDivEle.classList.remove("form-hidden");
  prevDivEle.classList.add("form-active");
}

function appendDailyTimeNodes(
  parentELe,
  labelELe,
  lableText,
  inputEle,
  className,
  name,
  controlId,
  formToHide,
  formToShow
) {
  // create labels for time
  // create text node for time
  // append text node with label
  // append input for label
  // append label for parent
  // set attribute of type
  // set attribute of class
  // set attribute of name
  // set attribute of id for label
  // set attribute of id for input

  labelELe.appendChild(lableText);
  labelELe.appendChild(inputEle);
  parentELe.appendChild(labelELe);
  inputEle.setAttribute("type", "time");

  inputEle.setAttribute("name", name);
  inputEle.setAttribute("class", className);
  inputEle.setAttribute("id", controlId);
  labelELe.setAttribute("id", controlId);

  labelELe.classList.add("freq");
  inputEle.classList.add("form-control");

  showNext(formToHide, formToShow);
}

// Show error message
function showError(message) {
  const error = document.querySelector(".error-add-new-med");
  error.textContent = `${message}`;
  error.classList.remove("display-none");
}

// hide error
function hideError() {
  const error = document.querySelector(".error-add-new-med");
  error.classList.add("display-none");
}
