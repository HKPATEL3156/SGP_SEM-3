<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fees Report</title>
    <link rel="stylesheet" href="css/dashbord.css">
    <link rel="stylesheet" href="css/fees_report.css">
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
                <a href="index.php"><li><i class="fa-solid fa-user"></i> Profile</li></a>
                <a href="dashboard.html"><li><i class="fa-solid fa-gauge"></i> Dashboard</li></a>
                <a href="notice_board.html"><li><i class="fa-solid fa-bullhorn"></i> Notice Board</li></a>
                <a href="edit_password.html"><li><i class="fa-solid fa-lock"></i> Edit Password</li></a>
                <a href="leave_application.html"><li><i class="fa-solid fa-person-walking-arrow-right"></i> Leave Application</li></a>
                <a href="food_menu.html"><li><i class="fa-solid fa-utensils"></i> Food Menu</li></a>
                <a href="fees/fees_detail.html"><li><i class="fa-solid fa-file-invoice-dollar"></i> Fees Detail</li></a>
                <a href="pay_fees.html"><li><i class="fa-solid fa-money-bill-wave"></i> Pay Fees</li></a>
                <a href="review_and_rating.html"><li><i class="fa-solid fa-star"></i> Review & Rating</li></a>
                <a href="query_or_doubt.html"><li><i class="fa-solid fa-question"></i> Query section</li></a>
            </ul>
        </aside>

        <!-- main content -->
        <main class="mcontent">
            <div class="management">
                <h2>Fees Report</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Student ID</th>
                            <th>Amount Paid</th>
                            <th>Payment Date</th>
                            <th>Remaining Amount</th>
                        </tr>
                    </thead>
                    <tbody id="feesTableBody">
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "hostel_management";
                        $total_fees = 1000000;

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Fetch data from the database
                        $sql = "SELECT student_name, student_id, amount_paid, payment_date FROM fees";
                        $result = $conn->query($sql);

                        // Check if there are results
                        if ($result->num_rows > 0) {
                            // Output data for each row
                            while($row = $result->fetch_assoc()) {
                                $remaining_amount = $total_fees - $row['amount_paid'];
                                echo "<tr>
                                        <td>{$row['student_name']}</td>
                                        <td>{$row['student_id']}</td>
                                        <td>{$row['amount_paid']}</td>
                                        <td>{$row['payment_date']}</td>
                                        <td>{$remaining_amount}</td>
                                    </tr>";
                            }
                        } else {
                            // If no data found, show a "No records found" message
                            echo "<tr><td colspan='5' style='text-align: center;'>No fees records found</td></tr>";
                        }

                        // Close the database connection
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="payment-form">
                <h2>Pay Fees</h2>
                <form id="paymentForm" action="php/process_payment.php" method="POST">
                    <div class="form-group">
                        <label for="student_name">Student Name:</label>
                        <input type="text" id="student_name" name="student_name" required>
                    </div>
                    <div class="form-group">
                        <label for="student_id">Student ID:</label>
                        <input type="text" id="student_id" name="student_id" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="number" id="amount" name="amount" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_date">Payment Date:</label>
                        <input type="date" id="payment_date" name="payment_date" required>
                    </div>
                    <button type="submit" class="button">Pay Now</button>
                </form>
                <div id="responseMessage"></div>
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

        // JavaScript to handle the payment form submission
        document.getElementById('paymentForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch('php/process_payment.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())  // Parse the JSON response from the server
            .then(data => {
                const responseMessage = document.getElementById('responseMessage');
                if (data.status === 'success') {
                    responseMessage.innerHTML = `<p style="color: green;">${data.message}</p>`;

                    // Optionally update the fees table with new data
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td>${data.data.student_name}</td>
                        <td>${data.data.student_id}</td>
                        <td>${data.data.amount_paid}</td>
                        <td>${data.data.payment_date}</td>
                        <td>${data.data.remaining_amount}</td>
                    `;
                    document.getElementById('feesTableBody').appendChild(newRow);

                    this.reset();  // Reset the payment form
                } else {
                    responseMessage.innerHTML = `<p style="color: red;">${data.message}</p>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('responseMessage').innerHTML = `<p style="color: red;">An error occurred. Please try again.</p>`;
            });
        });
    </script>
</body>
</html>
