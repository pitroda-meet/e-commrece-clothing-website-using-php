<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->

  <link rel="stylesheet" href="style.css">
  <style>
    /* Add your custom styles here */
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php?insert_product">Insert Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?product_view">View Product</a>
        </li>

        <!-- <li class="nav-item">
          <a class="nav-link" href="index.php?Insert_Categories">Insert Categories</a>
        </li> -->
        
          <li class="nav-item">
            <a class="nav-link" href="index.php?update_Categories">update Categories</a>
          </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="index.php?Insert Brands">Insert Brands</a>
        </li> -->
        
        <li class="nav-item">
          <a class="nav-link" href="index.php?update_Brands">update Brands</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?menslider">slider men</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="index.php?updatemenslider">update slider men</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?womenslider">slider women</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?updatewomenslider">update slider women</a>
        </li>
        

        
        <li class="nav-item">
          <a class="nav-link" href="index.php?order">order</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?delete_user">List Users</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="logout.php?logout">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container my-3">
    <?php
    if(isset( $_GET['Insert_Categories'])){
        include('Insert_Categories.php');
    }
    if(isset( $_GET['order'])){
      include('all_order.php');
  }
    if(isset( $_GET['update_Categories'])){
      include('update_Categories.php');
  }
    if(isset( $_GET['Insert_Brands'])){
        include('Insert_Brands.php');
    }
    if(isset( $_GET['update_Brands'])){
      include('update_Brands.php');
  }
    if(isset( $_GET['delete_user'])){
      include('delete_user.php');
  }
  
  if(isset($_GET['product_view'])){
    include('product_view.php');
  }

  if(isset($_GET['insert_product'])){
    include('insert_product.php');
  }

  if(isset($_GET['menslider'])){
    include('menslider.php');
  }
  if(isset($_GET['updatemenslider'])){
    include('updatemenslider.php');
  }

  if(isset($_GET['womenslider'])){
    include('womenslider.php');
  }
  if(isset($_GET['updatewomenslider'])){
    include('updatewomenslider.php');
  }
  
  if(isset($_GET['logout'])){
    include('login.php');
  }
  
  

    ?>
  </div>

  <!-- Bootstrap JS, jQuery, Popper.js -->
  <script src="https://kit.fontawesome.com/d2aa397344.js" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
