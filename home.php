<?php
    session_start();
    if(isset($_POST['logout']))
        header("location: logout.php");
?>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <?php
        if(isset($_SESSION['username']))
        {
            echo "Welcome ".$_SESSION['username'];
        }
    ?>
    <form method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
</body>
</html>