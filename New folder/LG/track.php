<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
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

$email = $_SESSION['email'];
$sql = "SELECT reference_id, status, submitted_date, last_updated FROM request WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // No requests found, set result_array to an empty array
    $result_array = [];
} else {
    $result_array = [];
    while ($row = $result->fetch_assoc()) {
        $row['status_class'] = strtolower($row['status']); 
        $result_array[] = $row;
    }
}

$result = $result_array; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="track.css"> 
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
                <a href="Submit.php">
                    <span class="material-symbols-outlined">rate_review</span>
                    <h3>Submit a Request or Feedback</h3>
                </a>
                <a href="track.php" class="active">
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
            <h2>Track your Requests</h2>
            
            <table id="tracking-table">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Status</th>
                        <th>Submitted Date</th>
                        <th>Last Updated</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['reference_id']); ?></td>
                        <td>
                            <div class="status-container">
                                <span class="status <?php echo isset($row['status_class']) ? $row['status_class'] : ''; ?>">
                                    <?php echo htmlspecialchars($row['status']); ?>
                                </span>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($row['submitted_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['last_updated']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <nav class="navigation">
            <button id="theme-toggle" class="btn-theme-toggle">
                <span class="material-symbols-outlined">light_mode</span>
            </button>
            <button class="btnLogin-popup"><a href="logout.php">Logout</a></button>
        </nav>
    </div>

    <script src="script.js"></script>
    <script src="index.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
