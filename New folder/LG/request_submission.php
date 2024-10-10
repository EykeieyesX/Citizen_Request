<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "lgutestdb"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = $_POST['email'];
$topic = $_POST['topic'];
$description = $_POST['description'];
$location = $_POST['location'];
$images = isset($_FILES['images']) ? $_FILES['images'] : null; // Check if images exist

// Check if the topic is "Feedback"
if ($topic === 'Feedback') {
    // Prepare and bind for feedback table
    $stmt = $conn->prepare("INSERT INTO feedback (Email, Topic, Description, Location, Images, Submitted_date) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssss", $email, $topic, $description, $location, $images['name']); 

    // Handle file upload
    if ($images && !empty($images['name'])) {
        if ($images['error'] === UPLOAD_ERR_OK) {
            move_uploaded_file($images['tmp_name'], "uploads/" . basename($images['name']));
        } else {
            echo "File upload error: " . $images['error'];
            exit; 
        }
    }

    // Execute the insert query
    if ($stmt->execute()) {
        echo "Thank you for your feedback."; // Return success message
    } else {
        echo "Error inserting feedback: " . $stmt->error; 
    }

    $stmt->close();
} else {
    // If it's not feedback, continue with the request table (unchanged)
    $reference_id = 'REF-' . strtoupper(substr(bin2hex(random_bytes(4)), 0, 7));
    $status = 'Submitted';

    // Prepare and bind for request table
    $stmt = $conn->prepare("INSERT INTO request (Email, Topic, Description, Location, Images, reference_id, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $email, $topic, $description, $location, $images['name'], $reference_id, $status); // Bind parameters

    // Handle file upload
    if ($images && !empty($images['name'])) {
        if ($images['error'] === UPLOAD_ERR_OK) {
            move_uploaded_file($images['tmp_name'], "uploads/" . basename($images['name']));
        } else {
            echo "File upload error: " . $images['error'];
            exit; 
        }
    }

    // Execute the insert query
    if ($stmt->execute()) {
        echo $reference_id; // Return the reference ID for other requests
    } else {
        echo "Error inserting request: " . $stmt->error; 
    }

    $stmt->close();
}

$conn->close();
?>