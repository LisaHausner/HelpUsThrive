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
        $houseName = $_SESSION["houseName"];
        if (isset($_REQUEST['Seasonally']) && $_REQUEST['Seasonally'] == 'Seasonally') {
            $Seasonally = mysqli_real_escape_string($db, $_REQUEST["Seasonally"]);
            $querySeasonally = "INSERT INTO chorehouseassignment(houseID, choreID) SELECT house.houseID, chores.choreID FROM house, chores WHERE chores.choreFrequency='Seasonally' 
            AND house.houseName='$houseName'";
            mysqli_query($con, $querySeasonally);
        }
        if (isset($_REQUEST['Outside']) && $_REQUEST['Outside'] == 'Outside') {
            $Outside = mysqli_real_escape_string($db, $_REQUEST["Outside"]);
            $queryRoomOutside = "INSERT INTO room (roomHouseName, roomName, roomType) VALUES ('$houseName','$houseName Outside','Outside')";
	    mysqli_query($con, $queryRoomOutside );
            $queryRoomToHouseOutside  = "INSERT INTO roomhouseassignment(houseID, roomID) SELECT house.houseID AS houseID, room.roomID AS roomID FROM house,room WHERE house.houseName='$houseName'AND 
            room.roomName='$houseName Outside'";
	    mysqli_query($con, $queryRoomToHouseOutside );
            $queryRoomToChoresOutside  = "INSERT INTO roomchoreAssignment(choreID,roomID) SELECT chores.choreID AS choreID,room.roomID AS roomID FROM chores,room WHERE chores.choreRoom='Outside'AND 
            room.roomName='$houseName Outside'";
            mysqli_query($con, $queryRoomToChoresOutside );
           $queryChoreToRoomOutside  = "INSERT INTO chorehouseassignment(houseID,choreID) SELECT house.houseID AS houseID, roomchoreAssignment.choreID AS choreID FROM house,roomchoreAssignment,room 
           WHERE house.houseName='$houseName'AND room.roomID=roomchoreAssignment.roomID AND room.roomName='$houseName Outside'";
           mysqli_query($con, $queryChoreToRoomOutside );
        }

        if (isset($_REQUEST['Dog']) && $_REQUEST['Dog'] == 'Dog') {
            $Dog = mysqli_real_escape_string($db, $_REQUEST["Dog"]);
            $queryRoomDog = "INSERT INTO room (roomHouseName, roomName, roomType) VALUES ('$houseName','$houseName Dog','Dog')";
            mysqli_query($con, $queryRoomDog);
	    $queryRoomToHouseDog = "INSERT INTO roomhouseassignment(houseID, roomID) SELECT house.houseID AS houseID, room.roomID AS roomID FROM house,room WHERE house.houseName='$houseName'
	    AND room.roomName='$houseName Dog'";
            mysqli_query($con, $queryRoomToHouseDog);
            $queryRoomToChoresDog = "INSERT INTO roomchoreAssignment(choreID,roomID) SELECT chores.choreID AS choreID,room.roomID AS roomID FROM chores,room WHERE chores.choreRoom='Dog'
            AND room.roomName='$houseName Dog'";
            mysqli_query($con, $queryRoomToChoresDog);
            $queryChoreToRoomDog = "INSERT INTO chorehouseassignment(houseID,choreID) SELECT house.houseID AS houseID, roomchoreAssignment.choreID AS choreID FROM house,roomchoreAssignment,room 
            WHERE house.houseName='$houseName'AND room.roomID=roomchoreAssignment.roomID AND room.roomName='$houseName Dog'";
            mysqli_query($con, $queryChoreToRoomDog);
        }

        if (isset($_REQUEST['Cat']) && $_REQUEST['Cat'] == 'Cat') {
            $Cat = mysqli_real_escape_string($db, $_REQUEST["Cat"]);        
            $queryRoomCat = "INSERT INTO room (roomHouseName, roomName, roomType) VALUES ('$houseName','$houseName Cat','Cat')";
	    mysqli_query($con, $queryRoomCat);
            $queryRoomToHouseCat = "INSERT INTO roomhouseassignment(houseID, roomID) SELECT house.houseID AS houseID, room.roomID AS roomID FROM house,room WHERE house.houseName='$houseName'
            AND room.roomName='$houseName Cat'";
	    mysqli_query($con, $queryRoomToHouseCat);
	    $queryRoomToChoresCat = "INSERT INTO roomchoreAssignment(choreID,roomID) SELECT chores.choreID AS choreID,room.roomID AS roomID FROM chores,room WHERE chores.choreRoom='Cat'
	    AND room.roomName='$houseName Cat'";
	    mysqli_query($con, $queryRoomToChoresCat);
	    $queryChoreToRoomCat = "INSERT INTO chorehouseassignment(houseID,choreID) SELECT house.houseID AS houseID, roomchoreAssignment.choreID AS choreID FROM house,roomchoreAssignment,room 
	    WHERE house.houseName='$houseName'AND room.roomID=roomchoreAssignment.roomID AND room.roomName='$houseName Cat'";
            mysqli_query($con, $queryChoreToRoomCat);
        }
        if (isset($_REQUEST['Rabbit']) && $_REQUEST['Rabbit'] == 'Rabbit') {
            $Rabbit = mysqli_real_escape_string($db, $_REQUEST["Rabbit"]);                      
            $queryRoomRabbit = "INSERT INTO room (roomHouseName, roomName, roomType) VALUES ('$houseName','$houseName Rabbit','Rabbit')";
	    mysqli_query($con, $queryRoomRabbit);
	    $queryRoomToHouseRabbit = "INSERT INTO roomhouseassignment(houseID, roomID) SELECT house.houseID AS houseID, room.roomID AS roomID FROM house,room WHERE house.houseName='$houseName'
	    AND room.roomName='$houseName Rabbit'";
	    mysqli_query($con, $queryRoomToHouseRabbit);
  	    $queryRoomToChoresRabbit = "INSERT INTO roomchoreAssignment(choreID,roomID) SELECT chores.choreID AS choreID,room.roomID AS roomID FROM chores,room WHERE chores.choreRoom='$Rabbit'
  	    AND room.roomName='$houseName Rabbit'";
	    mysqli_query($con, $queryRoomToChoresRabbit);
	    $queryChoreToRoomRabbit = "INSERT INTO chorehouseassignment(houseID,choreID) SELECT house.houseID AS houseID, roomchoreAssignment.choreID AS choreID FROM house,roomchoreAssignment,room 
	    WHERE house.houseName='$houseName'AND room.roomID=roomchoreAssignment.roomID AND room.roomName='$houseName Rabbit'";
            mysqli_query($con, $queryChoreToRoomRabbit);
        }
        if (isset($_REQUEST['Fish']) && $_REQUEST['Fish'] == 'Fish') {
            $Fish = mysqli_real_escape_string($db, $_REQUEST["Fish"]);                   
            $queryRoomFish = "INSERT INTO room (roomHouseName, roomName, roomType) VALUES ('$houseName','$houseName Fish','Fish')";
	    mysqli_query($con, $queryRoomFish);
	    $queryRoomToHouseFish = "INSERT INTO roomhouseassignment(houseID, roomID) SELECT house.houseID AS houseID, room.roomID AS roomID FROM house,room WHERE house.houseName='$houseName'
	    AND room.roomName='$houseName Fish'";
	    mysqli_query($con, $queryRoomToHouseFish);
	    $queryRoomToChoresFish = "INSERT INTO roomchoreAssignment(choreID,roomID) SELECT chores.choreID AS choreID,room.roomID AS roomID FROM chores,room WHERE chores.choreRoom='Fish'
	    AND room.roomName='$houseName Fish'";
	    mysqli_query($con, $queryRoomToChoresFish);
	    $queryChoreToRoomFish = "INSERT INTO chorehouseassignment(houseID,choreID) SELECT house.houseID AS houseID, roomchoreAssignment.choreID AS choreID FROM house,roomchoreAssignment,room 
	    WHERE house.houseName='$houseName'AND room.roomID=roomchoreAssignment.roomID AND room.roomName='$houseName Fish'";
	    mysqli_query($con, $queryChoreToRoomFish);
        }

        if (mysqli_errno($con) != 0) {
            echo mysqli_errno($con) . ": " . mysqli_error($con) . "\n";
        } else {
            echo "SQL is...<br>";
            echo $queryDog;
            echo "SQL is...<br>";
            echo $queryCat;
            echo "SQL is...<br>";
            echo $queryRabbit;
            echo "SQL is...<br>";
            echo $queryFish;
            echo "SQL is...<br>";
            echo $querySeasonally;
            echo "SQL is...<br>";
            echo $queryOutside;

            echo "<br> Rows affected: ";
            echo mysqli_affected_rows($con);
        }

        mysqli_close();
        header('Location: questionnaireComplete.php');
        ?> 
    </body>
</html>