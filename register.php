<?php 
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register New House and User</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

    <div class="header">
  	<h2>Register</h2>
    </div>
	
    <form method="post" action="insertUser.php">
  	
  	<div class="input-group">
  	  <label>House Name (Example: Humorous Hausners)</label>
          <input type="text" name="houseName">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="houseEmail">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class ="btn" name="reg_user">Register</button>
  	</div>
  	Already a member? <a class="btn btn1" style="text-decoration:none" href="login.php">Sign in</a>
  </form>
</body>
</html>
