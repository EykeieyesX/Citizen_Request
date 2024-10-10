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

// Query to count pending requests
$pendingRequestsQuery = "SELECT COUNT(*) as pendingCount FROM request WHERE status IN ('Submitted', 'Reviewed', 'In-Progress')";
$pendingResult = $conn->query($pendingRequestsQuery);
$pendingCount = $pendingResult->fetch_assoc()['pendingCount'];

// Query to count total users
$userCountQuery = "SELECT COUNT(*) as userCount FROM usercredentials"; 
$result = $conn->query($userCountQuery);
$userCount = $result->fetch_assoc()['userCount'];

// Query to count total feedback
$feedbackCountQuery = "SELECT COUNT(*) as feedbackCount FROM feedback"; 
$feedbackCountResult = $conn->query($feedbackCountQuery);
$feedbackCount = $feedbackCountResult->fetch_assoc()['feedbackCount'];

// Query to get pending requests details
$pendingRequestsQuery = "SELECT reference_id, email, topic, description, location, images, status FROM request WHERE status IN ('Submitted', 'Reviewed', 'In-Progress')";
$pendingRequestsResult = $conn->query($pendingRequestsQuery);

// Query for user list
$userListQuery = "SELECT firstname, lastname, email FROM usercredentials"; 
$userListResult = $conn->query($userListQuery);

// Query for feedback list
$feedbackQuery = "SELECT email, topic, description, location, images, submitted_date FROM feedback"; 
$feedbackResult = $conn->query($feedbackQuery);

// Function to update request status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reference_id'], $_POST['new_status'])) {
    $reference_id = $_POST['reference_id']; 
    $new_status = $_POST['new_status'];

    $updateStatusQuery = "UPDATE request SET status = ? WHERE `reference_id` = ?"; 
    $stmt = $conn->prepare($updateStatusQuery);
    $stmt->bind_param("ss", $new_status, $reference_id); 
    $stmt->execute();
    $stmt->close();
    
    header("Location: admindashboard.php");
    exit();
}
// Query for analytics data from requests
$analyticsQuery = "
    SELECT 
        status, COUNT(*) as count 
    FROM 
        request 
    GROUP BY 
        status
";
$analyticsResult = $conn->query($analyticsQuery);
$analyticsData = [];
while ($row = $analyticsResult->fetch_assoc()) {
    $analyticsData[$row['status']] = (int)$row['count'];
}

// Prepare data for feedback analytics
$feedbackAnalyticsQuery = "
    SELECT 
        topic, COUNT(*) as count 
    FROM 
        feedback 
    GROUP BY 
        topic
";
$feedbackAnalyticsResult = $conn->query($feedbackAnalyticsQuery);
$feedbackAnalyticsData = [];
while ($row = $feedbackAnalyticsResult->fetch_assoc()) {
    $feedbackAnalyticsData[$row['topic']] = (int)$row['count'];
}

// Fetch request counts by status
$SubmittedRequestsCount = $conn->query("SELECT COUNT(*) FROM request WHERE status = 'Submitted'")->fetch_row()[0];
$reviewedRequestsCount = $conn->query("SELECT COUNT(*) FROM request WHERE status = 'reviewed'")->fetch_row()[0];
$inProgressRequestsCount = $conn->query("SELECT COUNT(*) FROM request WHERE status = 'in-progress'")->fetch_row()[0];
$completedRequestsCount = $conn->query("SELECT COUNT(*) FROM request WHERE status = 'completed'")->fetch_row()[0];
$cancelledRequestsCount = $conn->query("SELECT COUNT(*) FROM request WHERE status = 'cancelled'")->fetch_row()[0];



