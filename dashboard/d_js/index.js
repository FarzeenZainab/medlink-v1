"use strict";

window.addEventListener("load", function () {
  const takeDoseBtnEle = document.querySelectorAll(".take-btn");
  const skipMedBtnsEle = document.querySelectorAll(".skip-btn");
  for (let i = 0; i < takeDoseBtnEle.length; i++) {
    const doseStatus = takeDoseBtnEle[i].getAttribute("data-status");

    // take medicine
    if (doseStatus == "taken") {
      takeDoseBtnEle[i].classList.add("med-taken");
      takeDoseBtnEle[i].disabled = true;
      takeDoseBtnEle[i].innerHTML =
        '<img src="d_images/icons/check-white.svg" width="20px" alt="dose marked as taken"  draggable = false>';

      skipMedBtnsEle[i].classList.add("display-none");
      skipMedBtnsEle[i].disabled = true;
    }

    // Skip medicine
    else if (doseStatus == "skipped") {
      takeDoseBtnEle[i].disabled = true;
      skipMedBtnsEle[i].disabled = true;
      takeDoseBtnEle[i].classList.add("display-none");
      skipMedBtnsEle[i].classList.add("skipped");
      skipMedBtnsEle[i].innerHTML =
        '<img src="d_images/icons/close.svg" width="20px" alt="dose marked as skipped"  draggable = false>';
    }
  }
});
