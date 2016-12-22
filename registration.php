<html>
    <head>
        <title>Processing information...</title>
    </head>
    <body>

    <?php
        $conn = new mysqli("localhost", "root", "", "oldrapper");

        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

        $userName = $_POST['username'];
        $password1 = $_POST['password1'];
        $password2= $_POST['password2'];
        if($password1 != $password2){
            echo "Passwords don't match!";
            //if passwords don't match, send user to index.html
            // <script>
            //     window.setTimeout(function () {
            //         window.location = "index.html";
            //     },2000);
            // </script>
            header('Location: index.html');
			exit;

        }
        else
            echo "OK";

        $query = "SELECT * from User where username=$userName";
        if($conn->query($query) == TRUE){
            //if username exists, send user to index.html
            echo "Username $userName already exists, please try again!";
            // <script>
            //     window.setTimeout(function () {
            //         window.location = "index.html";
            //     },3000);
            // </script>
            header('Location: index.html');
			exit;
        }else{
            $query2 = "INSERT into User (username, password) VALUES ($userName, $password1)";
            if($conn->query($query2) === TRUE){
                echo "Registration complete";
                //if registration is complete, send user to logged.html
                // <script>
                //     window.setTimeout(function () {
                //         window.location = "logged.html";
                //     },2000);
                // </script>
                header('Location: logged.html');
				exit;

            }
            else{
                echo "Connection error " . $conn->error;
                //if connection error occurs, send user to index.html
                // <script>
                //     window.setTimeout(function () {
                //         window.location = "index.html";
                //     },2000);
                // </script>
                header('Location: index.html');
				exit;

            }
        }
    $conn->close();
    ?>

    </body>
</html>

