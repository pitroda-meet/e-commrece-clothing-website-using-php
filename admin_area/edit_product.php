<?php
include('../includes/connect.php');

$product_title = $product_description = $product_keywords = $product_fabric = $product_fit = $product_color = $product_length = $product_gender = $product_category = $product_brands = $product_price = '';

if(isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $select_query = "SELECT * FROM product WHERE product_id = $product_id";
    $result_query = mysqli_query($con, $select_query);

    if ($result_query && mysqli_num_rows($result_query) > 0) {
        $row = mysqli_fetch_assoc($result_query);

        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_keywords = $row['product_keywords'];
        $product_fabric = $row['fabric'];
        $product_fit = $row['fit'];
        $product_color = $row['color'];
        $product_length = $row['length'];
        $product_gender = $row['gender_id'];
        $product_category = $row['category_id'];
        $product_brands = $row['brand_id'];
        $product_price = $row['product_price'];
        $image1=$row['product_image1'];
        $image2=$row['product_image2'];
        $image3=$row['product_image3'];
    } else {
        echo "No product found with the provided ID.";
        exit(); 
    }
}


if(isset($_POST['update_product'])) {
    $product_title = mysqli_real_escape_string($con, $_POST['product_title']);
    $product_description = mysqli_real_escape_string($con, $_POST['product_description']);
    $product_keywords = mysqli_real_escape_string($con, $_POST['product_keywords']);
    $product_brands = $_POST['product_brands'];
    $product_category = $_POST['product_category'];
    $product_gender = $_POST['product_gender'];
    $product_price = $_POST['product_price'];
    $product_fabric = $_POST['product_fabric'];
    $product_color = $_POST['product_color'];
    $product_fit = $_POST['product_fit'];
    $product_length = $_POST['product_length'];


    $update_query = "UPDATE `product` SET product_title = '$product_title', product_description = '$product_description', product_keywords = '$product_keywords', category_id = '$product_category', brand_id = '$product_brands', product_price = '$product_price', gender_id = '$product_gender', fabric = '$product_fabric', color = '$product_color', fit = '$product_fit', length = '$product_length'";

    if(($_FILES['product_image11']['name'] && $_FILES['product_image22']['name'] && $_FILES['product_image33']['name'] != "")){
        $product_image1 = $_FILES['product_image11']['name'];
        $product_image2 = $_FILES['product_image22']['name'];
        $product_image3 = $_FILES['product_image33']['name'];
        $temp_image1 = $_FILES['product_image11']['tmp_name'];
        $temp_image2 = $_FILES['product_image22']['tmp_name'];
        $temp_image3 = $_FILES['product_image33']['tmp_name'];
        $update_query .= ", `product_image1`='$product_image1', `product_image2`='$product_image2', `product_image3`='$product_image3'";
        
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");

        $q1 = "SELECT * FROM product WHERE `product_id`='$product_id'";
        $r = mysqli_query($con, $q1);
        while ($r1 = mysqli_fetch_assoc($r)) {
            $old_profile_pic1 = $r1['product_image1'];
            $old_profile_pic2 = $r1['product_image2'];
            $old_profile_pic3 = $r1['product_image3'];
            unlink("./product_images/" . $old_profile_pic1);
            unlink("./product_images/" . $old_profile_pic2);
            unlink("./product_images/" . $old_profile_pic3);
        }
    }

    $update_query .= " WHERE `product_id`='$product_id'";

    if (mysqli_query($con, $update_query)) {
?>
    <script>
        window.location.href = "product_view.php";
    </script>
<?php
    } else {
        echo "Error in updating data";
    }
}


