<?php
// delete_user.php
session_start();
$conn = new mysqli("localhost", "root", "", "lgutestdb");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['user_email']; // Use email as the identifier

    // Prepare the delete statement
    $deleteQuery = "DELETE FROM usercredentials WHERE email=?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("s", $email); // Bind the email parameter
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Redirect back to the admin dashboard with a success message
        header("Location: AdminDashboard.php?success=User deleted successfully.");
    } else {
        // Redirect back to the admin dashboard with an error message
        header("Location: AdminDashboard.php?error=User not found.");
    }

    $stmt->close();
} else {
    http_response_code(405); 
}
?>
