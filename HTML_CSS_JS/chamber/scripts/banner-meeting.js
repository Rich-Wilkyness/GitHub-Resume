function closeBanner() {
    document.getElementById("banner").style.display = "none";
}

let today = new Date().getDay();
if (today === 1 || today === 2 || today === 3) {
    document.getElementById("banner").style.display = "block";
} else {
    document.getElementById("banner").style.display = "none";
}