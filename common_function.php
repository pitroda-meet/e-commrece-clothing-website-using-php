<?php
include('./includes/connect.php');

function getproduct(){
    global $con;

    if(!isset($_GET['category'])){
        if(!isset($_GET['brands'])){
            if(!isset($_GET['accessoriess'])){

            $select_query = "select * from `product` order by rand() limit 0,9";
            $result_query = mysqli_query($con,$select_query);
            while($row = mysqli_fetch_assoc($result_query)){
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                
                echo "<div class='col-lg-3 col-md-4 col-sm-6 mb-4 '>
                        <div class='card product-card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='...'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>Price:$product_price/-</p>
                                <a href='na.php?add_to_cart=$product_id' class='btn btn-primary add-to-cart'>Add to Cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-primary view'>View</a>
                            </div>
                        </div>
                    </div>";
            }
        }
    }
}
}

// get all product
function get_all_product(){
    global $con;

    if(!isset($_GET['category'])){
        if(!isset($_GET['brands'])){
            if(!isset($_GET['accessoriess'])){
            
            $select_query = "select * from `product` order by rand() limit 0,9";
            $result_query = mysqli_query($con,$select_query);
            while($row = mysqli_fetch_assoc($result_query)){
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                
                echo "<div class='col-lg-3 col-md-4 col-sm-6 mb-4 '>
                        <div class='card product-card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='...'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>Price:$product_price/-</p>
                                <a href='na.php?add_to_cart=$product_id' class='btn btn-primary add-to-cart'>Add to Cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-primary view'>View</a>
                            </div>
                        </div>
                    </div>";
            }
        }
    }
}
}

// get unique catagarios
function get_unique_categories(){
    global $con;

    if(isset($_GET['category'])){
        
            $category_id=$_GET['category'];
            $select_query = "select * from `product` where category_id=$category_id";
            $result_query = mysqli_query($con,$select_query);
            $num_of_row=mysqli_num_rows($result_query);
            if($num_of_row==0){
                echo "<h2 class='text-center text-danger'>no stock for this category</h2> ";
            }
            while($row = mysqli_fetch_assoc($result_query)){
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                
                echo "<div class='col-lg-3 col-md-4 col-sm-6 mb-4 '>
                        <div class='card product-card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='...'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>Price:$product_price/-</p>
                                <a href='na.php?add_to_cart=$product_id' class='btn btn-primary add-to-cart'>Add to Cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-primary view'>View</a>
                            </div>
                        </div>
                    </div>";
            }
        }
    }
    function get_unique_brands(){
        global $con;
    
        if(isset($_GET['brands'])){
            
                $brand_id=$_GET['brands'];
                $select_query = "select * from `product` where brand_id=$brand_id";
                $result_query = mysqli_query($con,$select_query);
                $num_of_row=mysqli_num_rows($result_query);
                if($num_of_row==0){
                    echo "<h2 class='text-center text-danger '>no stock for this brands</h2> ";
                }
                while($row = mysqli_fetch_assoc($result_query)){
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_description = $row['product_description'];
                    $product_image1 = $row['product_image1'];
                    $product_price = $row['product_price'];
                    $category_id = $row['category_id'];
                    $brand_id = $row['brand_id'];
                    
                    echo "<div class='col-lg-3 col-md-4 col-sm-6 mb-4 '>
                            <div class='card product-card'>
                                <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>Price:$product_price/-</p>
                                    <a href='na.php?add_to_cart=$product_id' class='btn btn-primary add-to-cart'>Add to Cart</a>
                                    <a href='product_details.php?product_id=$product_id' class='btn btn-primary view'>View</a>
                                    </div>
                            </div>
                        </div>";
                }
            }
        }


        function get_unique_accesories(){
            global $con;
        
            if(isset($_GET['accesoriess'])){
                
                    $accesories_id=$_GET['accesoriess'];
                    $select_query = "select * from `product` where accesories_id=$accesories_id";
                    $result_query = mysqli_query($con,$select_query);
                    $num_of_row=mysqli_num_rows($result_query);
                    if($num_of_row==0){
                        echo "<h2 class='text-center text-danger'>no stock for this category</h2> ";
                    }
                    while($row = mysqli_fetch_assoc($result_query)){
                        $product_id = $row['product_id'];
                        $product_title = $row['product_title'];
                        $product_description = $row['product_description'];
                        $product_image1 = $row['product_image1'];
                        $product_price = $row['product_price'];
                        $category_id = $row['category_id'];
                        $brand_id = $row['brand_id'];
                        
                        echo "<div class='col-lg-3 col-md-4 col-sm-6 mb-4 '>
                                <div class='card product-card'>
                                    <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='...'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$product_title</h5>
                                        <p class='card-text'>Price:$product_price/-</p>
                                        <a href='na.php?add_to_cart=$product_id' class='btn btn-primary add-to-cart'>Add to Cart</a>
                                        <a href='product_details.php?product_id=$product_id' class='btn btn-primary view'>View</a>
                                    </div>
                                </div>
                            </div>";
                    }
                }
            }
         

