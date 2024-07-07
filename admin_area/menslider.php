<?php
include('../includes/connect.php');
if(isset($_POST['slider_image1'])){
  $slider_title=$_POST['slider_title'];
  $slider_image = $_FILES['slider_image']['name'];
  $temp_image = $_FILES['slider_image']['tmp_name'];



  $select_query="select * from `menslider` where slider_title='$slider_title'";
  $result_select=mysqli_query($con, $select_query);
  $number=mysqli_num_rows($result_select);
  if($number>0){
      echo "<script>alert('This slider_title is already present in the database')</script>";
  }else{

    move_uploaded_file($temp_image, "./slider_image/$slider_image");

      $insert_query="insert into `menslider` (`slider_title`,`slider_image`) values ('$slider_title','$slider_image')";
      $result=mysqli_query($con, $insert_query);
      if($result){
          echo "<script>alert('slider image Added Successfully!')</script>";
      }

  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert slider_image Admin</title>
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
        <h1 class="text-center">Insert slider_image</h1>
        <form id="insert_slider" action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4">
                <label for="slider_title" class="form-label fs-5 fw-bold">slider Title:</label>
                <input type="text" class="form-control" name="slider_title" id="slider_title" placeholder="Enter Product Title" autocomplete="off" >
                <p id="slider_title_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <label for="slider_image" class="form-label fs-5 fw-bold">slider image men:</label>
                <input type="file" class="form-control" name="slider_image" id="slider_image" >
                <p id="slider_image_error" class="form-error"></p>
            </div>

            <div class="form-outline mb-4">
                <input type="submit" class="btn btn-info form-control" value="Insert Product" name="slider_image1">
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            $('#insert_slider').validate({
                rules: {
                  slider_title: {
                        required: true,
                        maxlength: 30
                    },
                    slider_image: {
                        required: true
                    }
                },
                messages: {
                  slider_title: {
                        required: "Please enter a product title",
                        maxlength: "Product title must not exceed 30 characters"
                    },
                    slider_image: {
                        required: "Please select product image 1"
                    }
                },
                errorPlacement: function(error, element) {
                    // Display error messages within <p> tags
                    error.appendTo(element.closest('.form-outline').find('.form-error'));
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
