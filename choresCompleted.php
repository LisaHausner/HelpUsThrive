<!--Need to adjust for chores completed.-->

<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>choresCompleted </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/newcss.css">
    </head>
    <body>
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include("dbinfo.inc.php");
        
        $con = mysqli_connect("localhost", $username, $password, $database)
                or die("Unable to select database");
        $houseName = $_SESSION["houseName"];
        if (isset($_REQUEST['Seasonally']) && $_REQUEST['Seasonally'] == 'Seasonally') {
            $Seasonally = mysqli_real_escape_string($db, $_REQUEST["Seasonally"]);
            $querySeasonally = "INSERT INTO chorehouseassignment(houseID, choreID) SELECT house.houseID, chores.choreID FROM house, chores WHERE chores.choreFrequency='Seasonally' AND house.houseName= '$houseName'";
            mysqli_query($con, $querySeasonally);
        }
        if (isset($_REQUEST['Outside']) && $_REQUEST['Outside'] == 'Outside') {
            $Outside = mysqli_real_escape_string($db, $_REQUEST["Outside"]);
            $queryOutside = "INSERT INTO chorehouseassignment(houseID, choreID) SELECT house.houseID, chores.choreID FROM house, chores WHERE chores.choreRoom='Outside' AND house.houseName= '$houseName'";
            mysqli_query($con, $queryOutside);
        }

        if (isset($_REQUEST['Dog']) && $_REQUEST['Dog'] == 'Dog') {
            $Dog = mysqli_real_escape_string($db, $_REQUEST["Dog"]);
            $queryDog = "INSERT INTO chorehouseassignment(houseID, choreID) SELECT house.houseID, chores.choreID FROM house, chores WHERE chores.choreType='Dog' AND house.houseName= '$houseName'";
            mysqli_query($con, $queryDog);
        }

        if (isset($_REQUEST['Cat']) && $_REQUEST['Cat'] == 'Cat') {
            $Cat = mysqli_real_escape_string($db, $_REQUEST["Cat"]);
            $queryCat = "INSERT INTO chorehouseassignment(houseID, choreID) SELECT house.houseID, chores.choreID FROM house, chores WHERE chores.choreType='Cat' AND house.houseName= '$houseName'";
            mysqli_query($con, $queryCat);
        }
        if (isset($_REQUEST['Rabbit']) && $_REQUEST['Rabbit'] == 'Rabbit') {
            $Rabbit = mysqli_real_escape_string($db, $_REQUEST["Rabbit"]);
            $queryRabbit = "INSERT INTO chorehouseassignment(houseID, choreID) SELECT house.houseID, chores.choreID FROM house, chores WHERE chores.choreType='Rabbit' AND house.houseName= '$houseName'";
            mysqli_query($con, $queryRabbit);
        }
        if (isset($_REQUEST['Fish']) && $_REQUEST['Fish'] == 'Fish') {
            $Fish = mysqli_real_escape_string($db, $_REQUEST["Fish"]);
            $queryFish = "INSERT INTO chorehouseassignment(houseID, choreID) SELECT house.houseID, chores.choreID FROM house, chores WHERE chores.choreType='Fish' AND house.houseName= '$houseName'";
            mysqli_query($con, $queryFish);
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
        header('Location: http://localhost:8888/HelpMeThrive/questionnaireComplete.php');
        ?> 
    </body>
</html>