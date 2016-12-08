<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Add New Item</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="resources/mysite.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	
	
	
	<?php
	include("config.php");
	session_start();
	$user_get = $_SESSION["login_user"];
	?>
	
	<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="inventory.php">Student TextChange</a>
	    </div>
	    <ul class="nav navbar-nav navbar-left">
	      <li><a href="newItem.php">Add New Item</a></li>
	      <li><a href="profile.php">Profile</a></li>
	    </ul>
		<ul class="nav navbar-nav navbar-right">
	      <li><a href="profile.php">Logged in as <?php echo $user_get;?></a></li>
		  <li><a class="btn btn-danger" href="welcome.html" onclick="alert('You have successfully Logged out')"><font color="white">Logout</font></a></li>
	    </ul>
	  </div>
	</nav>
	<br><br><br>
  </head>
  <body>
	<div id="bodyBlock">
    <div class="header">
      <h1>Add New Item</h1>
    </div>
	<?php
	//variables to hold all the data
		$itemName = '';
		$priceReq = '';
		$conditionInput = '';
		$descriptionInput = '';
		$categoryInput = '';
		$nameInput = '';
		$contactInput = '';
	?>
	
	<?php 
	$havePost = isset($_POST["save"]);
	if ($havePost) {
		$itemName = (string)htmlspecialchars(trim($_POST["itemName"]));
		$priceReq = htmlspecialchars(trim($_POST["priceReq"]));
		$conditionInput = (string)htmlspecialchars(trim($_POST["conditionInput"]));
		$descriptionInput = (string)htmlspecialchars(trim($_POST["descriptionInput"]));
		$categoryInput = (string)htmlspecialchars(trim($_POST["categoryInput"]));
		$nameInput = (string)htmlspecialchars(trim($_POST["nameInput"]));
		$contactInput = (string)htmlspecialchars(trim($_POST["contactInput"]));
		
		$sql = "INSERT INTO inventory (item_name, item_condition, description, price, category, contact_info, full_name, username, date_added) 
		VALUES ('$itemName', '$conditionInput', '$descriptionInput', '$priceReq', '$categoryInput', '$contactInput', '$nameInput', '$user_get', CURRENT_TIMESTAMP)";
		
		if (mysqli_query($db,$sql) === TRUE) { $message = "New records created successfully";
			echo "<script type='text/javascript'>alert('$message');</script>"; } 
		else { echo "Error: " . $sql . "<br>" . $db->error; }
		
		$itemName = '';
		$priceReq = '';
		$conditionInput = '';
		$descriptionInput = '';
		$categoryInput = '';
		$nameInput = '';
		$contactInput = '';
	}
	?>
	
	<form id="postNewItem" name="postNewItem" method="post" action="newItem.php">
      <div class="middle_items">
        <h3><label class="field" style="text-align:right;">Item Name:</label></h3>
        <div class="value"><input type="text" size="25" value="<?php echo $itemName;?>" name="itemName" id="itemName" style="color:black;float:center;" required/></div>

        <h3><label class="field" style="text-align:right;">Asking Price:</label></h3>
        <div class="value"><input type="text" size="25" value="<?php echo $priceReq;?>" name="priceReq" id="priceReq" style="color:black;float:center;" required/></div>
		
		<h3><label class="field" style="text-align:right;">Condition:</label></h3>
		<select class="selected" value="<?php echo $conditionInput;?>" name="conditionInput" id="conditionInput" style="color:black;float:center;" required>
			<option value="" selected>None Selected...</option>
			<option value="Brand New">Brand New</option>
			<option value="Like New">Like New</option>
			<option value="Very Good">Very Good</option>
			<option value="Good">Good</option>
			<option value="Acceptable">Acceptable</option>
			<option value="poor">Poor</option>
		</select>
		

        <h3><label class="field" style="text-align:right;">Description:</label></h3>
        <div class="value"><input type="text" size="25" value="<?php echo $descriptionInput;?>" name="descriptionInput" id="descriptionInput" style="color:black;float:center;" required/></div>
		
		
		<h3><label class="field" style="text-align:right;">Category:</label></h3>
		<select class="selected" value="<?php echo $categoryInput;?>" name="categoryInput" id="categoryInput" style="color:black;float:center;" required>
			<option value="" selected>None Selected...</option>
			<option value="Electronics">Electronics</option>
			<option value="Notes">Notes</option>
			<option value="Textbook">Textbook</option>
			<option value="School Supplies">School Supplies</option>
			<option value="Other">Other</option>
		</select>


        <h3><label class="field" style="text-align:right;">Your Name:</label></h3>
        <div class="value"><input type="text" size="25" "<?php echo $nameInput;?>" name="nameInput" id="nameInput" style="color:black;float:center;" required/></div>

        <h3><label class="field" style="text-align:right;">Contact Information:</label></h3>
        <div class="value"><input type="text" size="25" value="<?php echo $contactInput;?>" name="contactInput" id="contactInput" style="color:black;float:center;" required/></div>

        <br/>

		<input type="submit" value="Submit" id="save" name="save" style="color:black;"/>
		<br/>

      </div>

    </form>
	</div>

  </body>
</html>


