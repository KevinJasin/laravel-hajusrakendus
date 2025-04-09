<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🗺️ Interactive Map
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-2 text-gray-700">
                📍 Click anywhere on the map to add a marker.
            </h3>
            <p class="text-sm text-gray-500 mb-4">
                You'll be prompted to enter a name and description.
            </p>
            <div id="map" class="rounded border h-[600px]"></div>
        </div>
    </div>

    {{-- Leaflet Styles & Scripts --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const map = L.map('map').setView([59.437, 24.7536], 13); // Tallinn

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            const markers = @json($markers);

            markers.forEach(marker => {
                L.marker([marker.latitude, marker.longitude])
                    .addTo(map)
                    .bindPopup(`<b>${marker.name}</b><br>${marker.description}`);
            });

            map.on('click', function (e) {
                const lat = e.latlng.lat;
                const lng = e.latlng.lng;

                const name = prompt("Marker name:");
                const description = prompt("Description:");

                if (!name) return;

                fetch('/markers', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ name, latitude: lat, longitude: lng, description })
                })
                .then(response => response.json())
                .then(data => location.reload());
            });
        });
    </script>
</x-app-layout>
