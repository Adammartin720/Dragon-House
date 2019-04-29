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
<title>Add Customer</title>	 

		<?PHP
		
			//open a DB connection
			$conn = new dbconnect();
			
			// Check connection is working
			if ($conn->connect() === true) {			
			
				if (isset($_POST['ForeName']) && isset($_POST['SurName']) && isset($_POST['Email']) && isset($_POST['Password']) && isset($_POST['Phone']) && isset($_POST['Address']) && isset($_POST['Postcode'])) {
					
					
					$forename = $_POST['ForeName'];
					$surname = $_POST['SurName'];			
					$email = $_POST['Email'];
					$password = $_POST['Password'];
					$phone = $_POST['Phone'];
					$address = $_POST['Address'];
					$postcode = $_POST['Postcode'];
					
						
					// build query
					$sql = "INSERT into dragoncustomer (ForeName,SurName,Email,Password,Phone,Address,Postcode) VALUES ('" . $forename . "','" . $surname . "','" . $email . "','" . $password . "','" . $phone . "','" . $address . "','" . $postcode . "')";	
					
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
					$sql = "DELETE from dragoncustomer WHERE id = " . $_POST['select'];
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
        <li><a href="rooms.php">ROOMS</a></li>
        <li> <a href="adminindex.php">LOGIN Admin</a></li>
		<li> <a href="custindex.php">LOGIN Customer</a></li>
        <li> <a href="registration.php">REGISTER</a></li>
      </ul>
	  </a>
	  </nav>
  </header>
  
		<?<h1>Add Customer</h1>
		<h2>Registration</h2>
		<div id="controls">
		</div>	
		
		<form method="post" action="registration.php" id="addcmr" onsubmit="myFunction()">
			
			<div class="formrow">
				<label for="ForeName">First Name: </label>
				<input type="text" name="ForeName" required placeholder="First Name" class="nametext" />
			</div>
			<div class="formrow">
				<label for="SurName">Last Name: </label>
				<input type="text" name="SurName" required placeholder="Last Name" class="nametext" />
			</div>		
			<div class="formrow">
				<label for="Email">Email: </label>
				<input type="email" name="Email" required placeholder="Email" class="nametext" />
			</div>
			<div class="formrow">
				<label for="Password">Password: </label>
				<input type="password" name="Password" required placeholder="Password" class="nametext" />
			</div>
			<div class="formrow">
				<label for="Phone">Phone: </label>
				<input type="text" name="Phone" required placeholder="Telephone Number" class="nametext" />
			</div>
			<div class="formrow">
				<label for="Address">Address: </label>
				<textarea name="Address" required placeholder="Address"></textarea>
			</div>	
			<div class="formrow">
				<label for="Postcode">Postcode: </label>
				<input type="text" name="Postcode" required placeholder="Postcode" class="nametext" />
			</div>			
			<div class="buttonrow">
				<input type="submit" value="Add"/>
				<input type="reset" value="Clear" onclick="alert('Text Boxes Clear');" />
			</div>
			</form>
<script>
function myFunction() {
    alert("The form was submitted");
}
			</body>
</html>
<?PHP
	$conn->close();
?>