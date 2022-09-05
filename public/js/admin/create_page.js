input_file = document.querySelector("#inputPicture");
label = document.querySelector(".custom-file-label");

input_file.addEventListener("change", (e) => {
  label.textContent = e.target.files.item(0).name;
});
