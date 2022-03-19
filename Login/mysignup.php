<?php include('../config/constants.php'); $GLOBALS["conn"]; ?>

<html>
<head>
    <title>Sign up - Sergiu's Goodies</title>
    <link rel="stylesheet" type='text/css' href="../Login/style.css">
</head>
<body>
<div class="singup">
    <br><br>
    <form action="mysignup.php" method="post">
        <h2>SIGN UP</h2>
        <?php
        if (isset($_SESSION['mysignup'])) {
            echo $_SESSION['mysignup'];
            unset($_SESSION['mysignup']);
        }
        if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p><?php }
        ?>

        <label>First Name:</label>
        <input type="text" name="fname" placeholder="First Name"><br>

        <label>Second Name:</label>
        <input type="text" name="scname" placeholder="Second Name"><br>

        <label>User Name:</label>
        <input type="text" name="uuname" placeholder="User Name"><br>

        <label>Mobile Number:</label>
        <input type="text" name="mobile" placeholder="Mobile number"><br>

        <label>Password:</label>
        <input type="password" name="password1" placeholder="Password"><br>

        <label>Confirm Password:</label>
        <input type="password" name="password2" placeholder="Password"><br>

        <label>Email:</label>
        <input type="email" name="email" placeholder="Email"><br>

        <input type="submit" name="submit" value="Sign up" class="btn-primary"><br>
        Do you already have an account? <a style="color: black" href="mylogin.php" class="singup">Log in</a>

    </form>
</div>
</body>
</html>

<?php
if (isset($_POST['fname']) && isset($_POST['scname']) && isset($_POST['uuname']) && isset($_POST['mobile']) && isset($_POST['password1']) && isset($_POST['password2']) && isset($_POST['email'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $fname = validate($_POST['fname']);
    $scname = validate($_POST['scname']);
    $uuname = validate($_POST['uuname']);
    $mobile = validate($_POST['mobile']);
    $pass1 = validate($_POST['password1']);
    $pass2 = validate($_POST['password2']);
    $email = validate($_POST['email']);

    if (empty($fname)) {
        header("Location: mysignup.php?error=First Name is required");
        exit();
    } else if (empty($scname)) {
        header("Location: mysignup.php?error=Second Name is required");
        exit();
    } else if (empty($uuname)) {
        header("Location: mysignup.php?error=UserName is required");
        exit();
    } else if (empty($mobile)) {
        header("Location: mysignup.php?error=Mobile number is required");
        exit();
    } else if (empty($pass1)) {
        header("Location: mysignup.php?error=Password is required");
        exit();
    } else if (empty($pass2)) {
        header("Location: mysignup.php?error=Password is required");
        exit();
    } else if (empty($email)) {
        header("Location: mysignup.php?error=Email is required");
        exit();
    } else if ($pass1 != $pass2) {
        header("Location: mysignup.php?error=Passwords does not match");
        exit();

    } else {
        $sql = "SELECT * FROM user WHERE UserName = '$uuname'";
        global $conn;
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        // TODO Validation of the existing users

        $userid = "SELECT MAX(id) FROM user";
        $result2 = mysqli_query($conn, $userid);
        $maxid = mysqli_fetch_row($result2);
        $newid = $maxid[0] + 1;


        if ($count >= 1) {
            $_SESSION['mysignup'] = "<div class='error text-center'> This User Name already exists.</div>";
            header('location:' . SITEURL . 'Login/mysignup.php');
        } else {
            $query = "INSERT INTO `user` (`UserName`, `FirstName`, `SecondName`, `password`, `email`, `mobile`,`id`)
             VALUES ('$uuname', '$fname', '$scname', '$pass1', '$email', '$mobile','$newid')";
            mysqli_query($conn, $query);
            $_SESSION['mysignup'] = "<div class='success text-center''>Your account has been created.</div>";
            header("Location: mylogin.php");
        }
    }
} else {
    exit();
}

?>

