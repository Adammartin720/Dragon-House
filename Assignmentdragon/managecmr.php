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
		<title>Add User</title>
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
			
				if (isset($_POST['username']) && isset($_POST['password'])) {

					$username = $_POST['username'];
					$password = $_POST['password'];			
					
						
					// build query
					$sql = "INSERT into useradmin (username,password) VALUES ('" . $username . "','" . $password . "')";	
					
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
					$sql = "DELETE from dragoncustomer WHERE CustID = " . $_POST['select'];
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
  
		<?<h1>Add User</h1>
		
		<h2>Add New</h2>
		<div id="controls">
			<a href="adminmonthview.php">View Reservations</a>
		</div>	
		
		<form method="post" action="managecmr.php" id="addcmr" onsubmit="myFunction()">
			
			<div class="formrow">
				<label for="username">username: </label>
				<input type="text" name="username" required placeholder="username" class="nametext" />
			</div>
			<div class="formrow">
				<label for="password">password: </label>
				<input type="password" name="password" required placeholder="password" class="nametext" />
			</div>				
			<div class="buttonrow">
				<input type="submit" value="Add"/>
				<input type="reset" value="Clear" onclick="alert('Cleared textboxes');" />
			</div>
	
		</form>
		
		<script>
function myFunction() {
    alert("The form was submitted");
}
</script>
		
		<h2>Current Customers</h2>
		<form method="post" action="managecmr.php" id="selectcmr">
			<table id="cmrs">
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Password</th>
					<th>Phone</th>
					<th>Address</th>
					<th>Postcode</th>		
					<th>?</th>
				</tr>
		
			<?PHP

				
				// grab all current records
				$sql = "SELECT * from dragoncustomer ORDER BY CustID";
				$result = $conn->select($sql);

				if ($result->num_rows > 0) {
					// output data of each row
					foreach($result as $row) {
						echo "<tr>";
						echo "<td>" . $row['CustID'] . "</td><td>" . $row['ForeName']. " " . $row['SurName'] . "</td><td>" . $row['Email'] . "</td><td>" . $row['Password'] . "</td><td>" . $row['Phone'] . "</td><td>" . $row['Address'] . "</td><td>" . $row['Postcode'] . "</td>";
						echo "<td><input type='radio' name='select' value='" . $row['CustID'] . "'/></td>";
						echo "</tr>";
					}
				} else {
					echo "<tr><td colspan='6'>No results returned</td></tr>";
				}
				
			?>
	
			</table>
			<div class="buttonrow">
				<input type="submit" value="Delete record"/>
				<input type="reset" value=" Clear" onclick="alert('Unselected record');" />
			</div>
		</form>
		
		
	</body>
</html>
<?PHP
	$conn->close();
?>