function getcategories(){
    global $con;

    
    $category_title="select * from `categories`";
    $result_category=mysqli_query($con,$category_title);
    echo '<ul class="nav flex-column">';
    while($row_data1=mysqli_fetch_assoc($result_category)){
        $category_title=$row_data1['category_title'];
        $category_id=$row_data1['category_id'];
        echo "<ul>";
        echo "<li ><a href='na.php?category=$category_id' >$category_title</a></li>";
        echo "</ul>";
    }
    echo '</ul>';
}

function getbrands(){
    global $con;
    $select_brands="select * from `brands`";
    $result_brands=mysqli_query($con,$select_brands);
    echo '<ul class="nav flex-column">';
    while($row_data= mysqli_fetch_assoc($result_brands)){
        $brand_title=$row_data['brand_title'];
        $brand_id=$row_data['brand_id'];
        echo "<ul>";
        echo "<li >
                <a href='na.php?brands=$brand_id' class=' text-dark'>$brand_title</a>
              </li>";
        echo "</ul>";
       

    }
    echo '</ul>';
}

function get_accesories(){
    global $con;

    
    $accessories_title="select * from `accessories`";
    $result_category=mysqli_query($con,$accessories_title);
    echo '<ul class="nav flex-column">';
    while($row_data1=mysqli_fetch_assoc($result_category)){
        $accessories_title=$row_data1['accessories_title'];
        $accessories_id=$row_data1['accessories_id'];
        echo "<ul>";
        echo "<li ><a href='na.php?accessoriess=$accessories_id' >$accessories_title</a></li>";
        echo "</ul>";
    }
    echo '</ul>';
}
function search_products(){
             global $con;
             if(isset($_GET['search_data_product'])){
            $search_data_value=$_GET['search_data'];    
            $search_query = "select * from `product` where product_keywords like'%$search_data_value%'";
            $result_query = mysqli_query($con,$search_query);
            $num_of_row=mysqli_num_rows($result_query);
            if($num_of_row==0){
                echo "<h2 class='text-center text-danger'>no result match . no product on this category found </h2> ";
            }
            while($row = mysqli_fetch_assoc($result_query)){
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                
  

                echo "<div class='col-lg-3 col-md-4 col-sm-6 mb-4 '>
                        <div class='card product-card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='...'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>Price:$product_price/-</p>
                                <a href='na.php?add_to_cart=$product_id' class='btn btn-primary '>Add to Cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-primary view'>View</a>
                            </div>
                        </div>
                    </div>";
            }
        }
    }

   

    function view_details(){
        global $con;
        if(isset($_GET['product_id'])){
            if(!isset($_GET['category'])){
                if(!isset($_GET['brands'])){
                    $product_id = $_GET['product_id'];
                    $select_query = "SELECT * FROM `product` WHERE product_id='$product_id'";
                    $result_query = mysqli_query($con, $select_query);
                    while($row = mysqli_fetch_assoc($result_query)){
                        $product_id = $row['product_id'];
                        $product_title = $row['product_title'];
                        $product_description = $row['product_description'];
                        $product_image1 = $row['product_image1'];
                        $product_image2 = $row['product_image2'];
                        $product_image3 = $row['product_image3'];
                        $product_price = $row['product_price'];
                        $category_id = $row['category_id'];
                        $brand_id = $row['brand_id'];
                        
                        $product_fabric = $row['fabric'];
                        $product_color = $row['color'];
                        $product_fit = $row['fit'];
                        $product_length = $row['length'];

                        $brand_query="SELECT * from brands where  brand_id='$brand_id' ";
                        $brand_result=mysqli_query($con,$brand_query );
                        while($brand_row=mysqli_fetch_assoc( $brand_result )){
                            $brand_title = $brand_row['brand_title'];
                        }

                        


                        $size_query = "SELECT sizes.size FROM sizes INNER JOIN product_size ON sizes.id = product_size.size_id WHERE product_size.product_id = $product_id";

                        $size_result = mysqli_query($con, $size_query);
                        if (!$size_result) {
                            echo "Error: " . mysqli_error($con);
                        } else {
                            $sizes = array();
                            while($size_row = mysqli_fetch_assoc($size_result)) {
                                $sizes[] = $size_row['size'];
                            }
                        }
                        
    
                        // Dynamically generate size options
                       // Dynamically generate size options
                        $sizeOptions = '';
                        foreach ($sizes as $size) {
                            $sizeOptions .= "<li class='list-inline-item'><label><input type='radio' name='size' id='size_$size' value='$size' class='hidden-radio' style='display: none;'><span class='btn btn-success btn-size'>$size</span></label></li>";
                        }

                    
                        echo "<div class='col-lg-6 '>
                        <div class='card mb-3'>
                            <img class='card-img img-fluid' src='./admin_area/product_images/$product_image1' style='height: 450px;' alt='Card image cap' id='product-detail'>
                        </div>
                        <div class='row'>
                            <!--Start Controls-->
                            <div class='col-1 align-self-center'>
                                <a href='#multi-item-example' role='button' data-bs-slide='prev'>
                                    <i class='text-dark fas fa-chevron-left'></i>
                                    <span class='sr-only'>Previous</span>
                                </a>
                            </div>
                            
                            <!--End Controls-->
                            <!--Start Carousel Wrapper-->
                            <div id='multi-item-example' class='col-10 carousel slide carousel-multi-item' data-bs-ride='carousel'>
                                <!--Start Slides-->
                                <div class='carousel-inner product-links-wap' role='listbox'>
                    
                                    <!--First slide-->
                                    <div class='carousel-item active'>
                                        <div class='row'>
                                            <div class='col-4'>
                                                <a href='#'>
                                                <img class='card-img img-fluid' src='./admin_area/product_images/$product_image1' alt='Card image cap' id='product-detail'>
                                                </a>
                                            </div>
                                            <div class='col-4'>
                                                <a href='#'>
                                                <img class='card-img img-fluid' src='./admin_area/product_images/$product_image2' alt='Card image cap' id='product-detail'>
                                                </a>
                                            </div>
                                            <div class='col-4'>
                                                <a href='#'>
                                                <img class='card-img img-fluid' src='./admin_area/product_images/$product_image3' alt='Card image cap' id='product-detail'>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/.First slide-->
                    
                                    <!--Second slide-->
                                    <div class='carousel-item'>
                                        <div class='row'>
                                            <div class='col-4'>
                                                <a href='#'>
                                                <img class='card-img img-fluid' src='./admin_area/product_images/$product_image1' alt='Card image cap' id='product-detail'>
                                                </a>
                                            </div>
                                            <div class='col-4'>
                                                <a href='#'>
                                                <img class='card-img img-fluid' src='./admin_area/product_images/$product_image2' alt='Card image cap' id='product-detail'>
                                                </a>
                                            </div>
                                            <div class='col-4'>
                                                <a href='#'>
                                                <img class='card-img img-fluid' src='./admin_area/product_images/$product_image3' alt='Card image cap' id='product-detail'>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/.Second slide-->
                    
                                    <!--Third slide-->
                                    <div class='carousel-item'>
                                        <div class='row'>
                                            <div class='col-4'>
                                                <a href='#'>
                                                <img class='card-img img-fluid' src='./admin_area/product_images/$product_image1' alt='Card image cap' id='product-detail'>
                                                </a>
                                            </div>
                                            <div class='col-4'>
                                                <a href='#'>
                                                <img class='card-img img-fluid' src='./admin_area/product_images/$product_image2' alt='Card image cap' id='product-detail'>
                                                </a>
                                            </div>
                                            <div class='col-4'>
                                                <a href='#'>
                                                <img class='card-img img-fluid' src='./admin_area/product_images/$product_image3' alt='Card image cap' id='product-detail'>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/.Third slide-->
                                </div>
                                <!--End Slides-->
                            </div>
                            <!--End Carousel Wrapper-->
                            <!--Start Controls-->
                            <div class='col-1 align-self-center'>
                                <a href='#multi-item-example' role='button' data-bs-slide='next'>
                                    <i class='text-dark fas fa-chevron-right'></i>
                                    <span class='sr-only'>Next</span>
                                </a>
                            </div>
                            <!--End Controls-->
                        </div>
                    </div>
                    <div class='col-lg-6 '>
                        <div class='card'>
                            <div class='card-body'>
                                <h1 class='h2'>$product_title</h1>
                                <p class='h3 py-2'>$product_price</p>
                                <p class='py-2'>
                                    <i class='fa fa-star text-warning'></i>
                                    <i class='fa fa-star text-warning'></i>
                                    <i class='fa fa-star text-warning'></i>
                                    <i class='fa fa-star text-warning'></i>
                                    <i class='fa fa-star text-secondary'></i>
                                    <span class='list-inline-item text-dark'>Rating 4.8 | 36 Comments</span>
                                </p>
                                <ul class='list-inline'>
                                    <li class='list-inline-item'>
                                        <h6>Brand:</h6>
                                    </li>
                                    <li class='list-inline-item'>
                                        <p class='text-muted'><strong>$brand_title</strong></p>
                                    </li>
                                </ul>
                    
                                <h6 >Description:</h6>
                                <p>$product_description</p>
                              
                    
                                <h6 class='mt-4'>Specification:</h6>
                                <ul class='list-unstyled pb-3'>
                                <div class='row'>
                                <div class='col-lg-6 col-md-6 col-xl-6 col-xxl-6'>
                                  <ul style='list-style:none'>
                                    <li><strong>Fabric:</strong>  $product_fabric</li>
                                    <li><strong>Fit:</strong> $product_fit</li>
                                  </ul>
                                </div>
                                <div class='col-lg-6 col-md-6 col-xl-6 col-xxl-6'>
                                  <ul style='list-style:none'>
                                    <li><strong>Color:</strong> $product_color</li>
                                    <li><strong>Length:</strong> $product_length</li>
                                  </ul>
                                </div>
                                </ul>
                                <form action='na.php?add_to_cart=$product_id' id='productForm' method='get'>
                                    <input type='hidden' name='product-title' value='Activewear'>
                                    <div class='row'>
                                        <div class='col-auto'>
                                            <ul class='list-inline pb-3'>
                                                <li class='list-inline-item'>Size :
                                                    <input type='hidden' name='product_size' id='product-size' value='S'>
                                                </li>
                                                 $sizeOptions
                                            </ul>
                                        </div>
                                     
                                    </div>
                                    <div id='errorMessageContainer' style='margin-top: 10px;color:red;'></div>

                                    <div class='row pb-3'>
                                        <div class='col d-grid'>
                                        <a href='na.php?add_to_cart=$product_id' id='addToCartBtn' class='btn btn-success btn-lg'> <i class='fa fa-shopping-cart'></i> Cart</a>
                                        </div>
                                        <div class='col d-grid'>
                                        <a href='home.php' class='btn btn-success btn-lg'>go home  </a>
                                        </div>
                                    </div>
                                </form>

                               
                                <div class='row'>
                                    <div class='col-lg-6 col-md-6 col-sm-12'>
                                    <h6>SHIPPING</h6>
                                    <p>Products ship within 2-3 working days with tracking.</p>
                                    </div>
                                    <div class='col-lg-6 col-md-6 col-sm-12'>
                                    <h6>RETURNS</h6>
                                    <p>We offer a 7-day return policy. Contact us for returns. Item must be in original condition. Shipping fees apply. Refunds processed promptly.</p>
                                    </div>
                                </div>

                    
                            </div>
                        </div>
                    </div>
                    ";
                    }
                    
                }
            }
        }
    }
    
    
    
