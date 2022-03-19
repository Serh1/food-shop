<!-- Updated-->

<?php

    include('../config/constants.php');
    $id = $_GET['id'];

    $sql = "DELETE FROM user WHERE id=$id";

    global $conn;
    $res = mysqli_query($conn, $sql);
    if($res==true)
    {
        $_SESSION['delete'] = "<div class='success'>Account Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-accounts.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Account. Try Again Later.</div>";
        header('location:'.SITEURL.'admin/manage-accounts.php');
    }
?>