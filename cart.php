
<?php
include('includes/connect.php');
include('common_function.php');
session_start();
$user_id = $_SESSION['user_id'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart detail</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="css.css">

<style>
 /* Center align table content */
 table {
        text-align: center;
    }


</style>
<body >
<div style="height:1024px;max-height: auto;">
      <!-- <div class="container"> -->
      <?php
      include('navbar.php');
      ?>


<!-- cart -->
<?php
if(isset($_POST['update_cart'])){
  $update_quantity = $_POST['cart_quantity'];
  $update_id = $_POST['cart_id'];
  mysqli_query($con, "UPDATE `cart_details` SET quantity = $update_quantity WHERE cart_id = $update_id") ;
}
if(isset($_GET['remove'])){
  $remove_id = $_GET['remove'];
  mysqli_query($con, "DELETE FROM `cart_details` WHERE cart_id = '$remove_id'") or die('query failed');
  echo "<script>window.open('cart.php','_self')</script>";

}
$user_id = $_SESSION['user_id'];

if(isset($_GET['delete_all'])){
  mysqli_query($con, "DELETE FROM `cart_details` WHERE user_id = $user_id") or die('query failed');
  echo "<script>window.open('cart.php','_self')</script>";


}

 ?>

<div class="container py-4">
    <h1 class="text-center mb-4">Shopping Cart</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col" colspan="2">Quantity</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $user_id = $_SESSION['user_id'];
                $cart_query = mysqli_query($con, "SELECT * FROM `cart_details` WHERE user_id = $user_id");
                $grand_total = 0;
                if (mysqli_num_rows($cart_query) > 0) {
                    while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
                        ?>
                        <tr>
                            <td><img src="./admin_area/product_images/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
                            <td><?php echo $fetch_cart['name']; ?></td>
                            <td>$<?php echo $fetch_cart['price']; ?>/-</td>
                            <form action="" method="post"  >

                            <td style="max-width: 50px;" >
                                    <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['cart_id']; ?>">
                                        <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>"  class="text- form-control quantity-input" >
                            </td>
                           <td>
                           <button type="submit" name="update_cart" class="btn btn-primary">Update</button>
                           </td>
                            </form>

                            <td>$<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
                            <td><a href="cart.php?remove=<?php echo $fetch_cart['cart_id']; ?>" class="btn btn-danger remove-btn" onclick="return confirm('Remove item from cart?');">Remove</a></td>
                        </tr>
                        <?php
                        $grand_total += $sub_total;
                    }
                } else {
                    echo '<tr><td colspan="6" class="text-center">No item added</td></tr>';
                }
                ?>
                <tr class="table-bottom">
                    <td colspan="3"></td>
                    <td class="text-end fw-bold">Grand Total:</td>
                    <td>$<?php echo $grand_total; ?>/-</td>
                    <td><a href="cart.php?delete_all" class="btn btn-danger delete-all-btn <?php echo ($grand_total > 0) ? '' : 'disabled'; ?>" onclick="return confirm('Delete all from cart?');">Delete All</a></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="text-center mt-4">
         <a href="na.php" class="btn btn-danger ">Continue Shopping</a>

        <a href="chackout.php" class="btn btn-success proceed-btn <?php echo ($grand_total > 0) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
    </div>
</div>






<!-- Bootstrap Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<!--  -->
</div>

</div>

</body>
<div>
  
<?php
include('footer.php');
?>
</div>



<script src="https://kit.fontawesome.com/d2aa397344.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
