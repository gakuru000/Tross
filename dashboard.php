<?php
// connect.php - This file handles database connection (to a database, for example)
// For simplicity, I will be using session storage to keep track of bookings here.

session_start(); // Start session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and retrieve posted data
    $fullName = htmlspecialchars($_POST['fullName']);
    $email = htmlspecialchars($_POST['email']);
    $service = htmlspecialchars($_POST['service']);
    $date = htmlspecialchars($_POST['date']);

    // Simulate storing data (In an actual application, insert into a database)
    if (!isset($_SESSION['bookings'])) {
        $_SESSION['bookings'] = [];
    }

    $_SESSION['bookings'][] = [
        'id' => uniqid(), // Generate a unique ID for each booking
        'fullName' => $fullName,
        'email' => $email,
        'service' => $service,
        'date' => $date,
        'status' => 'Confirmed'
    ];

    // Redirect to dashboard after booking
    header("Location: dash.php");
    exit();
}
?>