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

//update family member
 $queryUpdate= "UPDATE members SET memberFirstName='$memberFirstName',memberLastName='$memberLastName',memberType='$memberType',memberBirthdate='$memberBirthdate' WHERE 1 AND members.memberID='$memberID'";
 mysqli_query($con,$queryUpdate);

  if (mysqli_errno($con) != 0) {
    echo mysqli_errno($con) . ": " . mysqli_error($con) . "\n";
} else {
    echo "SQL is...<br>";
    echo $query;
    echo "<br> Rows affected: ";
    echo mysqli_affected_rows($con);
}
mysqli_close();
header('Location: addFamily.php');


?> 
    </body>
</html>
