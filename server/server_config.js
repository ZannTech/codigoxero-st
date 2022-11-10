const URL = document.querySelector("#url").value;
const ASSETS_PATH = document.querySelector("#assets").value;
const IMAGE_PATH = document.querySelector("#images").value;
const APP_NAME = "SISTEMA TIERRA";
const d = document;
const n = navigator;
const w = window;
const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
});
