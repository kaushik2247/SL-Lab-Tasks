<?php
session_start();
$t = isset($_REQUEST['etime']) ? (int)$_REQUEST['etime'] : 0;
$exp = time();

if ($t < $exp) {
    echo "<center><h1>Page Time Expired</h1></center>";
} else {
    echo "<center><h2>Name : " . htmlspecialchars($_REQUEST['uname'] ?? '') . "</h2></center>";
    echo "<center><h2>City : " . htmlspecialchars($_REQUEST['city'] ?? '') . "</h2></center>";
    echo "<center><h2>Phone NO : " . htmlspecialchars($_REQUEST['pno'] ?? '') . "</h2></center>";
    session_destroy();
}
?>