// Fetch total feedback count
$submittedFeedbackCount = $conn->query("SELECT COUNT(*) FROM feedback")->fetch_row()[0];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
    <title>LGU Admin Dashboard</title>
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
                <a href="AdminDashboard.php" class="active">
                    <span class="material-symbols-outlined">dashboard</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="admin.php">
                    <span class="material-symbols-outlined">shield_person</span>
                    <h3>Admin</h3>
                </a>
                <a href="AdminAnnouncement.php">
                    <span class="material-symbols-outlined">add_box</span>
                    <h3>Announcements</h3>
                </a>
                <a href="reviewsubmissions.php">
                    <span class="material-symbols-outlined">rate_review</span>         
                    <h3>Review Request & Feedback</h3>
                </a>
            </div>
        </aside>
        <!--Sidebar end-->

        <!--Main content per page-->
        <div class="main--content">
            <div class="header--wrapper">
                <h2>Dashboard</h2>
            </div>

            <div class="card-container">
                <!-- First card for pending requests -->
                <div class="card">
                    <h3><span class="material-symbols-outlined">description</span> Pending Requests</h3>
                    <p>Total Pending Requests: <?php echo $pendingCount; ?></p>
                </div>

                <div class="card">
                    <h3><span class="material-symbols-outlined">feedback</span> Review Feedbacks</h3>
                    <p>Total Reviews: <?php echo $feedbackCount; ?></p>
                </div>

                <div class="card" onclick="scrollToUserList()">
                    <h3><span class="material-symbols-outlined">group</span> Users</h3>
                    <p>Total Users: <?php echo $userCount; ?></p>
                </div>

                <div id="analyticsCard"class="card">
                    <h3><span class="material-symbols-outlined">monitoring</span> Analytics</h3>
                    <p>Click card to view analytics</p>
                </div>
            </div>

            <!-- Pending requests section with the same class as userlist-->
            <div id="pending-requests" class="user-list-section">
                <h2>Pending Requests</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Topic</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>REF ID</th>
                            <th>Images</th>
                            <th>Status</th>
                            <th>Quick Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($pendingRequestsResult->num_rows > 0) {
                            while($row = $pendingRequestsResult->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['topic']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['reference_id']) . "</td>";
                                if (!empty($row['images'])) {
                                    $images = explode(',', $row['images']); 
                                    echo "<td>";
                                    foreach ($images as $image) {
                                        echo "<img src='uploads/" . htmlspecialchars($image) . "' alt='Attached Image' style='width:100px; margin-right: 5px;'>";
                                    }
                                    echo "</td>";
                                } else {
                                    echo "<td>No Image</td>";
                                }

                                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                echo "<td>";
                                echo "<form action='admindashboard.php' method='POST'>"; 
                                echo "<input type='hidden' name='reference_id' value='" . htmlspecialchars($row['reference_id']) . "' />";
                                echo "<select name='new_status' onchange='this.form.submit()'>";
                                echo "<option value=''>Change Status</option>";
                                echo "<option value='Reviewed'>Reviewed</option>";
                                echo "<option value='In-progress'>In-Progress</option>";
                                echo "<option value='Cancelled'>Cancelled</option>";
                                echo "<option value='Completed'>Completed</option>";
                                echo "</select>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No pending requests found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Feedback section -->
            <div id="feedback-list" class="user-list-section">
                <h2>User Feedback</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Topic</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Images</th>
                            <th>Submitted Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($feedbackResult->num_rows > 0) {
                            while($row = $feedbackResult->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['topic']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                                if (!empty($row['images'])) {
                                    $images = explode(',', $row['images']); 
                                    echo "<td>";
                                    foreach ($images as $image) {
                                        echo "<img src='uploads/" . htmlspecialchars($image) . "' alt='Feedback Image' style='width:100px; margin-right: 5px;'>";
                                    }
                                    echo "</td>";
                                } else {
                                    echo "<td>No Image</td>";
                                }
                                echo "<td>" . htmlspecialchars($row['submitted_date']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No feedback found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- User List Section -->
            <div id="user-list" class="user-list-section">
                <h2>User List</h2>
                <table>
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($userListResult->num_rows > 0) {
                            while($row = $userListResult->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['firstname']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['lastname']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No users found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

             <!-- Analytics Panel -->
            <div id="analyticsPanel" class="analyticspanel">
                <h2>Analytics Overview</h2>
                <canvas id="analyticsChart" width="500" height="500" style="max-width: 500px; max-height: 500px;"></canvas>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const ctx = document.getElementById('analyticsChart').getContext('2d');
                    const analyticsChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Pending Requests', 'Completed Requests', 'Canceled Requests', 'Reviewed Requests', 'In Progress Requests'],
                            datasets: [{
                                label: 'Analytics Overview',
                                data: [
                                    <?php echo json_encode($SubmittedRequestsCount); ?>,
                                    <?php echo json_encode($completedRequestsCount); ?>,
                                    <?php echo json_encode($cancelledRequestsCount); ?>,
                                    <?php echo json_encode($reviewedRequestsCount); ?>,
                                    <?php echo json_encode($inProgressRequestsCount); ?>
                                ],
                                backgroundColor: [
                                    'rgba(0, 0, 255)', // Pending /submitted Requests
                                    'rgba(50, 211, 0)', // Completed Requests
                                    'rgba(255, 0, 0)', // Canceled Requests
                                    'rgba(255, 165, 0)', // Reviewed Requests
                                    'rgba(255, 255, 0)'  // In Progress Requests
                                ],
                                borderColor: [
                                    'rgba(0, 0, 255, 1)',
                                    'rgba50, 211, 0, 1)',
                                    'rgba(255, 0, 0 1)',
                                    'rgba(255, 165, 0, 1)',
                                    'rgba(255, 255, 0, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: false, 
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ': ' + tooltipItem.raw;
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>
            </div>

        </div>
        <!-- End of Main content -->
        <nav class="navigation">
            <div class="user-info">
                <span>Welcome, <?php echo htmlspecialchars($username); ?></span>
            </div>

            <button id="theme-toggle" class="btn-theme-toggle">
                <span class="material-symbols-outlined">light_mode
                <span class="material-symbols-outlined">light_mode</span>
                Toggle Theme
            </button>
            <button class="btnLogin-popup"><a href="admin_logout.php">Logout</a></button>
        </nav>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="script.js"></script>
</body>
</html>

