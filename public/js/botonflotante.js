const btnFloat = document.getElementById("btn-float");
const modal = document.getElementById("modal");
const closeBtn = modal.querySelector(".close");

btnFloat.addEventListener("click", function (event) {
    event.stopPropagation();

    modal.style.display = "block";
});

closeBtn.addEventListener("click", function () {
    modal.style.display = "none";
});