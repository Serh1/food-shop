<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<!-- Navbar Section Starts Here -->
<section class="navbar">
    <div class="header">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Goodies</a>
                    </li>

                    <li>
                        <a href="<?php echo SITEURL; ?>contact.php">Contact</a>
                    </li>

                    <li>
                        <a href="<?php echo SITEURL; ?>myaccount.php">My Account</a>
                    </li>
                    <?php if (isset($_SESSION['user'])) {
                        ?>
                        <li>
                            <a href="<?php echo SITEURL; ?>admin/logout.php">Log out</a>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li>
                            <a href="<?php echo SITEURL; ?>admin/logout.php">Log in</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>

</section>
<!-- Navbar Section Ends Here -->