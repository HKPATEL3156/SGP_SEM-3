<?php
session_start();
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
    $student_name = $_POST['student-name'];
    $id_number = $_POST['id-number'];
    $start_date = $_POST['start-date'];
    $end_date = $_POST['end-date'];
    $leave_type = $_POST['leave-type'];
    $reason = $_POST['reason'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO leave_applications (student_name, id_number, start_date, end_date, leave_type, reason) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $student_name, $id_number, $start_date, $end_date, $leave_type, $reason);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to leave_application.html with success parameter
        header("Location: leave_application.html?success=1");
        exit();
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