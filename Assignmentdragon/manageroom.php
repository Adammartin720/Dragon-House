<?PHP 
	// init autoload register for new classes
	spl_autoload_register(function ($class_name) {
		include $class_name . '.php';
	});
?>
<?DOCTYPE html>
<html>
	<head>
	<link href="css/dragonhouse.css" rel="stylesheet" type="text/css">

	<script>var __adobewebfontsappname__="dreamweaver"</script>
<script src="http://use.edgefonts.net/source-sans-pro:n2:default.js" type="text/javascript"></script>
		<title>Add Room</title>
		<style type="text/css">
			#cmrs {
				width: 100%;
			}
			
			#cmrs th, td {
				border: 1px solid #555555;
			}
		
		</style>
		<?PHP
			//open a DB connection
			$conn = new dbconnect();
			
			// Check connection is working
			if ($conn->connect() === true) {			
			
				if (isset($_POST['description']) && isset($_POST['roomtype']) && isset($_POST['price'])){

					$description = $_POST['description'];
					$roomtype = $_POST['roomtype'];		
					$price = $_POST['price'];	
					
					// build query
					$sql = "INSERT into dragonroom (description,roomtype,price) VALUES ('" . $description . "','" . $roomtype . "','" . $price . "')";	
					
					//run query
					if ($conn->update($sql) === TRUE) {
						echo "<p class='msg'>New record created successfully</p>";
					} else {
						echo $conn->err;
					}

				}
				// check for row delete
				elseif (isset($_POST['select'])) {
					//  this needs a sanity check but won't get one at the mo
					$sql = "DELETE from dragonroom WHERE roomid = " . $_POST['select'];
					$conn->drop($sql);
				}
			}
			else {
				echo $conn->err;
			}
		?>
	</head>
	<body>
	
	<div class="container"> 
  <!-- Header -->
  <header> <a href="index.html"> 
    <h4 class="logo">DragonHouse</h4>
   
    <nav>
      <ul>
        <li><a href="index.html">HOME</a></li>
        <li><a href="managecmr.php">CUSTOMER</a></li>
        <li> <a href="manageroom.php">ROOM</a></li>
        <li> <a href="adminmonthview.php">RESERVATIONS</a></li>
      </ul>
	  </a>
	  </nav>
  </header>
  
		<?<h1>Add Room</h1>
		
		<h2>Add New</h2>
		<div id="controls">
		</div>	
		
		<form method="post" action="manageroom.php" id="addroom" onsubmit="myFunction()">
			
			<div class="formrow">
				<label for="description">description: </label>
				<input type="text" name="description" required placeholder="description" class="nametext" />
			</div>
			<div class="formrow">
				<label for="roomtype">roomtype: </label>
				<input type="text" name="roomtype" required placeholder="roomtype" class="nametext" />
			</div>		
			<div class="formrow">
				<label for="price">price: </label>
				<input type="text" name="price" required placeholder="price" class="nametext" />
			</div>					
			<div class="buttonrow">
				<input type="submit" value="Add"/>
				<input type="reset" value="Clear" onclick="alert('Clear textboxes');" />
			</div>
		
		</form>

		<script>
function myFunction() {
    alert("The form was submitted");
}
	</script>	
	
		<h2>Current Rooms</h2>
		<form method="post" action="manageroom.php" id="selectroom">
			<table id="room">
				<tr>
					<th>ID</th>
					<th>description</th>
					<th>roomtype</th>
					<th>price</th>
					<th>?</th>
				</tr>
		
			<?PHP

				
				// grab all current records
				$sql = "SELECT * from dragonroom ORDER BY roomid";
				$result = $conn->select($sql);

				if ($result->num_rows > 0) {
					// output data of each row
					foreach($result as $row) {
						echo "<tr>";
						echo "<td>" . $row['roomid'] . "</td><td>" . $row['description']. "</td><td>" . $row['roomtype'] . "</td><td>" . $row['price'] . "</td>";
						echo "<td><input type='radio' name='select' value='" . $row['roomid'] . "'/></td>";
						echo "</tr>";
					}
				} else {
					echo "<tr><td colspan='6'>No results returned</td></tr>";
				}
				
			?>
	
			</table>
			<div class="buttonrow">
				<input type="submit" value="Delete record"/>
				<input type="reset" value="Clear" onclick="alert('Unselect room record');" />
			</div>
		</form>
		
	</body>
</html>
<?PHP
	$conn->close();
?>