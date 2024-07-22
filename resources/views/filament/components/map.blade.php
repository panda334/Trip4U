<div id="map" style="height: 400px;"></div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const map = L.map('map').setView([51.505, -0.09], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const marker = L.marker([51.5, -0.09]).addTo(map);

        map.on('click', function (e) {
            marker.setLatLng(e.latlng);
            document.querySelector('input[name="latitude"]').value = e.latlng.lat;
            document.querySelector('input[name="longitude"]').value = e.latlng.lng;
        });
    });
</script>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
