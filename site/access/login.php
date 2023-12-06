<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">   
    <!--Writen by Shane George,  Dec 2023.-->
    <!-- login.php, get the login details from user - then send request to processLogin.php -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syndicate Share - Login</title>
</head>

<body>
    <h1>Login</h1>
  </header>

<?php
        // Display login error message
        if (isset($_SESSION['login_error'])) {
            echo '<p class="warn">' . $_SESSION['login_error'] . '</p>';
            unset($_SESSION['login_error']); // clear the error message
        }
        ?>
        <form action="processlogin.php" method="POST">
            <div>
                <label for="loginUser" class="form-label">Username</label>
                <input type="text" id="loginUser" name="loginUser" required>
            </div>
            <div>
                <label for="loginPass" class="form-label">Password</label>
                <input type="password" id="loginPass" name="loginPass" required>
            </div>
            <button type="submit">Login</button>
        </form>
  <footer>

  </footer>
</body>
</html>