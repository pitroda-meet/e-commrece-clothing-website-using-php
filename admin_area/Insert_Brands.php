<!DOCTYPE html>
<html>
<head>
  <title>Insert Brand</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
include('../includes/connect.php'); 
if(isset($_POST['insert_brand'])){
    $brand_title=$_POST['brand_title'];

    $select_query="select * from `brands` where brand_title='$brand_title'";
    $result_select=mysqli_query($con, $select_query);
    $number=mysqli_num_rows($result_select);
    if($number>0){
        echo "<script>alert('This brand is already present in the database')</script>";
    }else{

        $insert_query="insert into `brands` (brand_title) values ('$brand_title')";
        $result=mysqli_query($con, $insert_query);
        if($result){
            echo "<script>alert('Brand Added Successfully!')</script>";
        }

    }
} 
?>

<h2 class="text-center">Insert brands</h2>
<form action="" method="post" id="brandForm" class="mb-2">
  <div class="input-group w-90 mb-2">
    <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
    <input type="text" class="form-control" name="brand_title" id="brand_title" placeholder="Insert brand" aria-label="brand" aria-describedby="basic-addon1">
  </div>
  <span id="error" style="color: red;"></span>
  <div class="input-group w-10 mb-2">
    <input type="submit" class="bg-info p-2 my-3 border-0" value="Insert Brand" name="insert_brand">
  </div>
</form>

<script>
$(document).ready(function(){
  $('#brandForm').submit(function(e){
    var brand_title = $('#brand_title').val();
    // Regular expression to match only alphabets
    var regex = /^[A-Za-z]+$/;
    if(!regex.test(brand_title)){
      $('#error').text('Please enter only alphabets');
      e.preventDefault(); // Prevent form submission
    } else if (brand_title.length > 20) {
      $('#error').text('Brand title should not exceed 20 characters');
      e.preventDefault(); // Prevent form submission
    }
  });
});
</script>

</body>
</html>