// get ip fun

function getIPAddress() {  
    // Whether the IP is from the shared internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  
        $ip = $_SERVER['HTTP_CLIENT_IP'];  
    }  
    // Whether the IP is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }  
    // Whether the IP is from the remote address  
    else {  
        $ip = $_SERVER['REMOTE_ADDR'];  
    }  
    return $ip;  
    
}  
function cart(){
//    if(isset($_GET['add_to_cart'])){
//     global $con;
//     $email=$_SESSION['email'];

//     $get_product_id = $_GET['add_to_cart'];
//     $select_query="select * from `cart_details` where email='$email' and product_id=$get_product_id";
//     $result_query=mysqli_query($con,$select_query);
//     $num_of_row=mysqli_num_rows($result_query);
//     if($num_of_row>0){
//         echo "<script>alert('This item Is Already Added To Your Cart')</script>";
//         echo "<script>window.open('na.php','_self')</script>";
//     }
//     else{
//         $insert_query= "INSERT INTO `cart_details`(`product_id`,quantity,`email`) VALUES ($get_product_id,1,'$email')"; 
//         $result_query=mysqli_query($con,$insert_query);
//         echo "<script>alert('item Added To Your Cart')</script>";
//         echo "<script>window.open('na.php','_self')</script>";
//     }
// } 
}
 
