<?php include('../config/constants.php'); ?>

    <html>
    <head>
        <title>Login - Sergiu's Goodies</title>
        <link rel="stylesheet" href="../Login/style.css">
    </head>
    <body>
    <div class="login">
        <br><br>
        <?php
//        if (isset($_SESSION['no-login-message'])) {
//            echo $_SESSION['no-login-message'];
//            unset($_SESSION['no-login-message']);
//        }
        ?>
        <br><br>
        <!-- Login Form Starts HEre -->
        <form action="" method="POST" class="text-center">
            <div class="logo">
                <img src="../images/logo2.jpg" alt="Restaurant Logo" width="400" height="400" class="img-responsive">
            </div>
            <h1 class="text-center">Log in to your account</h1>
            Username:
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>
            <input type="submit" name="submit" value="Log in" class="btn-primary"><br>
            No account yet? <a style="color: black" href="mysignup.php" class="singup">Sign up</a>
            <?php
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if (isset($_SESSION['order'])) {
                echo $_SESSION['order'];
                unset($_SESSION['order']);
            }
            ?>
            <br><br>
        </form>
        <!-- Login Form Ends HEre -->
    </div>
    </body>
    </html>

<?php
//CHeck whether the Submit Button is Clicked or NOt
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE UserName='$username' AND password='$password'";
    global $conn;
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        if ($username == 'admin' && $password == 'admin1') {
            $_SESSION['login'] = "<div class='success text-center'>Login Successful.</div>";
            $_SESSION['user'] = $username;
            header('location:' . SITEURL . 'admin/index.php');

        } else {
            $_SESSION['user'] = $username;
            $_SESSION['login'] = "<div class='success text-center'>Login Successful.</div>";
            header('location:' . SITEURL);

            $sql = "SELECT * FROM user WHERE UserName='$username' AND password='$password'";
            global $conn;
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);
            $id = $row['id'];
            $_SESSION['myid'] = $id;
        }
    } else {
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        header('location:' . SITEURL . 'Login/mylogin.php');
    }


}

?>