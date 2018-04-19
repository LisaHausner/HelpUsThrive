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
        <title>Questionnaire: Start- Add House </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/newcss.css">
    </head>
    <body>
    	<div class="logout">
    	<h4><strong>Thriving <?php echo $_SESSION['houseName']; ?></strong></h4><br>
    	<a class ="logoutbutton" href="index.php?logout='1'">logout</a></div>
        <fieldset>                
            <h1>Help Me Thrive! Questionnaire</h1>  
            <h2>Add Your House</h2>
            <p>Thank you for signing up for Help Us Thrive!</p>
            <p>Please answer the following questions about your house then click submit.</p>
            <fieldset>
                <form action="insertHouse.php" method="post">
                    <p>What is the size of your house?</p>
                    <label class="containerRadio">Category I:  under 2,000 square feet  <input type="radio" name="houseSize" value="Small"><span class="checkmarkRadio"></span></label>
                    <label class="containerRadio">Category II:  2,001 to 2,999 square feet  <input type="radio" name="houseSize" value="Medium"><span class="checkmarkRadio"></span></label>
                    <label class="containerRadio">Category III: 3,000+ square feet <input type="radio" name="houseSize" value="Large"><span class="checkmarkRadio"></span></label>
                    <input class ="button button1" type="Submit" value="Create House">
                </form>
            </fieldset>
        </fieldset> 



    </body> 
</html>
