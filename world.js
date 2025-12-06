window.onload = function () {

    let lookupCountryBtn = document.getElementById('lookup');
    let lookupCitiesBtn = document.getElementById('lookup-cities');
    let search = document.getElementById('country');
    let result = document.getElementById('result');

    // Function to fetch data
    async function fetchData(url) {
        try {
            let response = await fetch(url);

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            let data = await response.text();
            result.innerHTML = data;

        } catch (error) {
            result.innerHTML = `<p style="color:red;">Error: ${error.message}</p>`;
            console.error("Fetch error:", error);
        }
    }

    // Lookup countries
    lookupCountryBtn.addEventListener('click', function () {
        let country = search.value.trim();
        let url = 'http://localhost/info2180-lab5/world.php';

        if (country !== "") {
            url += "?country=" + encodeURIComponent(country);
        }

        fetchData(url);
    });

    // Lookup cities
    lookupCitiesBtn.addEventListener('click', function () {
        let country = search.value.trim();
        if (country === "") {
            result.innerHTML = `<p style="color:red;">Please enter a country name first.</p>`;
            return;
        }

        let url = `http://localhost/info2180-lab5/world.php?country=${encodeURIComponent(country)}&lookup=cities`;

        fetchData(url);
    });

};
