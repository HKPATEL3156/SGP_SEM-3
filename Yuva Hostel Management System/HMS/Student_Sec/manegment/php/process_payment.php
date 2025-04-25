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

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['student_name'], $_POST['student_id'], $_POST['amount'], $_POST['payment_date'])) {
        $student_name = $_POST['student_name'];
        $student_id = $_POST['student_id'];
        $amount = $_POST['amount'];
        $payment_date = $_POST['payment_date'];
        $total_fees = 1000000; // Assuming the total fees for the student

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO fees (student_name, student_id, amount_paid, payment_date) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            $response['status'] = 'error';
            $response['message'] = "Prepare failed: " . $conn->error;
            echo json_encode($response);
            exit;
        }
        $stmt->bind_param("ssds", $student_name, $student_id, $amount, $payment_date);

        // Execute the statement
        if ($stmt->execute()) {
            // Calculate the remaining amount
            $remaining_amount = $total_fees - $amount;

            // Successful payment response
            $response['status'] = 'success';
            $response['message'] = 'Payment successful!';
            $response['data'] = array(
                'student_name' => $student_name,
                'student_id' => $student_id,
                'amount_paid' => $amount,
                'payment_date' => $payment_date,
                'remaining_amount' => $remaining_amount
            );
        } else {
            $response['status'] = 'error';
            $response['message'] = "Execute failed: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Missing required fields
        $response['status'] = 'error';
        $response['message'] = 'All form fields are required.';
    }
    // Close the connection
    $conn->close();
} else {
    // Invalid request method
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

// Output the response in JSON format
echo json_encode($response);
?>
