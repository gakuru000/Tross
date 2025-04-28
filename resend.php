<?php
// resend_confirmation.php
session_start();

// Connect to your database (adjust credentials as needed)
$conn = new mysqli("localhost", "root", "", "wedding_service");
if ($conn->connect_error) {
    die("Connection failed: " . htmlspecialchars($conn->connect_error));
}

// Ensure the user is logged in to know which account to resend to
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT email, confirmation_code, is_verified FROM users WHERE id = ?";
    
    // Prepare and execute the statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if ($user["is_verified"]) {
                echo "Your account is already verified.";
                exit();
            }

            // Use the existing confirmation code or generate a new one if empty
            $code = $user["confirmation_code"];
            if (empty($code)) {
                $code = bin2hex(random_bytes(16)); // Generate a new code
                $update = "UPDATE users SET confirmation_code = ? WHERE id = ?";
                if ($stmt_update = $conn->prepare($update)) {
                    $stmt_update->bind_param("si", $code, $user_id);
                    $stmt_update->execute();
                    $stmt_update->close();
                }
            }

            // Prepare the email content (adjust the URL/path as needed)
            $email = $user["email"];
            $subject = "Email Confirmation - THE TROSS GROUP";
            $message  = "Dear User,\n\n";
            $message .= "Please confirm your email by clicking the link below:\n";
            $message .= "http://yourdomain.com/confirm_email.php?code=" . urlencode($code) . "\n\n";
            $message .= "Alternatively, you can enter the following code on the confirmation page: " . $code . "\n\n";
            $message .= "Thank you,\nTHE TROSS GROUP";
            $headers = "From: admin@thetrossgroup.com";

            // Send email and handle potential errors
            if (mail($email, $subject, $message, $headers)) {
                echo "A new confirmation email has been sent to your email address.";
            } else {
                echo "There was an error sending the email. Please try again later.";
            }
        } else {
            echo "No user found.";
        }
        $stmt->close();
    } else {
        echo "Database error: Could not prepare statement.";
    }
} else {
    echo "User not logged in.";
}
$conn->close();
?>