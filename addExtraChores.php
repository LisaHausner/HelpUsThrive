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
        <title>Questionnaire: Additional Chores </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/newcss.css">
    </head>
    <body>
<div class="logout">
    <h4><strong>Thriving <?php echo $_SESSION['houseName']; ?></strong></h4><br>
    	<a class ="logoutbutton" href="index.php?logout='1'">Logout</a></div>
        <fieldset>
            <h1>Help Me Thrive! Questionnaire </h1>
            <h2>Selecting Additional Chores </h2>  
        <p>This is the final set of questions. Please answer the following questions about what additional chores you would like to add to your list then submit the form to review your chore assignment list.</p>
        <fieldset>
        <form action="insertExtraChores.php" method="post">                                        
                    <p>If you would like these additional chore types to be added to your chore list, please select the check box.</p>
                    <label class="container">Seasonal Chores?<input type="checkbox" name="Seasonally" value="Seasonally"><span class="checkmark"></span></label>
                    <label class="container">Outside Chores?<input type="checkbox" name="Outside" value="Outside"><span class="checkmark"></span></label>
                    <p>Do you have any of the following Pets?</p>
                    <label class="container">Dog<input type="checkbox" name="Dog" value="Dog"><span class="checkmark"></span></label>
                    <label class="container">Cat<input type="checkbox" name="Cat" value="Cat"><span class="checkmark"></span></label>
                    <label class="container">Fish<input type="checkbox" name="Fish" value="Fish"><span class="checkmark"></span></label>
                    <label class="container">Rabbit<input type="checkbox" name="Rabbit" value="Rabbit"><span class="checkmark"></span></label>
                    <input class="button" type="Submit">                
        </form>
        </fieldset>
        </fieldset>
        <fieldset>
            <form action="questionnaireComplete.php" method="post">
                <p class ="center">When you are finished with the questionnaire please click below.</p>
            <input class ="button" style="width:100%" type="Submit" value="Questionnaire Complete">
            </form>
        </fieldset>
        <a class ="button button2" href ="addFamily.php">Add Family Member</a>
        <a class ="button button2" href="addRoom.php">Add a Room</a>
        
        
        
        
    </body>
</html>