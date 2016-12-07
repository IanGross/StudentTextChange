<!DOCTYPE html>
<html>
  <head>
    <title>Forms with PHP - ITWS</title> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
    <script type="text/javascript" src="resources/jquery-1.4.3.min.js"></script>
	<script type="text/javascript" src="resources/iit.js"></script>   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="resources/mysite.css" rel="stylesheet" type="text/css"/>
	
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">Student TextChange</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="welcome.html">Home</a></li>
	      <li><a href="login.php">Log in</a></li>
	      <li><a href="signup.php">Sign Up</a></li>
	    </ul>
	  </div>
	</nav>
	<div class="container">
	</div>
	
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
	<div class="middle_items">
		<form id="userloginForm" name="userloginForm" method="post" action="">
			<fieldset> 
				<h3><label class="form_desc" style="text-align:right;">Email (Use your RPI Email Address):</label></h3>
				<div class="value"><input type="text" size="25" name="userName" class = "box" style="color:black;float:center;white-space:nowrap;"/></div>
				<!-- value="<?php/* echo $userName;*/ ?>" -->
				<h3><label class="form_desc" style="text-align:right;">Password:</label></h3>
				<div class="value"><input type="password" size="25" name="passWord" class = "box" style="color:black;float:center;"/></div>
				<!-- value="<?php/* echo $userName;*/ ?>" -->
				
				<input type="submit" value="login" id="login" name="login" style="color:black;float:right;"/>
		   </fieldset> 
		</form>
	</div>
  </body>
</html>
