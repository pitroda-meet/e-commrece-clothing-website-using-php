<?php
include('../includes/connect.php'); 
if(isset($_POST['insert_accessories'])){
    $accessories_title=$_POST['accessories_title'];

    //select data form db
    $select_query="select * from `accessories` where accessories_title='$accessories_title'";
    $result_select=mysqli_query($con, $select_query);
    $number=mysqli_num_rows($result_select);
    if($number>0){
        echo "<script>alert('this accessories is present in database')</script>";
    }else{

        $insert_query="insert into `accessories` (accessories_title) values ('$accessories_title')";
        $result=mysqli_query($con, $insert_query);
        if($result){
            echo "<script>alert('Category Added Successfully!')</script>";
        }

    }
} 
?>
<h2 class="text-center">Insert Categories </h2>
<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
  <span class="input-group-text  bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" name="accessories_title" placeholder="inset accessories" aria-label="Catagarios" aria-describedby="basic-addon1">
</div>

<div class="input-group w-10 mb-2 ms-auto">
  <input type="submit"  value="insert accessories"  class="bg-info p-2 my-3 border-0" name="insert_accessories" >
</div>
</form>