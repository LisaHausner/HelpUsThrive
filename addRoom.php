<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Questionnaire: Add Rooms</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/newcss.css">
    </head>
    <body>
        <fieldset>
        <h1>Help Me Thrive! Questionnaire</h1>  
        <h2>Selecting Rooms</h2>
        <p>Please answer the following questions about what rooms are in your house and submit the form to review your chore assignment list.</p>
        <form action="scripts/insertRoom.php" method="post">                                        
            <fieldset>
               
                <label>Room Name:</label> <input type="text" name="roomName"><br>
                <label>Room Type:</label>  <select name="roomType">
                    <option value="">Select...</option>
                    <option value="Bedroom">Bedroom</option>
                    <option value="Kitchen">Kitchen</option>
                    <option value="Dining Room">Dining Room</option>
                    <option value="Breakfast Nook">Breakfast Nook</option>
                    <option value="Living Room">Living Room</option>
                    <option value="Bathroom">Bath Room</option>
                    <option value="Sitting Room">Sitting Room</option>
                    <option value="Game Room">Game Room</option>
                    <option value="Storage">Storage</option>
                    <option value="Garage">Garage</option>
                    <option value="Other">Other</option>
                    </select><br>
            <input class ="button button1" type="Submit" value ="Add Room">
            </fieldset>
        </form>
        </fieldset>
        <a class ="button button2" href="addFamily.php">Previous Section</a> 
        <a class ="button button2" href="addExtraChores.html">Next Section</a>
        <fieldset>
    <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include("scripts/dbinfo.inc.php");
        $con = mysqli_connect("localhost", $username, $password, $database)
                or die("Unable to select database");
        $houseName = $_SESSION["houseName"];
        $query = "SELECT * FROM houserooms WHERE houseName = '$houseName'AND roomName != 'Family House Chores'";
        //$query = "SELECT * FROM housemembers";
        $result = mysqli_query($con, $query);

//$num = mysqli_num_rows($result);
//echo $num;
        mysqli_close($con);

        echo "<b><center>House Rooms</center></b><br><br>";
        ?>
        <table border="0" cellspacing="2" cellpadding="2">
            <tr> 
                <th>Room Name</th>
                <th>Room Type</th>
                
                
            </tr>
            <?php while ($row = mysqli_fetch_array($result)) : ?>
            <tr> 
                    <td><?php echo $row['roomName']; ?></td>
                    <td><?php echo $row['roomType']; ?></td>
                    
            </tr>
            <?php endwhile ?>
        </table>  
       </fieldset>
    </body>
</html>
