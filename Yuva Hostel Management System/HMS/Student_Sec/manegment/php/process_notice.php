<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostel_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $notice_text = $_POST['notice_text'];
    $notice_date = $_POST['notice_date'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO notices (notice_text, date) VALUES (?, ?)");
    $stmt->bind_param("ss", $notice_text, $notice_date);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Notice saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>