<html>
    <head>
        <title>Processing information...</title>
    </head>
    <body>

    <?php
        $conn = new mysqli("localhost", "root", "oldrapper", "project");

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
            header('index.html');
			exit;

        }

        $query = $conn->prepare("SELECT * from consumer where user_name=?");
        $query->bind_param("s", $userName);
        $query->execute();
        $query->store_result();
        $countRows = $query->num_rows;
        if($countRows>=1){
            //if username exists, send user to index.html
            echo "Username $userName already exists, please try again!";
            // <script>
            //     window.setTimeout(function () {
            //         window.location = "index.html";
            //     },3000);
            // </script>
            header('refresh:2; url=index.html');
			exit;
        }else{
            $query2 = $conn->prepare("INSERT into consumer (user_name, user_password) VALUES (?, ?)");
            $query2->bind_param("ss", $userName, $password1);
            if($query2->execute()){
                echo "Registration complete";
                //if registration is complete, send user to logged.html
                // <script>
                //     window.setTimeout(function () {
                //         window.location = "logged.html";
                //     },2000);
                // </script>
                header('refresh:2; url=logged.html');
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
                header('refresh:2; url=index.html');
				exit;

            }
        }
    $conn->close();
    ?>

    </body>
</html>

