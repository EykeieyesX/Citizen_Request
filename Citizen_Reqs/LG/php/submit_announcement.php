<?php
session_set_cookie_params(0);
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "Unauthorized access!";
    exit();
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lgutestdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $topic = $conn->real_escape_string($_POST['topic']);
    $description = $conn->real_escape_string($_POST['description']);
    $image = "";
    $username = $_SESSION['username'];  

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $targetDir = "../uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $image = $targetFile;
        } else {
            echo "Image upload failed.";
            exit();
        }
    }

    // Insert data into announcements table along with the admin's username
    $stmt = $conn->prepare("INSERT INTO announcements (Topic, Description, Images, username) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $topic, $description, $image, $username);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Failed to post announcement.";
    }

    $stmt->close();
}

$conn->close();
?>
