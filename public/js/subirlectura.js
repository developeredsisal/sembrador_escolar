const imageUploadInput = document.getElementById("image-upload-input");
imageUploadInput.addEventListener("change", function () {
    const fileName = this.value.split("\\").pop();
    this.parentNode.querySelector(".image-upload-name").innerHTML = fileName;
});

const button = document.querySelector('button[id="subir"]');
button.addEventListener("click", function () {
    this.innerHTML =
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Subiendo lectura...';
    this.classList.add("disabled");
});

const form = document.querySelector("form");
form.addEventListener("submit", function () {
    const button = this.querySelector('button[id="subir"]');
    setTimeout(function () {
        button.innerHTML = "Guardar lectura";
        button.classList.remove("disabled");
    }, 3000);
});
