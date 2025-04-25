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

if (isset($_GET['room_no'])) {
    $room_no = $_GET['room_no'];

    // Query to count the number of students in a specific room
    $sql = "SELECT COUNT(*) AS student_count FROM students WHERE room_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $room_no); // 'i' for integer type
    $stmt->execute();
    $stmt->bind_result($student_count);
    $stmt->fetch();

    // Return the student count as JSON
    echo json_encode(array('count' => $student_count));

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(array('error' => 'Room number is required.'));
}
?>
