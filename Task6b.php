<?php
// Handle cookie operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['set_cookie'])) {
        // Set a cookie
        $cookie_name = $_POST['cookie_name'];
        $cookie_value = $_POST['cookie_value'] ?? '';
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // Expires in 30 days
        echo "<p style='color: green;'>Cookie set successfully!</p>";
    } elseif (isset($_POST['get_cookie'])) {
        // Retrieve a cookie
        $cookie_name = $_POST['cookie_name'];
        if (isset($_COOKIE[$cookie_name])) {
            echo "<p>Cookie value: " . htmlspecialchars($_COOKIE[$cookie_name]) . "</p>";
        } else {
            echo "<p style='color: red;'>Cookie not found!</p>";
        }
    } elseif (isset($_POST['delete_cookie'])) {
        // Delete a cookie
        $cookie_name = $_POST['cookie_name'];
        setcookie($cookie_name, "", time() - 3600, "/"); // Expire the cookie
        echo "<p style='color: green;'>Cookie deleted successfully!</p>";
    }
}
?>
