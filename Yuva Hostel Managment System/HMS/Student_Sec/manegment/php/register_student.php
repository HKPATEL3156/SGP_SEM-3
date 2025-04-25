<?php
// Database configuration
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Enable error reporting
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Start output buffering
    ob_start();

    $photo = $_FILES['photo']['name'];
    $name = $_POST['name'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $dob = $_POST['dob'];
    $blood_group = $_POST['blood_group'];
    $caste = $_POST['caste'];
    $religion = $_POST['religion'];
    $address = $_POST['address'];
    $university = $_POST['university'];
    $institute = $_POST['institute'];
    $program = $_POST['program'];
    $current_semester = $_POST['current_semester'];
    $student_contact = $_POST['student_contact'];
    $parent_contact = $_POST['parent_contact'];
    $emergency_contact = $_POST['emergency_contact'];

    // Upload photo
    $target_dir = "../ids/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($photo);
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        // Generate unique ID and password
        $student_id = uniqid('STU_');
        $password = bin2hex(random_bytes(4)); // Generate a random 8-character password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password

        // Insert data into database
        $sql = "INSERT INTO students (student_id, password, photo, name, father_name, mother_name, dob, blood_group, caste, religion, address, university, institute, program, current_semester, student_contact, parent_contact, emergency_contact)
                VALUES ('$student_id', '$hashedPassword', '$photo', '$name', '$father_name', '$mother_name', '$dob', '$blood_group', '$caste', '$religion', '$address', '$university', '$institute', '$program', '$current_semester', '$student_contact', '$parent_contact', '$emergency_contact')";

        if ($conn->query($sql) === TRUE) {
            header("Location: http://localhost/HMS/Student_Sec/manegment/success.php?student_id=$student_id&password=$password");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }

    $conn->close();
    ob_end_flush();
}
?>