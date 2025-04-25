<?php
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

$sql = "SELECT student_id, password FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $student_id = $row['student_id'];
        $password = $row['password'];

        // Check if the password is hashed
        if (password_get_info($password)['algo'] === 0) {
            echo "Student ID: $student_id has a plain text password.<br>";
        } else {
            echo "Student ID: $student_id has a hashed password.<br>";
        }
    }
} else {
    echo "No students found.";
}

$conn->close();
?>