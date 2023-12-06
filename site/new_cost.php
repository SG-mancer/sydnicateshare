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
        <title>Sydnicate Share - new Cost</title>
    </head>
    <body>
        <form method="post">
            <label for="date">Date paid: </label>
            <input id="date" name="date" type="date" required>

            <label for="ammount">Ammount paid: </label>
            <input id="ammount" name="ammount" type="number" step="any">

            <label for="note">Description: </label>
            <textarea id="note" name="note" rows="3" cols="30" placeholder="description of spend"></textarea>

            <label for="image">Copy of reciept: </label>
            <input id="image" name="image" type="file">

        </form>
    </body>
    </html>

<?php
}
?>