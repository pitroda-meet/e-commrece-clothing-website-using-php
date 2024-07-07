<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        .table-responsive {
            overflow-x: auto;
        }
        /* Style for keyword and description columns */
        .keyword-column,
        .description-column {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>
<body>


    
    <div class="container mt-4">
        <h2 class="mb-4">Product List</h2>
        <div class="table-responsive">
            <?php
            include('../includes/connect.php');
            global $con;
            if ($con) {
                $sql = "SELECT * FROM product";
                $result = mysqli_query($con, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    echo "<table class='table table-striped table-bordered'>
                            <thead>
                                <tr class='text-center'>
                                      <th>image</th>
                                    <th>Title</th>
                                    
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Gender</th>
                                    <th>sold</th>
                                    
                                    <th>edit</th>
                                    <th>delete</th>
                                </tr>
                            </thead>
                            <tbody>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        $brand_id = $row['brand_id'];
                        $brand_query = "SELECT * FROM brands where brand_id=$brand_id";
                        $brand_result = mysqli_query($con, $brand_query);
                        $brand = "";
                        if ($brand_result && mysqli_num_rows($brand_result) > 0) {
                            $fetchbrand = mysqli_fetch_assoc($brand_result);
                            $brand = $fetchbrand['brand_title'];
                        }

                        $category_id = $row['category_id'];
                        $category_query = "SELECT * FROM categories where category_id=$category_id";
                        $category_result = mysqli_query($con, $category_query);
                        $category = "";
                        if ($category_result && mysqli_num_rows($category_result) > 0) {
                            $fetchcategory = mysqli_fetch_assoc($category_result);
                            $category = $fetchcategory['category_title'];
                        }

                        $gender_id = $row['gender_id'];
                        $gender_query = "SELECT * FROM genders where gender_id=$gender_id";
                        $gender_result = mysqli_query($con, $gender_query);
                        $gender = "";
                        if ($gender_result && mysqli_num_rows($gender_result) > 0) {
                            $fetchgender = mysqli_fetch_assoc($gender_result);
                            $gender = $fetchgender['gender_title'];
                        }
                        $product_image1=$row['product_image1'];
                        echo "<tr class='text-center'>
                                <td>
                                <img src='product_images/$product_image1' width='80' height='80' class='card-img-top' alt='...'>
                                </td>              
                                 <td>" . $row["product_title"] . "</td>
               
                                <td>" . $category. "</td>
                                <td>" . $brand . "</td>
                                <td>" . $row["product_price"] . "</td>
                                <td>" . $row["status"] . "</td>
                                <td>" . $gender . "</td>
                                <td>" . 0 . "</td>
                                
                                <td>
                                    <a href='edit_product.php?id=" . $row["product_id"] . "' class='btn btn-primary btn-sm'>Update</a>
                                    </td>
                                    <td>

                                    <a href='delete_product.php?id=" . $row["product_id"] . "' class='btn btn-danger btn-sm'>Delete</a>
                                </td>
                              </tr>";
                    }
                    echo "</tbody>
                          </table>";
                } else {
                    echo "0 results";
                }

                mysqli_close($con);
            } else {
                echo "Failed to connect to the database.";
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
