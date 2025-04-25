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
session_start();

// Fetch profile information
$student_id = $_SESSION['student_id']; // Assuming we are fetching the profile of the student with this ID
$sql = "SELECT * FROM students WHERE student_id = '$student_id'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error: " . $conn->error);
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No profile found.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/first4.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="hleft">
                <img class="logo" src="logor.png" alt="Yuva_Hostel_icon">
                <h1>Yuva Hostel</h1>
            </div>
            <ul class="hright">
                <li class="icon1"><a href="index.html"><i class="fa-solid fa-user"></i></a></li>
                <li class="icon2"><a href="dashboard.html"><i class="fa-solid fa-gauge"></i></a></li>
                <li class="icon3"><a href="food_menu.html"><i class="fa-solid fa-utensils"></i></a></li>
                <li class="icon4"><a href="notification.html"><i class="fa-solid fa-bell"></i></a></li>
                <li class="icon5"><a href="logout.html"><i class="fa-solid fa-right-from-bracket"></i></a></li>
            </ul>
            <div class="hamburger-menu" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars"></i>
            </div>
        </header>

        <!-- Sidebar -->
        <aside class="sidebar">
         <ul>
            <a href="index.php">
               <li>
                  <i class="fa-solid fa-user"></i>
                  Profile
               </li>
            </a>
            <a href="first4.html">
               <li>
                  <i class="fa-solid fa-gauge"></i> Dashboard
               </li>
            </a>
            <a href="notice_board.html">
               <li>
                  <i class="fa-solid fa-bullhorn"></i>
                  Notice Board
               </li>
            </a>
            <a href="edit_password.html">
               <li>
                  <i class="fa-solid fa-lock"></i>
                  Edit Password
               </li>
            </a>
            <a href="leave_application.html">
               <li>
                  <i class="fa-solid fa-person-walking-arrow-right"></i>
                  Leave Application
               </li>
            </a>
            <a href="food_menu.html">
               <li>
                  <i class="fa-solid fa-utensils"></i>
                  Food Menu
               </li>
            </a>
            <a href="fees/fees_detail.html">
               <li>
                  <i class="fa-solid fa-file-invoice-dollar"></i>
                  Fees Detail
               </li>
            </a>
            <a href="pay_fees.html">
               <li>
                  <i class="fa-solid fa-money-bill-wave"></i>
                  Pay Fees
               </li>
            </a>
            <a href="review_and_rating.html">
               <li>
                  <i class="fa-solid fa-star"></i>
                  Review & Rating
               </li>
            </a>
            <a href="query_or_doubt.html">
               <li>
                  <i class="fa-solid fa-question"></i>
                  Query section
               </li>
            </a>
         </ul>
      </aside>

        <!-- Main Content -->
        <main class="mcontent">
            <div class="profile">
                <h2>Profile</h2>
                <div class="profile-info">
                    <div class="profile-photo">
                        <img src="uploads/<?php echo htmlspecialchars($row['photo']); ?>" alt="Profile Photo">
                    </div>
                    <div class="profile-details">
                        <div class="form-group">
                            <label>Name:</label>
                            <p><?php echo htmlspecialchars($row['name']); ?></p>
                        </div>
                        <div class="form-group">
                            <label>Father's Name:</label>
                            <p><?php echo htmlspecialchars($row['father_name']); ?></p>
                        </div>
                        <div class="form-group">
                            <label>Mother's Name:</label>
                            <p><?php echo htmlspecialchars($row['mother_name']); ?></p>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth:</label>
                            <p><?php echo htmlspecialchars($row['dob']); ?></p>
                        </div>
                        <div class="form-group">
                            <label>Blood Group:</label>
                            <p><?php echo htmlspecialchars($row['blood_group']); ?></p>
                        </div>
                        <div class="form-group">
                            <label>Caste:</label>
                            <p><?php echo htmlspecialchars($row['caste']); ?></p>
                        </div>
                        <div class="form-group">
                            <label>Religion:</label>
                            <p><?php echo htmlspecialchars($row['religion']); ?></p>
                        </div>
                        <div class="form-group">
                            <label>Address:</label>
                            <p><?php echo htmlspecialchars($row['address']); ?></p>
                        </div>
                        <div class="form-group">
                            <label>University:</label>
                            <p><?php echo htmlspecialchars($row['university']); ?></p>
                        </div>
                        <div class="form-group">
                            <label>Institute:</label>
                            <p><?php echo htmlspecialchars($row['institute']); ?></p>
                        </div>
                        <div class="form-group">
                            <label>Program:</label>
                            <p><?php echo htmlspecialchars($row['program']); ?></p>
                        </div>
                        <div class="form-group">
                            <label>Current Semester:</label>
                            <p><?php echo htmlspecialchars($row['current_semester']); ?></p>
                        </div>
                        <div class="form-group">
                            <label>Student Contact No:</label>
                            <p><?php echo htmlspecialchars($row['student_contact']); ?></p>
                        </div>
                        <div class="form-group">
                            <label>Parent Contact No:</label>
                            <p><?php echo htmlspecialchars($row['parent_contact']); ?></p>
                        </div>
                        <div class="form-group">
                            <label>Emergency Contact No:</label>
                            <p><?php echo htmlspecialchars($row['emergency_contact']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-info">
                <div class="contact-info">
                    <h4>Contact Us</h4>
                    <p>123 Yuva Hostel, near valetva chowkdi, nadiaad, kheda, Pincode: 395642</p>
                    <p>Phone: (123) 456-7890 | +91 - 9876543210</p>
                    <p>Email: yuvahosteloffice@gmail.com</p>
                </div>
                <div class="quick-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Facilities</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">FAQs</a></li>
                    </ul>
                </div>
                <div class="social-media">
                    <h4>Follow Us</h4>
                    <ul>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">LinkedIn</a></li>
                    </ul>
                </div>
                <div class="policies">
                    <h4>Policies</h4>
                    <ul>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Cancellation Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2024 Yuva Hostel Association. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }
    </script>
</body>

</html>