<!--WORKS-->

<?php include('partials/menu.php'); ?>
    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Accounts</h1>

            <br/>
            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add']; //Displaying Session Message
                unset($_SESSION['add']); //REmoving Session Message
            }

            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if (isset($_SESSION['user-not-found'])) {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }

            if (isset($_SESSION['pwd-not-match'])) {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
            }

            if (isset($_SESSION['change-pwd'])) {
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']);
            }

            ?>
            <br><br><br>

            <!-- Button to Add Admin -->
            <a href="add-admin.php" class="btn-primary">Add Account</a>

            <br/><br/><br/>

            <table class="tbl-full">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Second Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Actions</th>
                </tr>


                <?php
                $sql = "SELECT * FROM user";
                global $conn;
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $first_name = $rows['FirstName'];
                            $second_name = $rows['SecondName'];
                            $username = $rows['UserName'];
                            $email = $rows['email'];
                            $mobile = $rows['mobile'];
                            ?>
                            <tr>
                                <td><?php echo $id; ?>.</td>
                                <td><?php echo $first_name; ?></td>
                                <td><?php echo $second_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><br><?php echo $mobile; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>"
                                       class="btn-secondary">Update Account</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-account.php?id=<?php echo $id; ?>"
                                       class="btn-danger">Delete Account</a>
                                </td>
                            </tr>

                            <?php

                        }
                    } else {
                    }
                }
                ?>
            </table>
        </div>
    </div>
    <!-- Main Content Setion Ends -->

<?php include('partials/footer.php'); ?>