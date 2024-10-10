document.addEventListener("DOMContentLoaded", function () {
    const map = L.map('map').setView([14.6487, 121.0553], 13); // Set initial view to Quezon City Memorial Circle
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);
    
    // Default marker location at Quezon City Memorial Circle
    const defaultLocation = [14.6487, 121.0553]; // Latitude and Longitude for Quezon City Memorial Circle
    let marker = L.marker(defaultLocation).addTo(map);
    document.getElementById('location').value = "Quezon City Memorial Circle"; // Set default address

    // Move the map to the default location
    map.setView(defaultLocation, 13);
    
    // Fetch the location using reverse geocoding
    fetchLocation({ lat: defaultLocation[0], lng: defaultLocation[1] })
        .then(displayName => {
            document.getElementById('location').value = displayName; // Set the location input to the fetched address
        })
        .catch(error => {
            console.error('Error fetching location data:', error);
        });

    map.on('click', function (e) {
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;

        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker([lat, lng]).addTo(map);

        // Fetch the location using reverse geocoding
        fetchLocation({ lat, lng })
            .then(displayName => {
                document.getElementById('location').value = displayName; // Set the location input to the fetched address
            })
            .catch(error => {
                console.error('Error fetching location data:', error);
                document.getElementById('location').value = ''; // Clear the input in case of error
            });
    });

    // Image preview functionality
    const imageInput = document.getElementById('images'); // Get the correct file input element
    const imagePreview = document.getElementById('image-preview'); // Get the img element for preview

    if (imageInput) {
        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0]; // Get the selected file

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result; // Set the src of the img to the file's data URL
                    imagePreview.style.display = 'block'; // Show the preview
                }
                reader.readAsDataURL(file); // Read the file as a data URL
            } else {
                imagePreview.src = ''; // Clear the preview if no file
                imagePreview.style.display = 'none'; // Hide the preview
            }
        });
    }
});

// Function to fetch location name from latitude and longitude
function fetchLocation(coords) {
    const { lat, lng } = coords;
    const url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`;

    return fetch(url)
        .then(response => response.json())
        .then(data => data.display_name || 'Unknown location');
}
