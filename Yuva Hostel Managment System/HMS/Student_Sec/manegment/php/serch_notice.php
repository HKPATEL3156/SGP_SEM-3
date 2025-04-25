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

if (isset($_GET['date'])) {
    $date = $_GET['date'];

    // Query to fetch notices by date
    $sql = "SELECT notice_text, date FROM notices WHERE date = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $date);
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }
    $stmt->bind_result($notice_text, $notice_date);

    $notices = [];
    while ($stmt->fetch()) {
        $notices[] = ['text' => $notice_text, 'date' => $notice_date];
    }

    // Return the notices as JSON
    echo json_encode($notices);

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode([]);
}
?>