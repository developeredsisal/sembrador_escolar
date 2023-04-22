const imageUploadInput = document.getElementById("image-upload-input");
imageUploadInput.addEventListener("change", function () {
    const fileName = this.value.split("\\").pop();
    this.parentNode.querySelector(".image-upload-name").innerHTML = fileName;
});

const button = document.querySelector('button[id="subir"]');
button.addEventListener("click", function () {
    const xhr = new XMLHttpRequest();
    const formData = new FormData(form);
    xhr.upload.addEventListener("progress", function (event) {
        if (event.lengthComputable) {
            const percentComplete = Math.round(
                (event.loaded / event.total) * 100
            );
            button.innerHTML = "Subiendo actividad... %" + percentComplete;
        }
    });
    xhr.addEventListener("load", function () {
        button.innerHTML = "Guardar lectura";
        button.classList.remove("disabled");
    });
    xhr.open("POST", "/upload", true);
    xhr.send(formData);

    this.innerHTML =
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Subiendo lectura...';
    this.classList.add("disabled");
});

const form = document.querySelector("form");
form.addEventListener("submit", function () {
});

