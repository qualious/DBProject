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
				<th>Select</th>
				<th>Quantity</th>
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
   			$userName = $_SESSION['username'];
			$query = "	SELECT activity.activity_id, res_count, title,event_date, activity.showroom, capacity,fullness,activity_type,city_name
						FROM activity
						INNER JOIN showroom ON activity.showroom = showroom.showroom
						INNER JOIN city ON showroom.city_id = city.city_id 
						INNER JOIN reserve ON activity.activity_id = reserve.activity_id
						WHERE reserve.user_name = '$userName';
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
	            <label for='regular'><?php echo $row['res_count']?></label>
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
	    <td>
	    	New Quantity?</br>
			<input type="text" name="res_count_update" size="5" /></td>
	    </td>
	    <tr>
		<td>
			<input type="submit" name="btnUpdate" value="Update the reservation"/>&#160&#160
			<input type="submit" name="btnCancel" value="Cancel the reservation"/>
		</td>
		</tr>
	    </form>
	    <form action="logged.html">
	    	<input type="submit" value="Search for events!" />&#160&#160
		</form>

	    <form action="index.html">
	    	<input type="submit" value="Quit!" />
		</form>

	    </tbody>
	</table>

    </body>
</html>