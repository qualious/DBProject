<html>
    <head>
        <title>Showing events based on filters...</title>
    </head>
    <body>

	<?php 
		$conn = new mysqli("localhost", "root", "oldrapper", "project");

        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
	//Here, user will search for the desired activities.
        $day1 = $_POST['day1'];
        $month1 = $_POST['month1'];
        $year1 = $_POST['year1'];
		$string1 = $year1 . "-" . $month1 . "-" . $day1;

        $day2 = $_POST['day2'];
        $month2 = $_POST['month2'];
        $year2 = $_POST['year2'];
		$string2 = $year2 . "-" . $month2 . "-" . $day2;

        $city = $_POST['city'];
		$activity_type = $_POST['type'];


		$result = mysqli_query($con,"SELECT * FROM activity WHERE event_date BETWEEN '$string1 . "00:00:00"' 
																				AND  '$string2 . "23:59:59"'");
		echo "<table border='1'>
			<tr>
			<th>Title</th>
			<th>Date</th>
			<th>Showroom</th>
			<th>Capacity</th>
			<th>Fullness</th>
			<th>Activity Type</th>
			</tr>";

			while($row = mysqli_fetch_array($result))
			{
			echo "<tr>";
			echo "<td>" . $row['title'] . "</td>";
			echo "<td>" . $row['event_date'] . "</td>";
			echo "<td>" . $row['showroom'] . "</td>";
			echo "<td>" . $row['capacity'] . "</td>";
			echo "<td>" . $row['fullness'] . "</td>";
			echo "<td>" . $row['activity_type'] . "</td>";
			echo "</tr>";
			}
			echo "</table>";
    $conn->close();
	?>
    </body>
</html>

