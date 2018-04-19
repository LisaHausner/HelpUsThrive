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
        <title>RoomInsert </title>
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

$roomName = mysqli_real_escape_string($con, $_REQUEST['roomName']);
$roomType = mysqli_real_escape_string($con, $_REQUEST['roomType']);
$houseName = $_SESSION["houseName"];
//inserts room into house
$queryRoom = "INSERT INTO room (roomHouseName, roomName, roomType) VALUES ('$houseName','$roomName','$roomType')";
mysqli_query($con, $queryRoom);
$queryRoomToHouse = "INSERT INTO roomhouseassignment(houseID, roomID) SELECT house.houseID AS houseID, room.roomID AS roomID FROM house,room WHERE house.houseName='$houseName'AND room.roomName='$roomName'";
mysqli_query($con, $queryRoomToHouse);
$queryRoomToChores = "INSERT INTO roomchoreAssignment(choreID,roomID) SELECT chores.choreID AS choreID,room.roomID AS roomID FROM chores,room WHERE chores.choreRoom='$roomType'AND room.roomName='$roomName'";
mysqli_query($con, $queryRoomToChores);
$queryChoreToRoom = "INSERT INTO chorehouseassignment(houseID,choreID) SELECT house.houseID AS houseID, roomchoreAssignment.choreID AS choreID FROM house,roomchoreAssignment,room WHERE house.houseName='$houseName'AND room.roomID=roomchoreAssignment.roomID AND room.roomName='$roomName'";
if (mysqli_errno($con) != 0) {
    echo mysqli_errno($con) . ": " . mysqli_error($con) . "\n";
} else {
    echo "SQL is...<br>";
    echo $queryRoom;
    echo "SQL is...<br>";
    echo $queryRoomToHouse;
    echo "<br> Rows affected: "; 
    echo mysqli_affected_rows($con);
}

mysqli_close();
header('Location: addRoom.php');
?> 
    </body>
</html>