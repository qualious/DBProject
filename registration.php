<html>
	<head>
		<title>Information Gathered</title>
	</head>
	<body>

    <?php
        $servername = "localhost";
        $uname = "root";
        $password = "password";

        // Create connection
        $conn = new mysqli($servername, $uname, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

    	$userName = $_POST['username'];
    	$password1 = $_POST['password1'];
    	$password2= $_POST['password2'];
    	if($password1 != $password2)
    		echo "Passwords don't match!";
    	else
    		echo "OK";

        $query = "SELECT * from User where username=$userName"
        if(mysql_query($query)){
            echo "Username $userName already exists, please try again!";
        }else{
            $query2 = "INSERT into User (username, password) VALUES ($userName, $password1)"
            mysql_query($query2);
            echo "User sucesfully created.";
        }

    ?>

	</body>
</html>
