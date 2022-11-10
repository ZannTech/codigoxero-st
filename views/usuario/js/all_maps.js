const view_map = () => {
    let pos;
    if (navigator.geolocation) { //check if geolocation is available
        navigator.geolocation.getCurrentPosition(function (position) {
            pos = position
            console.log(position)

            $("#longitud").val(pos.coords.longitude)
            $("#latitud").val(pos.coords.latitude)
            map = L.map('map').setView([pos.coords.latitude, pos.coords.longitude], 10);
            var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            L.marker([pos.coords.latitude, pos.coords.longitude]).addTo(map)

            map.addLayer(markers);
        });
    }
}



