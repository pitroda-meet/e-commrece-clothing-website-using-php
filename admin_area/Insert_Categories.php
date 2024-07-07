<?php
include('../includes/connect.php'); 
if(isset($_POST['insert_cat'])){
    $category_title=$_POST['cat_title'];

    //select data form db
    $select_query="select * from `categories` where category_title='$category_title'";
    $result_select=mysqli_query($con, $select_query);
    $number=mysqli_num_rows($result_select);
    if($number>0){
        echo "<script>alert('this Category is present in database')</script>";
    }else{

        $insert_query="insert into `categories` (category_title) values ('$category_title')";
        $result=mysqli_query($con, $insert_query);
        if($result){
            echo "<script>alert('Category Added Successfully!')</script>";
        }

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
<h2 class="text-center">Insert Categories </h2>
<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
  <span class="input-group-text  bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" name="cat_title" placeholder="inset Catagarios" aria-label="Catagarios" aria-describedby="basic-addon1">
</div>

<div class="input-group w-10 mb-2 ms-auto">
  <input type="submit"  value="insert Catagarios"  class="bg-info p-2 my-3 border-0" name="insert_cat" >
</div>
</form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</html>
