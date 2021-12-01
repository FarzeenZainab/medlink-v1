"use strict";
// // get the id of medicine and dose
// // initiate AJAX to fill up the strength and dose intake fields
// // onclick on save changes button update the data in database

const editMedBtnEle = document.querySelectorAll(".edit-medicine");

// Ajax Req to get the data of the dose in modal header
for (let i = 0; i < editMedBtnEle.length; i++) {
  editMedBtnEle[i].addEventListener("click", logIds);

  // Set dose id to hidden field dynamically
  editMedBtnEle[i].addEventListener("click", setDoseid);
}

// get dose details by dose id to display relative dose data in modal header
function logIds() {
  const doseId = this.getAttribute("data-dose-edit");

  // AJAX Req
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector("#edit-modal-header").innerHTML =
        this.responseText;
    }
  };

  xhr.open("GET", `d_modals/edit-med-info.php?q=${doseId}`, true);
  xhr.send();
}

// set dose id to hidden field in the edit medicine form
function setDoseid() {
  const hiddenInput = document.querySelector(".dose_input_hidden");
  const doseId = this.getAttribute("data-dose-edit");

  console.log(doseId);
  hiddenInput.value = doseId;
}
