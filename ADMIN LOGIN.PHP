<?php
session_start();
$admin_username = "ADMIN"; // Unique admin username
$admin_password = "ADMIN"; // Unique admin password

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == $admin_username && $password == $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: ADMIN PAGE.HTML");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>
