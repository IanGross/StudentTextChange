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
	
  </head>
  <body>
	<div class="header">
      <h1>Student Text-Change</h1>
    </div>
	
<?php 
  /* some very basic form processing */
  
  // variables to hold our form values:
  $loginUserName = '';  
  $loginUserPassword = '';
  $loginUserPasswordVal = '';
  // hold any error messages
  $errors = ''; 
  
  // have we posted?
  $havePost = isset($_POST["save"]);
  
  if ($havePost) {
	  
   include("config.php");
   session_start();
    // Get the input and clean it.
    // First, let's get the input one param at a time.
    // Could also output escape with htmlentities()
	
    $loginUserName = htmlspecialchars(trim($_POST["loginUserName"]));  
    $loginUserPassword = htmlspecialchars(trim($_POST["loginUserPassword"]));
	$loginUserPasswordVal = htmlspecialchars(trim($_POST["loginUserPasswordVal"])); 
    
    // Let's do some basic validation
    $focusId = ''; // trap the first field that needs updating, better would be to save errors in an array
    
    if ($loginUserName == '') {
      $errors .= '<li>First name may not be blank</li>';
      if ($focusId == '') $focusId = '#loginUserName';
    }
    if ($loginUserPassword == '') {
      $errors .= '<li>Last name may not be blank</li>';
      if ($focusId == '') $focusId = '#loginUserPassword';
    }
    if ($loginUserPasswordVal == '') {
      $errors .= '<li>Matching Password may not be blank</li>';
      if ($focusId == '') $focusId = '#loginUserPasswordVal';
    }
	if ($loginUserPassword != $loginUserPasswordVal) {
      $errors .= '<li>Passwords must be matching</li>';
      if ($focusId == '') $focusId = '#loginUserPasswordVal';
    }
  
    if ($errors != '') { ?>
      <div id="messages">
        <h4>Please correct the following errors:</h4>
        <ul>
          <?php echo $errors; ?>
        </ul>
        <script type="text/javascript">
          $(document).ready(function() {
            $("<?php echo $focusId ?>").focus();
          });
        </script>
      </div>
    <?php } else { ?>
	  
	  <?php
		$sql = "INSERT INTO users (username, password) VALUES ('$loginUserName', '$loginUserPassword');";
		if (mysqli_query($db,$sql) === TRUE) { $message = "User Credentials stored successfully";
			echo "<script type='text/javascript'>alert('$message');</script>"; } 
		else { echo "Error: " . $sql . "<br>" . $db->error; }
		
		$loginUserName = '';  
		$loginUserPassword = '';
		$loginUserPasswordVal = '';
		
		?>
    <?php } 
  }
?>


	<div class="header">
      <h2>Sign Up</h2>
    </div>

    <form id="loginForm" name="loginForm" method="post" action="signup.php">
		<fieldset> 

		  <div class="middle_items">
			<h3><label class="form_desc" style="text-align:right;">Email (Use your RPI Email Address):</label></h3>
			<div class="value"><input type="text" size="25" value="<?php echo $loginUserName; ?>" style="color:black;float:center;" name="loginUserName" id="loginUserName"/></div>

			<h3><label class="form_desc" style="text-align:right;">Password:</label></h3>
			<div class="value"><input type="password" size="25" value="<?php echo $loginUserPassword; ?>" style="color:black;float:center;" name="loginUserPassword" id="loginUserPassword"/></div>

			<h3><label class="form_desc" style="text-align:right;">Confirm Password:</label></h3>
			<div class="value"><input type="password" size="25" value="<?php echo $loginUserPasswordVal; ?>" style="color:black;float:center;" name="loginUserPasswordVal" id="loginUserPasswordVal"/></div>

			
			<input type="submit" value="Save" id="save" name="save" style="color:black;float:right;"/>
			</br>
		
		  </div>
	   </fieldset> 
    </form>
  </body>
</html>
