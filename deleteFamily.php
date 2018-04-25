
Currently editing:  
/home/helpusth/public_html/scripts/updateFamily.php
 Encoding:     Switch to Code Editor      Save

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
        <title>Update Family Members </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/newcss.css">
    </head>
    <body>
<?php
error_reporting(E_ALL);
        ini_set('display_errors', 1);
include("dbinfo.inc.php");

$con = mysqli_connect($host, $username, $password, $database)
        or die("Unable to select database");

$memberID = mysqli_real_escape_string($con, $_REQUEST['memberID']);
$memberFirstName = mysqli_real_escape_string($con, $_REQUEST['memberFirstNameUpdate']);
$memberLastName = mysqli_real_escape_string($con, $_REQUEST['memberLastNameUpdate']);
$memberType = mysqli_real_escape_string($con, $_REQUEST['memberTypeUpdate']);
$memberBirthdate = mysqli_real_escape_string($con, $_REQUEST['memberBirthdateUpdate']);
$houseName = mysqli_real_escape_string($con, $_REQUEST['houseName']);

//delete family member

  $query5= "DELETE FROM roomhouseassignment WHERE roomhouseassignment.roomID = (SELECT room.roomID FROM room WHERE room.roomName='$memberFirstName $memberBirthdate Personal' AND room.roomHouseName='$houseName')";
  mysqli_query($con, $query5);
  $query4= "DELETE FROM room WHERE roomName='$memberFirstName $memberBirthdate Personal'";
  mysqli_query($con, $query4);
  $query3= "DELETE FROM `choreassignment` WHERE memberID='$memberID'";
  mysqli_query($con, $query3);
  $query1= "DELETE FROM memberhouseassignment WHERE memberhouseassignment.memberID='$memberID'";
  mysqli_query($con, $query1);
  $query2= "DELETE FROM members WHERE members.memberID='$memberID';";
  mysqli_query($con, $query2);
  
  if (mysqli_errno($con) != 0) {
    echo mysqli_errno($con) . ": " . mysqli_error($con) . "\n";
} else {
    echo "SQL is...<br>";
    echo $query1;
    echo "SQL is...<br>";
    echo $query2;
    echo "<br> Rows affected: ";
    echo mysqli_affected_rows($con);
}
mysqli_close();
header('Location: addFamily.php');

?>
  
 
    </body>
</html>

