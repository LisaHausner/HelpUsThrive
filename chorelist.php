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
        <fieldset>
 <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include("dbinfo.inc.php");
        $con = mysqli_connect($host, $username, $password, $database)
                or die("Unable to select database");
        $houseName = $_SESSION["houseName"];              
        $query = "SELECT * FROM houseMembers WHERE houseMembers.houseName='$houseName'";
        $result = mysqli_query($con, $query);
        $query2 = "SELECT * FROM houseChore2 WHERE houseChore2.houseName='$houseName'AND houseChore2.choreType != 'Personal'ORDER BY houseChore2.choreFrequency";
        $result2 = mysqli_query($con, $query2);        
        $queryPersonal = "SELECT * FROM personalMemberChores WHERE 1 AND personalMemberChores.memberHouseName='$houseName'ORDER BY personalMemberChores.memberFirstName ASC";
        $result3 = mysqli_query($con, $queryPersonal);
        
//$num = mysqli_num_rows($result);
//echo $num;
mysqli_close($con);
?>
	<h1>Welcome to the Completed Chore List</h1>
	<div class="grid-container">
  <div class="item2">
	<fieldset>
            <h3><center>Family Chore List<center></h3>
       
        <table border="0" cellspacing="2" cellpadding="2">
            <tr> 
                <th>Chore Frequency</th>
                <th>Chore Room Name</th>
                <th>Chore Name</th>
                                                
            </tr>
            <?php while ($row = mysqli_fetch_array($result2)): ?>
            <tr> 
                    <td><?php echo $row['choreFrequency']; ?></td>
                    <td><?php echo $row['roomName']; ?></td>
                    <td><?php echo $row['choreName']; ?></td>
                                           
 	</tr>                     
 	<?php endwhile ?>
         </table>
         </fieldset>
         </div>
            <div class="item3">
            <fieldset>
            <!--Personal -->
            <h3>Personal Chore List</h3>
        
        <table border="0" cellspacing="2" cellpadding="2">
            <tr> 
                <th>Chore Frequency</th>
                <th>Member Name</th>
                <th>Chore Name</th>
            </tr>
            <?php while ($row = mysqli_fetch_array($result3)): ?>
            <tr> 
		    <td><?php echo $row['choreFrequency']; ?></td>
                    <td><?php echo $row['memberFirstName']; ?> (<?php echo $row['memberBirthdate'];?>)</td>
                    <td><?php echo $row['choreName']; ?></td>                                    
            </tr>
            <?php endwhile ?>            
         </table>
        </fieldset>     
         </div>
      </fieldset>      
    </body>
</html>