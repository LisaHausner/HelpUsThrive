<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Insert House </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/newcss.css">
    </head>
    <body>
        <fieldset>
 <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include("dbinfo.inc.php");
        $con = mysqli_connect("localhost", $username, $password, $database)
                or die("Unable to select database");
        $houseName = $_SESSION["houseName"];
        //adding family chores
        $queryRoom = "INSERT INTO room (roomHouseName, roomName, roomType) VALUES ('$houseName','Family House Chores','Family')";
        mysqli_query($con, $queryRoom);
        
        $queryRoomToHouse = "INSERT INTO roomhouseassignment(houseID, roomID) SELECT house.houseID AS houseID, room.roomID AS roomID FROM house, room WHERE house.houseName = '$houseName' AND room.roomName = 'Family House Chores'";
        mysqli_query($con, $queryRoomToHouse);
        
        $queryFamilyChores = "INSERT INTO chorehouseassignment(houseID, choreID) SELECT house.houseID, chores.choreID FROM house, chores WHERE chores.roomType='Family' AND house.houseName= '$houseName'";
        mysqli_query($con, $queryFamilyChores);
        //end adding family chores
        $query = "SELECT * FROM housemembers WHERE houseName = '$houseName'";
        //$query = "SELECT * FROM housemembers";
        $result = mysqli_query($con, $query);
        $query2 = "SELECT * FROM houseChores WHERE houseName = '$houseName'AND choreType != 'Personal'";
        //$query = "SELECT * FROM housemembers";
        $result2 = mysqli_query($con, $query2);
        
        $queryPersonal = "SELECT * FROM personalchores WHERE houseName = '$houseName'";
        $result3 = mysqli_query($con, $queryPersonal);
        
//$num = mysqli_num_rows($result);
//echo $num;
        mysqli_close($con);
?>
            <h3>Room Chore Assignment List</h3>
            <p>Please select who to assign the chore to.</p>
            <p> *When the member is not available then the member is too young to accomplish this chore.</p>
        
        <table border="0" cellspacing="2" cellpadding="2">
            <tr> 
                <th>Chore Room Name</th>
                <th>Chore Name</th>
                <th>Chore Frequency</th>
                <th>Chore Reward Points</th>                         
                <?php while ($column = mysqli_fetch_array($result)): ?>
                <th><?php echo $column['firstName']; ?></th>
                <?php endwhile ?>                
            </tr>
            <?php while ($row = mysqli_fetch_array($result2)): ?>
            <tr> 
                    <td><?php echo $row['roomName']; ?></td>
                    <td><?php echo $row['choreName']; ?></td>
                    <td><?php echo $row['choreFrequency']; ?></td>
                    <td><?php echo $row['choreRewardPoints']; ?></td>
                    <?php while($column = mysqli_fetch_array($result)):?>
                    <td><label class="containerRadio"><input type="radio" name="memberName" value="<?php echo $column['firstName']; ?>"><span class="checkmarkRadio"></span></label></td>
                    <?php endwhile ?>
            </tr>
            <?php endwhile ?>            
         </table>
      </fieldset>
        <fieldset>
            <!--Personal -->
            <h3>Personal Chore Assignment List</h3>
        
        <table border="0" cellspacing="2" cellpadding="2">
            <tr> 
                <th>Member Name</th>
                <th>Chore Name</th>
                <th>Chore Frequency</th>
            </tr>
            <?php while ($row = mysqli_fetch_array($result3)): ?>
            <tr> 
                    <td><?php echo $row['memberFirstName']; ?></td>
                    <td><?php echo $row['choreName']; ?></td>
                    <td><?php echo $row['choreFrequency']; ?></td>                                       
            </tr>
            <?php endwhile ?>            
         </table>
        </fieldset>         
    </body>
</html>