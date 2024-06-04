<?php
require_once('classes/database.php');
$con = new database();
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lafhang Online System</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

  <!-- Navbar start -->

  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand me-auto" href="#"><img src="img/nav_logo.png" alt=""></a>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Logo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link mx-lg-2 active" aria-current="page" href="#Home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="#Menu">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="#About Us">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="#Contact">Contact</a>
            </li>
          </ul>
        </div>
      </div>
      <ul class="navbar-nav ms-auto d-flex flex-row pe-3">
        <li class="nav-item ">
          <a class="nav-link mx-lg-2 pe-2" href="login.php"><i class="bi bi-person"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-lg-2 pe-2" href="#"><i class="bi bi-search"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-lg-2" href="#"><i class="bi bi-cart"></i><span class="quantity">0</span></a>
        </li>
      </ul>
      <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>
  <div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
    </div>
    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active" aria-current="true"
          aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>

      <div class="carousel-inner">
        <div class="carousel-item active c-item">
          <img src="img/img1.jpg" class="d-block w-100 c-img" alt="Slide 1">
          <div class="carousel-caption top-0 mt-4">
            <p class="mt-5 fs-1 text-uppercase justify-content-center">Lafhang House</p>
            <h1 class="display-1 fw-bolder text-capitalize">Authentic Cebu Lechon Belly</h1>
            <button class="btn btn-primary px-4 py-2 fs-5 mt-5">Order Now</button>
          </div>
        </div>
        <div class="carousel-item c-item">
          <img src="img/img2.jpg" class="d-block w-100 c-img" alt="Slide 2">
          <div class="carousel-caption top-0 mt-4">
            <p class="text-uppercase fs-3 mt-5">The Best Lechon Belly</p>
            <p class="display-1 fw-bolder text-capitalize">Here in Batangas</p>
            <button class="btn btn-primary px-4 py-2 fs-5 mt-5" data-bs-toggle="modal"
              data-bs-target="#booking-modal">Order Now</button>
          </div>
        </div>
        <div class="carousel-item c-item">
          <img src="img/img3.jpg" class="d-block w-100 c-img" alt="Slide 3">
          <div class="carousel-caption top-0 mt-4">
            <p class="text-uppercase fs-3 mt-5">Ano pang hinihintay mo?</p>
            <p class="display-1 fw-bolder text-capitalize">Aba'y tikme</p>
            <button class="btn btn-primary px-4 py-2 fs-5 mt-5" data-bs-toggle="modal"
              data-bs-target="#booking-modal">Order Now</button>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  </div>
  </div>
  </div>
  </div>

  <!-- Navbar end -->

  <section id="Menu" class="pt-md-5">
    <h2 class="text-center my-5">Menu</h2>

    <!-- Card starts -->
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <img src="img/menu/Screenshot 2024-05-29 222415.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title ">ChickSilog</h5>
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <img src="img/menu/Screenshot 2024-05-29 222427.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">SauSilog</h5>
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <img src="img/menu/Screenshot 2024-05-29 222436.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">BangSilog</h5>
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <img src="img/menu/Screenshot 2024-05-29 222445.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">TocSilog</h5>
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <img src="img/menu/Screenshot 2024-05-29 222452.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">ShangSilog</h5>
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <img src="img/menu/Screenshot 2024-05-29 222458.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">MeatSilog</h5>
             
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <img src="img/menu/img6.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Chicken Wings</h5>
             
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <img src="img/menu/img7.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Lechon Sisig</h5>
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <img src="img/menu/img8.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Lechon Belly</h5>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Card End -->
  </section>

 <!-- About Us Section -->
 <section id="About Us" class="pt-md-5">
  <h2 class="text-center my-5">About Us</h2>
  <div class="container">
    
    <div class="row">
      <div class="col-lg-12 mb-4 text-center">
        <h3>Our Mission</h3>
        <p>Our mission is to deliver the best products and services to our customers, ensuring the highest level of satisfaction and value.</p>
      </div>
      <!-- <div class="col-lg-6 mb-4">
        <h3>Our Vision</h3>
        <p>We envision a world where technology seamlessly integrates into everyday life, enhancing experiences and driving progress.</p>
      </div>
    </div> -->
    
    <div class="row">
      <div class="col text-center">
        <h3>Meet Our Team</h3>
      </div>
    </div>
    
    <div class="row">
      <!-- Team Member 1 -->
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="team1.jpg" class="card-img-top" alt="Team Member 1">
          <div class="card-body text-center">
            <h5 class="card-title">John Doe</h5>
            <p class="card-text">CEO</p>
            <p>John leads our company with over 20 years of experience in the industry.</p>
          </div>
        </div>
      </div>
      
      <!-- Team Member 2 -->
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="team2.jpg" class="card-img-top" alt="Team Member 2">
          <div class="card-body text-center">
            <h5 class="card-title">Jane Smith</h5>
            <p class="card-text">CTO</p>
            <p>Jane oversees all technical aspects of our projects, ensuring innovation and efficiency.</p>
          </div>
        </div>
      </div>
      
      <!-- Team Member 3 -->
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="team3.jpg" class="card-img-top" alt="Team Member 3">
          <div class="card-body text-center">
            <h5 class="card-title">Emily Johnson</h5>
            <p class="card-text">CFO</p>
            <p>Emily manages our financial operations, maintaining the company's financial health.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="Contact" class="pt-md-5">
  <h2 class="text-center my-5">Contact</h2>
  <div class="col-md-12">
    <form class="contact-form">
      <div class="row justify-content-center">
        <div class="col-md-6">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required >
        </div>
        <div class="col-md-6">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</div>
</div>
</section>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>

</body>

</html>