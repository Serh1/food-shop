
<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Account</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>First Name: </td>
                    <td>
                        <input type="text" name="first_name" placeholder="Enter Your First Name" required>
                    </td>
                </tr>
                <tr>
                    <td>Second Name: </td>
                    <td>
                        <input type="text" name="second_name" placeholder="Enter Your Second Name" required>
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username" required>
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password" required>
                    </td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="email" placeholder="Your Email" required>
                    </td>
                </tr>
                <tr>
                    <td>Mobile: </td>
                    <td>
                        <input type="text" name="Mobile" placeholder="Your mobile number" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Account" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>
<?php
    if(isset($_POST['submit']))
    {
        $first_name = $_POST['first_name'];
        $second_name = $_POST['second_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];

        global $conn;
        $userid = "SELECT MAX(id) FROM user";
        $result2 = mysqli_query($conn, $userid);
        $maxid = mysqli_fetch_row($result2);
        $id = $maxid[0] + 1;
        $sql = "INSERT INTO user SET
            FirstName='$first_name',
           SecondName='$second_name',
            UserName='$username',
            password='$password',
            email='$email',
            mobile='$mobile',
            id = '$id'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==TRUE)
        {
            $_SESSION['add'] = "<div class='success'>Account Added Successfully.</div>";
            header("location:".SITEURL.'admin/manage-accounts.php');
        }
        else
        {
            $_SESSION['add'] = "<div class='error'>Failed to Add Account<Account></Account>.</div>";
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>