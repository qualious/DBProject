<html>
    <head>
        <title>Your reservations...</title>
    </head>
    <body>
    <h1>Your Reservations</h1>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
		<table class="table table-responsive">
		<thread>
			<tr>
				<th>Cancel</th>
				<th>Title</th>
				<th>Date</th>
				<th>Showroom</th>
				<th>Capacity</th>
				<th>Reserved</th>
				<th>Activity Type</th>
			</tr>
	    </thead>
	    <tbody>
	    <form action="cancel_res.php" method="post">

		<?php 
    		require_once('../Project/mysqli_connect.php');
    		session_start();
    		$id = $_SESSION['activity_id'];

			$query = "	SELECT activity_id, title,event_date, activity.showroom, capacity,fullness,activity_type,city_name
						FROM activity
						INNER JOIN showroom ON activity.showroom = showroom.showroom
						INNER JOIN city ON showroom.city_id = city.city_id 
						WHERE activity.activity_id = '$id'
					 ";

			$result = @mysqli_query($conn,$query);
			if (!$result) {
		    	printf("\n\nError: %s\n", mysqli_error($conn));
	    		exit();
			}
			while($row = mysqli_fetch_array($result)){
		?>
		<tr>
			<td>
	        	<div class="radio">
	            	<label><input type="radio" id='regular' name="optradio" value=<?php echo $row['activity_id']?>> </label>
	            </div>
	        </td>
	        <td>
	        <div class="radiotext">
	            <label for='regular'><?php echo $row['title']?></label>
	        </div>
	        </td>
	        <td>
	        <div class="radiotext">
	            <label for='regular'><?php echo $row['event_date']?></label>
	        </div>
	        </td>
	        <td>
	        <div class="radiotext">
	            <label for='regular'><?php echo $row['showroom']?></label>
	        </div>
	        </td>
	        <td>
	        <div class="radiotext">
	            <label for='regular'><?php echo $row['capacity']?></label>
	        </div>
	        </td>
	        <td>
	        <div class="radiotext">
	            <label for='regular'><?php echo $row['fullness']?></label>
	        </div>
	        </td>
	        <td>
	        <div class="radiotext">
	            <label for='regular'><?php echo $row['activity_type']?></label>
	        </div>
	        </td>
	    </tr>
	    <?php 
            }
            $conn->close();
        ?>
		<tr>
			<td colspan="2" align="center"><input type="submit" value="Cancel"/></td>
		</tr>
	    </form>
	    </tbody>
	</table>

    </body>
</html>