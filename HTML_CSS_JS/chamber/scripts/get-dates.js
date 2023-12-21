let date = new Date();
let currentYear = date.getFullYear();
document.querySelector("#year").textContent = currentYear;

let lastModif = new Date(document.lastModified);
document.querySelector("#lastModified").textContent = lastModif;
