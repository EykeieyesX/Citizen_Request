<?php
session_set_cookie_params(0); 
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: AdminLogin.html");
    exit();
}

// Initialize error and success messages
$errorMessage = "";
$successMessage = "";

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

// Retrieve admin data from the database
$currentUsername = $_SESSION['username'];
$stmt = $conn->prepare("SELECT username, firstname, lastname, barangay FROM admincredentials WHERE username = ?");
$stmt->bind_param("s", $currentUsername);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = htmlspecialchars($row['username']);
    $firstname = htmlspecialchars($row['firstname']);
    $lastname = htmlspecialchars($row['lastname']);
    $barangay = htmlspecialchars($row['barangay']);
} else {
    echo "Error: User not found.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
    <title>Admin Announcements</title>
</head>
<body>

<div class="container">
    <!-- Side bar -->
    <aside id="sidebar">
        <div class="toggle">
            <div class="logo">
                <img src="images/iconx.png" alt="Logo">
                <h2>Welcome</h2>
            </div>
            <div class="close" id="toggle-btn">
                <span class="material-icons-sharp">menu_open</span>
            </div>
        </div>

        <div class="sidebar">
            <a href="AdminDashboard.php">
                <span class="material-symbols-outlined">dashboard</span>
                <h3>Dashboard</h3>
            </a>
            <a href="admin.php">
                <span class="material-symbols-outlined">shield_person</span>
                <h3>Admin</h3>
            </a>
            <a href="AdminAnnouncement.php" class="active">
                <span class="material-symbols-outlined">add_box</span>
                <h3>Announcements</h3>
            </a>
            <a href="Reviewsubmissions.php">
                <span class="material-symbols-outlined">rate_review</span>
                <h3>Review Request & Feedback</h3>
            </a>
        </div>
    </aside>
    <!-- Sidebar end -->

    <!-- Main content per page -->
    <div class="main--content">
        <h2>Create an Announcement</h2>

        <!-- Form for announcement creation -->
        <form id="announcementForm" enctype="multipart/form-data">
            <label for="topic">Topic:</label><br>
                <input type="text" id="topic" name="topic" required><br><br>

            <label for="description">Description:</label><br>
                <textarea id="description" name="description" rows="5" cols="40" required></textarea><br><br>

            <label for="image">Upload Image:</label><br>
                <input type="file" id="image" name="image" accept="image/*"><br><br>

            <!-- Image preview section -->
            <img id="image-preview" src="" alt="Image Preview" style="max-width: 300px; display:none;"><br><br>

            <div class="postannouncementbutton">
                <button type="submit">Post Announcement</button>
            </div>
        </form>

        <!-- Success message -->
        <p id="successMessage" style="color:green; display:none;">Your announcement has been posted</p>

        <!-- Error message -->
        <p id="errorMessage" style="color:red; display:none;"></p>
    </div>
    
    <nav class="navigation">
        <button id="theme-toggle" class="btn-theme-toggle">
            <span class="material-symbols-outlined">light_mode</span>
        </button>
        <button class="btnLogin-popup"><a href="admin_logout.php">Logout</a></button>
    </nav>
</div>

<script src="script.js"></script>
<script>
    // Handle form submission
    document.getElementById('announcementForm').addEventListener('submit', function(event) {
        event.preventDefault();
        
        const formData = new FormData(this);
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/submit_announcement.php', true);
        
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = xhr.responseText;
                if (response === 'success') {
                    document.getElementById('successMessage').style.display = 'block';
                    document.getElementById('errorMessage').style.display = 'none';
                    document.getElementById('announcementForm').reset();
                    
                    // Clear image preview after successful submission
                    const imagePreview = document.getElementById('image-preview');
                    imagePreview.src = '';
                    imagePreview.style.display = 'none';
                } else {
                    document.getElementById('errorMessage').style.display = 'block';
                    document.getElementById('errorMessage').textContent = response;
                }
            }
        };
        
        xhr.send(formData);
    });

    // Image preview when a file is selected
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const imagePreview = document.getElementById('image-preview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '';
            imagePreview.style.display = 'none';
        }
    });
</script>
</body>
</html>
