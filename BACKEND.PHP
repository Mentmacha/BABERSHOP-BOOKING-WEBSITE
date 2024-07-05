<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "babershop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$haircut = $_POST['haircut'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$payment = isset($_POST['payment']) ? $_POST['payment'] : null;

if ($payment) {
    // Insert data into database
    $sql = "INSERT INTO book (haircut, name, phone, date, payment) VALUES ('$haircut', '$name', '$phone', '$date', '$payment')";

    if ($conn->query($sql) === TRUE) {
        echo "New booking recorded successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Error: Payment method is not selected.";
}

$conn->close();
?>





