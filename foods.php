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


    <!-- Food menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">The Goodies:</h2>
            <h3 class="text-center">Filter by:</h3>
            <div class="menu text-center">
                <div class="wrapper">
                    <ul>
                        <li><a href="foods.php?choice=ORDER BY title ASC">Alphabetical</a></li>
                        <li><a href="foods.php?choice=ORDER BY price ASC">Lowest Price</a></li>
                        <li><a href="foods.php?choice=ORDER BY price DESC">Highest Price</a></li>
                        <li><a href="foods.php?category=category_id=991">Breakfast</a></li>
                        <li><a href="foods.php?category=category_id=992">Lunch</a></li>
                        <li><a href="foods.php?category=category_id=993">Dinner</a></li>
                    </ul>
                </div>
            </div>
            <?php

            if (isset($_GET['choice'])) {
                $choice = $_GET['choice'];
            }else{
                $choice = 'ORDER BY id';
                $category = ' ';
            }
            if (isset($_GET['category'])) {
                $c = $_GET['category'];
                $category = $c.' AND ';
                $choice = ' ';
            }else{
                $category = ' ';
            }
            //$choice = $_GET['choice'];
            $sql = "SELECT * FROM item WHERE $category active='Yes' $choice";
            global $conn;
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['summary'];
                    $price = $row['price'];
                    $image_name = $row['image'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            //CHeck whether image available or not
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
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price; ?>RON</p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>
                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>"
                               class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='error'>Food not found.</div>";
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Food menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>