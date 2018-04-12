<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Insert House </title>
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
  $houseSize = mysqli_real_escape_string($con, $_REQUEST['houseSize']);
      $query = "INSERT INTO house VALUES ('','$houseName','$houseSize')";
       echo $query;
       mysqli_query($con, $query);
        if (mysqli_errno($con) != 0) {
            echo mysqli_errno($con) . ": " . mysqli_error($con) . "\n";
        } else {
           echo "SQL is...<br>";
            echo $query;
            echo "<br> Rows affected: ";
            echo mysqli_affected_rows($con);
        }

        mysqli_close();
        header('Location: http://localhost:8888/HelpMeThrive/addFamily.php');
        ?>
    </body>
</html>