<!-- Navbar start -->

<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand me-auto" href="#"><img src="img/logo2.png" alt=""></a>
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
        <a class="nav-link mx-lg-2" href="cart.php"><i class="bi bi-cart"></i><span class="quantity">0</span></a>
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