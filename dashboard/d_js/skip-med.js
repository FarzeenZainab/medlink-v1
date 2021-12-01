const skipMedBtnsEle = document.querySelectorAll(".skip-btn");

for (let i = 0; i < skipMedBtnsEle.length; i++) {
  skipMedBtnsEle[i].addEventListener("click", function () {
    if (!skipMedBtnsEle[i].classList.contains("display-none")) {
      const doseId = this.getAttribute("data-skipmed");
      const inputSkipMeds = document.querySelector(
        "#modal-btn-skip-dose-confirmed"
      );
      inputSkipMeds.value = doseId;
    }
  });
}
