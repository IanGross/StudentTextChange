<!DOCTYPE html>
<html>
  <head>
    <title>Forms with PHP - ITWS</title> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
    <script type="text/javascript" src="resources/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="resources/iit.js"></script>   
    <link href="resources/ii.css" rel="stylesheet" type="text/css"/>
	<!--<link href="http://localhost/iitforms/resources/mysite.css" rel="stylesheet" type="text/css"/>-->
	<link href="resources/mysite.css" rel="stylesheet" type="text/css"/>
  </head>
  <body>
	<div class="header">
      <h1>Student Text-Change</h1>
    </div>



<?php
   include("config.php");
   session_start();
   
   $havePost2 = isset($_POST["login"]);
   
   if($_SERVER["REQUEST_METHOD"] == "POST" && $havePost2) {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['userName']);
      $mypassword = mysqli_real_escape_string($db,$_POST['passWord']); 
      
      $sql = "SELECT username FROM users WHERE users.username = '$myusername' and users.password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row[0]['username'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         //session_register("myusername");

         //$_SESSION['login_user'] = $row[0]['username'];
		 $_SESSION["login_user"] = $myusername;
         
         header("location: inventory.php");
      }else {
         $error = "Your Login Name or Password is invalid";
		 echo $error;
      }
   }
?>
	<div class="header">
      <h2>Log In</h2>
    </div>
	
	<form id="userloginForm" name="userloginForm" method="post" action="">
		<fieldset> 

		  <div class="middle">
			<h3><label class="field">Email (Use your RPI Email Address):</label></h3>
			<div class="value"><input type="text" size="25" name="userName" class = "box"/></div>
			<!-- value="<?php/* echo $userName;*/ ?>" -->
			<h3><label class="field">Password:</label></h3>
			<div class="value"><input type="password" size="25" name="passWord" class = "box"/></div>
			<!-- value="<?php/* echo $userName;*/ ?>" -->
			
			<input type="submit" value="login" id="login" name="login"/>
		
		  </div>
	   </fieldset> 
    </form>
  </body>
</html>
