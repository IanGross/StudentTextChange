<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Inventory</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="resources/mysite.css" rel="stylesheet" type="text/css"/>
  </head>

  <body>
    <div class="upperleft">
      <form action="newItem.html">
        <button type="submit">Add New Item</button>
      </form>
    </div>


    <div class="upperright">
      <form action="profile.html">
        <button type="submit">Profile</button>
      </form>
    </div>

    <div class="header">
      <h1>Inventory</h1>
    </div>
	
	<div class = "search_cent">
	  <form>
        <input type="text" class="search" placeholder="Search..">
	  </form>
	</div>


    <fieldset>
      <div class="middle">
		
		
		<?php
		$servername = "localhost";
		$username = "root";
		$password = "localhost";
		$dbname = "iit";
		$money_symbol="$";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			 die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT item_name, item_condition, description, price, category, contact_info FROM inventory";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			 // output data of each row
			 while($row = $result->fetch_assoc()) {
				 echo"<br><div class=\"title\"><h2>".$row["item_name"]."</h2></div>";
				 //echo "<br> Item Name: ". $row["item_name"]. " - Condition: ". $row["item_condition"]. " - Description" . $row["description"] . "<br>";
				 
				 echo"<h3><label class=\"subitem_title\">Asking Price:</label></h3>";
				 echo"<div class=\"subitem\"><h4>$money_symbol". $row["price"]."</h4></div>";
				 
				 echo"<h3><label class=\"subitem_title\">Condition: </label></h3>";
				 echo"<div class=\"subitem\"><h4>". $row["item_condition"]."</h4></div>";
				 
				 echo"<h3><label class=\"subitem_title\">Description: </label></h3>";
				 echo"<div class=\"subitem\"><h4>". $row["description"]."</h4></div>";
				 
				 echo"<h3><label class=\"subitem_title\">Contact Info: </label></h3>";
				 echo"<div class=\"subitem\"><h4>". $row["contact_info"]."</h4></div><br>";
			}
		} else {
			 echo "0 results";
		}
		
		/*
		        <div class="title"><h2>Place Holder</h2></div>

        <h3><label class="field">Asking Price:</label></h3>
        <div class="askingPrice"><h4>Place Holder</h4></div>

        <h3><label class="field">Condition:</label></h3>
        <div class="condition"><h4>Place Holder</h4></div>

        <h3><label class="field">Description:</label></h3>
        <div class="description"><h4>Place Holder</h4></div>

        <h3><label class="field">Category:</label></h3>
        <div class="category"><h4>Place Holder</h4></div>

        <h3><label class="field">Contact Info:</label></h3>
        <div class="contact Info"><h4>Place Holder</h4></div>
		*/

		$conn->close();
		?>  



      </div>

    </fieldset>

  </body>
</html>




