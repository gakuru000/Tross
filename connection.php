<?php
// Database connection settings
$servername = "localhost";
$dbUsername = "root";             // default for XAMPP; change if needed
$dbPassword = "";                 // default for XAMPP
$dbName     = "wedding_service";

// Create a new MySQLi connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select all columns from the "users" table
$sql = "SELECT id, username, email, password, is_verified, confirmation_code, reset_code, registration_date FROM users";

// Execute the query
$result = $conn->query($sql);

// Check if records exist and display them
if ($result->num_rows > 0) {
    echo "<h2>User Records:</h2>";
    while ($row = $result->fetch_assoc()) {
        echo "<div style='margin-bottom:15px; padding:10px; border:1px solid #ccc;'>";
        echo "<strong>ID:</strong> " . htmlspecialchars($row["id"]) . "<br>";
        echo "<strong>Username:</strong> " . htmlspecialchars($row["username"]) . "<br>";
        echo "<strong>Email:</strong> " . htmlspecialchars($row["email"]) . "<br>";
        echo "<strong>Password:</strong> " . htmlspecialchars($row["password"]) . "<br>";
        echo "<strong>Verified:</strong> " . ($row["is_verified"] ? "Yes" : "No") . "<br>";
        echo "<strong>Confirmation Code:</strong> " . htmlspecialchars($row["confirmation_code"]) . "<br>";
        echo "<strong>Reset Code:</strong> " . htmlspecialchars($row["reset_code"]) . "<br>";
        echo "<strong>Registered On:</strong> " . htmlspecialchars($row["registration_date"]) . "<br>";
        echo "</div>";
    }
} else {
    echo "No records found in the 'users' table.";
}

// Close the connection
$conn->close();
?>
