<!DOCTYPE html>
<html>
<head>
  <title>Manage Brands</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
include('../includes/connect.php'); 

// Insert Brand
if(isset($_POST['insert_brand'])){
    $brand_title=$_POST['brand_title'];

    $select_query="SELECT * FROM `brands` WHERE brand_title='$brand_title'";
    $result_select=mysqli_query($con, $select_query);
    $number=mysqli_num_rows($result_select);

    if($number > 0){
        echo "<script>alert('This brand is already present in the database')</script>";
    } else {
        $insert_query="INSERT INTO `brands` (brand_title) VALUES ('$brand_title')";
        $result=mysqli_query($con, $insert_query);
        if($result){
            echo "<script>alert('Brand Added Successfully!')</script>";
        }
    }
} 

// Update Brand
if(isset($_POST['update_brand'])){
    $brand_id = $_POST['brand_id'];
    $new_brand_title = $_POST['new_brand_title'];

    $update_query = "UPDATE brands SET brand_title = '$new_brand_title' WHERE brand_id = '$brand_id'";
    $update_result = mysqli_query($con, $update_query);

    if($update_result) {
        echo "<script>alert('Brand updated successfully!');</script>";
    } else {
        echo "<script>alert('Failed to update brand.');</script>";
    }
}

// Delete Brand
if(isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['brand_id'])) {
    $brand_id = $_GET['brand_id'];
    
    // Delete brand
    $delete_query = "DELETE FROM brands WHERE brand_id = '$brand_id'";
    $delete_result = mysqli_query($con, $delete_query);
    
    if($delete_result) {
        echo "<script>alert('Brand deleted successfully!');</script>";
    } else {
        echo "<script>alert('Failed to delete brand.');</script>";
    }
}
?>

<h2 class="text-center">Manage Brands</h2>

<!-- Insert Brand Form -->
<form action="" method="post" class="mb-2">
  <div class="input-group w-90 mb-2">
    <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
    <input type="text" class="form-control" name="brand_title" placeholder="Insert Brand" aria-label="Brand" aria-describedby="basic-addon1" required>
  </div>
  <div class="input-group w-10 mb-2">
    <input type="submit" class="bg-info p-2 my-3 border-0" value="Insert Brand" name="insert_brand">
  </div>
</form>

<!-- Brands Table -->
<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Fetch brands from database
    $select_query = "SELECT * FROM brands";
    $result_select = mysqli_query($con, $select_query);

    if(mysqli_num_rows($result_select) > 0){
        while($row = mysqli_fetch_assoc($result_select)){
            $brand_id = $row['brand_id'];
            $brand_title = $row['brand_title'];
            echo "<tr>
                    <td>$brand_id</td>
                    <td>
                      <form method='post'>
                        <input type='hidden' name='brand_id' value='$brand_id'>
                        <input type='text' name='new_brand_title' value='$brand_title' required>
                        <button type='submit' class='btn btn-primary btn-sm' name='update_brand'>Update</button>
                      </form>
                    </td>
                    <td>
                      <a href='delete_brands.php?id=$brand_id' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No brands found</td></tr>";
    }
    ?>
  </tbody>
</table>

</body>
</html>
