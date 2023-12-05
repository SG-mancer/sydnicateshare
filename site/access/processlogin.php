<?php
// Writen by Shane George Dec 2023.
// process login from login.php, and then redirct back to login.php (if failed) or onto index.php (if login success)
session_start();
require_once('../../dbconfig.php');

try{
    //create a connection database and check if there was an error
    if(!$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)) {
        throw new Exception("Connection failed: ".mysql_connect_error());
    }
} catch (Exception $e) {
    // Log error, and then give link to login page for re-attempt
    error_log("Connection Failed: " . $e->getMessage());
    print("<h1>Connection Failed:</h1> <p>There was an issue with the connection. <a href=\"login.php\">Please try again</a></p>");
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginUsername = mysqli_real_escape_string($db, $_POST['loginUser']);
    $loginPassword = mysqli_real_escape_string($db, $_POST['loginPass']);

    try {
        //TODO: Remove Test for proof can login
        //$loginSQL = "SELECT * FROM admin  WHERE userName = 'admin' AND password = md5('secure')";
        $loginSQL = "SELECT account_no FROM syndicate_user  WHERE username = md5('$loginUsername') AND password = md5('$loginPassword')";

        if (!$result = @mysqli_query($db, $loginSQL)) {
            throw new Exception("Query failed:" . mysqli_error($db));
        }
    } catch (Exception $e) {
        //log the error
        error_log("Query Failed: " . $e->getMessage());

        // Send a user-friendly error message 
        print("<p class=\"warn\">An error occurred during login. Please try again.</p>");

    }

    if (mysqli_num_rows($result) > 0) {
        // Login Successful - set session access and redirect to menu
        $row = mysqli_fetch_assoc($result);

        $_SESSION["account_no"] = $row["account_no"];
        $_SESSION["access"] = true;
        header("Location: ../index.php");
    } else {
        // Login Failed
        $_SESSION['login_error'] = "Invalid credentials";
        header("Location: login.php");
        exit();
    }
}
?>