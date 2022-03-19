<?php include('partials-front/menu.php'); ?>

    <!-- Food search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Food search Section Ends Here -->

<?php
if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}
?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">

            <?php if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            } ?>
            <h2 class="text-center">Explore By Day Time:</h2>

            <?php
            //Create SQL Query to Display CAtegories from Database
            $sql = "SELECT * FROM category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            //Execute the Query
            global $conn;
            $res = mysqli_query($conn, $sql);
            //Count rows to check whether the category is available or not
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                //Categories Available
                while ($row = mysqli_fetch_assoc($res)) {
                    //Get the Values like id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image'];
                    ?>

                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                            //Check whether Image is available or not
                            if ($image_name == "") {
                                //Display Message
                                echo "<div class='error'>Image not Available</div>";
                            } else {
                                //Image Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza"
                                     class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>

                    <?php
                }
            } else {
                //Categories not Available
                echo "<div class='error'>Category not Added.</div>";
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Some Goodies:</h2>

            <?php
            $sql2 = "SELECT * FROM item WHERE active='Yes' AND featured='Yes' LIMIT 4";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if ($count2 > 0) {

                while ($row = mysqli_fetch_assoc($res2)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['summary'];
                    $image_name = $row['image'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            if ($image_name == "") {
                                echo "<div class='error'>Image not available.</div>";
                            } else {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"
                                     alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                        </div>
                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price; ?>RON</p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>
                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>"
                               class="btn btn-primary">Order
                                Now</a>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo "<div class='error'>Food not available.</div>";
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- fOOD Menu Section Ends Here -->


    <!-- Big food photos Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Most Wanted:</h2>

            <?php
            $sql2 = "SELECT * FROM item WHERE active='Yes' AND featured='Yes' ORDER BY RAND () LIMIT 4 ";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if ($count2 > 0) {

                while ($row = mysqli_fetch_assoc($res2)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['summary'];
                    $image_name = $row['image'];
                    ?>

                    <div class="food-menu-details">
                        <div class="food-menu-img2">
                            <?php
                            if ($image_name == "") {
                                echo "<div class='error'>Image not available.</div>";
                            } else {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"
                                     alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                        </div>
                        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        <div class="food-menu-det" align="center">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price; ?>RON</p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br><br>
                            <p class="text-center">
                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?> "
                                   class="btn btn-primary">
                                    Order Now
                                </a>
                            </p>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo "<div class='error'>Food not available.</div>";
            }
            ?>
            <div class="clearfix"></div>
        </div>
        <p class="text-center">
            <a href="<?php echo SITEURL; ?>foods.php">See All Goodies</a>
        </p>
    </section>
    <!-- Big food photos Section Ends Here -->


<?php include('partials-front/footer.php'); ?>