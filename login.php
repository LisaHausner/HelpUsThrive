<?php 
 session_start(); 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="header">
  	<h2>Welcome to Help Us Thrive! Login </h2>
        </div>
        <form method="post" action="insertUser.php">
       	<div class="input-group">
  		<label>House Name</label><input type="text" name="houseName" >
  	</div>
  	<div class="input-group">
  		<label>Password</label> <input type="password" name="password1">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
            Not yet a member? <a class="btn btn1" style =" text-decoration: none" href="register.php">Sign up</a>
        </p>
        </form>
    </body>
</html> 
 




