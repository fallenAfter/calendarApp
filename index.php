<!doctype HTML>
<html>
	<head>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<section class="calendar">
			<section class="modifyEvent">
			<h2><a href="editCalendar.php">Add Event</a></h2>
		</section>
			<?php
				// variables to hadle  retreiving information about the month and the days within
				$day = date('j');
				$daysInMonth = date('t');
				$dayOfWeek = date('N');
				$curentMonth = date('m');
				$currentYear = date('Y');
				// variables to handle looping of calendar table
				$displayedDays = 7;
				$dateCount = 1;
				echo '<table>';
				// loop repeats the creation of cels where one cell per day for the table header loops as many times as stated in displayedDays variable
				do{
					// switch to change the day of week value from being a number to an english representation
					switch ($dayOfWeek) {
						case 1:
							$textDayOfWeek = 'Monday';
							break;
						case 2:
							$textDayOfWeek = 'Tuesday';
							break;
						case 3:
							$textDayOfWeek = 'Wendnesday';
							break;
						case 4:
							$textDayOfWeek = 'Thursday';
							break;
						case 5:
							$textDayOfWeek = 'Friday';
							break;
						case 6:
							$textDayOfWeek = 'Saturday';
							break;
						case 7:
							$textDayOfWeek = 'Sunday';
							break;
						
						default:
							echo "something is wrong";
							break;
					}
					// creates the table header
					echo '<th>'. $textDayOfWeek .'</th>';
					$dayOfWeek = $dayOfWeek +1;
					$dateCount = $dateCount +1;
					// resets the count to the start of the week so week value repeats from monday
					if ($dayOfWeek > 7) {
						$dayOfWeek = 1;
					}
				}while ( $dateCount <= $displayedDays);
				// reset dateCount variable to zero so it can be used for the day cell
				$dateCount = 1;
				// starts table row outside of loop so it does not get repeated
				echo '<tr>';
					do{
						// connect to database
						try{
						$conn = new PDO('mysql:host=localhost;dbname=calendar', 'belliott', 'admin');
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						}
						// catch and display connection errors
						catch(PDOException $e){
							echo "connection failed :" . $e->getMessage() . "/n";
						}
						// queries to get information for the constructed day
						$sql = 'SELECT title, description FROM calendar WHERE eventDay ='. $day;
						//echo $day;
						$result = $conn->query($sql);
						// checks for errors in sql query
						if (!$result){
							echo "error";
							print_r($result->errInfo());
						}
						// set variables that pick up information from server to be null
						$eventTitle = null;
						$eventDescription = null;
						// assaigns retreived information to variables if information is present
						echo '<td><h3>'. $day. '</h3><div class="events">';
						foreach ($result as $row) {
							echo '<h4>'. $row['title']. '</h4></br><p>'. $row['description'] .'</p></br>';
						}
						echo "</div></td>";
						// Increment day to diplay new value in each cell
						$day = $day + 1;
						// handles end of month to reset to first of month by changing the current month and the day order
						if($day > $daysInMonth){
							$day = 1;
							$curentMonth = $curentMonth + 1;
							if($currentMonth > 12){
								$currentMonth = 1;
								$currentYear = $currentYear + 1;
							}
						}
						// Increments date count so it stops creating table rows after it reaches the number of desired days displayed
						$dateCount = $dateCount +1;
					}while($dateCount <= $displayedDays);
				// ends table row
				echo '</tr>';
				// ends calendar table
				echo '</table>';
				// disconect from database
				$conn = null;
			?>
	</section>
	</body>
</html>
<!-- ************************Known bugs*************************************** 
___________________________No Known Bugs______________________________________
______________________________________________________________________________
______________________________________________________________________________
______________________________________________________________________________-->