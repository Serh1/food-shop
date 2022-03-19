
<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Starts -->
        <div  class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br><br>
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
//                if (isset($_SESSION['no-login-message'])) {
//                    echo $_SESSION['no-login-message'];
//                    unset($_SESSION['no-login-message']);
//                }
                ?>
                <br><br>

                <div style="color: black" class="col-4 text-center">

                    <?php 
                        //Sql Query 
                        $sql = "SELECT * FROM category";
                        global $conn;
                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br />
                    Categories
                </div>

                <div style="color: black" class="col-4 text-center">

                    <?php 
                        //Sql Query 
                        $sql2 = "SELECT * FROM item";
                        global $conn;
                        $res2 = mysqli_query($conn, $sql2);
                        //Count Rows
                        $count2 = mysqli_num_rows($res2);
                    ?>

                    <h1><?php echo $count2; ?></h1>
                    <br />
                    Foods
                </div>

                <div style="color: black" class="col-4 text-center">
                    
                    <?php
                        $sql3 = "SELECT * FROM orders";
                        global $conn;
                        $res3 = mysqli_query($conn, $sql3);
                        $count3 = mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count3; ?></h1>
                    <br />
                    Total Orders
                </div>

                <div style="color: black" class="col-4 text-center">
                    <?php
                        $sql4 = "SELECT SUM(totalPrice) AS Total FROM orders WHERE status='Delivered'";
                        global $conn;
                        $res4 = mysqli_query($conn, $sql4);
                        $row4 = mysqli_fetch_assoc($res4);
                        $total_revenue = $row4['Total'];
                    ?>

                    <h1><?php echo $total_revenue; ?>RON</h1>
                    <br />
                    Revenue Generated
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Main Content Setion Ends -->

<?php include('partials/footer.php') ?>