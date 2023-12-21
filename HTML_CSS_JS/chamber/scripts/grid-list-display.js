const gridbutton = document.querySelector(".grid-button");
const listbutton = document.querySelector(".list-button");
const display = document.querySelector("#directory-members");


gridbutton.addEventListener("click", () => {
	display.classList.add("grid");
	display.classList.remove("list");
});

listbutton.addEventListener("click", showList); 

function showList() {
	display.classList.add("list");
	display.classList.remove("grid");
}
