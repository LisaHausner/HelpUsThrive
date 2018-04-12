<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Chore Review</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/newcss.css">
    </head>
    <body>
        
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include("dbinfo.inc.php");
        $con = mysqli_connect("localhost", $username, $password, $database)
                or die("Unable to select database");
        $houseName = $_SESSION["houseName"];
        $members= "SELECT memberFirstName FROM members";
        $result2= mysqli_query($con, $members);
        $query = "SELECT chorehouseassignment.houseID AS houseID, house.houseName AS houseName, chorehouseassignment.choreID AS choreID, chores.choreName AS choreName, chores.choreFrequency AS choreFrequency, chores.choreRoom AS choreRoom, roomhouseassignment.roomID AS roomID, room.roomName AS roomName, room.roomType AS roomType, chores.choreRewardPoints AS choreRewardPoints, members.memberID AS memberID  FROM chores, room, chorehouseassignment, roomhouseassignment, members, memberhouseassignment, house WHERE chorehouseassignment.choreID=chores.choreID AND roomhouseassignment.roomID=room.roomID AND members.memberID=memberhouseAssignment.memberID AND memberhouseAssignment.houseID=roomhouseassignment.houseID=chorehouseassignment.houseID";
        $result = mysqli_query($con, $query);

//$num = mysqli_num_rows($result);
//echo $num;
        mysqli_close($con);
        echo "<b><center>'$houseName'</center></b><br>";

        echo "<b><center>Family Chores</center></b><br><br>";
        ?>
        <table border="0" cellspacing="2" cellpadding="2">
            <tr> 
                <th>Chore Description</th>
                <th>Chore Frequency</th>
                <th>Chore Room Name: Room Type</th>
                
                <th>Chore Reward Points</th>
                <th>Choose Member to Assign Chore to.</th>
            <input type="radio" name="delete" value="" />
            </tr>

            <?php
            while ($row = mysqli_fetch_array($result) && $col = mysqli_fetch_array($result2)) {

                $choreName = $row['choreName'];
                $choreFrequency = $row['choreFrequency'];
                $roomName = $row['roomName'];
                $roomType = $row['roomType'];
                $choreRewardPoints = $row['choreRewardPoints'];
                foreach ($members as $memberFirstName) {
                $memberFirstName = $col['$memberFirstName'];}
                
                
                ?>

                <tr> 
                    <td><?php echo "$choreName"; ?></td>
                    <td><?php echo "$choreFrequency"; ?></td>
                    <td><?php echo "$roomName $roomType"; ?></td>
                    <td><?php echo "$choreRewardPoints"; ?></td>
                    <td><input type ="radio" name="$memberFirstName"/> <?php echo "$memberFirstName"; ?></td>
                </tr>

    <?php
}
echo "</table>";
?>
<!-- second table  -->
<?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include("dbinfo.inc.php");
        $con = mysqli_connect("localhost", $username, $password, $database)
                or die("Unable to select database");

        $query = "SELECT members.memberFirstName AS memberFirstName, chores.choreName AS choreName, chores.choreFrequency AS choreFrequency, chores.choreRewardPoints AS choreRewardPoints, chores.choreType AS choreType, room.roomName AS roomName, memberhouseassignment.houseID AS houseID, memberhouseassignment.memberID AS memberID, choreassignment.choreID AS choreID, choreassignment.memberID  FROM members, choreassigment, memberhouseassignment, chores, room, WHERE choreassignment.choreID=chores.choreID GROUP BY members.memberFirstName";
        $result = mysqli_query($con, $query);

//$num = mysqli_num_rows($result);
//echo $num;
        mysqli_close($con);

        echo "<b><center>Current Chores by Family Member</center></b><br><br>";
        ?>
        <table border="0" cellspacing="2" cellpadding="2">
            <tr> 
                 
                <th>Member First Name</th>
                <th>Chore Name</th>
                <th>Chore Room name</th>
                <th>Chore Frequency</th>
                <th>Chore Reward Points</th>
                <th>Chore Type</th>
                
               
            </tr>

            <?php
            while ($row = mysqli_fetch_array($result)) {

                $memberFirstName = $row['memberFirstName'];
                $choreName = $row['choreName'];
                $choreRoomName = $row['choreRoomName'];
                $choreFrequency = $row['choreFrequency'];
                $choreRewardPoints = $row['choreRewardPoints'];
                $choreType = $row['choreType'];
                
                ?>

                <tr> 
                    <td><?php echo "$memberFirstName"; ?></td>
                    <td><?php echo "$choreName"; ?></td>
                    <td><?php echo "$choreRoomName"; ?></td>
                    <td><?php echo "$choreFrequency"; ?></td>
                    <td><?php echo "$choreRewardPoints"; ?></td>
                    <td><?php echo "$choreType"; ?></td>
                    <td><input type="radio" name="delete">Click to delete chore from <?php echo "$memberFirstName"; ?>'s chores.</td>
                   
                </tr>

    <?php
}
echo "</table>";
?>
    </body>
</html>


// need to place table to include chorehouseassignment and choreassignment.  
//buttons to assign to member from chores
// delete
//add chore  plus member to add to.
