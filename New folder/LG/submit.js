document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('request-form').addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('request_submission.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            console.log("Response from server:", data); 

            // Handle Reference ID response
            if (data.startsWith("REF-")) {
                showSuccessMessage(`Your submission was successful! Your reference ID is: ${data}`);
                resetFormAndLocation();  
            } 
            // Handle feedback response
            else if (data.trim() === "Thank you for your feedback.") {  // Ensure the message is trimmed properly
                showSuccessMessage(data); // Show success message on webpage
                resetFormAndLocation();  
            } 
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    // Function to show success message
    function showSuccessMessage(message) {
        const successMessage = document.getElementById('success-message');
        successMessage.textContent = message;
        successMessage.style.display = 'block'; // Show the success message on the webpage
    }

    // Function to reset the form and clear location
    function resetFormAndLocation() {
        // Reset the form
        const form = document.getElementById('request-form');
        form.reset();  

        // Clear location field and map marker
        clearLocation(); 

        // Clear the image preview
        const imagePreview = document.getElementById('image-preview');
        imagePreview.src = ''; // Clear the image source
        imagePreview.style.display = 'none'; // Hide the image preview
    }

    // Function to clear location and remove the marker from the map
    function clearLocation() {
        const marker = window.marker;  // Ensure marker is accessible
        const map = window.map;        // Ensure map is accessible
        if (marker) {
            map.removeLayer(marker);
            window.marker = null; // Clear the global marker reference
        }
        document.getElementById('location').value = ''; // Reset location field
    }
});
