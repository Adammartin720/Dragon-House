<?PHP 
	// init autoload register for new classes
	spl_autoload_register(function ($class_name) {
		include $class_name . '.php';
	});
?>
<?DOCTYPE html>
<link href="css/dragonhouse.css" rel="stylesheet" type="text/css">
<script>var __adobewebfontsappname__="dreamweaver"</script>
<script src="http://use.edgefonts.net/source-sans-pro:n2:default.js" type="text/javascript"></script>
<?PHP
	// grab day/month/year from GET, if not present use today as default.
	if (isset($_GET['month'])) $month = $_GET['month'];
	else $month = date("n");
	if (isset($_GET['year'])) $year = $_GET['year'];
	else $year = date("Y");	
	if (isset($_GET['day'])) $day = $_GET['day'];
	else $day = date("j") + 0;	
	
	// get a timestamp object from the supplied year / month
	// this will allow us access to information about that date without having to work it out.
	$tstamp = mktime(12,0,0,$month,$day,$year);
	$url = "custres.php?day=" . $day . "&month=" . $month . "&year=" . $year;
	
	// get a new DB connect object
	$conn = new dbconnect();
	
	// This next section is the add/remove code for each slot
	// ======================================================
	$console = "";
	
	if (isset($_POST['slot'])) {
		if ($conn->connect() === true) {
			
			// get a timestamp for this slot
			$slottimestamp = mktime($_POST['slot'],0,0,$month,$day,$year);
			
			// deal with add to slot first (even though it is a select we still check for cmr 
			// as there may not be any cmr records and the button may have been pressed by accident)
			if (isset($_POST['add']) && isset($_POST['cmr'])) {
				
				// check to see if a record already exists in this slot
				
				// go ahead and add new record
				$sql = "INSERT into dragonappointments (cmr,datetime) VALUES ('" . $_POST['cmr'] . "','" . $slottimestamp . "')";

				if ($conn->update($sql) === TRUE) {
					$console.= "<p class='msg'>New record created successfully</p>";
				} else {
					$console.= "<p>" . $conn->err ."</p>";
				}

			}
			elseif (isset($_POST['clear'])) {
				//  this needs a sanity check but won't get one at the mo
				$slottimestamp = mktime($_POST['slot'],0,0,$month,$day,$year);
				$sql = "DELETE from dragonappointments WHERE datetime = " . $slottimestamp;
				$conn->drop($sql);
				$console.= "<p>Record removed</p>";
			}
			// close db connection
			$conn->close();
		}
		else {
			$console.= "<p>" . $conn->err ."</p>";
		}
	}	
?>
<html>
	<head>
		<title><?PHP echo $day . ' ' . date("S",$tstamp) . ' ' . date("F",$tstamp) . ' ' . $year; ?></title>
		<style type="text/css">
			#custdayview {
				width: 100%;
			}			
			#custdayview th, td {
				border: 1px solid #555555;
				height: 30px;
			}
			td.deadspace {
				background: #CCCCCC;
				
			}
			td.lunch, th.lunch {
				background: #EEEE00;
			}			
		</style>		
	</head>
	<body>
	<header> <a href="index.html">
    <h4 class="logo">DragonHouse</h4>
    </a>
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
		<h2><?PHP echo $day . '<sup>' . date("S",$tstamp) . '</sup> ' . date("F",$tstamp) . ' ' . $year; ?></h2>
		
		<!-- link back to monthly view -->
		<div id="controls">
			<a href="custmonthview.php?year=<?PHP echo $year; ?>&month=<?PHP echo $month;?>">Back to Monthly View</a>
		</div>	
		
		<form action="<?PHP echo $url; ?>" method="POST" id="slotform">
			<table id="custdayview">
				<tr>
					<th>Ocean View</th>
					<th>Balcony View</th>
					<th>Pool Side</th>
					<th class="lunch">Grand Hall</th>	
					<th>Top View</th>
					<th>Galla Room</th>
					<th>Grand Room</th>
				</tr>
				<tr>
				
				<?PHP
					$hours = array(9,10,11,12,1,2,3);
					
					// Check connection is working
					if ($conn->connect() === true) {			
				
						for ($i = 0; $i < 7; $i++) {
							// add in a <TD> with class dependant on slot (as we would like some lunch most days)
							if ($i != 3) echo '<td class="slot">';
							else echo '<td class="lunch">';
							
							// create a timestamp for this slot
							$slot = mktime($hours[$i],0,0,$month,$day,$year);
							
							// select from appointments table anything with this timestamp 
							// (this is quicker than searchning day / month / year individually)
							$sql = "SELECT dragonappointments.*,dragoncustomer.* from dragonappointments JOIN dragoncustomer ON dragonappointments.cmr = dragoncustomer.CustID WHERE dragonappointments.datetime=" . $slot;
							
							$result = $conn->select($sql);
							
							if ($result->num_rows > 0) {
								// output data of each row 
								// (should only be a max of 1 but let's not assume that in code)	
								foreach($result as $row) {								
									echo "booked";
								}
							} else {
								// if no record is found display a free message
								echo "Free slot";
							}
							echo '</td>';
						}
					}	
					else {
						echo '<td class="error" colspan="7">' . $conn->err . '</td>';
					}
					// close DB connection
					$conn->close();
				?>
				</tr>
				<tr>
					<?PHP 
						for ($i = 0; $i < 7; $i++) {
							if ($i != 3) echo '<td class="radioslot">';
							else echo '<td class="lunch">';						
							echo '<input type="radio" name="slot" value="' . $hours[$i] . '"/></td>';
						}
					?>
				</tr>
			</table>
			
			<!-- this next block adds controls to assign and deassign cmrs from slots -->
			<div id="addremove">
				<div id="clear">
					<input type="submit" name="clear" value="Clear slot"/>
				</div>
				
				<div id="add">
					
					<?PHP
					
						if ($conn->connect() === true) {	
						
							// we need the cmr name but this may not be unique 
							// so also grab the email which has to be unique
							$sql = "SELECT CustID,ForeName,SurName,Email from dragoncustomer ORDER BY CustID";
							$result = $conn->select($sql);
							
							if ($result->num_rows > 0) {
								// draw select control to allow the cmr to be selected 
								echo '<select name="cmr">';
								
								// output data of each row
								foreach($result as $row) {
									echo '<option value="' . $row['CustID'] . '">' . $row['ForeName'] . ' '  . $row['SurName'] . ":" . $row['Email'] . '</option>';
								}
							
								echo '</select>';
								
								// draw an add button if there are cmrs to be added
								echo '<input type="submit" name="add" value="Add to slot"/>';
							}
							else {
								// no customer records in database
								echo '<p>No customer records available</p>';
							}
						
						}
						else {
							echo '<p>' . $conn->error . '</p>';
						}
						// close db connection
						$conn->close();	
					?>
				</div>
			</div>
		</form>
		
		<div id="console">
			<?PHP
				echo $console;
			?>
		</div>
	</body>
</html>