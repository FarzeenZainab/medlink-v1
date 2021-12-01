const takeMedBtnEle = document.querySelectorAll(".take-btn");

const takeMedAction = function () {
  const doseId = this.getAttribute("data-takeMed");
  const medBtnEle = document.querySelector(`[data-takeMed='${doseId}']`);

  const xhrObj = new XMLHttpRequest();
  xhrObj.onreadystatechange = function () {
    if (this.status == 200 && this.readyState == 4) {
      const response = this.responseText;
      // check the response
      if (response == 1) {
        medBtnEle.classList.add("med-taken");
        medBtnEle.disabled = true;
        medBtnEle.innerHTML =
          '<img src="d_images/icons/check-white.svg" width="20px" alt="dose marked as taken" draggable = false>';

        const madeTakenTotal = document.querySelector(`.taken-total-weekly`);
        madeTakenTotal.textContent++;
      } else {
        // show failed message
        alert("Something went wrong, please try later.");
      }

      const skipBtnEle = document.querySelector(`[data-skipmed='${doseId}']`);

      skipBtnEle.classList.add("display-none");
      skipBtnEle.disabled = true;
    }
  };
  xhrObj.open("POST", `d_modals/take_med.php?d=${doseId}`, true);
  xhrObj.send();
};

for (let i = 0; i < takeMedBtnEle.length; i++) {
  takeMedBtnEle[i].addEventListener("click", takeMedAction);
}

