<?php
include('includes/connect.php');
include('common_function.php');
if(isset($_POST['submit'])) {  
    $name=$_POST['name'];  
    $email=$_POST['email']; 
    $message=$_POST['message']; 
    $sql="INSERT INTO contect (name, email, message) VALUES ('$name', '$email','$message')";
    $result_select=mysqli_query($con, $sql);

     if (!$result_select) {
        die("Error: " . mysqli_error($con));
     } else{
         echo "<script>alert('Message Sent Successfully!')</script>";
         header('Location:home.php');
     }

   
  }
?>
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="css.css">
 
</head>
<header>
<?php
include_once('navbar.php');
?>
</header>
<body>
<div class="" style="min-height: 1024px;">

<div class="container mt-5" style="padding: 20px;" style="border-radius: 25px; box-shadow: 0px 0px 20px 1px rgba(143,143,143,0.3);">
<div class=" px-4 py-5 rounded" style="border-radius: 25px; box-shadow: 0px 0px 20px 1px rgba(143,143,143,0.3);">
  
<div class="row">
    <!-- Location Column -->
    <div class="col-md-6">

      <h2>Location</h2>
      <div class="map-container" style="height: 0; padding-bottom: 56.25%; position: relative; overflow: hidden;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3691.4748697288646!2d70.80354511091512!3d22.297873579603607!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959ca01554b3e33%3A0xfc17dbd6901afc44!2sCloth%20Market!5e0!3m2!1sen!2sin!4v1708438531048!5m2!1sen!2sin" width="100%" height="100%" style="border:0; position: absolute; top: 0; left: 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
    <!-- Contact Form Column -->
    <div class="col-md-6">
      <h2>Contact Us</h2>
      <form id="contactForm" method="post">
        <div class="mb-3">
          <label for="name" class="form-label">Your Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
          <span class="error-span text-danger" id="name-error"></span>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Your Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
          <span class="error-span text-danger" id="email-error"></span>
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Message</label>
          <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message"></textarea>
          <span class="error-span text-danger" id="message-error"></span>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>
    </div>
    </div>
  </div>
</div>
</div>
<script src="https://kit.fontawesome.com/d2aa397344.js" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
  $(document).ready(function() {
    $('#contactForm').validate({
      rules: {
        name: 'required',
        email: {
          required: true,
          email: true
        },
        message: 'required'
      },
      messages: {
        name: 'Please enter your name',
        email: {
          required: 'Please enter your email',
          email: 'Please enter a valid email address'
        },
        message: 'Please enter your message'
      },
      errorElement: 'span',
      errorPlacement: function(error, element) {
        error.addClass('text-danger');
        error.attr('id', element.attr('name') + '-error');
        error.appendTo(element.parent());
      }
    });
  });
</script>

</body>
<?php
include_once('footer.php');
?>
</html>
