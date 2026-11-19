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
    // Validate and sanitize the user ID
    $userId = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);

    if ($userId) {
        try {
            // Delete query using prepared statements
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $pdo->prepare($sql);

            // Bind the user ID parameter
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);

            // Execute the statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    echo "User deleted successfully.";
                } else {
                    echo "No user found with the specified ID.";
                }
            } else {
                echo "Failed to delete the user.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid user ID. Please provide a valid numeric ID.";
    }
}
?>
