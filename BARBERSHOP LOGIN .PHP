<?php
session_start(); // Start a session to store messages

// Establish database connection
$servername = "localhost";
$username = "root";
$db_password = "";
$database = "sign"; // Database name for login credentials

// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Create connection
$conn = new mysqli($servername, $username, $db_password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if username and password are provided
    if (isset($_POST['username'], $_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Retrieve the hashed password from the database
        $query = $conn->prepare("SELECT password FROM clients WHERE username=?");
        $query->bind_param("s", $username);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Password is correct, set session and redirect to main page
                $_SESSION['username'] = $username;
                header('Location:BABERSHOP  BOOKING PAGE.HTML '); // Replace MAIN_PAGE.PHP with the actual main page file
                exit();
            } else {
                echo 'Incorrect username or password';
            }
        } else {
            echo 'Incorrect username or password';
        }
    } else {
        echo 'Username and password are required';
    }
}

$conn->close();
?>























