//car number
function cart_item(){
    if(isset($_GET['add_to_cart'])){
        global $con;
        $email=$_SESSION['email'];

        // $get_ip = getIPAddress();
        $select_query="select * from `cart_details` where email='$email'";
        $result_query=mysqli_query($con,$select_query);
        $count_cart_item=mysqli_num_rows($result_query);
    }
        else{
            global $con;
            $email=$_SESSION['email'];

            // $get_ip = getIPAddress();
            $select_query="select * from `cart_details` where email='$email'";
            $result_query=mysqli_query($con,$select_query);
            $count_cart_item=mysqli_num_rows($result_query);
        }
        echo "$count_cart_item";
    } 

    function total_cart_price(){
        global $con;
        // $get_ip=getIPAddress();
        $total=0;
        $email=$_SESSION['email'];

        $cart_query="select * from  `cart_details` where email='$email'";
        $result=mysqli_query($con,$cart_query);
        while($row=mysqli_fetch_array($result)) {
            $product_id= $row["product_id"];
            $select_products="select * from `product` where product_id='$product_id'";
            $result_products=mysqli_query($con,$select_products);
            while($row_product_price=mysqli_fetch_array($result_products)){
                $product_price=array($row_product_price['product_price']);
                $product_values=array_sum($product_price);
                $total+=$product_values;
        }
    }
    echo $total;
}