if (!empty($_POST["sizes"])) {
    $selected_sizes = $_POST["sizes"];
    
    $existing_sizes_query = "SELECT size_id FROM product_size WHERE product_id = $product_id";
    $existing_sizes_result = mysqli_query($con, $existing_sizes_query);
    if (!$existing_sizes_result) {
        echo "Error retrieving existing product sizes: " . mysqli_error($con);
        exit();
    }
    
    $existing_sizes = array();
    while ($row = mysqli_fetch_assoc($existing_sizes_result)) {
        $existing_sizes[] = $row['size_id'];
    }
    
    $new_sizes = array_diff($selected_sizes, $existing_sizes);
    foreach ($new_sizes as $size_id) {
        $insert_query = "INSERT INTO product_size (product_id, size_id) VALUES ($product_id, $size_id)";
        $insert_result = mysqli_query($con, $insert_query);
        if (!$insert_result) {
            echo "Error inserting product sizes: " . mysqli_error($con);
            exit();
        }
    }
    
    $removed_sizes = array_diff($existing_sizes, $selected_sizes);
    foreach ($removed_sizes as $size_id) {
        $delete_query = "DELETE FROM product_size WHERE product_id = $product_id AND size_id = $size_id";
        $delete_result = mysqli_query($con, $delete_query);
        if (!$delete_result) {
            echo "Error deleting product sizes: " . mysqli_error($con);
            exit();
        }
    }
    
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <style>
        .container {
            margin-top: 50px;
        }
        .form-error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container ">
        <h1 class="text-center">Update Product</h1>
        <form id="update_product_form" action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4">
                <label for="product_title" class="form-label fs-5 fw-bold">Product Title:</label>
                <input type="text" class="form-control" name="product_title" id="product_title" placeholder="Enter Product Title" autocomplete="off" required="required" value="<?php echo $product_title; ?>">
                <p id="product_title_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <label for="description" class="form-label fs-5 fw-bold">Product Description:</label>
                <textarea class="form-control" name="product_description" id="description" placeholder="Enter Product Description" autocomplete="off" required="required"><?php echo $product_description; ?></textarea>
                <p id="description_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <label for="product_keywords" class="form-label fs-5 fw-bold">Product Keywords:</label>
                <input type="text" class="form-control" name="product_keywords" id="product_keywords" placeholder="Enter Product Keywords" autocomplete="off" required="required" value="<?php echo $product_keywords; ?>">
                <p id="product_keywords_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <label for="product_fabric" class="form-label fs-5 fw-bold">Product Fabric:</label>
                <input type="text" class="form-control" name="product_fabric" id="product_fabric" placeholder="Enter Product Fabric" autocomplete="off" required="required" value="<?php echo $product_fabric; ?>">
                <p id="product_fabric_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <label for="product_fit" class="form-label fs-5 fw-bold">Product Fit:</label>
                <input type="text" class="form-control" name="product_fit" id="product_fit" placeholder="Enter Product Fit" autocomplete="off" required="required" value="<?php echo $product_fit; ?>">
                <p id="product_fit_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <label for="product_color" class="form-label fs-5 fw-bold">Product Color:</label>
                <input type="text" class="form-control" name="product_color" id="product_color" placeholder="Enter Product Color" autocomplete="off" required="required" value="<?php echo $product_color; ?>">
                <p id="product_color_error" class="form-error"></p>
            </div>

            <?php
$sizes_query = "SELECT * FROM sizes";
$sizes_result = mysqli_query($con, $sizes_query);

if (mysqli_num_rows($sizes_result) > 0) {
    while ($row = mysqli_fetch_assoc($sizes_result)) {
        $size_id = $row["id"];
        $size_name = $row["size"];
        $checked = ''; 

        $check_query = "SELECT * FROM product_size WHERE product_id = $product_id AND size_id = $size_id";
        $check_result = mysqli_query($con, $check_query);
        if (mysqli_num_rows($check_result) > 0) {
            $checked = 'checked'; 
        }

        echo '<div class="form-outline form-check mb-4" style="display:inline-block;">';
        echo '<input type="checkbox" id="size_' . $size_id . '" name="sizes[]" value="' . $size_id . '" ' . $checked . '>';
        echo '<label for="size_' . $size_id . '">' . $size_name . '</label>';
        echo '</div>';
    }
} else {
    echo "No sizes found!";
}
?>


            <div class="form-outline mb-4">
                <label for="product_length" class="form-label fs-5 fw-bold">Product Length:</label>
                <input type="text" class="form-control" name="product_length" id="product_length" placeholder="Enter Product Length" autocomplete="off" required="required" value="<?php echo $product_length; ?>">
                <p id="product_length_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <select name="product_gender" id="product_gender" class="form-select">
                    <option value="">Select Gender</option>
                    <?php
                    $select_query = "SELECT * FROM `genders`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $gender_title = $row['gender_title'];
                        $gender_id = $row['gender_id'];
                        $selected = ($product_gender == $gender_id) ? 'selected' : '';
                        echo "<option value='$gender_id' $selected> $gender_title</option>";
                    }
                    ?>
                </select>
                <p id="product_gender_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <select name="product_category" id="product_category" class="form-select">
                    <option value="">Select Category</option>
                    <?php
                    $select_query = "SELECT * FROM `categories`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];
                        $selected = ($product_category == $category_id) ? 'selected' : '';
                        echo "<option value='$category_id' $selected> $category_title</option>";
                    }
                    ?>
                </select>
                <p id="product_category_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <select name="product_brands" id="product_brands" class="form-select">
                    <option value="">Select Brand</option>
                    <?php
                    $select_query = "SELECT * FROM `brands`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $brand_title = $row['brand_title'];
                        $brand_id = $row['brand_id'];
                        $selected = ($product_brands == $brand_id) ? 'selected' : '';
                        echo "<option value='$brand_id' $selected> $brand_title</option>";
                    }
                    ?>
                </select>
                <p id="product_brands_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <label for="product_price" class="form-label fs-5 fw-bold">Product Price:</label>
                <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Enter Product Price" autocomplete="off" required="required" value="<?php echo $product_price; ?>">
                <p id="product_price_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <img src='product_images/<?php echo $image1?>' width='80' height='80' class='' alt='...'>

                <label for="product_image1" class="form-label fs-5 fw-bold">Product Image 1:</label>
                <input type="file" class="form-control" name="product_image11" id="product_image11" >
            </div>

            <div class="form-outline mb-4">
            <img src='product_images/<?php echo $image2?>' width='80' height='80' class='' alt='...'>

                <label for="product_image2" class="form-label fs-5 fw-bold">Product Image 2:</label>
                <input type="file" class="form-control" name="product_image22" id="product_image22" >
            </div>

            <div class="form-outline mb-4">
            <img src='product_images/<?php echo $image3?>' width='80' height='80' class='' alt='...'>
                
                <label for="product_image3" class="form-label fs-5 fw-bold">Product Image 3:</label>
                <input type="file" class="form-control" name="product_image33" id="product_image33" >
            </div>
            <div class="form-outline mb-4">
            <input type="submit" class="btn btn-info form-control" name="update_product" value="Update Product" >

                <!-- <a class="btn btn-info " href="update_product.php?id=<?php echo $product_id ?>"  >update_product</a> -->
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            $('#update_product_form').validate({
              
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
