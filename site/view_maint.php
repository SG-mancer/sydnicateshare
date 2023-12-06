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
        <title>Syndicate Share - view all maintenance requests</title>
    </head>

    <body>
    <header>
        <h1>Syndicate Share - all maintenance requests</h1>
    </header>

    <section>

        <?php
        //display all maint_req in database
        
        // SQL query to select all maint_req order by date
        $selectSQL = "SELECT `request_no`, `safety_issue`, `title`, `description`, `image`, `account_no` FROM maintenance_request ORDER BY `request_no`";

        // Execute the query
        $maint_req = mysqli_query($db, $selectSQL);
        
        // Check if there are rows returned
        if (mysqli_num_rows($maint_req) > 0) {
            // Loop through the results and display each cabin
            print ("<table>
                    <tr><th>Request Number</th><th>Safety Issue</th><th>Title</th><th>Description</th><th>Image</th><th>raising Account</th></tr>");
            while ($ROW = mysqli_fetch_assoc($maint_req)) {
                //Each cabin is shown in an article tag
                print("<tr>
                        <td>".$ROW['request_no']."</td>
                        <td>".$ROW['safety_issue']."</td>
                        <td>".$ROW['title']."</td>
                        <td>".$ROW['description']."</td>
                        <td>".$ROW['image']."</td>
                        <td>".$ROW['account_no']."</td>
                       </tr>");            
            }
            print("</table>");
        } else {
            // display a message if there are no cabins in the database
            print("<h2>No maintenance requests in database</h2>");
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
