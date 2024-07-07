<?php
include('../includes/connect.php');

if(isset($_POST['insert_product'])) {
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

    $product_status = true;

    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    // accessing temp name
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    // Check if all required fields are filled
    if($product_title =='' or $product_description=='' or $product_keywords=='' or $product_brands==""  or $product_price=="" or $product_image1=='' or $product_image2=='' or $product_image3==''){
        echo "<script>alert('Please fill all the available fields')</script>";
        exit();
    }  
    else{
        // Move uploaded files to the destination directory
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");

        // Insert product data into the database
        $insert_query = "INSERT INTO `product` (product_title, product_description, product_keywords, category_id, brand_id, product_image1, product_image2, product_image3, product_price, date, status,gender_id,fabric,color,fit,length) VALUES ('$product_title','$product_description','$product_keywords','$product_category','$product_brands','$product_image1','$product_image2','$product_image3','$product_price',NOW(),'$product_status','$product_gender','$product_fabric','$product_color','$product_fit','$product_length')";
        $result_query = mysqli_query($con, $insert_query);

        if($result_query){
            $product_id = mysqli_insert_id($con);

            // Insert selected sizes into product_sizes table
            if (!empty($_POST["sizes"])) {
                foreach ($_POST["sizes"] as $size_id) {
                    $insert_product_size_query = "INSERT INTO product_size (product_id, size_id) VALUES ($product_id, $size_id)";
                    $result_query_size = mysqli_query($con, $insert_product_size_query);
                    if (!$result_query_size) {
                        echo "Error inserting sizes: " . mysqli_error($con);
                        exit(); // Exit the script if insertion of sizes fails
                    }
                }
                ?>
            <script>
                window.location.href = "product_view.php";
            </script>
            <?php

                echo "<script>alert('Inserted product successfully')</script>";
            }
        } else {
            // Display error message if insertion failed
            echo "Error inserting product: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Add jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Add jQuery Validation Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <style>
        
        .container {
            margin-top: 50px; /* Adjust margin top as needed */
        }
        .form-error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body class="bg-light">
    
    <div class="container">
        <h1 class="text-center">Insert  Product</h1>
        <form id="insert_product_form" action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4">
                <label for="product_title" class="form-label fs-5 fw-bold">Product Title:</label>
                <input type="text" class="form-control" name="product_title" id="product_title" placeholder="Enter Product Title" autocomplete="off" required="required">
                <p id="product_title_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <label for="description" class="form-label fs-5 fw-bold">Product Description:</label>
                <input type="text" class="form-control" name="product_description" id="description" placeholder="Enter Product Description" autocomplete="off" required="required">
                <p id="description_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <label for="product_keywords" class="form-label fs-5 fw-bold">Product Keywords:</label>
                <input type="text" class="form-control" name="product_keywords" id="product_keywords" placeholder="Enter Product Keywords" autocomplete="off" required="required">
                <p id="product_keywords_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <label for="product_fabric" class="form-label fs-5 fw-bold">Product fabric:</label>
                <input type="text" class="form-control" name="product_fabric" id="product_fabric" placeholder="Enter Product fabric" autocomplete="off" required="required">
                <p id="product_fabric_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <label for="product_fit" class="form-label fs-5 fw-bold">Product fit:</label>
                <input type="text" class="form-control" name="product_fit" id="product_fit" placeholder="Enter Product fit" autocomplete="off" required="required">
                <p id="product_fit_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <label for="product_color" class="form-label fs-5 fw-bold">Product color:</label>
                <input type="text" class="form-control" name="product_color" id="product_color" placeholder="Enter product color" autocomplete="off" required="required">
                <p id="product_color_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <label for="product_length" class="form-label fs-5 fw-bold">Product length:</label>
                <input type="text" class="form-control" name="product_length" id="product_length" placeholder="Enter product_length" autocomplete="off" required="required">
                <p id="product_length_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <select name="product_gender" id="product_gender" class="form-select">
                    <option value="">Select gender</option>
                    <?php
                    // Your PHP code to fetch and display categories
                    $select_query = "SELECT * FROM `genders`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $gender_title = $row['gender_title'];
                        $gender_id = $row['gender_id'];
                        echo "<option value='$gender_id'> $gender_title</option>";
                    }
                    ?>
                </select>
                <p id="product_gender_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <select name="product_category" id="product_category" class="form-select">
                    <option value="">Select Category</option>
                    <?php
                    // Your PHP code to fetch and display categories
                    $select_query = "SELECT * FROM `categories`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];
                        echo "<option value='$category_id'> $category_title</option>";
                    }
                    ?>
                </select>
                <p id="product_category_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <select name="product_brands" id="product_brands" class="form-select">
                    <option value="">Select Brand</option>
                    <?php
                    // Your PHP code to fetch and display brands
                    $select_query = "SELECT * FROM `brands`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $brand_title = $row['brand_title'];
                        $brand_id = $row['brand_id'];
                        echo "<option value='$brand_id'> $brand_title</option>";
                    }
                    ?>
                </select>
                <p id="product_brands_error" class="form-error"></p>
            </div>

            <?php 
            // Your PHP code to fetch and display sizes as checkboxes
            $sizes_query = "SELECT * FROM sizes";
            $sizes_result = mysqli_query($con, $sizes_query);

            if (mysqli_num_rows($sizes_result) > 0) {
                while ($row = mysqli_fetch_assoc($sizes_result)) {
                    echo '<div class="form-outline form-check mb-4" style="display:inline-block;">';
                    echo '<input type="checkbox" id="size_' . $row["id"] . '" name="sizes[]" value="' . $row["id"] . '">';
                    echo '<label for="size_' . $row["id"] . '">' . $row["size"] . '</label>';
                    echo '</div>';
                }   
            } else {
                echo "No sizes found!";
            }
            ?>

            <div class="form-outline mb-4">
                <label for="product_image1" class="form-label fs-5 fw-bold">Product Image 1:</label>
                <input type="file" class="form-control" name="product_image1" id="product_image1" required="required">
                <p id="product_image1_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <label for="product_image2" class="form-label fs-5 fw-bold">Product Image 2:</label>
                <input type="file" class="form-control" name="product_image2" id="product_image2" required="required">
                <p id="product_image2_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <label for="product_image3" class="form-label fs-5 fw-bold">Product Image 3:</label>
                <input type="file" class="form-control" name="product_image3" id="product_image3" required="required">
                <p id="product_image3_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <label for="product_price" class="form-label fs-5 fw-bold">Product Price:</label>
                <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Enter Product Price" autocomplete="off" required="required">
                <p id="product_price_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <input type="submit" class="btn btn-info form-control" value="Insert Product" name="insert_product">
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            $('#insert_product_form').validate({
                rules: {
                    product_title: {
                        required: true,
                        maxlength: 30
                    },
                    description: {
                        required: true,
                        maxlength: 200
                    },
                    product_keywords: {
                        required: true,
                        maxlength: 200
                    },
                    product_category: {
                        required: true
                    },
                    product_brands: {
                        required: true
                    },
                    product_image1: {
                        required: true
                    },
                    product_image2: {
                        required: true
                    },
                    product_image3: {
                        required: true
                    },
                    product_price: {
                        required: true,
                        number: true
                    }
                },
                messages: {
                    product_title: {
                        required: "Please enter a product title",
                        maxlength: "Product title must not exceed 15 characters"
                    },
                    description: {
                        required: "Please enter a product description",
                        maxlength: "Product description must not exceed 100 characters"
                    },
                    product_keywords: {
                        required: "Please enter product keywords",
                        maxlength: "Product keywords must not exceed 100 characters"
                    },
                    product_category: {
                        required: "Please select a product category"
                    },
                    product_brands: {
                        required: "Please select a product brand"
                    },
                    product_image1: {
                        required: "Please select product image 1"
                    },
                    product_image2: {
                        required: "Please select product image 2"
                    },
                    product_image3: {
                        required: "Please select product image 3"
                    },
                    product_price: {
                        required: "Please enter a product price",
                        number: "Please enter a valid number"
                    }
                },
                errorPlacement: function(error, element) {
                    // Display error messages within <p> tags
                    error.appendTo(element.closest('.form-outline').find('.form-error'));
                }
            });
        });
    </script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>
