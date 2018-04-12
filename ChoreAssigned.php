<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Chores Assigned </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/newcss.css">
    </head>
    <body>
        <fieldset>
            <form action="scripts/choresCompleted.php" method="post">
         <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include("scripts/dbinfo.inc.php");
        $con = mysqli_connect("localhost", $username, $password, $database)
                or die("Unable to select database");
        $houseName = $_SESSION["houseName"];
        $queryPersonalDaily = "SELECT * FROM dailypersonalchore WHERE houseName = '$houseName'";
        $daily = mysqli_query($con, $queryPersonalDaily);
        $queryPersonalWeekly = "SELECT * FROM weeklypersonalchore WHERE houseName = '$houseName'";
        $weekly = mysqli_query($con, $queryPersonalWeekly);
        $queryPersonalMonthly = "SELECT * FROM monthlypersonalchore WHERE houseName = '$houseName'";
        $monthly = mysqli_query($con, $queryPersonalMonthly);
        $queryPersonalAnnually = "SELECT * FROM annuallypersonalchore WHERE houseName = '$houseName'";
        $annually = mysqli_query($con, $queryPersonalAnnually);
        $queryPersonalSeasonally = "SELECT * FROM seasonallypersonalchore WHERE houseName = '$houseName'";
        $seasonally = mysqli_query($con, $queryPersonalSeasonally);
//$num = mysqli_num_rows($result);
//echo $num;
        mysqli_close($con);
?>
        <fieldset>
            <h3>Daily Chore Assignment List</h3>
        
        <table border="0" cellspacing="2" cellpadding="2">
            
            <tr> 
                <th>Member Name</th>
                <th>Chore Name</th>
                <th>Chore Room</th>
                <th>Chore Reward Points</th>
                <th>Completed</th>
            </tr>
            <?php while ($columndaily = mysqli_fetch_array($daily)): ?>
            <tr> 
                    <td><?php echo $columndaily['memberFirstName']; ?></td>
                    <td><?php echo $columndaily['choreName']; ?></td>
                    <td><?php echo $columndaily['roomName']; ?></td>
                    <td><?php echo $columndaily['choreRewardPoints']; ?></td>
                    <td><input type="checkbox" name="dateCompleted" value="Timestamp"><span class="checkmark"></span></td>
            </tr>
            <?php endwhile ?>            
         </table>
        </fieldset>
        <fieldset>
            <h3>Weekly Chore Assignment List</h3>
            <table border="0" cellspacing="2" cellpadding="2">
            
            <tr> 
                <th>Member Name</th>
                <th>Chore Name</th>
                <th>Chore Room</th>
                <th>Chore Reward Points</th>
                <th>Completed</th>
            </tr>
            <?php while ($columnweekly = mysqli_fetch_array($weekly)): ?>
            <tr> 
                    <td><?php echo $columnweekly['memberFirstName']; ?></td>
                    <td><?php echo $columnweekly['choreName']; ?></td>
                    <td><?php echo $columnweekly['roomName']; ?></td>
                    <td><?php echo $columnweekly['choreRewardPoints']; ?></td>
                    <td><input type="checkbox" name="dateCompleted" value="Timestamp"><span class="checkmark"></span></td>
            </tr>
            <?php endwhile ?>            
         </table>
        </fieldset>
        <fieldset>
            <h3>Monthly Chore Assignment List</h3>
            <table border="0" cellspacing="2" cellpadding="2">
            
            <tr> 
                <th>Member Name</th>
                <th>Chore Name</th>
                <th>Chore Room</th>
                <th>Chore Reward Points</th>
                <th>Completed</th>
            </tr>
            <?php while ($columnmonthly = mysqli_fetch_array($monthly)): ?>
            <tr> 
                    <td><?php echo $columnmonthly['memberFirstName']; ?></td>
                    <td><?php echo $columnmonthly['choreName']; ?></td>
                    <td><?php echo $columnmonthly['roomName']; ?></td>
                    <td><?php echo $columnmonthly['choreRewardPoints']; ?></td>
                    <td><input type="checkbox" name="dateCompleted" value="Timestamp"><span class="checkmark"></span></td>
            </tr>
            <?php endwhile ?>            
         </table>
        </fieldset>
        <fieldset>
            <h3>Annually Chore Assignment List</h3>
            <table border="0" cellspacing="2" cellpadding="2">
            
            <tr> 
                <th>Member Name</th>
                <th>Chore Name</th>
                <th>Chore Room</th>
                <th>Chore Reward Points</th>
                <th>Completed</th>
            </tr>
            <?php while ($columnannually = mysqli_fetch_array($annually)): ?>
            <tr> 
                    <td><?php echo $columnannually['memberFirstName']; ?></td>
                    <td><?php echo $columnannually['choreName']; ?></td>
                    <td><?php echo $columnannually['roomName']; ?></td>
                    <td><?php echo $columnannually['choreRewardPoints']; ?></td>
                    <td><input type="checkbox" name="dateCompleted" value="Timestamp"><span class="checkmark"></span></td>
            </tr>
            <?php endwhile ?>            
         </table>
        </fieldset>
        <fieldset>
            <h3>Seasonally Chore Assignment List</h3>
            <table border="0" cellspacing="2" cellpadding="2">
            
            <tr> 
                <th>Member Name</th>
                <th>Chore Name</th>
                <th>Chore Room</th>
                <th>Chore Reward Points</th>
                <th>Completed</th>
            </tr>
            <?php while ($columnseasonnally = mysqli_fetch_array($annually )): ?>
            <tr> 
                    <td><?php echo $columnseasonnally['memberFirstName']; ?></td>
                    <td><?php echo $columnseasonnally['choreName']; ?></td>
                    <td><?php echo $columnseasonnally['roomName']; ?></td>
                    <td><?php echo $columnseasonnally['choreRewardPoints']; ?></td>
                    <td><input type="checkbox" name="dateCompleted" value="Timestamp"><span class="checkmark"></span></td>
            </tr>
            <?php endwhile ?>            
         </table>
        </fieldset>
                    <input class ="button button1" type="Submit" value="Submit Completed Chores">
            </form>
        </fieldset>
        <fieldset>
        <a class ="button button2" href ="welcome.html">Welcome Page</a>
        <a class ="button button2" href ="addFamily.php">Add Family Member</a>
        <a class ="button button2" href="addRoom.php">Add a Room</a>
        <a class ="button button2" href="choreRewardReview.php">Reward Points</a>
        </fieldset>
    </body>
</html>