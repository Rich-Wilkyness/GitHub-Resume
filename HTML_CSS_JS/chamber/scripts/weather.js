

const singleURL = 'https://api.openweathermap.org/data/2.5/weather?lat=43.63&lon=-111.77&units=imperial&appid=1a683f200d043cac1ff34739a925f11d';

const forecastURL = 'https://api.openweathermap.org/data/2.5/forecast?lat=43.63&lon=-111.77&units=imperial&appid=1a683f200d043cac1ff34739a925f11d';

const temps = [];

async function apiFetch(url, display) {
    try {
        const response = await fetch(url);
        if (response.ok) {
            const data = await response.json();
            if (display === "s"){
                displayResults(data);
            } else {
                displayForecast(data);
            }
        } else {
            throw Error(await response.text());
        }
    } catch (error) {
        console.log(error);
    }
}

function displayResults(data) {
    const currentTemp = document.querySelector("#current-temp");
    const tempDesc = document.querySelector('#temp-desc');
    // const weatherIcon = document.querySelector("#weather-icon");
    // const captionDesc = document.querySelector("figcaption");
    // const iconsrc = `https://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png`;
    let desc = data.weather[0].description;

    currentTemp.innerHTML = `${data.main.temp}&deg;F`;
    tempDesc.innerHTML = desc;
    // weatherIcon.setAttribute('src',iconsrc);
    // weatherIcon.setAttribute('alt',desc);
    // captionDesc.textContent = `${desc}`;
}

function displayForecast(data) {
    let counter = 0;

    data.list.forEach((item) => {
        let date = new Date(item.dt_txt);
        let hour = date.getHours();
        temps.push(parseFloat(item.main.temp));

        if (hour === 0) {
            const minTemp = Math.round(Math.min(...temps));
            const maxTemp = Math.round(Math.max(...temps));
            temps.length = 0;
            let day = date.toLocaleDateString('en-US', { weekday: 'long' });
            let desc = item.weather[0].description;
            let iconSrc = `https://openweathermap.org/img/wn/${item.weather[0].icon}@2x.png`;
      
            let forecastDayElem = document.querySelector(`#forecast-day-${counter + 1}`);
            let forecastMinMaxTempElem = document.querySelector(`#forecast-minMaxTemp-${counter + 1}`);
            let forecastIconElem = document.querySelector(`#forecast-icon-${counter + 1}`);
      
            forecastDayElem.innerHTML = day;
            forecastMinMaxTempElem.innerHTML = `${minTemp}&deg;F - ${maxTemp}&deg;F`;
            forecastIconElem.setAttribute('src', iconSrc);
            forecastIconElem.setAttribute('alt', desc);
            counter++;
        } 
    });
}

apiFetch(singleURL, 's');

apiFetch(forecastURL, 'f');
