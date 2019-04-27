<?php include 'header.php' ?>

<body>
    <div style="margin-top: 20px;" class="container">
        <header class="jumbotron">
            <h1 class="display-3">Registration</h1>
            <p class="lead">Join us as we explore PHP and SQL!</p>
        </header>
        <?php 
            // Connect to DB
            $config = parse_ini_file("../../../private/config.ini");
            $host = "127.0.0.1";
            $mysqli = mysqli_connect($host, $config["username"], $config["password"], "menagerie");
            if (mysqli_connect_errno($mysqli)) {
                echo "Failed to connect to MySQL: " . mysql_connect_errno();
            }

            // Check if user table exists
            // TODO find the right way to do this
            $query = "SELECT * FROM user";
            $res = mysqli_query($mysqli, $query);
            // Create user table  if it doesn't exist
            if (!$res) {    
                $res = mysqli_query(
                    $mysqli, 
                    "CREATE TABLE user (name VARCHAR(20), hobby VARCHAR(20))"
                );
            }

            // User sign up
            if ($_POST) {   
                while (TRUE) {        
                    $name = htmlspecialchars($_POST["name"]);
                    $password = password_hash(
                        htmlspecialchars($_POST["password"]),
                        PASSWORD_BCRYPT
                    );  

                    // Make sure form fields aren't empty
                    if (strlen($name)<1 || strlen($password)<1) {
                        echo "Missing form data <br/>";        
                        break;
                    }

                    // Check if user exists already
                    $name_query = "SELECT * FROM user WHERE name='$name';";
                    $name_res = mysqli_query($mysqli, $name_query);

                    if ($name_res->num_rows > 0) {
                        echo "That user exists <br/>";      
                        break;  
                    } else {
                        // Sign the user up            
                        $new_query = "INSERT INTO user (name, password) VALUES ('$name', '$password')";
                        $name_res = mysqli_query($mysqli, $new_query);
                        echo  "User Successfully signed up <br/>";
                        break;
                    }      
                } 
            } 
        ?>
        <a href="form.php">Go back</a>
    </div>
</body>
</html>

