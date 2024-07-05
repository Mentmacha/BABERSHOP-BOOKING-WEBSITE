<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="receipt.css">
</head>

<body>
    <h2>Booking Receipt</h2>
    <?php
    // Get booking details from query parameters
    $haircut = $_GET['haircut'];
    $name = $_GET['name'];
    $phone = $_GET['phone'];
    $date = $_GET['date'];
    $payment = $_GET['payment'];

    // Display receipt
    echo "<p>Haircut: $haircut</p>";
    echo "<p>Name: $name</p>";
    echo "<p>Phone: $phone</p>";
    echo "<p>Date: $date</p>";
    echo "<p>Payment: $payment</p>";
    ?>
    <button onclick="window.print()">Print Receipt</button>
</body>
</html>

