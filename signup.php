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
    // Get the input and clean it.
    // First, let's get the input one param at a time.
    // Could also output escape with htmlentities()
	
    $loginUserName = htmlspecialchars(trim($_POST["loginUserName"]));  
    $loginUserPassword = htmlspecialchars(trim($_POST["loginUserPassword"]));
	  $loginUserPasswordVal = htmlspecialchars(trim($_POST["loginUserPasswordVal"]));
    
    // special handling for the date of birth
    //$dobTime = strtotime($dob); // parse the date of birth into a Unix timestamp (seconds since Jan 1, 1970)
    //$dateFormat = 'Y-m-d'; // the date format we expect, yyyy-mm-dd
    // Now convert the $dobTime into a date using the specfied format.
    // Does the outcome match the input the user supplied?  
    // The right side will evaluate true or false, and this will be assigned to $dobOk
    //$dobOk = (date($dateFormat, $dobTime) == $dob);  
    
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
		$servername = "localhost";
		$username = "root";
		$password = "localhost";
		$dbname = "iit";
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "INSERT INTO users (username, password)
		VALUES ('$loginUserName', '$loginUserPassword');";
		if ($conn->multi_query($sql) === TRUE) { $message = "New records created successfully";
			echo "<script type='text/javascript'>alert('$message');</script>"; } 
		else { echo "Error: " . $sql . "<br>" . $conn->error; }
		$conn->close();
		
		$loginUserName = '';  
		$loginUserPassword = '';
		$loginUserPasswordVal = '';
		
		?>
	  
	  
    <?php } 
  }
?>

<?php 
  // to include client-side validation to the form below, 
  // add the following parameter:
  // onsubmit="return validate(this);"
?>


<div class="header">
      <h2>Sign Up</h2>
    </div>

    <form id="loginForm" name="loginForm" method="post" action="login.php">
		<fieldset> 

		  <div class="middle">
			<h3><label class="field">Email (Use your RPI Email Address):</label></h3>
			<div class="value"><input type="text" size="25" value="<?php echo $loginUserName; ?>" name="loginUserName" id="loginUserName"/></div>

			<h3><label class="field">Password:</label></h3>
			<div class="value"><input type="password" size="25" value="<?php echo $loginUserPassword; ?>" name="loginUserPassword" id="loginUserPassword"/></div>

			<h3><label class="field">Confirm Password:</label></h3>
			<div class="value"><input type="password" size="25" value="<?php echo $loginUserPasswordVal; ?>" name="loginUserPasswordVal" id="loginUserPasswordVal"/></div>

			
			<input type="submit" value="save" id="save" name="save"/>
		
		  </div>
	   </fieldset> 
    </form>
  </body>
</html>