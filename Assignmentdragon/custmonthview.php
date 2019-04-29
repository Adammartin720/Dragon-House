<!DOCTYPE html> 

<html>
	<head>
		<title>Month view</title>
		<link href="css/dragonhouse.css" rel="stylesheet" type="text/css">
<script>var __adobewebfontsappname__="dreamweaver"</script>
<script src="http://use.edgefonts.net/source-sans-pro:n2:default.js" type="text/javascript"></script>
		<style type="text/css">
			#monthview {
				width: 100%;
			}
			
			#monthview th, td {
				border: 1px solid #555555;
				height: 30px;
			}
			td.deadspace {
				background: #CCCCCC;
				
			}
			td.weekend {
				background: #EEEEEE;
			}			
		</style>
		<?PHP 
			// grab month/year from GET, if not present use today as default.
			if (isset($_GET['month'])) $month = $_GET['month'];
			else $month = date("n");
			if (isset($_GET['year'])) $year = $_GET['year'];
			else $year = date("Y");	
			
			// get a timestamp object from the supplied year / month
			// this will allow us access to information about that date without having to work it out.
			$tstamp = mktime(12,0,0,$month,1,$year); // Hour:Minute:Second:Month:Day:Year
			
			// work out month / year values for next btn
			$nextmonth = $month + 1;
			$nextyear = $year;
			if ($nextmonth > 12) { // we have moved past dec - go back to jan an increase year
				$nextmonth = 1;
				$nextyear += 1;
			}
			
			// work out month / year values for previous button.
			$lastmonth = $month - 1;
			$lastyear = $year;
			if ($lastmonth < 1) { // we have moved behind jan, go to dec and deincrement year
				$lastmonth = 12;
				$lastyear -=1;
			}
			
		?>
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
	
		<h2><?PHP echo date("F",$tstamp) . " " . $year; ?></h2>
		
					
		
		<div id="controls">
			<a href="registration.php">Create account</a>
		</div>
		
		<table id="monthview">
			<tr>
				<th>Monday</th>
				<th>Tuesday</th>
				<th>Wednesday</th>
				<th>Thursday</th>
				<th>Friday</th>
				<th>Saturday</th>
				<th>Sunday</th>
			</tr>
			
			<?PHP 

				$firstdayofweek = date("N",$tstamp);
				$daysinmonth = date("t",$tstamp);
				
				// start first row
				echo '<tr>';
				if ($firstdayofweek > 1) {
					for ($i = 0; $i < ($firstdayofweek - 1); $i++) {
						echo '<td class="deadspace">&nbsp;</td>';
					}
				}
				
				// set the day of week counter to the start day
				// use this to know where each table row ends
				$dayindex = $firstdayofweek;
				for ($i = 1; $i <= $daysinmonth; $i++) {
					
					// draw in controls to launch day view here.
					if ($dayindex <= 5) echo '<td class="day"><a href="custres.php?day=' . $i . '&month=' . $month . '&year=' . $year . '">' . $i . '</a></td>';
					else echo '<td class="weekend"><a href="custres.php?day=' . $i . '&month=' . $month . '&year=' . $year . '">' . $i . '</a></td>';
					
					// if this is sunday and is not the last day of the month
					// finish the row and reset the day of week counter
					$dayindex++;
					if ($dayindex > 7 && $i != $daysinmonth) {
						$dayindex = 1;
						echo '</tr><tr>';
					}
				}
				// complete last row with dead cells
				for ($i = $dayindex; $i <= 7; $i++) {
					echo '<td class="deadspace">&nbsp;</td>';
				}
				echo '</tr>';
			
			?>
		</table>
		
		<div id="nextback">
			<a href="custmonthview.php?year=<?PHP echo $lastyear; ?>&month=<?PHP echo $lastmonth;?>">Previous</a>
			<a href="custmonthview.php?year=<?PHP echo $nextyear; ?>&month=<?PHP echo $nextmonth;?>">Next</a>
		</div>
		
		<div id="jumptomonth">
			<form action="custmonthview.php" method="GET" id="directinputmonth">
				<select name="month">
					<?PHP
						// format month names
						$months = array("January","February","March","April","May","June","July","August","September","October","November","December");
						
						// draw select option tags for each month with the current selection pre-set
						for($i = 1; $i <= 12; $i++) {
							$selected = " ";
							if ($i == $month) $selected="selected";
							echo '<option value="' . $i . '"' . $selected . '>' . $months[$i - 1] . '</option>';
						}
					?>
				</select>
				
				<select name="year">
					<?PHP
						// get year params +/- 10 years from currently selected.
						$startyear = $year - 10;
						$endyear = $year + 10;
						
						// draw select option tags for each year in range with the current selection pre-set
						for ($i = $startyear; $i <= $endyear; $i++) {
							$selected = " ";
							if ($i == $year) $selected="selected";
							echo '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
						}						
					?>
				</select>
				
				<div class="buttonrow">
					<input type="submit" value="Go"/>
				</div>
				
			</form>
		</div>
	
	
	</body>
</html>