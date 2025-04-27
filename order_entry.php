<?php

// ✅ Start output buffering (Fix header issue)
ob_start();

// ✅ Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "order_db";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// ✅ Retrieve Form Data
$fullname = $_POST['firstname'];
$email = $_POST['email'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];


// ✅ Secure insertion using prepared statements
$sql = "INSERT INTO payments (fullname, email, address, city, state, zip) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $fullname, $email, $address, $city, $state, $zip);

// ✅ Close connections
$stmt->close();
$conn->close();

// ✅ End output buffering
ob_end_flush();

?>
