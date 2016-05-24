<?php ob_start();?>
<!doctype HTML>
<html>
	<head>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<?php
			// retreive POST from form in editCalendar.php
			$title = $_POST['title'];
			$description = $_POST['description'];
			$eventDay = $_POST['eventDay'];
			$eventMonth = $_POST['eventMonth'];
			$eventYear = $_POST['eventYear'];
			$category = $_POST['category'];

			// connect to database
			try{
				$conn = new PDO('mysql:host=localhost;dbname=local', 'belliott', 'admin');
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				}
				// catch and display connection errors
			catch(PDOException $e){
					// echo "connection failed :" . $e->getMessage() . "</br>";
				}

			$sql = 'INSERT INTO calendar (title, description, category, eventDay, eventMonth, eventYear)
			VALUES  ("'. $title.'", "'. $description.'" , "'. $category.'" , "'. $eventDay.'" , "'. $eventMonth.'" , "'. $eventYear. '")';
			// echo $sql;
			$conn->query($sql);
			// send mail to confirm event creation to my email. ##note this is hard coded to my email##
				// variable to hold message baing sent
				$message = "<html><body><h1>New Event Created:". $title ."</h1><h2>New Event Description:</h2><p>". $description."</br>On:".$eventDay.",".$eventMonth.",".$eventYear."</p></body></html>";
				// set headers so document can display html
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			mail('brandon6elliott@gmail.com', "New Event:". $title, $message, $headers);
			// disconect from database
			$conn= null;
			// return to eddit page
			header('location:editCalendar.php');
		?>
	</body>
</html>
<?php ob_end_flush();?>