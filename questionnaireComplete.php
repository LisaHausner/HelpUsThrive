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
        <title>Create a House </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/newcss.css">
    </head>
    <body>
    	<div class="logout">
    	<h4><strong>Thriving <?php echo $_SESSION['houseName']; ?></strong></h4><br>
    	<a class ="logoutbutton" href="index.php?logout='1'">Logout</a></div>
        <fieldset>
        <h1>Congratulations!</h1> <h1>You Completed The Questionnaire!</h1> 
        <p> Below is the information that you have input.  Please double check it then please press Questionnaire Complete.</p>
            <fieldset>
            <form action="questionnaire.php" method="post">
            <input class ="button button1" style="width:100%" type="Submit" value="Questionnaire Complete">
            </form>
        </fieldset>
        <a class ="button button2" href ="addFamily.php">Add Family Member</a>
        <a class ="button button2" href="addRoom.php">Add a Room</a>
              
        </fieldset>
       <!-- House Information-->
       <fieldset>
   <?php
        include("dbinfo.inc.php");
        $con = mysqli_connect("localhost", $username, $password, $database)
                or die("Unable to select database");
        $houseName = $_SESSION["houseName"];
        $query = "SELECT * FROM house WHERE houseName = '$houseName'";
        //$query = "SELECT * FROM housemembers";
        $result = mysqli_query($con, $query);

//$num = mysqli_num_rows($result);
//echo $num;
        mysqli_close($con);
              ?>
        <table border="0" cellspacing="2" cellpadding="2">
            <?php while ($row = mysqli_fetch_array($result)) : ?>
            <tr> 
                    <h2><?php echo $row['houseName']; ?></h2>                                     
            </tr>
            <?php endwhile ?>
	</table>
	<div class="grid-container">
	<div class="item2">
       <!-- Family Information-->
 <?php
        include("dbinfo.inc.php");
        $con = mysqli_connect("localhost", $username, $password, $database)
                or die("Unable to select database");
        $houseName = $_SESSION["houseName"];
        $query = "SELECT * FROM houseMembers WHERE houseMembers.houseName='$houseName'";
        //$query = "SELECT * FROM housemembers";
        $result = mysqli_query($con, $query);

//$num = mysqli_num_rows($result);
//echo $num;
        mysqli_close($con);

        echo "<center><h4>Members</h4></center>";
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
        </div>
        <div class="item3">
        <!-- Room Information-->
        
        <?php

        include("dbinfo.inc.php");
        $con = mysqli_connect("localhost", $username, $password, $database)
                or die("Unable to select database");
        //$houseName = $_SESSION["houseName"];
        $query = "SELECT * FROM houseRooms WHERE houseName = '$houseName'AND roomName != '$houseName Chores'";
        //$query = "SELECT * FROM housemembers";
        $result = mysqli_query($con, $query);

//$num = mysqli_num_rows($result);
//echo $num;
        mysqli_close($con);

        echo "<center><h4>Rooms</h4></center>";
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
        </div>
        </div> 
       </fieldset>
    </body>
</html>