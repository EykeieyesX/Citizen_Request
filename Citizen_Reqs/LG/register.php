<?php

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

// Retrieve the form data
$username = $_POST["username"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

// Check if username already exists
$username_check = $conn->prepare("SELECT * FROM usercredentials WHERE username = ?");
$username_check->bind_param("s", $username);
$username_check->execute();
$username_check->store_result();

if ($username_check->num_rows > 0) {
    $username_check->close();
    $conn->close();
    header("Location: index.html?error=username");
    exit();
}

$username_check->close();

// Check if email already exists
$email_check = $conn->prepare("SELECT * FROM usercredentials WHERE email = ?");
$email_check->bind_param("s", $email);
$email_check->execute();
$email_check->store_result();

if ($email_check->num_rows > 0) {
    $email_check->close();
    $conn->close();
    header("Location: index.html?error=email");
    exit();
}

$email_check->close();

// Insert the new user
$stmt = $conn->prepare("INSERT INTO usercredentials (username, firstname, lastname, email, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $username, $firstname, $lastname, $email, $password);

if ($stmt->execute()) {
    header("Location: index.html?success=registered");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
