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
    $student_id = $_POST['UserID'];
    $password = $_POST['Password'];

    // Debugging: Check received data
    echo "Received student_id: $student_id<br>";
    echo "Received password: $password<br>";

    // Prepare and bind
    $stmt = $conn->prepare("SELECT password FROM students WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);

    // Execute the statement
    $stmt->execute();

    // Store the result
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Fetch the hashed password from the database
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            echo "Login successful!";
            // Store student_id in session
            $_SESSION['student_id'] = $student_id;
            // Redirect to management/first4.html
            header("Location: /HMS/Student_Sec/first4.html");
            exit();
        } else {
            echo "Invalid credentials. Please try again.";
        }
    } else {
        echo "Invalid credentials. Please try again.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>