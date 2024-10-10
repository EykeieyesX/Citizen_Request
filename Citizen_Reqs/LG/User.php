<?php
session_set_cookie_params(0); 
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lgutestdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$currentUsername = $_SESSION['username'];
$stmt = $conn->prepare("SELECT username, firstname, lastname, email, password FROM usercredentials WHERE username = ?");
$stmt->bind_param("s", $currentUsername);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = htmlspecialchars($row['username']);
    $firstname = htmlspecialchars($row['firstname']);
    $lastname = htmlspecialchars($row['lastname']);
    $email = htmlspecialchars($row['email']);
    $hashedPassword = $row['password']; 
} else {
    header("Location: index.html");
    exit();
}

$stmt->close();

$errorMessage = ""; 
$successMessage = ""; 

if (isset($_GET['error'])) {
    $errorMessage = htmlspecialchars($_GET['error']);
} elseif (isset($_GET['success'])) {
    $successMessage = "Profile updated successfully!";
}


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
    <title>User Profile Edit</title>
</head>
<body>

<div class="container">
    <!-- Side bar-->
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
            <a href="Home.php">
                <span class="material-icons-sharp">home</span>
                <h3>Home</h3>
            </a>
            <a href="User.php" class="active">
                <span class="material-icons-sharp">person_outline</span>
                <h3>User</h3>
            </a>
            <a href="Announcement.html">
                <span class="material-icons-sharp">campaign</span>
                <h3>Announcement</h3>
            </a>
            <a href="Submit.php">
                <span class="material-symbols-outlined">rate_review</span>         
                <h3>Submit a Request or Feedback</h3>
            </a>
            <a href="track.php">
                <span class="material-symbols-outlined">query_stats</span>
                <h3>Track</h3>
            </a>
            <a href="Contact.html">
                <span class="material-symbols-outlined">call</span>
                <h3>Contact Us</h3>
            </a>
            <a href="About.html">
                <span class="material-symbols-outlined">info</span>
                <h3>About Us</h3>
            </a>
        </div>
    </aside>
    <!--Sidebar end-->

    <!--Main content per page-->
    <div class="main--content">
        <h2>Edit Profile</h2>

        <!-- Display error message if there is one -->
        <?php if (!empty($errorMessage)): ?>
            <div class="error-message"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <!-- Display success message if profile was updated -->
        <?php if (!empty($successMessage)): ?>
            <div class="success-message"><?php echo $successMessage; ?></div>
        <?php endif; ?>

        <!-- User Profile Form -->
        <form action="user_update_profile.php" method="POST">
            <div class="profile-section">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>
            </div>

            <div class="profile-section">
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" value="<?php echo $firstname; ?>" required>
            </div>

            <div class="profile-section">
                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo $lastname; ?>" required>
            </div>

            <div class="profile-section">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>

            <div class="profile-section password-container">
                <label for="current_password">Current Password:</label>
                <input type="password" id="current_password" name="current_password" required>
                <button type="button" class="btn-show" onclick="togglePasswordVisibility('current_password')">Show</button>
            </div>

            <div class="profile-section password-container">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password">
                <button type="button" class="btn-show" onclick="togglePasswordVisibility('new_password')">Show</button>
            </div>

            <div class="formbuttons">
                <div class="updatebutton">
                    <button type="submit">Update Profile</button>
                </div>
            </div>
        </form>
        </div>

    <nav class="navigation">
        <button id="theme-toggle" class="btn-theme-toggle">
            <span class="material-symbols-outlined">light_mode</span>
        </button>
        <button class="btnLogin-popup"><a href="logout.php">Logout</a></button>
    </nav>

    <!-- Incorrect Password Popup -->
    <div class="passwordpopup" id="passwordpopup" style="display: <?php echo !empty($errorMessage) ? 'block' : 'none'; ?>;">
        <div class="popup-content">
            <span class="popup-close" onclick="this.parentElement.parentElement.style.display='none'">&times;</span>
            <img src="images/error.png" alt="Error Icon" class="popup-icon">
            <p><?php echo $errorMessage; ?></p>
        </div>
    </div>

    <!-- Profile Updated Popup -->
    <div class="successpopup" id="successpopup" style="display: <?php echo !empty($successMessage) ? 'block' : 'none'; ?>;">
        <div class="popup-content">
            <span class="popup-close" onclick="this.parentElement.parentElement.style.display='none'">&times;</span>
            <img src="images/success.png" alt="Success Icon" class="popup-icon">
            <p><?php echo $successMessage; ?></p>
        </div>
    </div>
</div>


        <!-- toggle password -->
<script>
function togglePasswordVisibility(fieldId, btn) {
    const passwordField = document.getElementById(fieldId);
    if (passwordField.type === "password") {
        passwordField.type = "text";
        btn.textContent = "Hide";
    } else {
        passwordField.type = "password";
        btn.textContent = "Show";
    }
}
</script>
<script src="script.js"></script>
</body>
</html>
