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

    const form = document.querySelector("form");
    const xhr = new XMLHttpRequest();
    xhr.open("POST", form.action);
    xhr.upload.addEventListener("progress", function (event) {
        if (event.lengthComputable) {
            const percentComplete = (event.loaded / event.total) * 100;
            button.innerHTML =
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Subiendo lectura... ' +
                percentComplete.toFixed(0) +
                "%";
        }
    });
    xhr.addEventListener("load", function () {
        button.innerHTML = "Guardar lectura";
        button.classList.remove("disabled");
    });
    xhr.send(new FormData(form));
});
