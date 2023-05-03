<?php
    session_start();

    if(isset($_SESSION['username']))
    {
        header("location: home.php");
    }

    $conn = mysqli_connect('localhost', 'root', '');
    mysqli_select_db($conn, 'newdb');

    if(isset($_POST['login']))
    {
        $user = mysqli_real_escape_string($conn, $_POST['usr']);
        $pass = mysqli_real_escape_string($conn, $_POST['pw']);
        $query = "SELECT * FROM logindata WHERE username='$user' AND password='$pass';";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if(!empty($row))
        {
            $_SESSION['username'] = $user;
            if(!empty($_POST['remember']))
            {
                setcookie('lusr', $user, time()+60*60);
                setcookie('lpass', $pass, time()+60*60);
            }
            else
            {
                if(isset($_COOKIE['lusr']))
                    setcookie('lusr');
                if(isset($_COOKIE['lpass']))
                    setcookie('lpass');
            }
            header("location: home.php");
        }
        else
        {
            echo '<center style="color: red;">Incorrect username/password</center>';
        }
    }
    mysqli_close($conn);
?>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="post">
        <center>
            <h2>Login</h2>
            Username: <input type="text" name="usr"
                    value="<?php if(isset($_COOKIE['lusr'])){echo $_COOKIE['lusr'];}?>">
            <br>
            <br>
            Password: <input type="password" name="pw"
                    value="<?php if(isset($_COOKIE['lpass'])){echo $_COOKIE['lpass'];}?>">
            <br>
            <input type="checkbox" name="remember"
            <?php if(isset($_COOKIE['lusr'])){echo "checked";}?>>Remember Me
            <br>
            <input type="submit" name="login" value="Login">
        </center>
    </form>
</body>
</html>
