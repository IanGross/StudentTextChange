<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Inventory</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="resources/mysite.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	
	
	<?php
	include("config.php");
	session_start();
	$user_get = $_SESSION["login_user"];
	$searchTerm = '';
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
		<div class = "search_cent">
		  <form name="searchBox" target="" method="post">
			<input type="text" class="search" value="<?php echo $searchTerm;?>" name="searchIt" id="searchIt" placeholder="Search..">
		  </form>
		</div>
	  </div>
	</nav>
	<br><br><br>
	
  </head>
  <body>
    <div class="header">
      <h1><b>Inventory</b></h1>
    </div>
	<br>
    <fieldset>
      <div class="middle">
		<?php
		$money_symbol="$";
		$sql = "SELECT item_name, item_condition, description, price, category, contact_info FROM inventory ORDER BY date_added DESC";
		$havePost = isset($_POST["searchIt"]);
  
		if ($havePost) {
			$searchTerm = htmlspecialchars(trim($_POST["searchIt"]));
			unset($sql);
			$searchTermBits = array("item_name LIKE '%$searchTerm%'", "description LIKE '%$searchTerm%'", "item_condition LIKE '%$searchTerm%'");
			$sql = "SELECT item_name, item_condition, description, price, category, contact_info FROM inventory
			WHERE " .implode(' OR ', $searchTermBits). " ORDER BY date_added DESC";	
		}
		
		$result = mysqli_query($db,$sql);
		
		if ($havePost) {echo "Search Term: \"$searchTerm\" yielded $result->num_rows result(s)";}
		

		if ($result->num_rows > 0) {
			 // output data of each row
			 while($row = $result->fetch_assoc()) {
				 ?> <div class = inventory_item> <?php
				 echo"<br><div class=\"title\"><h2>".$row["item_name"]."</h2></div>";
				 
				 echo"<div class=\"subitem\"><h3><label><u>Category</u>: &nbsp;&nbsp;&nbsp;&nbsp;</label><font color=\"black\"> ";
				 echo $row["category"]."</font></h3></div>";
				 
				 echo"<div class=\"subitem\">";
				 echo"<h3><label><u>Asking Price</u>: &nbsp;&nbsp;&nbsp;&nbsp;</label><font color=\"black\"> ";
				 echo"$money_symbol". $row["price"]."</font></h3>";
				 echo"</div>";
				 
				 echo"<div class=\"subitem\"><h3><label><u>Condition</u>: &nbsp;&nbsp;&nbsp;&nbsp;</label><font color=\"black\">";
				 echo $row["item_condition"]."</font></h3></div>";
				 
				 echo"<div class=\"subitem\"><h3><label><u>Description</u>: &nbsp;&nbsp;&nbsp;&nbsp;</label><font color=\"black\">";
				 echo $row["description"]."</font></h3></div>";
				 
				 echo"<div class=\"subitem\"><h3><label><u>Contact Info</u>: &nbsp;&nbsp;&nbsp;&nbsp;</label><font color=\"black\">";
				 echo $row["contact_info"]."</font></h3></div>";

				 ?> </div><?php
				 echo "</br>";
			}
		} else {
			 echo "0 results";
		}
		?>  
      </div>
    </fieldset>
  </body>
</html>

