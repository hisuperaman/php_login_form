<?php
    session_start();
    if(isset($_SESSION['username']))
    {
        header("location: home.php");
    }
    $conn = mysqli_connect('localhost', 'root', '', 'newdb');
    if(isset($_POST['login']))
    {
        $username = $_POST['usr'];
        $password = $_POST['pw'];
        $query = "SELECT * FROM logindata WHERE usrname='$username' AND password='$password';";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if(!empty($row))
        {
            if(!empty($_POST['remember']))
            {
                setcookie('usrname', $username, time()+60*60);
                setcookie('pass', $password, time()+60*60);
            }
            else
            {
                setcookie('usrname');
                setcookie('pass');
            }
            $_SESSION['username'] = $username;
            header("location: home.php");
        }
        else{
            echo "Enter valid login information";
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
                    value="<?php if(isset($_COOKIE['usrname'])){echo $_COOKIE['usrname'];}?>">
            <br>
            <br>
            Password: <input type="password" name="pw"
                    value="<?php if(isset($_COOKIE['pass'])){echo $_COOKIE['pass'];}?>">
            <br>
            <input type="checkbox" name="remember">Remember Me
            <br>
            <input type="submit" name="login" value="Login">
        </center>
    </form>
</body>
</html>