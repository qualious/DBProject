<html>
    <head>
        <title>Reserve...</title>
    </head>
    <body>

	<?php 

    	require_once('../Project/mysqli_connect.php');
		session_start();

    	$_SESSION['activity_id'] = $id;
    	$id = $_POST['optradio'];		//returns the activity_id
        $userName = $_SESSION['username'];
     	$query = "SELECT * FROM activity WHERE fullness = capacity AND activity_id = '$id'";
     	$result = mysqli_query($conn,$query);
     	if ($result) {
		   	echo "I'm sorry, but it seems like that activity is in its full capacity! Please select another activity";
			header('refresh:2; url=search.php');
			exit;
		}
		else{
			$sqlUpdate = "UPDATE activity SET fullness = fullness + 1 WHERE activity_id = '$id'";
			$sqlReserve = "INSERT INTO `reserve` (`user_name`,`activity_id`, `res_count`) VALUES ('$userName', '$id','1')";
			$resultUpdate = mysqli_query($conn,$sqlUpdate);
			$resultReserve = mysqli_query($conn,$sqlReserve);
			if (!$resultUpdate || !$resultReserve) {
		    	printf("\n\nError: %s\n", mysqli_error($conn));
	    		exit();
			}
			else{
				echo "Reservation has been made!";
				header('refresh:2; url=userPage.php');
				exit;
			}
		}
   		$conn->close();
	?>
    </body>
</html>
