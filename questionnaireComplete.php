<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Create a House </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/newcss.css">
    </head>
    <body>
        <fieldset>
        <h1>Congratulations You Have Completed The Questionnaire!</h1> 
        <p> Below is the information that you have input.  Please double check it then please press Questionnaire Complete.</p>
            <fieldset>
            <form action="scripts/questionnaire.php" method="post">
            <input class ="button button1" type="Submit" value="Questionnaire Complete">
            </form>
        </fieldset>
        <a class ="button button2" href ="addFamily.php">Add Family Member</a>
        <a class ="button button2" href="addRoom.php">Add a Room</a>
              
        </fieldset>
       <!-- House Information-->
       <fieldset>
 <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include("scripts/dbinfo.inc.php");
        $con = mysqli_connect("localhost", $username, $password, $database)
                or die("Unable to select database");
        $houseName = $_SESSION["houseName"];
        $query = "SELECT * FROM house WHERE houseName = '$houseName'";
        //$query = "SELECT * FROM housemembers";
        $result = mysqli_query($con, $query);

//$num = mysqli_num_rows($result);
//echo $num;
        mysqli_close($con);

        echo "<b><center>House Information</center></b><br><br>";
        ?>
        <table border="0" cellspacing="2" cellpadding="2">
            <tr> 
                <th>House Name</th>
                <th>House Size</th>
                               
            </tr>
            <?php while ($row = mysqli_fetch_array($result)) : ?>
            <tr> 
                    <td><?php echo $row['houseName']; ?></td>
                    <td><?php echo $row['houseSize']; ?></td>
                    
            </tr>
            <?php endwhile ?>
        </table>
            </fieldset>
       <!-- Family Information-->
               <fieldset>
 <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include("scripts/dbinfo.inc.php");
        $con = mysqli_connect("localhost", $username, $password, $database)
                or die("Unable to select database");
        $houseName = $_SESSION["houseName"];
        $query = "SELECT * FROM housemembers WHERE houseName = '$houseName'";
        //$query = "SELECT * FROM housemembers";
        $result = mysqli_query($con, $query);

//$num = mysqli_num_rows($result);
//echo $num;
        mysqli_close($con);

        echo "<b><center>House Members</center></b><br><br>";
        ?>
        <table border="0" cellspacing="2" cellpadding="2">
            <tr> 
                <th>Name</th>
                <th>Member Type</th>
                <th>Birthdate</th>
                <th>Age</th>
                
            </tr>
            <?php while ($row = mysqli_fetch_array($result)) : ?>
            <tr> 
                    <td><?php echo $row['firstName']; ?> <?php echo  $row['lastName']; ?></td>
                    <td><?php echo $row['memberType']; ?></td>
                    <td><?php echo $row['birthdate']; ?></td>
                    <td><?php echo $row['age']; ?></td>
            </tr>
            <?php endwhile ?>
        </table>
            </fieldset>
        <!-- Room Information-->
        <fieldset>
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include("scripts/dbinfo.inc.php");
        $con = mysqli_connect("localhost", $username, $password, $database)
                or die("Unable to select database");
        //$houseName = $_SESSION["houseName"];
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