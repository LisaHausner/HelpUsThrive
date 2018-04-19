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
        <title>Register Users </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("dbinfo.inc.php");

$con = mysqli_connect($host, $username, $password, $database)
        or die("Unable to select database");

// REGISTER USER
if (isset($_REQUEST['reg_user'])) {
  // receive all input values from the form
  $houseName = mysqli_real_escape_string($con, $_REQUEST['houseName']);
  $houseEmail = mysqli_real_escape_string($con, $_REQUEST['houseEmail']);
  $password_1 = mysqli_real_escape_string($con, $_REQUEST['password_1']);
  $password_2 = mysqli_real_escape_string($con, $_REQUEST['password_2']);
  if(empty($houseName)){
      die("House Name is required");
  }
  if(empty($houseEmail)){
      die("Email is required");
  }
  if(empty($password_1)){
      die("Password is required");
  }
  if($password_1 != $password_2) {
  die("The two passwords do not match");
  }
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $_SESSION["houseName"] = $houseName;
  $house_check_query = "SELECT * FROM house WHERE houseName='$houseName' OR houseEmail='$houseEmail' LIMIT 1";
  $result = mysqli_query($con, $house_check_query);
  $house = mysqli_fetch_assoc($result);
  
  if ($house) { // if user exists
    if ($house['houseName'] === $houseName) {
      die("Username already exists");
    }

    if ($house['houseEmail'] === $houseEmail) {
      die("Email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (mysqli_errno($con) != 0) {
    echo mysqli_errno($con) . ": " . mysqli_error($con) . "\n";
} else {
  	$housePassword = md5($password_1);//encrypt the password before saving in the database
        //$housePassword = $password_1;
  	$query = "INSERT INTO house (houseName, houseEmail, housePassword) 
  			  VALUES('$houseName', '$houseEmail', '$housePassword')";
  	mysqli_query($con, $query);
  	$_SESSION['houseName'] = $houseName;
  	$_SESSION['success'] = "You are now logged in";
        mysqli_close();
  	header('location: addFamily.php');
  }
}

// LOGIN USER
if (isset($_REQUEST['login_user'])) {
  $houseName = mysqli_real_escape_string($con, $_REQUEST['houseName']);
  $password1 = mysqli_real_escape_string($con, $_REQUEST['password1']);
  $_SESSION["houseName"] = $houseName;

  if (empty($houseName)) {
  	die("House name is required");
  }
  if (empty($password1)) {
  	die("Password is required");
  }
if (mysqli_errno($con) != 0) {
    echo mysqli_errno($con) . ": " . mysqli_error($con) . "\n";
} else {
    	$housePassword = md5($password1);
        //$housePassword = $password1;
        $query = "SELECT * FROM house WHERE houseName='$houseName' AND housePassword= '$housePassword'";
        $results = mysqli_query($con, $query);
        if((mysqli_num_rows($results))===1){
            $_SESSION['houseName'] = $houseName;
            $_SESSION['success'] = "You are now logged in.";
            mysqli_close($con);
            header('location: index.php');
            }else{
                die("Wrong username/password combination.");
            }
      }
}

?> 
    </body>
</html>