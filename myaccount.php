<?php include('partials-front/menu.php'); ?>


    <section class="food-menu">
        <div class="container">
            <?php
            $GLOBALS["conn"];
            if (!isset($_SESSION['user'])) {
                $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";
                echo "User not logged in";
                ?>
                <a href="<?php echo SITEURL . 'Login/mylogin.php' ?>">Log in</a>
                <?php
            } else {

                $username = $_SESSION['user'];
                $sql = "SELECT * FROM user WHERE UserName='$username'";
                global $conn;
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    $rows = mysqli_fetch_assoc($res);
                    $id = $rows['id'];
                    $first_name = $rows['FirstName'];
                    $second_name = $rows['SecondName'];
                    $username = $rows['UserName'];
                    $email = $rows['email'];
                    $mobile = $rows['mobile'];

                    ?>
                    <div class="container" align="center">
                        <div class="food-menu-box">
                            <div class="food-menu-desc">
                                <h4>Your ID:</h4>
                                <p class="food-price"><?php echo $id; ?></p>
                                <br>
                            </div>
                        </div>
                        <div class="food-menu-box">
                            <div class="food-menu-desc">
                                <h4>First Name:</h4>
                                <p class="food-price"><?php echo $first_name; ?></p>
                                <br>
                            </div>
                        </div>
                        <div class="food-menu-box">
                            <div class="food-menu-desc">
                                <h4>Second Name:</h4>
                                <p class="food-price"><?php echo $second_name; ?></p>
                                <br>
                            </div>
                        </div>
                        <div class="food-menu-box">
                            <div class="food-menu-desc">
                                <h4>User Name:</h4>
                                <p class="food-price"><?php echo $username; ?></p>
                                <br>
                            </div>
                        </div>
                        <div class="food-menu-box">
                            <div class="food-menu-desc">
                                <h4>Your email:</h4>
                                <p class="food-price"><?php echo $email; ?></p>
                                <br>
                            </div>
                        </div>
                        <div class="food-menu-box">
                            <div class="food-menu-desc">
                                <h4>Your mobile number:</h4>
                                <p class="food-price"><?php echo $mobile; ?></p>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="food-menu-orders">
                            <div class="food-menu-ord">
                                <h4>Orders:</h4>
                                <?php
                                if (isset($_SESSION['myid'])) {
                                    $userid = $_SESSION['myid'];
                                    $sql = "SELECT * FROM orders WHERE user_id = '$userid'";
                                    global $conn;
                                    $res = mysqli_query($conn, $sql);
                                    $count = mysqli_num_rows($res);
                                    $totalprice = '0';
                                    if ($count > 0) {
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $ordered_item = $row['item'];
                                            $ordered_price = $row['price'];
                                            $quantity = $row['qnty'];
                                            $foodid = $row['food_id'];
                                            $status = $row['status'];
                                            ?>
                                            <div class="container">
                                                <?php
                                                $sql2 = "SELECT * FROM item WHERE id = '$foodid'";
                                                global $conn;
                                                $res2 = mysqli_query($conn, $sql2);
                                                $count2 = mysqli_num_rows($res2);
                                                $row2 = mysqli_fetch_assoc($res2);
                                                $image_name = $row2['image'];
                                                if ($count2 > 0) {
                                                ?>
                                                <div class="food-menu-ord">
                                                    <div class="food-menu-img">
                                                        <?php
                                                        if ($image_name == "") {
                                                            echo "<div class='error'>Image not Available.</div>";
                                                        } else {
                                                            ?>
                                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"
                                                                 alt="Food Image" class="img-responsive img-curve">
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <br><br>
                                                    <div class="order-label" align="center">Item:<?php echo $ordered_item; ?></div>
                                                    <div class="order-label" align="center">Price:<?php echo $ordered_price; ?>RON</div>
                                                    <div class="order-label" align="center">Quantity:<?php echo $quantity; ?></div>
                                                    <div class="order-label" align="center">Status:<?php echo $status; ?></div>
                                                    <?php $totalprice = $totalprice + $ordered_price * $quantity; ?>
                                                </div>
                                                <br><br><br>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="container">
                                            <div class="order-label">Total price: <?php echo $totalprice; ?>RON</div>
                                        </div>
                                        <?php
                                    } else {
                                        echo "Your orders will appear here! :)";
                                    }
                                } else {
                                    echo "Your orders will appear here! :)";
                                }
                                ?>
                                <br>
                            </div>
                        </div>
                    </div>


                    <?php

                }
            }
            ?>
        </div>
        <div class="clearfix"></div>
    </section>


<?php include('partials-front/footer.php'); ?>