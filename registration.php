<html>
    <head>
        <title>Information Gathered</title>
    </head>
    <body>

    <?php
        $servername = "localhost";
        $uname = "root";
        $password = "password";

        $dbhandle = mysql_connect($servername, $uname, $password) 
            or die("Unable to connect to MySQL");
        echo "Connected to MySQL<br>";
        
        $user_db = mysql_select_db("User",$dbhandle) 
            or die("Could not select user");


        $userName = $_POST['username'];
        $password1 = $_POST['password1'];
        $password2= $_POST['password2'];
        if($password1 != $password2)
            echo "Passwords don't match!";
        else
            echo "OK";

        $query = "SELECT * FROM User where username=$userName";
        $result = mysql_query($query);
        if($result){
            echo "Username $userName already exists, please try again!";
        }else{
            $query2 = "INSERT INTO User (username, password) VALUES ($userName, $password1)";
            mysql_query($query2);
            echo "User sucesfully created.";
        }

    ?>

    </body>
</html>
