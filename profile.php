<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Profile</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="resources/mysite.css" rel="stylesheet" type="text/css"/>
  </head>

  <body>
	<!--<div id="bodyBlock">-->
    <div class="upperleft">
      <form action="inventory.php">
        <button type="submit">Back</button>
      </form>
    </div>

    <div class="header">
      <h1>Profile</h1>
    </div>

    <div class="left">

      <div class="header">
        <h2>Change Password</h2>
      </div>

      <form action="profile.php">



          <h3><label class="field">Email:</label></h3>
          <div class="Email"><h4>Place Holder</h4></div>

          <h3><label class="field">Enter Old Password:</label></h3>
          <div class="value"><input type="text" size="25" value=""/></div>

          <h3><label class="field">Enter New Password:</label></h3>
          <div class="value"><input type="text" size="25" value=""/></div>

          <button type="submit">Save</button>



      </form>
    </div>



    <div class="right">

      <div class="header">
        <h2>Delete Items</h2>
      </div>
	  
	  <?php
	  include("config.php");
	  session_start();
	  
	  $user_get = $_SESSION["login_user"];
	  $sql = "SELECT item_name, date_added FROM inventory WHERE inventory.username = '$user_get' ";
      $result = mysqli_query($db,$sql);
	  
	  
	  if ($result->num_rows > 0) {
			 // output data of each row
			 while($row = $result->fetch_assoc()) {
				 ?>
				 <div class="right_item">
				 
				 <?php
				 //echo '<div class=\"userItem_single\">';
				 echo"<h3><u>Item Name</u>: ".$row["item_name"]."</h3>";
				 echo"<h3><u>Time Created</u>: ".$row["date_added"]."</h3>";
				 //echo '</div><br>';
				 ?>
				 </div>
				 
				 <?php
			}
		} else {
			 echo "You have 0 items created, go add a new item :D";
		}
	  
	  
	  ?>
		<!--
        <form action="inventory.html">

          <h3><label class="field">Text Book Title</label></h3>
          <button type="submit">Delete</button>

        </form>
		-->

    </div>
	<!--</div>-->

  </body>
</html>


