<?php
// Database connection details
$host = 'localhost';
$username = 'root';
$password = ''; // Add your MySQL root password here
$dbname = 'user_management';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and sanitize input
    $userId = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
    $username = trim($_POST['username'] ?? '');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if ($userId && $username && $email) {
        try {
            // Update query using prepared statements
            $sql = "UPDATE users SET username = :username, email = :email WHERE id = :id";
            $stmt = $pdo->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);

            // Execute the statement
            if ($stmt->execute()) {
                echo "User information updated successfully.";
            } else {
                echo "Failed to update user information.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid input. Please ensure all fields are filled in correctly.";
    }
}
?>
