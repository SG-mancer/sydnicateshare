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
        <title>Syndicate Share - new Maintenance Request</title>
    </head>
    <body>
        <form>

            <label for="note">Description: </label>
            <textarea id="note" name="note" rows="3" cols="30" placeholder="description of spend" required></textarea>

            <label for="safety">This is a safety issue, that need to be reviewed before next usage</label>
            <input id="safety" name="safety" type="checkbox">

            <label for="image">Copy of reciept: </label>
            <input id="image" name="image" type="file">
        </form>
        
    </body>
    </html>
<?php
}
?>