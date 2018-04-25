<?php 
  session_start(); 

  if (!isset($_SESSION['houseName'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['houseName']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Chore Assignment</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/newcss.css">
    </head>
    <body>
    	<div class="logout">
    	<h4><strong>Thriving <?php echo $_SESSION['houseName']; ?></strong></h4><br>
    	<a class ="logoutbutton" href="index.php?logout='1'">logout</a></div>
        <div class="fish">
    	<img src="../images/fish.png" height="50" style="border-radius:12px"></div>        
        <fieldset>
 <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include("dbinfo.inc.php");
        $con = mysqli_connect($host, $username, $password, $database)
                or die("Unable to select database");
        $houseName = $_SESSION["houseName"];
        //adding family chores
        $queryRoom = "INSERT INTO room (roomHouseName, roomName, roomType) VALUES ('$houseName','$houseName Chores','Family')";
        mysqli_query($con, $queryRoom);        
        $queryRoomToHouse = "INSERT INTO roomhouseassignment(houseID, roomID) SELECT house.houseID AS houseID, room.roomID AS roomID FROM house, room 
        WHERE house.houseName = '$houseName' AND room.roomName = '$houseName Chores'";
        mysqli_query($con, $queryRoomToHouse);        
        $queryFamilyChores = "INSERT INTO chorehouseassignment(houseID, choreID) SELECT house.houseID, chores.choreID FROM house, chores WHERE chores.choreType='Family'
        AND house.houseName= '$houseName'";
        mysqli_query($con, $queryFamilyChores);
        //end adding family chores
        header('Location: chorelist.php');
        mysqli_close($con);
?>
        
        $query = "SELECT * FROM houseMembers WHERE houseMembers.houseName='$houseName'";
        $result = mysqli_query($con, $query);
        $query2 = "SELECT * FROM houseChore2 WHERE houseChore2.houseName='$houseName'AND houseChore2.choreType != 'Personal'";
        $result2 = mysqli_query($con, $query2);        
        $queryPersonal = "SELECT * FROM personalMemberChores WHERE personalMemberChores.memberHouseName='$houseName'";
        $result3 = mysqli_query($con, $queryPersonal);
        
//$num = mysqli_num_rows($result);
//echo $num;

            <h3><center>Family Chore List<center></h3>
       
        <table border="0" cellspacing="2" cellpadding="2">
            <tr> 
                <th>Chore Room Name</th>
                <th>Chore Name</th>
                <th>Chore Frequency</th>                                
            </tr>
            <?php while ($row = mysqli_fetch_array($result2)): ?>
            <tr> 
                    <td><?php echo $row['roomName']; ?></td>
                    <td><?php echo $row['choreName']; ?></td>
                    <td><?php echo $row['choreFrequency']; ?></td>                       
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
                    <td><?php echo $row['memberFirstName']; ?> (<?php echo $row['memberBirthdate'];?>)</td>
                    <td><?php echo $row['choreName']; ?></td>
                    <td><?php echo $row['choreFrequency']; ?></td>                                       
            </tr>
            <?php endwhile ?>            
         </table>
        </fieldset>         
    </body>
</html>