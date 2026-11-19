<?php
session_start();

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection credentials
    $host = 'localhost';
    $username = 'root';
    $password = ''; // Add your MySQL root password here
    $dbname = 'user_management';

    // Create a connection to the database
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $uname = $_POST['username'];
    $pwd = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($pwd, $user['password'])) {
            $_SESSION['username'] = $uname;
            header("Location: home.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
<style>
 body {
 font-family: Arial, sans-serif;
 margin: 0;
 padding: 0;
 background-color: #f8f9fa;
 }
 .container {
 max-width: 400px;
 margin: 50px auto;
 padding: 20px;
 background: white;
 box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
 border-radius: 8px;
 }
 h1 {
 text-align: center;
 margin-bottom: 20px;
 }
 form {
 display: flex;
 flex-direction: column;
 }
 label {
 margin-bottom: 5px;
 font-weight: bold;
 }
 input {
 margin-bottom: 15px;
 padding: 10px;
 border: 1px solid #ccc;
 border-radius: 5px;
 box-sizing: border-box;
 }
 button {
 padding: 10px;
 background-color: #007bff;
 color: white;
 border: none;
 border-radius: 5px;
 cursor: pointer;
 }
button:hover {
 background-color: #0056b3;
 }
.error {
 color: red;
 font-size: 0.9em;
 margin-bottom: 10px;
 }
</style>
</head>
<body>
<div class="container">
<h1>Login</h1>
<?php if (!empty($error)): ?>
<p class="error"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
<form method="POST" action="login.php">
<label for="username">Username:</label>
<input type="text" id="username" name="username" required>
<label for="password">Password:</label>
<input type="password" id="password" name="password" required>
<button type="submit">Login</button>
</form>
</div>
</body>
</html>
