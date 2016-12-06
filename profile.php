<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Profile</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="resources/mysite.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
	<?php
	include("config.php");
	session_start();
	$user_get = $_SESSION["login_user"];
	$searchTerm = '';
	$tmp = '';
	?>
	
	
	<nav class="navbar navbar-inverse">
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
	    </ul>
		<!--
		<div class = "search_cent">
		  <form name="searchBox" target="" method="post">
			<input type="text" class="search" value="<?php echo $searchTerm;?>" name="searchIt" id="searchIt" placeholder="Search..">
		  </form>
		</div>
		-->
	  </div>
	</nav>
	
  </head>
  
  
  </head>

  <body>
	<!--<div id="bodyBlock">-->
	<?php 
  
	// have we posted?
	$havePost = isset($_POST["deleteBtn"]);
  
	if ($havePost) {
		echo "hello";
		$tmp = $_POST["lblItemName"];
		echo $tmp;
		$sql = "DELETE FROM inventory WHERE item_id = '$tmp'";

		if (mysqli_query($db,$sql) === TRUE) { $message = "Record has been deleted succesfully";
			echo "<script type='text/javascript'>alert('$message');</script>"; } 
		else { echo "Error: " . $sql . "<br>" . $db->error; }
		
	}
	?>
	
	

    <div class="header">
      <h1>Profile</h1>
    </div>

    <div class="profile_item">

      <div class="header">
        <h2>Change Password</h2>
      </div>

      <form action="profile.php">
          <div class="subitem"><h3><label class="field">Current Email:</label></h3>
          <h4><?php echo $user_get;?></h4></div>

		  <div class="subitem"><h3><label class="field">Enter Old Password:</label></h3>
		  <input type="text" size="25" value=""/></div>

          <div class="subitem"><h3><label class="field">Enter New Password:</label></h3>
          <input type="text" size="25" value=""/></div>
		  </br>

          <input type="submit" value="Submit" id="save" name="save"/><br/>
      </form>
    </div>



    <div class="profile_item">

      <div class="header">
        <h2>Delete Items</h2>
      </div>
	  
	  <?php
	  $sql = "SELECT item_id, item_name, date_added FROM inventory WHERE inventory.username = '$user_get' ";
      $result = mysqli_query($db,$sql);
	  
	  
	  if ($result->num_rows > 0) {
			 // output data of each row
			 while($row = $result->fetch_assoc()) {

				  
				  
				 echo"<div class=\"user_items\">";
				 echo"<h3><u>Item Name</u>: ".$row["item_name"]."</h3>";
				 echo"<h3><u>Time Created</u>: ".$row["date_added"]."</h3>";
				 
				 ?>
				 
				 <form name="delete-item" method="POST" action="profile.php">
					 <input type="submit" value="DELETE" name="deleteBtn" style="color:black;float:right;"/>
					 <input type="hidden" name="lblItemName" value="<?php echo $row["item_id"]; ?>">
				 </form>
				 
				 <?php
				 echo"</br></div>";
				 
			}
		} else {
			 echo "You have 0 items created, go add a new item :D";
		}
	  
	  
	  ?>

    </div>
	<!--</div>-->

  </body>
</html>


