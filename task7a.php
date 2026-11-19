<?php
// Database connection credentials
$host = 'localhost';
$username = 'root';
$password = ''; // Add your MySQL root password here
$dbname = 'user_management';

// Create a connection to the database
$conn = new mysqli($host, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists.<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Connect to the created database
$conn->select_db($dbname);

// Create the table for user information
$tableSQL = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($tableSQL) === TRUE) {
    echo "Table 'users' created successfully or already exists.<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uname = $_POST['username'];
    $pwd = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];

    $sql = "INSERT INTO users (username, password, email, full_name) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $uname, $pwd, $email, $full_name);

    if ($stmt->execute()) {
        echo "<p>User registered successfully!</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
