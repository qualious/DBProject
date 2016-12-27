<html>
    <head>
        <title>Processing information...</title>
    </head>
    <body>

    <?php
        $userName = $_POST['username'];
        $password = $_POST['password'];
    	session_start();
    	$_SESSION['username'] = $userName;
        if($userName == '' || $password == ''){
            echo "<h2>Username or password can't be blank!</h2>";
            exit();
        }
        require_once('../Project/mysqli_connect.php');
        $query = $conn->prepare("SELECT * from consumer where user_name=? AND user_password=?");
        $query->bind_param("ss", $userName, $password);
        $query->execute();
        $query->store_result();
        $countRows = $query->num_rows;
        if($countRows>=1){
            //if username exists, send user to index.html
            echo "Sucesfully logged in, redirecting to userPage!";
            header('refresh:2; url=userPage.php');
			exit;
        }else{
            echo "Username or password doesn't exits! Please try logging again!";
            header('refresh:2; url=index.html');
        }
    $conn->close();
    ?>

    </body>
</html>

