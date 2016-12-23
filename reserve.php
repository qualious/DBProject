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

    	$id = $_GET['id'];

   		$conn->close();
	?>
    </body>
</html>
