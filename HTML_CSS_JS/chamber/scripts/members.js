const baseURL = "https://rich-wilkyness.github.io/wdd230/";
const membersURL = "https://rich-wilkyness.github.io/wdd230/chamber/data/members.json";
const membersElement = document.getElementById("directory-members");

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
        const memberElement = document.createElement('section');
        const businessName = document.createElement("h4");
        const businessIcon = document.createElement("img");
        const address = document.createElement("p");
        const phone = document.createElement("p");
        const website = document.createElement("a");


// -------- setting element values ---------

        businessName.textContent = member.name;

        businessIcon.setAttribute('src', member.icon);
        businessIcon.setAttribute('alt', `${member.name} Logo`);
        businessIcon.setAttribute('loading', 'lazy');
        businessIcon.setAttribute('width', '200px');
        businessIcon.setAttribute('height', 'auto');

        address.textContent = member.address;
        phone.textContent = member.phone;
        website.setAttribute('href', member.website);
        website.textContent = member.website;

// --------- appending elements to document ---


        memberElement.appendChild(businessName);
        memberElement.appendChild(businessIcon);
        memberElement.appendChild(address);
        memberElement.appendChild(phone);
        memberElement.appendChild(website);

        membersElement.appendChild(memberElement);
    });
}

getMembers();