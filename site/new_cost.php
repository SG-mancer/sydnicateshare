<?php
session_start();
//Check if a valid session is open
if(!isset($_SESSION["access"])){
    //redirect to login if not valid
    header("Location: access/login.php");
}else {
    //show page of login valid
    try{       
        //create a connection database and check if there was an error
        require_once('../dbconfig.php');
        if(!$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)) {
            throw new Exception("Connection failed: ".mysql_connect_error());
        }
    } catch (Exception $e) {
        // Log error, and then give link to login page for re-attempt
        error_log("Connection Failed: " . $e->getMessage());
        print("<h1>Connection Failed:</h1> <p>There was an issue with the connection. <a href=\"login.php\">Please try again</a></p>");
    }

    //Process form submission
    if (isset($_POST['action']) && $_POST['action'] == "Add Cost") {
        // Get data from form and session
        $clodged = date("Y-m-d H:i:s", date_timestamp_get(date_create()));
        $cdate = $_POST['date'];
        $cuser = $_SESSION["account_no"];
        $cammount = $_POST['ammount'];
        $cnote = $_POST['note'];
        $cimage = basename($_FILES['image']["name"]); //TODO handle file uploads

        // SQL query to add the data
        $updateSQL = "INSERT INTO costs (lodged, date, account_no, ammount, note, image) VALUES (
            '$clodged', 
            '$cdate',
            '$cuser',
            '$cammount',
            '$cnote',
            '$cimage')";
  
            //Add the new record
            if (mysqli_query($db, $updateSQL)) {
                print("cost added");
            } else {
                print("error... try again");
            }
    }

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sydnicate Share - new Cost</title>
    </head>
    <body>
        <form action="#?nav=new" enctype="multipart/form-data" method="post">
            <label for="date">Date paid: </label>
            <input id="date" name="date" type="date" required>

            <label for="ammount">Ammount paid: </label>
            <input id="ammount" name="ammount" type="number" step="any">

            <label for="note">Description: </label>
            <textarea id="note" name="note" rows="3" cols="30" placeholder="description of spend"></textarea>

            <label for="image">Copy of reciept: </label>
            <input id="image" name="image" type="file">

            <input type="submit" name="action" value="Add Cost">
        </form>

        <footer> 
            <a href="index.php">index</a> 
        </footer>

    </body>
    </html>

<?php
}
?>