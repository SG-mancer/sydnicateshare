<?php
session_start();
//Check if a valid session is open
if(!isset($_SESSION["access"])){
    //redirect to login if not valid
    header("Location: access/login.php");
}else {
    //show page of login valid
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syndicate Share - home</title>
</head>
<body>
    logged in

    <ul>
        <li><a href="new_cost.php">lodge spending</a></li>
        <li><a href="view_cost.php">view all costs</a></li>
        <li><a href="new_maintenance_req.php">add maintenance request</a></li>
        <li><a href="view_maint.php">check maintenance requests</a></li>
        <li><a href="view_log.php">check maintenance log</a></li>
        <li>review bookings</li>
        <li>book upcoming usage</li>
    </ul>
    
</body>
</html>

<?php
}
?>