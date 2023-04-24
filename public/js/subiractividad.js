const form = document.querySelector("form");
const nombreInput = document.querySelector("#file-name-input");
const invalidNombreFeedback = document.querySelector(
    ".invalid-feedback-nombre"
);
const imagenInput = document.querySelector("#image-upload-input");
const invalidImagenFeedback = document.querySelector(
    ".invalid-feedback-imagen"
);
const fileInput = document.getElementById("file-upload-input");
const invalidFileFeedback = document.querySelector(".invalid-feedback-file");
const button = document.querySelector('button[id="subir"]');

nombreInput.addEventListener("input", () => {
    nombreInput.classList.remove("is-invalid");
    invalidNombreFeedback.style.display = "none";
});

imagenInput.addEventListener("change", () => {
    const fileName = imagenInput.files[0]?.name;
    const uploadName = document.querySelector(".image-upload-name");
    uploadName.textContent = fileName;
    imagenInput.classList.remove("is-invalid");
    invalidImagenFeedback.style.display = "none";
});

fileInput.addEventListener("change", () => {
    const fileName = fileInput.files[0]?.name;
    const uploadName = document.querySelector(".file-upload-name");
    uploadName.textContent = fileName;
    fileInput.classList.remove("is-invalid");
    invalidFileFeedback.style.display = "none";
});

button.addEventListener("click", function () {
    if (!imagenInput.files || imagenInput.files.length === 0) {
        event.preventDefault();
        imagenInput.classList.add("is-invalid");
        invalidImagenFeedback.style.display = "block";
    } else if (!fileInput.files || fileInput.files.length === 0) {
        event.preventDefault();
        fileInput.classList.add("is-invalid");
        invalidFileFeedback.style.display = "block";
    } else if (!nombreInput.value) {
        event.preventDefault();
        nombreInput.classList.add("is-invalid");
        invalidNombreFeedback.style.display = "block";
    } else {
        if (form.checkValidity()) {
            button.innerHTML =
            'Cargando...';
            button.classList.add("disabled");
        } else {
            alert("Por favor complete todos los campos requeridos");
        }
    }
});
