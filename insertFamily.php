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
        <title>Insert Family Members </title>
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

$memberFirstName = mysqli_real_escape_string($con, $_REQUEST['memberFirstName']);
$memberLastName = mysqli_real_escape_string($con, $_REQUEST['memberLastName']);
$memberType = mysqli_real_escape_string($con, $_REQUEST['memberType']);
$memberBirthdate = mysqli_real_escape_string($con, $_REQUEST['memberBirthdate']);
$houseName = $_SESSION["houseName"];
//inserting member to house
$query = "INSERT INTO members (memberHouseName, memberFirstName, memberLastName, memberType, memberBirthdate) VALUES ('$houseName','$memberFirstName','$memberLastName','$memberType','$memberBirthdate')";
mysqli_query($con, $query);
$queryMemberHouseAssignment = "INSERT INTO memberhouseassignment(houseID, memberID) SELECT house.houseID AShouseID,members.memberID ASmemberID FROM house,members WHERE house.houseName='$houseName'AND members.memberHouseName='$houseName'AND members.memberFirstName='$memberFirstName'AND members.memberLastName='$memberLastName'AND members.memberBirthdate='$memberBirthdate'";
//inserting personal chores to member
mysqli_query($con, $queryMemberHouseAssignment);
$queryChoresToMembers = "INSERT INTO choreassignment(choreID,memberID) SELECT chores.choreID ASchoreID,members.memberID AS memberID  FROM chores,members WHERE chores.choreType='Personal'AND members.memberFirstName='$memberFirstName'AND members.memberHouseName='$houseName'AND chores.choreMinAge<=TIMESTAMPDIFF(YEAR,members.memberBirthdate,CURDATE())";
mysqli_query($con, $queryChoresToMembers);
$queryRoom = "INSERT INTO room (roomHouseName, roomName, roomType) VALUES ('$houseName','$memberFirstName $memberBirthdate Personal','Personal')";
mysqli_query($con, $queryRoom);
$queryRoomToHouse = "INSERT INTO roomhouseassignment(houseID, roomID) SELECT house.houseID AS houseID, room.roomID AS roomID FROM house, room WHERE house.houseName='$houseName'AND room.roomName='$memberFirstName Personal'";
mysqli_query($con, $queryRoomToHouse);

if (mysqli_errno($con) != 0) {
    echo mysqli_errno($con) . ": " . mysqli_error($con) . "\n";
} else {
    echo "SQL is...<br>";
    echo $query;
    echo "SQL is...<br>";
    echo $queryMemberHouseAssignment;
    echo "<br> Rows affected: ";
    echo mysqli_affected_rows($con);
}

mysqli_close();
header('Location: addFamily.php');
?> 
    </body>
</html>
