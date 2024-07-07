<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clothing Website About Section</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Custom CSS for text animation */
    .carousel-caption {
      opacity: 0;
      transition: opacity 0.5s ease;
    }

    .carousel-item.active .carousel-caption {
      opacity: 1;
    }
  </style>
</head>
<body>

<section class="about-section">
  <div id="carouselAbout" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="https://via.placeholder.com/1200x500" class="d-block w-100" alt="...">
        <div class="carousel-caption">
          <h5>Our Brand Story</h5>
          <p>Discover the inspiration behind our brand and how we aim to redefine fashion with our unique style.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://via.placeholder.com/1200x500" class="d-block w-100" alt="...">
        <div class="carousel-caption">
          <h5>Design Philosophy</h5>
          <p>Learn about our design approach, focusing on elegance, comfort, and sustainability.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://via.placeholder.com/1200x500" class="d-block w-100" alt="...">
        <div class="carousel-caption">
          <h5>Quality Assurance</h5>
          <p>We are committed to delivering high-quality products, crafted with attention to detail and passion.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://via.placeholder.com/1200x500" class="d-block w-100" alt="...">
        <div class="carousel-caption">
          <h5>Behind the Scenes</h5>
          <p>Get a sneak peek into our production process and the people who bring our designs to life.</p>
        </div>
      </div>
      <!-- Add more slides as needed -->
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselAbout" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselAbout" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</section>


<script src="https://kit.fontawesome.com/d2aa397344.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
