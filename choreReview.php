<?php 
  session_start(); 

  if (!isset($_SESSION['houseName'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: /HelpMeThrive/login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['houseName']);
  	header("location: /HelpMeThrive/login.php");
  }
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
    	<div class="logout">
    	<h4><strong>Thriving <?php echo $_SESSION['houseName']; ?></strong></h4><br>
    	<a class ="logoutbutton" href="index.php?logout='1'">logout</a></div>
        
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include("dbinfo.inc.php");
        $con = mysqli_connect("localhost", $username, $password, $database)
                or die("Unable to select database");
        $houseName = $_SESSION["houseName"];
        $members= "SELECT * FROM members WHERE members.memberHouseName='$houseName'";
        $result2= mysqli_query($con, $members);
        $query = "SELECT * FROM houseChore2 WHERE houseChoresREAL.houseName='$houseName'";
        $result = mysqli_query($con, $query);

//$num = mysqli_num_rows($result);
//echo $num;
        mysqli_close($con);
        echo "<b><center>'$houseName'</center></b><br>";

        echo "<b><center>Family Chores</center></b><br><br>";
        ?>
        <table border="0" cellspacing="2" cellpadding="2">
            <tr> 
                <th>Chore Room Name: Room Type</th>
                <th>Chore Description</th>
                <th>Chore Frequency</th>
                <th>Chore Reward Points</th>
                <th>Choose Member to Assign Chore to.</th>
            </tr>

            <?php
            while ($row = mysqli_fetch_array($result) && $col = mysqli_fetch_array($result2)) {

                $choreName = $row['choreName'];
                $choreFrequency = $row['choreFrequency'];
                $roomName = $row['roomName'];
                $roomType = $row['roomType'];
                $choreRewardPoints = $row['choreRewardPoints'];
                $memberFirstName = $col['$memberFirstName'];}
                
                
                ?>

                <tr> 
                    <td><?php echo "$choreName"; ?></td>
                    <td><?php echo "$choreFrequency"; ?></td>
                    <td><?php echo "$roomName $roomType"; ?></td>
                    <td><?php echo "$choreRewardPoints"; ?></td>
                    <td><input class="containerRadio" type ="radio" name="$memberFirstName"/> <?php echo "$memberFirstName"; ?></td>
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

        $query = "SELECT * FROM personalMemberChores";
        $result = mysqli_query($con, $query);

//$num = mysqli_num_rows($result);
//echo $num;
        mysqli_close($con);

        echo "<b><center>Personal Chores by Family Member</center></b><br><br>";
        ?>
        <table border="0" cellspacing="2" cellpadding="2">
            <tr> 
                 
                <th>Member Name (Birthdate)</th>
                <th>Chore Name</th>
                <th>Chore Room Name</th>
                <th>Chore Frequency</th>
                <th>Chore Reward Points</th>

                
               
            </tr>

            <?php
            while ($row = mysqli_fetch_array($result)) {

                $memberFirstName = $row['memberFirstName'];
                $memberLastName = $row['memberLastName'];
		$memberBirthdate = $row['memberBirthdate'];
                $choreName = $row['choreName'];
                $choreFrequency = $row['choreFrequency'];
                $choreRewardPoints = $row['choreRewardPoints'];

                
                ?>

                <tr> 
                    <td><?php echo "$memberFirstName"; ?> <?php echo "$memberLastName";?> (<?php echo "$memberBirthdate";?>)</td>
                    <td><?php echo "$choreName"; ?></td>
                    <td><?php echo "$choreRoomName"; ?></td>
                    <td><?php echo "$choreFrequency"; ?></td>
                    <td><?php echo "$choreRewardPoints"; ?></td>
                    <td><?php echo "$choreType"; ?></td>
                    <td><input class="containerRadio" type="radio" name="delete">Click to delete chore from <?php echo "$memberFirstName"; ?>'s chores.</td>
                   
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
