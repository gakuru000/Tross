<?php
session_start();

// Only process POST requests
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and trim form data
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Database connection settings — adjust as needed
    $servername = "localhost";
    $dbUsername = "root";     // Change if needed
    $dbPassword = "";         // Change if needed
    $dbName     = "wedding_services"; // Your database name

    // Create a new MySQLi connection
    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute a query to get user details based on the email (or username)
    $sql = "SELECT id, username, email, password, is_verified FROM users WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows == 0) {
        // For security, you might want to show a generic error message
        echo "Invalid email or password.";
    } else {
        $user = $result->fetch_assoc();

        // Check if the account is verified
        if ($user['is_verified'] == 0) {
            echo "Your account is not verified. Please check your email for the confirmation link.";
        } else {
            // Verify the password against the stored hashed password
            if (password_verify($password, $user['password'])) {
                // Successful login.
                // Set user session variables
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["username"] = $user["username"];

                // Redirect to home.php (dashboard or homepage)
                header("Location: home.php");
                exit();
            } else {
                echo "Invalid email or password.";
            }
        }
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
