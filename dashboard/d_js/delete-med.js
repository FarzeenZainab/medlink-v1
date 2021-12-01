"use strict";

// First, manage to get the data-dose attribute value on dynamic elements
// store that attribute value and save it in the modal button attribute
// and on click on that button send the value of the attribute to the php file
// inside the code will select the matching doseId values
// and it will delete it
// redirect to homepage

let dltBtnEle = document.querySelectorAll(".delete-dose");
let modalBtnInput = document.querySelector("#modal-btn-delete-dose-confirmed");

const setDoseId = function setDoseId() {
  const doseId = this.getAttribute("data-dose");
  modalBtnInput.value = doseId;
};

for (let i = 0; i < dltBtnEle.length; i++) {
  dltBtnEle[i].addEventListener("click", setDoseId);
}
