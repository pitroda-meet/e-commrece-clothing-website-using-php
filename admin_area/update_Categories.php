<?php
include('../includes/connect.php');

// Insert Category
if(isset($_POST['insert_cat'])){
    $category_title=$_POST['cat_title'];

    // Check if category already exists
    $select_query="SELECT * FROM categories WHERE category_title='$category_title'";
    $result_select=mysqli_query($con, $select_query);
    $number=mysqli_num_rows($result_select);

    if($number>0){
        echo "<script>alert('This category is already present in the database')</script>";
    } else {
        $insert_query="INSERT INTO categories (category_title) VALUES ('$category_title')";
        $result=mysqli_query($con, $insert_query);
        
        if($result){
            echo "<script>alert('Category Added Successfully!')</script>";
        }
    }
} 

// Update Category
if(isset($_POST['update_cat'])){
    $category_id = $_POST['category_id'];
    $new_category_title = $_POST['new_category_title'];

    $update_query = "UPDATE categories SET category_title = '$new_category_title' WHERE category_id = '$category_id'";
    $update_result = mysqli_query($con, $update_query);

    if($update_result) {
        echo "<script>alert('Category updated successfully!');</script>";
    } else {
        echo "<script>alert('Failed to update category.');</script>";
    }
}

// Delete Category
if(isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    
    // Delete category
    $delete_query = "DELETE FROM categories WHERE category_id = '$category_id'";
    $delete_result = mysqli_query($con, $delete_query);
    
    if($delete_result) {
        echo "<script>alert('Category deleted successfully!');</script>";
    } else {
        echo "<script>alert('Failed to delete category.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<body>
  <div class="container">
    <h2 class="text-center">Categories</h2>

    <!-- Insert Category Form -->
    <form action="" method="post" class="mb-2">
      <div class="input-group mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert Category" aria-label="Category" aria-describedby="basic-addon1">
      </div>
      <div class="input-group">
        <input type="submit" value="Insert Category" class="btn btn-info" name="insert_cat">
      </div>
    </form>

    <!-- Categories Table -->
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
        // Fetch categories from database
        $select_query = "SELECT * FROM categories";
        $result_select = mysqli_query($con, $select_query);

        if(mysqli_num_rows($result_select) > 0){
            while($row = mysqli_fetch_assoc($result_select)){
                $category_id = $row['category_id'];
                $category_title = $row['category_title'];
                echo "<tr>
                        <td>$category_id</td>
                        <td>$category_title</td>
                        <td>
                          <form method='post' class='d-inline'>
                            <input type='hidden' name='category_id' value='$category_id'>
                            <input type='text' name='new_category_title' placeholder='New Title' required>
                            <button type='submit' class='btn btn-primary btn-sm' name='update_cat'>Update</button>
                          </form>
                          <a href='delete_categories.php?id=$category_id' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No categories found</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</html>
