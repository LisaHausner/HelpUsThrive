<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Questionnaire: Add Family Member </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/newcss.css">
    </head>
    <body>
        <fieldset>
            <h1>Help Me Thrive! Questionnaire</h1>
            <h2>Adding Family Members </h2>
        <p>Please add each family member, after all of the members has been added please click "Next Section".  </p>
        <form action="scripts/insertFamily.php" method="post">
            <fieldset>
                
                <label>First Name:</label> <input type="text" name="memberFirstName"><br>
                <label>Last Name:</label> <input type="text" name="memberLastName"><br>
                <label>Member Type:</label>  <select name="memberType">
                    <option value="">Select...</option>
                    <option value="Crown1"> Head of House 1</option>
                    <option value="Crown2">Head of House 2</option>
                    <option value="Child">Child</option>
                    <option value="Other">Other</option>
                    </select><br>
                    <label>Birth Date:</label><input type="date" name="memberBirthdate"><br>
            <input class ="button button1" type="Submit" value ="Add Member">
            </fieldset>
        </form>
        </fieldset>
        <a class ="button button2" href ="addFamily.php">Add Family Member</a>
        <a class ="button button2" href="addRoom.php">Next Section</a>
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
    </body>
</html>