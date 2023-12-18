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
    if (isset($_POST['action']) && $_POST['action'] == "Add Request") {
        // Get data from form and session
        $ruser = $_SESSION["account_no"];
        $rsafety = !empty($_POST['safety']);
        $rtitle = $_POST['title'];
        $rdescription = $_POST['note'];
        $rimage = basename($_FILES['image']["name"]); //TODO handle file uploads

        // SQL query to add the data
        $updateSQL = "INSERT INTO maintenance_request (account_no, safety_issue, title, description, image) VALUES (
            '$ruser',
            '$rsafety',
            '$rtitle',
            '$rdescription',
            '$rimage')";
    
            //Add the new record
            if (mysqli_query($db, $updateSQL)) {
                print("maintenance request added");
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
        <link href="styles/style.css" rel="stylesheet" type="text/css">
        <title>Syndicate Share - new Maintenance Request</title>
    </head>
    <body>
        <form action="#?nav=new" enctype="multipart/form-data" method="post">

            <label for="title">Title of Maintenance Request: </label>
            <input id="title" name="title" type="text" required>

            <label for="note">Description: </label>
            <textarea id="note" name="note" rows="3" cols="30" placeholder="description of spend" required></textarea>

            <label for="safety">This is a safety issue, that need to be reviewed before next usage</label>
            <input id="safety" name="safety" type="checkbox">

            <label for="image">Image of issue: </label>
            <input id="image" name="image" type="file">

            <input type="submit" name="action" value="Add Request">
        </form>

        <footer> 
            <a href="index.php">index</a> 
        </footer>
        
    </body>
    </html>
<?php
}
?>