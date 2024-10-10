<?php
session_set_cookie_params(0); 
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: AdminLogin.html');
    exit();
}

$username = $_SESSION['username'];

$conn = new mysqli("localhost", "root", "", "lgutestdb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"  rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
    <title>LGU User Dashboard</title>
</head>
<body>

    <div class="container">
        <!-- Side bar-->
        <aside id="sidebar">
            <div class="toggle">
                <div class="logo">
                    <img src="images/iconx.png">
                    <h2>Welcome</h2>
                </div>
                <div class="close" id="toggle-btn">
                    <span class="material-icons-sharp">
                        menu_open
                    </span>
                </div>
            </div>
            
            <div class="sidebar">
                <a href="Home.php" class="active">
                    <span class="material-icons-sharp">
                        home
                    </span>
                    <h3>Home</h3>
                </a>
                <a href="User.php">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>User</h3>
                </a>
                <a href="Announcement.html">
                    <span class="material-icons-sharp">
                        campaign
                    </span>
                    <h3>Announcement</h3>
                </a>
                <a href="Submit.php">
                    <span class="material-symbols-outlined">
                        rate_review
                    </span>         
                    <h3>Submit a Request or Feedback</h3>
                </a>
                <a href="track.php">
                    <span class="material-symbols-outlined">
                        query_stats
                    </span>
                    <h3>Track</h3>
                </a>
                <a href="Contact.html">
                    <span class="material-symbols-outlined">
                        call
                    </span>
                    <h3>Contact Us</h3>
                </a>
                <a href="About.html">
                    <span class="material-symbols-outlined">
                        info
                    </span>
                    <h3>About Us</h3>
                </a>
            </div>
        </aside>
        
        <!--Sidebar end-->
        <iframe src="chatbot.html" style="border: none; width: 70%; height: 600px; position: fixed; bottom: 10px; right: 10px; z-index: 1000"></iframe>
        <!--Main content per page-->
        <div class="main--content">
            <h2>Home</h2>
            
        </div>
        <nav class="navigation">
        <div class="user-info">
                <span>Welcome, <?php echo htmlspecialchars($username); ?></span>
        </div>
            <button id="theme-toggle" class="btn-theme-toggle">
                <span class="material-symbols-outlined">light_mode</span>
            </button>

            <button class="btnLogin-popup"><a href="logout.php">Logout</button>
        </nav>

    </div>

    <script src="script.js"></script>
</body>
</html>