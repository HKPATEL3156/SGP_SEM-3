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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_name = $_POST['student_name'];
    $student_id = $_POST['student_id'];
    $date = $_POST['date'];
    $facility = $_POST['facility'];
    $query_content = "";

    // Process different types of content based on the selected facility
    if ($facility == 'image' && isset($_FILES['image-upload'])) {
        // Handle image file upload
        $image = $_FILES['image-upload'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image["name"]);
        move_uploaded_file($image["tmp_name"], $target_file);
        $query_content = $target_file; // Save the file path as the query content
    } elseif ($facility == 'text' && isset($_POST['text-input'])) {
        // Handle text input
        $query_content = $_POST['text-input'];
    } elseif ($facility == 'recording' && isset($_FILES['recording-upload'])) {
        // Handle recording file upload
        $recording = $_FILES['recording-upload'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($recording["name"]);
        move_uploaded_file($recording["tmp_name"], $target_file);
        $query_content = $target_file; // Save the file path as the query content
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO queries (student_name, student_id, date, facility, query) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $student_name, $student_id, $date, $facility, $query_content);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: ..Student_sec/query_or_doubt.html?success=1");
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
