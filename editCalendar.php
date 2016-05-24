<!doctype HTML>
<html>
	<head>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<form action="modifyCalendr.php" method="POST">
			<label for="title" maxlength="150">Event Title</label>
			<input name="title" type="input" required></br>

			<label for="description" maxlength="400" required>Description<label>
			<textarea name="description" rows="4" cols=""></textarea></br>

			<label for="category">Category</label>
			<select name="category">
				<?php
					// connect to server
					try{
					$conn = new PDO('mysql:host=localhost;dbname=local', 'belliott', 'admin');
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					}
					// catch and display connection errors
					catch(PDOException $e){
						echo "connection failed :" . $e->getMessage() . "</br>";
					}
					// query database for catagories
					$sql = 'SELECT * FROM category';
					$result = $conn->query($sql);
					// loop values into an select input
					foreach ($result as $row) {
						$category = $row['category'];
						echo '<option value="'.$category.'">'.$category.'</option>';
					}
					$conn = null;
				?>
			</select></br>

			<label for="eventDay">Day</label>
			<input name="eventDay" type="input" maxlength="2" required></br>

			<label for="eventMonth">Month</label>
			<select name="eventMonth">
				<option value="1">January</option>
				<option value="2">Febuary</option>
				<option value="3">March</option>
				<option value="4">April</option>
				<option value="5">May</option>
				<option value="6">June</option>
				<option value="7">July</option>
				<option value="8">August</option>
				<option value="9">September</option>
				<option value="10">October</option>
				<option value="11">November</option>
				<option value="12">December</option>
			</select>


			<label for="eventYear">
				<select name="eventYear">
			<?php
				// generate next 5 years
				$setYear = date('Y');
				$currentYear = date('Y');
				// create a loop to create incrementing years
				do{
					echo '<option value="'.$currentYear .'">'.$currentYear.'</option>';
					$currentYear = $currentYear + 1;
				}while($currentYear <= $setYear + 5);
			?>
		</label>

			<input type="submit" value="submit">

		</form>
		<a href="index.php">Back</a>
	</body>
</html>