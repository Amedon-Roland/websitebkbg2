{{-- filepath: resources/views/components/google-map.blade.php --}}
<div class="w-full h-[500px] rounded-lg overflow-hidden shadow-lg">
    {{-- Google Maps Container --}}
    <div id="map" class="w-full h-full"></div>

    {{-- Google Maps Script --}}
    <script>
        function initMap() {
            const location = { lat: {{ $latitude }}, lng: {{ $longitude }} };
            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: location,
            });

            const marker = new google.maps.Marker({
                position: location,
                map: map,
                title: "Hôtel BKBG",
            });
        }
    </script>

    {{-- Load Google Maps API --}}
    <script async
        src="https://maps.googleapis.com/maps/api/js?key={{ $apiKey }}&callback=initMap">
    </script>
</div>
