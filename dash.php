<?php
session_start(); // Start the session to access stored data
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #007bff;
            padding: 10px;
            text-align: center;
        }

        .navbar a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
        }

        .content {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: none; /* Hide all sections by default */
        }

        .active {
            display: block; /* Show active section */
        }

        .btn {
            padding: 10px 15px;
            margin-right: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn.cancel {
            background-color: #dc3545;
        }

        .btn.cancel:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="#" onclick="showSection('myBookings')">My Bookings</a>
        <a href="#" onclick="showSection('paymentHistory')">Payment History</a>
        <a href="#" onclick="showSection('accountSettings')">Account Settings</a>
        <a href="#" onclick="showSection('support')">Support</a>
    </div>

    <!-- My Bookings Section -->
    <div id="myBookings" class="content active">
        <h1>My Bookings</h1>
        <p>Here is a list of your current bookings:</p>
        <div id="bookingList">
            <?php if (isset($_SESSION['bookings']) && count($_SESSION['bookings']) > 0): ?>
                <?php foreach ($_SESSION['bookings'] as $booking): ?>
                    <div class="booking-item">
                        <h2>Booking #<?= $booking['id'] ?></h2>
                        <p><strong>Name:</strong> <?= $booking['fullName'] ?></p>
                        <p><strong>Email:</strong> <?= $booking['email'] ?></p>
                        <p><strong>Service:</strong> <?= $booking['service'] ?></p>
                        <p><strong>Date:</strong> <?= $booking['date'] ?></p>
                        <p><strong>Status:</strong> <?= $booking['status'] ?></p>
                        <button class="btn" onclick="viewDetails('<?= $booking['id'] ?>')">View Details</button>
                        <button class="btn cancel" onclick="cancelBooking('<?= $booking['id'] ?>')">Cancel Booking</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No bookings found.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Payment History Section -->
    <div id="paymentHistory" class="content">
        <h1>Payment History</h1>
        <p>Your payment history is shown below:</p>
        <ul>
            <li>Payment #001 - $100.00 - January 1, 2024</li>
            <li>Payment #002 - $250.00 - January 10, 2024</li>
            <li>Payment #003 - $150.00 - January 15, 2024</li>
        </ul>
    </div>

    <!-- Account Settings Section -->
    <div id="accountSettings" class="content">
        <h1>Account Settings</h1>
        <p>Edit your account details below:</p>
        <form id="accountForm">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email"><br><br>
            <button type="submit" class="btn">Save Changes</button>
        </form>
    </div>

    <!-- Support Section -->
    <div id="support" class="content">
        <h1>Support</h1>
        <p>If you need help, please contact our support team:</p>
        <p>Email: support@example.com</p>
        <p>Phone: (+250) 700-7890</p>
    </div>

    <script>
        // Function to view booking details
        function viewDetails(bookingId) {
            alert(`Viewing details for Booking #${bookingId}`);
            // Here you could redirect to a detailed booking page or display additional info
        }

        // Function to cancel a booking
        function cancelBooking(bookingId) {
            if (confirm(`Are you sure you want to cancel Booking #${bookingId}?`)) {
                // Here you would typically update the booking status on the server
                alert(`Booking #${bookingId} has been cancelled.`);
            }
        }

        // Function to show the selected section and hide others
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.content');
            sections.forEach(section => {
                section.classList.remove('active'); // Set all sections inactive
            });
            document.getElementById(sectionId).classList.add('active'); // Show the selected section
        }

        // Handle form submission in the Account Settings section
        document.getElementById('accountForm').addEventListener('submit', function(event) {
            event.preventDefault();
            alert('Account settings saved!'); // Display a success message
        });
    </script>
</body>
</html>