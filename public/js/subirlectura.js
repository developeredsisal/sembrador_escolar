const form = document.querySelector("form");
const imagenInput = document.querySelector("#image-upload-input");
const invalidImagenFeedback = document.querySelector(
    ".invalid-feedback-imagen"
);
const nombreInput = document.querySelector("#file-name-input");
const invalidNombreFeedback = document.querySelector(
    ".invalid-feedback-nombre"
);
const button = document.querySelector('button[id="subir"]');
const gradoSelect = document.getElementById("category-select");

imagenInput.addEventListener("change", () => {
    const fileName = imagenInput.files[0]?.name;
    const uploadName = document.querySelector(".image-upload-name");
    uploadName.textContent = fileName;
    imagenInput.classList.remove("is-invalid");
    invalidImagenFeedback.style.display = "none";
});

nombreInput.addEventListener("input", () => {
    nombreInput.classList.remove("is-invalid");
    invalidNombreFeedback.style.display = "none";
});

gradoSelect.addEventListener("change", () => {
    if (gradoSelect.value) {
        gradoSelect.classList.remove("is-invalid");
        const invalidFeedbackGrado = gradoSelect.nextElementSibling;
        invalidFeedbackGrado.style.display = "none";
    }
});

button.addEventListener("click", function () {
    if (!imagenInput.files || imagenInput.files.length === 0) {
        event.preventDefault();
        imagenInput.classList.add("is-invalid");
        invalidFeedback.style.display = "block";
    } else if (!gradoSelect.value) {
        event.preventDefault();
        gradoSelect.classList.add("is-invalid");
        const invalidFeedbackGrado = gradoSelect.nextElementSibling;
        invalidFeedbackGrado.style.display = "block";
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
