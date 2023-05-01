<?php
    session_start();
    if(!(isset($_SESSION['username'])))
    {
        header("location: login.php");
    }
?>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <?php
        echo "<h3>Welcome ".$_SESSION['username']. "</h3>";
    ?>
    <br> <br>
    <a href="logout.php">Logout</a>
</body>
</html>