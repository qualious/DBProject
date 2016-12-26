<html>
    <head>
        <title>Canceling reservation...</title>
    </head>
    <body>
    <?php 
    	require_once('../Project/mysqli_connect.php');
    	session_start();
   		$id = $_SESSION['activity_id'];
   		$userName = $_SESSION['username'];
     	$query = "SELECT * FROM activity WHERE activity_id = '$id'";
     	$result = mysqli_query($conn,$query);
     	if (!$result) {
		   	echo "I'm sorry, but it seems like there is a problem with database. Please try again later!";
			header('refresh:2; url=userPage.php');
			exit;
		}
		else{
			$sqlUpdate = "UPDATE activity SET fullness = fullness - 1 WHERE activity_id = '$id'";
			$sqlReserve = "DELETE FROM `reserve` WHERE user_name = '$userName' AND activity_id = '$id'";
			$resultUpdate = mysqli_query($conn,$sqlUpdate);
			$resultReserve = mysqli_query($conn,$sqlReserve);
			if (!$resultUpdate || !$resultReserve) {
		    	printf("\n\nError: %s\n", mysqli_error($conn));
	    		exit();
			}
			else{
				echo "Reservation has been cancelled!";
				header('refresh:2; url=userPage.php');
				exit;
			}
		}
   		$conn->close();
    ?>
    </body>
</html>