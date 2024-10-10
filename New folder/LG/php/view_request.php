<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: AdminLogin.html");
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

$reference_id = $_GET['reference_id'];

$sql = "SELECT * FROM Request WHERE reference_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $reference_id);
$stmt->execute();
$result = $stmt->get_result();
$request = $result->fetch_assoc();

if (!$request) {
    echo "Request not found!";
    exit();
}

// List of all valid statuses
$all_statuses = ['Submitted', 'Reviewed', 'In Progress', 'Completed', 'Cancelled'];
$current_status = $request['status'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_status = $_POST['status'];

    // Prepare the SQL update statement
    $sql_update = "UPDATE Request SET status = ?, last_updated = NOW() WHERE reference_id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ss", $new_status, $reference_id);

    if ($stmt_update->execute()) {
        echo "Status updated successfully!";
        header("Refresh:0");
    } else {
        echo "Error updating status: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Request</title>
    <link rel="stylesheet" href="../modal.css"> <!-- Separate CSS for Modal -->
</head>
<body>

<div class="view-request-container">
    <div class="view-request-header">
        <h2>Request Details</h2>
        
        <!-- Table for Request Information -->
        <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Reference ID:</td>
                <td><?php echo htmlspecialchars($request['reference_id']); ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo htmlspecialchars($request['email']); ?></td>
            </tr>
            <tr>
                <td>Topic:</td>
                <td><?php echo htmlspecialchars($request['topic']); ?></td>
            </tr>
            <tr>
                <td>Description:</td>
                <td><?php echo htmlspecialchars($request['description']); ?></td>
            </tr>
            <tr>
                <td>Location:</td>
                <td><?php echo htmlspecialchars($request['location']); ?></td>
            </tr>
            <tr>
                <td>Status:</td>
                <td><?php echo htmlspecialchars($request['status']); ?></td>
            </tr>
            <tr>
                <td>Submitted Date:</td>
                <td><?php echo htmlspecialchars($request['submitted_date']); ?></td>
            </tr>
            <tr>
                <td>Last Updated:</td>
                <td><?php echo htmlspecialchars($request['last_updated']); ?></td>
            </tr>
        </table>

      <!-- Display Images if available -->
<div class="images-container">
    <h3>Attached Images</h3>
    <div class="image-gallery">
        <?php if (!empty($request['images']) && $request['images'] !== 'NULL'): // Ensure it's not NULL ?>
            <?php $images = explode(',', $request['images']); ?>
            <?php foreach ($images as $image): ?>
                <img src="../uploads/<?php echo htmlspecialchars($image); ?>" class="request-image" style="width:100px; margin-right: 5px; cursor: pointer;" alt="Attached Image" onclick="openModal(this.src)">
            <?php endforeach; ?>
        <?php else: ?>
            <p>No image attached.</p>
        <?php endif; ?>
    </div>
</div>

        <div class="statuschange">
            <h3>Update Status</h3>
            <div class="view-updatestatus">
                <form method="POST" action="">
                    <label for="status">Status:</label>
                    <select name="status" id="status" <?php echo ($current_status === 'Completed' || $current_status === 'Cancelled') ? 'disabled' : ''; ?>>
                        <option value="">Change Status</option>
                        <?php foreach ($all_statuses as $status) { ?>
                            <option value="<?php echo $status; ?>" <?php if ($status === $current_status) echo 'selected'; ?>><?php echo $status; ?></option>
                        <?php } ?>
                    </select>
                </div>
        
                <div class="updaterequeststatus">
                    <?php if ($current_status !== 'Completed' && $current_status !== 'Cancelled') { ?>
                        <button type="submit">Update</button>
                    <?php } else { ?>
                        <p>Status cannot be changed when it is Completed or Cancelled.</p>
                    <?php } ?>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Zoomed Image -->
<div id="myModal" class="modal" style="display:none;">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage" alt="Zoomed Image">
</div>

<div class="backtoreview">
    <a href="../reviewsubmissions.php">Back to Review Submissions</a>
</div>

<script>
    function openModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('myModal').style.display = "flex";
    }

    function closeModal() {
        document.getElementById('myModal').style.display = "none";
    }

    // Close the modal when clicking outside of the image
    window.onclick = function(event) {
        if (event.target == document.getElementById('myModal')) {
            closeModal();
        }
    }
</script>

</body>
</html>

<?php
$conn->close();
?>
