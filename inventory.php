<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Inventory</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="resources/mysite.css" rel="stylesheet" type="text/css"/>
  </head>

  <body>
    <div class="upperleft">
      <form action="newItem.php">
        <button type="submit">Add New Item</button>
      </form>
    </div>


    <div class="upperright">
      <form action="profile.php">
        <button type="submit">Profile</button>
      </form>
    </div>

    <div class="header">
      <h1>Inventory</h1>
    </div>
	
	<?php $searchTerm = ''; ?>
	
	<div class = "search_cent">
	  <form name="searchBox" target="" method="post">
        <input type="text" class="search" value="<?php echo $searchTerm;?>" name="searchIt" id="searchIt" placeholder="Search..">
	  </form>
	</div>
	
	<!--
	<div class="parent">
    <div class="row">
      <div class="col1">1</div>
      <div class="col2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam lectus. Sed sit amet ipsum mauris. Maecenas congue ligula ac quam viverra nec consectetur ante hendrerit.</div>
    </div>
    <div class="row">
      <div class="col1">2</div>
      <div class="col2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam lectus. Sed sit amet ipsum mauris. Maecenas congue ligula ac quam viverra nec consectetur ante hendrerit.</div>
    </div>
</div>
-->
	
	

    <fieldset>
      <div class="middle">
		
		
		<?php
		//session_start();
		$money_symbol="$";
		
		include("config.php");
		session_start();
		
		//$sql = "SELECT item_name, item_condition, description, price, category, contact_info FROM inventory";
		$sql = "SELECT item_name, item_condition, description, price, category, contact_info FROM inventory";
		//WHERE item_name LIKE '%at%'";
		//$result = $conn->query($sql);
		
		
		$havePost = isset($_POST["searchIt"]);
  
		if ($havePost) {
			$searchTerm = htmlspecialchars(trim($_POST["searchIt"]));
			unset($sql);
			$searchTermBits = array("item_name LIKE '%$searchTerm%'", "description LIKE '%$searchTerm%'", 
			"item_condition LIKE '%$searchTerm%'");
			//$searchTermBits[] = "item_name LIKE '%$searchTerm%'", "description LIKE '%$searchTerm%'";
			$sql = "SELECT item_name, item_condition, description, price, category, contact_info FROM inventory
			WHERE " .implode(' OR ', $searchTermBits);
			//WHERE item_name LIKE '%\'$searchTerm\'%'";	
		}
		
		$result = mysqli_query($db,$sql);
		
		if ($havePost) {echo "Search Term: \"$searchTerm\" yielded $result->num_rows result(s)";}
		

		if ($result->num_rows > 0) {
			 // output data of each row
			 while($row = $result->fetch_assoc()) {
				 ?> <div class = inventory_item> <?php
				 echo"<br><div class=\"title\"><h2>".$row["item_name"]."</h2></div>";
				 //echo "<br> Item Name: ". $row["item_name"]. " - Condition: ". $row["item_condition"]. " - Description" . $row["description"] . "<br>";
				 
				 //echo"<div class=\"subitem\"><h3><label class=\"subitem_title\">Asking Price:</label></h3>";
				 //echo"<h4>$money_symbol". $row["price"]."</h4></div>";
				 /*
				 echo"<h3><label class=\"subitem_title\">Condition: </label></h3>";
				 echo"<div class=\"subitem_text\"><h4>". $row["item_condition"]."</h4></div>";
				 
				 echo"<h3><label class=\"subitem_title\">Description: </label></h3>";
				 echo"<div class=\"subitem_text\"><h4>". $row["description"]."</h4></div>";
				 
				 echo"<h3><label class=\"subitem_title\">Contact Info: </label></h3>";
				 echo"<div class=\"subitem_text\"><h4>". $row["contact_info"]."</h4></div><br>";
				 */
				 
				 echo"<div class=\"subitem\">";
				 echo"<h3><label><u>Asking Price</u>: &nbsp;&nbsp;&nbsp;&nbsp;</label>";
				 echo"$money_symbol". $row["price"]."</h3>";
				 echo"</div>";
				 
				 echo"<div class=\"subitem\"><h3><label><u>Condition</u>: &nbsp;&nbsp;&nbsp;&nbsp;</label>";
				 echo $row["item_condition"]."</h3></div>";
				 
				 echo"<div class=\"subitem\"><h3><label><u>Description</u>: &nbsp;&nbsp;&nbsp;&nbsp;</label>";
				 echo $row["description"]."</h3></div>";
				 
				 echo"<div class=\"subitem\"><h3><label><u>Contact Info</u>: &nbsp;&nbsp;&nbsp;&nbsp;</label>";
				 echo $row["contact_info"]."</h3></div>";
				 
				 /*
				 echo"<h3><label class=\"subitem_title\">Condition: </label></h3>";
				 echo"<div class=\"subitem_text\"><h4>". $row["item_condition"]."</h4></div>";
				 
				 echo"<h3><label class=\"subitem_title\">Description: </label></h3>";
				 echo"<div class=\"subitem_text\"><h4>". $row["description"]."</h4></div>";
				 
				 echo"<h3><label class=\"subitem_title\">Contact Info: </label></h3>";
				 echo"<div class=\"subitem_text\"><h4>". $row["contact_info"]."</h4></div><br>";
				 */
				 ?> </div><?php
			}
		} else {
			 echo "0 results";
		}
		?>  
      </div>
    </fieldset>
  </body>
</html>

