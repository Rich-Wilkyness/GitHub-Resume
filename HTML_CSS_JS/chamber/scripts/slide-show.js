const baseURL = "https://rich-wilkyness.github.io/wdd230/";
const membersURL = "https://rich-wilkyness.github.io/wdd230/chamber/data/members.json";


const slideshowElement = document.getElementById("slideshow-container");

async function getMembers() {
    try {
        const response = await fetch(membersURL);
        if (response.ok) {
            const data = await response.json();
            displayMembers(data.members);
        } else {
            throw new Error("Failed to fetch links");
        }
    } catch (error) {
        console.error(error);
    }
}

function displayMembers(members) {
    members.forEach((member) => {
        if(member.membershipLevel === "Gold" || member.membershipLevel === "Silver") {
            const memberElement = document.createElement('div');
            const businessName = document.createElement("h2");
            const businessImg = document.createElement("img");
            const businessSource = document.createElement("source");
            const website = document.createElement("a");
            const pictureElement = document.createElement('picture');

            // -------- setting element values ---------

            memberElement.classList.add('mySlides');
            memberElement.setAttribute('style', 'display: none;');

            businessName.textContent = member.name; 

            businessSource.setAttribute('media', '(max-width: 500px)');
            businessSource.setAttribute('srcset', member.image500);

            businessImg.setAttribute('src', member.image700);
            businessImg.setAttribute('alt', `${member.name} Logo`);
            businessImg.setAttribute('loading', 'lazy');
            businessImg.setAttribute('width', '600');
            businessImg.setAttribute('height', '400');

            website.setAttribute('href', member.website);

    // --------- appending elements to document ---

            website.appendChild(businessSource);
            website.appendChild(businessImg);
            pictureElement.appendChild(website);
            memberElement.appendChild(pictureElement);
            memberElement.appendChild(businessName);

            slideshowElement.appendChild(memberElement);
        }
    });
    showSlides(slideIndex);
}

getMembers();




let slideIndex = Math.floor(Math.random() * 4);

function plusSlides(n) {
showSlides(slideIndex += n);
}
function currentSlide(n) {
showSlides(slideIndex = n);
}

async function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");

    if (n > slides.length) {
        slideIndex = 1;
    }
    if (n < 1) {
        slideIndex = slides.length;
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].setAttribute('style', "display: none");
    }
    slides[slideIndex-1].setAttribute('style', "display: block");
}
setInterval(() => {
    plusSlides(1);
}, 15000);

