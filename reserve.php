<html>
    <head>
        <title>Reserve...</title>
    </head>
    <body>

	<?php 

    	require_once('../Project/mysqli_connect.php');
		session_start();

    	$id = $_POST['optradio'];		
    	$_SESSION['activity_id'] = $id;
        $userName = $_SESSION['username'];


    	$res_count = $_POST['res_count'];
    	$_SESSION['res_count'] = $res_count;

     	$query = "SELECT * FROM activity WHERE fullness = capacity AND activity_id = '$id'";
     	$result = mysqli_query($conn,$query);
     	if (!$result) {
		   	echo "I'm sorry, but it seems like that activity is in its full capacity! Please select another activity";
			header('refresh:2; url=search.php');
			exit;
		}
		else{
			$sqlUpdate = "UPDATE activity SET fullness = fullness + '$res_count' WHERE activity_id = '$id'";
			$sqlReserve = "INSERT INTO `reserve` (`user_name`,`activity_id`, `res_count`) VALUES ('$userName', '$id','$res_count')";
			$resultReserve = mysqli_query($conn,$sqlReserve);
			$resultUpdate = mysqli_query($conn,$sqlUpdate);
			if (!$resultUpdate || !$resultReserve) {
		    	//printf("\n\nError in update and reserve: %s\n", mysqli_error($conn));
	    		echo "You already have a reservation in the selected activity, please update or cancel it in your user page!"
	    		header('refresh:2; url=userPage.php');
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
