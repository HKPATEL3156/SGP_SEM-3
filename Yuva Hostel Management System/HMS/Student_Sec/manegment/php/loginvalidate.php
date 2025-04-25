<?php
// Assuming you have a database connection established
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userID = $_POST['UserID'];
    $password = $_POST['Password'];

    // Validate login credentials
    $sql = "SELECT * FROM students WHERE student_id = '$userID' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Login successful, fetch student data
        $student = mysqli_fetch_assoc($result);
        // Display student section
        echo "<h1>Welcome, " . $student['name'] . "</h1>";
        // Add more student-specific content here
    } else {
        echo "Invalid credentials. Please try again.";
    }

    mysqli_close($conn);
} else {
    echo "Invalid request method.";
}
?>