<!--Updated-->

<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Account</h1>
        <br><br>
        <?php
            $id=$_GET['id'];
            $sql="SELECT * FROM user WHERE id=$id";
            global $conn;
            $res=mysqli_query($conn, $sql);
            if($res==true)
            {
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    $row=mysqli_fetch_assoc($res);
                    $id = $row['id'];
                    $first_name = $row['FirstName'];
                    $second_name = $row['SecondName'];
                    $username = $row['UserName'];
                    $email = $row['email'];
                    $mobile = $row['mobile'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-accounts.php');
                }
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
<!--                <tr>-->
<!--                    <td>Id: </td>-->
<!--                    <td>-->
<!--                        <input type="text" name="id" value="--><?php //echo $id; ?><!--" required>-->
<!--                    </td>-->
<!--                </tr>-->
                <tr>
                    <td>First Name: </td>
                    <td>
                        <input type="text" name="first_name" value="<?php echo $first_name; ?>" required>
                    </td>
                </tr>

                <tr>
                    <td>Second Name: </td>
                    <td>
                        <input type="text" name="second_name" value="<?php echo $second_name; ?>"required>
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>"required>
                    </td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="email" value="<?php echo $email; ?>"required>
                    </td>
                </tr>
                <tr>
                    <td>Mobile number: </td>
                    <td>
                        <input type="text" name="mobile" value="<?php echo $mobile; ?>"required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $first_name = $_POST['first_name'];
        $second_name = $_POST['second_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];

        $sql = "UPDATE `user` SET `UserName`='$username',`FirstName`='$first_name',
        `SecondName`='$second_name',`email`='$email',`mobile`='$mobile' WHERE id = $id";

        global $conn;
        $res = mysqli_query($conn, $sql);
        if($res==true)
        {
            $_SESSION['update'] = "<div class='success'>Account Updated Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-accounts.php');
        }
        else
        {
            $_SESSION['update'] = "<div class='error'>Failed to Update Account.</div>";
            header('location:'.SITEURL.'admin/manage-accounts.php');
        }
    }
?>

<?php include('partials/footer.php'); ?>