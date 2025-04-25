<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query Management</title>
    <link rel="stylesheet" href="css/dashbord.css">
    <link rel="stylesheet" href="css/query_management.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <!-- header -->
        <header class="header">
            <div class="hleft">
                <img class="logo" src="logor.png" alt="Yuva_Hostel_icon">
                <h1>Yuva Hostel</h1>
            </div>
            <ul class="hright">
                <li class="icon1"><a href="index.php"><i class="fa-solid fa-user"></i></a></li>
                <li class="icon2"><a href="dashboard.html"><i class="fa-solid fa-gauge"></i></a></li>
                <li class="icon3"><a href="food_menu.html"><i class="fa-solid fa-utensils"></i></a></li>
                <li class="icon4"><a href="notification.html"><i class="fa-solid fa-bell"></i></a></li>
                <li class="icon5"><a href="logout.html"><i class="fa-solid fa-right-from-bracket"></i></a></li>
            </ul>
            <div class="hamburger-menu" onclick="toggleSidebar()"><i class="fa-solid fa-bars"></i></div>
        </header>
        <!-- sidebar -->
        <aside class="sidebar">
            <ul>
                <a href="index.html"><li><i class="fa-solid fa-user"></i> Profile</li></a>
                <a href="dashboard.html"><li><i class="fa-solid fa-gauge"></i> Dashboard</li></a>
                <a href="studentreg.html"><li><i class="fa-solid fa-user-plus"></i> Register Student</li></a>
                <a href="room.html"><li><i class="fa-solid fa-bed"></i> Room Availability</li></a>
                <a href="daily_expense.html"><li><i class="fa-solid fa-money-bill-wave"></i> Daily Expense</li></a>
                <a href="profit.html"><li><i class="fa-solid fa-chart-line"></i> Profit</li></a>
                <a href="search_student.html"><li><i class="fa-solid fa-search"></i> Search Student</li></a>
                <a href="light_bill.html"><li><i class="fa-solid fa-lightbulb"></i> Light Bill Calculation</li></a>
                <a href="notice_board.html"><li><i class="fa-solid fa-sticky-note"></i> Notice Board</li></a>
                <a href="wifi_management.html"><li><i class="fa-solid fa-wifi"></i> WiFi Password</li></a>
                <a href="students_query.html"><li><i class="fa-solid fa-question-circle"></i>Query & Doubt</li></a>
                <a href="leave_application.html"><li><i class="fa-solid fa-file-alt"></i> Leave Application</li></a>
                <a href="fees_details.html"><li><i class="fa-solid fa-money-check"></i>Fees Details</li></a>
            </ul>
        </aside>

        <!-- main content -->
        <main class="mcontent">
            <div class="management">
                <h2>Query Management</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Student ID</th>
                            <th>Date</th>
                            <th>Facility</th>
                            <th>Query</th>
                        </tr>
                    </thead>
                    <tbody>
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

                        $sql = "SELECT student_name, student_id, date, facility, query FROM queries";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['student_name']}</td>
                                        <td>{$row['student_id']}</td>
                                        <td>{$row['date']}</td>
                                        <td>{$row['facility']}</td>
                                        <td>{$row['query']}</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No queries found</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </main>

        <!-- footer -->
        <footer class="footer">
            <div class="footer-info">
                <div class="contact-info">
                    <h4>Contact Us</h4>
                    <p>123 Yuva Hostel, near valetva chowkdi, nadiaad , kheda , Pincode: 395642</p>
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