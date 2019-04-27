<?php include 'header.php' ?>
<body>
    <div style="margin-top: 20px;" class="container">
        <header class="jumbotron">
            <h1 class="display-3">Sign up</h1>
            <p class="lead">Join us as we explore PHP and SQL!</p>
        </header>
        <form action="sql.php" method="post">
            <p>
                Name: <input name="name" type="text">
            </p>
            <p>
                Password: <input name="password" type="password">
            </p>
            <input class="btn btn-primary" type="submit" value="Sign Up">
        </form>
    </div>
</body>
</html>