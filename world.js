window.onload = function (){


    let lookup = document.getElementById('lookup');
    let search = document.getElementById('country');
    let result = document.getElementById('result');

    lookup.addEventListener('click', async function () {
        let country = search.value.trim();

        let url = 'http://localhost/info2180-lab5/world.php'

        if (country !== ""){
            url += "?country=" + encodeURIComponent(country);
        }

        let countries = await fetch(url);
        let resp = await countries.text();

        result.innerHTML = resp;
        
    });
}