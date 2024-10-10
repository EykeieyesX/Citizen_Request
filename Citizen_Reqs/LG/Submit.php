<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
$email = $_SESSION['email']; // Get the email of the logged-in user
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
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
                    <span class="material-icons-sharp">menu_open</span>
                </div>
            </div>

            <div class="sidebar">
                <a href="Home.php">
                    <span class="material-icons-sharp">home</span>
                    <h3>Home</h3>
                </a>
                <a href="User.php">
                    <span class="material-icons-sharp">person_outline</span>
                    <h3>User</h3>
                </a>
                <a href="Announcement.html">
                    <span class="material-icons-sharp">campaign</span>
                    <h3>Announcement</h3>
                </a>
                <a href="Submit.php" class="active">
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
        <!-- Sidebar end-->

        <!-- Main content per page-->
        <div class="main--content">
            <h2>Submit a Request or Feedback</h2>
    
            <form id="request-form" action="request_submission.php" method="POST" enctype="multipart/form-data">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required readonly>
                
                <label for="topic">Topic:</label>
                <select id="topic" name="topic" required>
                    <option value="" disabled selected>Select a topic</option>
                    <option value="General Inquiry">General Inquiry</option>
                    <option value="Technical Support">Technical Support</option>
                    <option value="Feedback">Feedback</option>
                    <option value="Complaint">Complaint</option>
                </select>
                
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>
                <input type="file" name="images" id="images"> 
                <img id="image-preview" src="" alt="Image Preview" style="display:none;">
                <br>
                <br>
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>
                
                <div id="map" style="height: 300px; width: 100%;"></div> 
                
                    <div class="submitbutton">
                        <button type="submit">Submit</button>
                    </div>
                <div id="success-message"></div> 
            </form>
        </div>

        <nav class="navigation">
            <button id="theme-toggle" class="btn-theme-toggle">
                <span class="material-symbols-outlined">light_mode</span>
            </button>
            <button class="btnLogin-popup"><a href="logout.php">Logout</a></button>
        </nav>
    </div>

    <script src="script.js"></script>  
    <script src="submit.js"></script> 
    <script src="maps.js"></script> 
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

</body>
</html>
