<?php include('partials-front/menu.php'); ?>


<?php
if (isset($_GET['food_id'])) {
    $foodid = $_GET['food_id'];
    $sql = "SELECT * FROM item WHERE id=$foodid";
    global $conn;
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image'];
    } else {
        header('location:' . SITEURL);
    }
} else {
    //Redirect to homepage
    header('location:' . SITEURL);
}
?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            <?php
            if (!isset($_SESSION['user'])) {
                $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";
                echo "User not logged in";
                ?>
                <a href="<?php echo SITEURL . 'Login/mylogin.php' ?>">Log in</a>
                <?php
            } else {
            ?>
            <h2 class="text-center text-white"> Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order" style="color:white">
                <fieldset>
                    <legend>Selected Food</legend>
                    <div class="food-menu-img">
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'>Image not Available.</div>";
                        } else {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"
                                 alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                    </div>
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price"><?php echo $price; ?>RON</p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                    </div>
                </fieldset>

                <!--                --><?php
                $username = $_SESSION['user'];
                $sql = "SELECT * FROM user WHERE UserName = '$username'";
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
//                    ?>
                    <fieldset>
                        <legend>Delivery Details</legend>
                        <div class="order-label">First Name</div>
                        <input type="text" name="first-name" placeholder="E.g. Sergiu" class="input-responsive" required
                               value=<?php echo $first_name ?>>
                        <div class="order-label">Second Name</div>
                        <input type="text" name="second-name" placeholder="E.g. Mateiu" class="input-responsive"
                               required value=<?php echo $second_name ?>>
                        <div class="order-label">Phone Number</div>
                        <input type="tel" name="contact" placeholder="E.g. 0742xxxxxx" class="input-responsive" required
                               value=<?php echo $mobile ?>>
                        <div class="order-label">Email</div>
                        <input type="email" name="email" placeholder="E.g. myacccount@email.com"
                               class="input-responsive" required value=<?php echo $email ?>>
                        <div class="order-label">Address</div>
                        <textarea name="address" rows="10" placeholder="E.g. Street, City, Country"
                                  class="input-responsive" required></textarea>
                        <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                    </fieldset>
                    <?php
                } else {
                    echo "No user found";
                }
                }
                ?>

                <?php
                if (isset($_POST['submit'])) {
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $order_date = date("Y-m-d h:i:sa");
                $status = "Ordered";
                $customer_fname = $_POST['first-name'];
                $customer_sname = $_POST['second-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                $sql2 = "INSERT INTO orders SET
        item = '$food',
        food_id = '$foodid',
        user_id = '$id',
        price = '$price',
        qnty = '$qty',
        totalPrice = '$total',
        orderDate = '$order_date',
        status = '$status',
        UserName = '$username',
        FirstName ='$customer_fname',
        SecondName = '$customer_sname',
        UserAdress = '$customer_address',
        mobile = '$customer_contact',
        email = '$customer_email'
        "; ?>
                <fieldset>
                    <legend>Status</legend>
                    <?php
                    $res2 = mysqli_query($conn, $sql2);
                    if ($res2 == true) {
                        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                        $_SESSION['myid'] = $id;
                        echo "Food Ordered Successfully";
                    } else {
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                        echo "Failed to Order Food.";
                    }
                    }
                    ?>
                </fieldset>
            </form>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>