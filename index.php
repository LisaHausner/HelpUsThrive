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
	<title>Home</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <fieldset>
<div class="header">
	<h2>Welcome to Help Me Thrive!</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['houseName'])) : ?>
    <h3>Welcome <strong><?php echo $_SESSION['houseName']; ?></strong></h3><br>
    	<a class ="btn" style="text-decoration: none; background-color: red" href="index.php?logout='1'">logout</a>
        <a class= "btn" style="text-decoration: none" href="addFamily.php">Get Started!</a>
        <!--<a class= "btn" href="ChoreAssigned.php">Current Chores</a>
        <a class= "btn" href="choreHistory.php.php">Chore History</a>
        <a class= "btn" href="rewardPoints.php">Reward Points</a>-->
        <!--<p> <a class ="button button2" href="addChores.php">Add Customized Chores</a></p>-->
        <a class="btn" style="text-decoration: none" href="choresToComplete.php">Chores to Complete</a>
        <!--<p> <a class ="btn" href="choreHistory.html">Chore History</a></p>-->
    <?php endif ?>
</div>
</fieldset>		
</body>
</html>
