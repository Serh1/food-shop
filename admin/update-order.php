<!--Updated-->

<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>
        <?php 

            if(isset($_GET['id']))
            {
                $id=$_GET['id'];

                $sql = "SELECT * FROM orders WHERE id=$id";
                global $conn;
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    $row=mysqli_fetch_assoc($res);

                    $item = $row['item'];
                    $price = $row['price'];
                    $qty = $row['qnty'];
                    $status = $row['status'];
                    $first_name = $row['FirstName'];
                    $second_name = $row['SecondName'];
                    $user_address= $row['UserAdress'];
                    $mobile = $row['mobile'];
                    $email = $row['email'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        
        ?>

        <form action="" method="POST">
        
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b> <?php echo $item; ?> </b></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <b>  <?php echo $price; ?> RON </b>
                    </td>
                </tr>

                <tr>
                    <td>Quantity</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>First Name: </td>
                    <td>
                        <input type="text" name="customer_fname" value="<?php echo $first_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Second Name: </td>
                    <td>
                        <input type="text" name="customer_sname" value="<?php echo $second_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Mobile number: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $mobile; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address: </td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $user_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td clospan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        
        </form>


        <?php 
            //CHeck whether Update Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //Get All the Values from Form
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $status = $_POST['status'];
                $first_name = $_POST['customer_fname'];
                $second_name = $_POST['customer_sname'];
                $mobile = $_POST['customer_contact'];
                $email = $_POST['customer_email'];
                $user_address = $_POST['customer_address'];

                $sql2 = "UPDATE orders SET 
                    qnty = $qty,
                    totalPrice = $total,
                    status = '$status',
                    FirstName = '$first_name',
                    SecondName = '$second_name',
                    UserAdress = '$user_address',
                    mobile = '$mobile',
                    email = '$email'
                    WHERE id=$id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                if($res2==true)
                {
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>
