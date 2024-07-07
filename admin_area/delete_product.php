<?php
include('../includes/connect.php');

if(isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $delete_sizes_query = "DELETE FROM product_size WHERE product_id = $product_id";
    $delete_sizes_result = mysqli_query($con, $delete_sizes_query);
    if (!$delete_sizes_result) {
        echo "Error deleting product sizes: " . mysqli_error($con);
        exit();
    }

    $fetch_images_query = "SELECT product_image1, product_image2, product_image3 FROM product WHERE product_id = $product_id";
    $fetch_images_result = mysqli_query($con, $fetch_images_query);
    if (!$fetch_images_result) {
        echo "Error fetching product images: " . mysqli_error($con);
        exit();
    }

    $row = mysqli_fetch_assoc($fetch_images_result);
    $product_image1 = $row['product_image1'];
    $product_image2 = $row['product_image2'];
    $product_image3 = $row['product_image3'];

    unlink("./product_images/$product_image1");
    unlink("./product_images/$product_image2");
    unlink("./product_images/$product_image3");

    $delete_product_query = "DELETE FROM product WHERE product_id = $product_id";
    $delete_product_result = mysqli_query($con, $delete_product_query);
    if (!$delete_product_result) {
        echo "Error deleting product record: " . mysqli_error($con);
        exit();
    }

    header("Location: product_view.php");
    ?>
        <script>
        window.location.href = "product_view.php";
    </script>
    <?php
    exit();
} else {
    echo "Product ID not provided.";
}
?>
