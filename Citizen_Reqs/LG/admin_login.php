<?php
session_set_cookie_params(0);
session_start();

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "lgutestdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST["username"];
$password = $_POST["password"];

$stmt = $conn->prepare("SELECT * FROM admincredentials WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['username'] = $username;  
        header("Location: AdminDashboard.php");  
        exit();
    } else {
        // Incorrect password
        header("Location: AdminLogin.html?error=admin_password");
        exit();
    }
} else {
    // User not found
    header("Location: AdminLogin.html?error=admin_user_not_found");
    exit();
}

$stmt->close();
$conn->close();
?>
