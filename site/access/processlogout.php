<?php
    session_start();
    // Clear all session data
    session_unset();
    session_destroy();

    // Set a message so when returning to login screen logout is acknowledged
    session_start();
    $_SESSION['login_error'] = "Logged out success";
    header("Location: login.php");
    exit();
?>