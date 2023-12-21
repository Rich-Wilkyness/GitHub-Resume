const millisecondsInDay = 86400000; //miliseconds in a day
const currentTime = new Date();
const visitedElement = document.querySelector('#visited');

let lastVisited;

const storedValue = localStorage.getItem('last-visited');

try {
  lastVisited = storedValue ? new Date(JSON.parse(storedValue)) : currentTime;
} catch (error) {
  lastVisited = currentTime;
}

const timePassed = currentTime - lastVisited; //this is in miliseconds

localStorage.setItem('last-visited', JSON.stringify(currentTime));

if (timePassed <= 0) {
    visitedElement.textContent = "Welcome! Let us know if you have any questions.";
} else if (timePassed >= millisecondsInDay) {
    const daysSince = (timePassed/millisecondsInDay);
    visitedElement.textContent = `You last visited ${daysSince.toFixed(0)} day(s) ago.`;
}
else if (timePassed > 0 && timePassed < millisecondsInDay) {
    visitedElement.textContent = 'Back so soon! Awesome!';
}