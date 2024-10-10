<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: AdminLogin.html");
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
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user data from the database
$currentUsername = $_SESSION['username'];
$stmt = $conn->prepare("SELECT username, firstname, lastname, barangay, password FROM admincredentials WHERE username = ?");
$stmt->bind_param("s", $currentUsername);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists and fetch data
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $storedUsername = $row['username'];
    $storedFirstname = $row['firstname'];
    $storedLastname = $row['lastname'];
    $storedBarangay = $row['barangay'];
    $storedPassword = $row['password']; // Password hash
} else {
    header("Location: admin.php?error=" . urlencode("User not found"));
    exit();
}

$stmt->close();

// Check current password and update profile
$currentPassword = $_POST['current_password'];
$newUsername = $_POST['username'];
$newFirstname = $_POST['firstname'];
$newLastname = $_POST['lastname'];
$newBarangay = $_POST['barangay'];
$newPassword = $_POST['new_password'];

// Verify current password
if (!password_verify($currentPassword, $storedPassword)) {
    header("Location: admin.php?error=" . urlencode("Incorrect current password"));
    exit();
}

// Update profile data
$stmt = $conn->prepare("UPDATE admincredentials SET username = ?, firstname = ?, lastname = ?, barangay = ? WHERE username = ?");
$stmt->bind_param("sssss", $newUsername, $newFirstname, $newLastname, $newBarangay, $currentUsername);

if ($stmt->execute()) {
    // Update password if provided
    if (!empty($newPassword)) {
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE admincredentials SET password = ? WHERE username = ?");
        $stmt->bind_param("ss", $hashedNewPassword, $newUsername);
        $stmt->execute();
    }
    header("Location: admin.php?success=1");
} else {
    header("Location: admin.php?error=" . urlencode("Error updating profile: " . $stmt->error));
}

$stmt->close();
$conn->close();
?>
