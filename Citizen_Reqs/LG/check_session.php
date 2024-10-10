<?php
session_start();
if (isset($_SESSION['username'])) {
    echo json_encode(['isLoggedIn' => true]);
} else {
    echo json_encode(['isLoggedIn' => false]);
}
?>
