<?php
session_start(); // Start a session to store messages

// Establish database connection
$servername = "localhost";
$username = "root";
$db_password = "";
$database = "chief"; // Ensure this is the correct database name and use underscore instead of spaces

// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Create connection
$conn = new mysqli($servername, $username, $db_password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if all required fields are set
    if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Securely hash the password

        // Check if username or email already exists
        $checkQuery = $conn->prepare("SELECT * FROM clients WHERE username=? OR email=?");
        $checkQuery->bind_param("ss", $username, $email);
        $checkQuery->execute();
        $checkResult = $checkQuery->get_result();

        if ($checkResult->num_rows > 0) {
            echo 'Username or email already exists';
        } else {
            // Insert new user into the database
            $insertQuery = $conn->prepare("INSERT INTO administrator (username, email, password) VALUES (?, ?, ?)");
            $insertQuery->bind_param("sss", $username, $email, $password);

            if ($insertQuery->execute()) {
                // Store a success message in session and redirect to the login page
                $_SESSION['signup_success'] = 'Signup successful! Please log in.';
                header('Location:ADMIN LOGIN PAGE.HTML'); // Ensure the file name is correct and has no spaces
                exit();
            } else {
                echo 'Error: ' . $insertQuery->error;
            }
            $insertQuery->close();
        }

        $checkQuery->close();
    } else {
        echo 'All fields are required.';
    }
}

$conn->close();
?>












