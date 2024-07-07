<?php
include('includes/connect.php');
include('common_function.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="css.css">

<body>
    <!-- <div class="container"> -->
      <?php
      include('navbar.php');
      ?>
<?php
cart();
?>
<!--  -->
<div class="container-fluid py-5 ">
    <div class="row">
        <!-- Brands and Categories Accordion -->
        <div class="col-md-2">
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
              <button class="accordion-button text-dark " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                Men
              </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne">
              <div class="accordion-body">
                <?php
                    getcategories();
                ?>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
              <button class="accordion-button text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="true" aria-controls="flush-collapseTwo">
                brands
              </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingTwo">
              <div class="accordion-body">
              <?php
                    getbrands();
                ?>
              </div>
            </div>
          </div>
          
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingFour">
              <button class="accordion-button text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="true" aria-controls="flush-collapseFour">
                Accessories
              </button>
            </h2>
            <div id="flush-collapseFour" class="accordion-collapse collapse show" aria-labelledby="flush-headingFour">
              <div class="accordion-body">
              <?php
                get_accesories();
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>

        <!-- Products Section -->
        <div class="col-md-10 ">
            <div class="row">
                <!-- Fetch Products -->
                <?php 
                  get_all_product();
                  get_unique_categories();
                  get_unique_brands();               
                ?>
                <!-- End Fetch Products -->
            </div>
        </div>
        <!-- End Products Section -->
    </div>
</div>

<?php
include('footer.php');
?>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



      </div>
</body>
<script>
 $(document).ready(function(){
    // Collapse accordion on small screens
    function collapseAccordion() {
        if ($(window).width() < 768) {
            $('#collapseBrands, #collapseCategories').collapse('hide');
        } else {
            $('#collapseBrands, #collapseCategories').collapse('show');
        }
    }

    // Trigger resize event on page load and window resize
    $(window).on('resize', function() {
        collapseAccordion();
    });

    // Trigger resize event on page load
    $(window).trigger('resize');
});

</script>

<script src="https://kit.fontawesome.com/d2aa397344.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>

