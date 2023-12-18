<?php
session_start();
//Check if a valid session is open
if(!isset($_SESSION["access"])){
    //redirect to login if not valid
    header("Location: access/login.php");
}else {
    //show page if login valid

    require_once('../dbconfig.php');

    try{
        //create a connection database and check if there was an error
        if(!$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)) {
            throw new Exception("Connection failed: ".mysql_connect_error());
        }
    } catch (Exception $e) {
        print("<h1>Connection Failed:</h1>" . $e-> getMessage());
    }
?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles/style.css" rel="stylesheet" type="text/css">
        <title>Syndicate Share - view all costs</title>
    </head>

    <body>
    <header>
        <h1>Syndicate Share - all costs</h1>
    </header>

    <section>

        <?php
        //display all costs in database
        
        // SQL query to select all costs order by date
        $selectSQL = "SELECT `lodged`, `date`, `account_no`, `ammount`, `note`, `image`, `verified` FROM costs ORDER BY `date`";

        // Execute the query
        $costs = mysqli_query($db, $selectSQL);
        
        // Check if there are rows returned
        if (mysqli_num_rows($costs) > 0) {
            // Loop through the results and display each cabin
            print ("<table>
                    <tr><th>Date</th><th>Lodged</th><th>Account</th><th>Description</th><th>Image</th><th>Ammount</th></tr>");
            while ($ROW = mysqli_fetch_assoc($costs)) {
                //Each cabin is shown in an article tag
                print("<tr>
                        <td>".$ROW['date']."</td>
                        <td>".$ROW['lodged']."</td>
                        <td>".$ROW['account_no']."</td>
                        <td>".$ROW['note']."</td>
                        <td>".$ROW['image']."</td>
                        <td>".$ROW['ammount']."</td>
                       </tr>");            
            }
            print("</table>");
        } else {
            // display a message if there are no cabins in the database
            print("<h2>No costs in database</h2>");
        }                
        ?>

    </section>
    
    <footer> 
        <a href="index.php">index</a> 
    </footer>
    </body>
    </html>

<?php
}
?>
