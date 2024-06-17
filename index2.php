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

  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="include/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

  <?php include('include/user_nav.php'); ?>

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


  <section id="Menu" class="pt-md-5">
    <h2 class="text-center my-5">Menu</h2>
    <div class="card-container d-flex flex-wrap justify-content-center">
        <?php
          $data = $con->viewProduct();
          foreach ($data as $rows) {
        ?>
            <div class="card m-2">
              <div class="card-body text-center">
                <?php if (!empty($rows['product_image'])): ?>
                  <img src="<?php echo htmlspecialchars($rows['product_image']); ?>" alt="Profile Picture"
                    class="profile-img img-fluid">
                <?php else: ?>
                  <img src="path/to/default/profile/pic.jpg" alt="Default Profile Picture" class="profile-img img-fluid">
                <?php endif; ?>
                <h5 class="card-title"><?php echo htmlspecialchars($rows['product_name']); ?></h5>
                <p class="card-text"><strong>Description:</strong>
                  <?php echo htmlspecialchars($rows['product_descrip']); ?></p>
                <p class="card-text"><strong>Price:</strong> <?php echo htmlspecialchars($rows['product_price']); ?></p>
                <!-- <p class="card-text"><strong>Stocks:</strong> <?php echo htmlspecialchars($rows['product_stock']); ?></p> -->
                <!-- <form action="update.php" method="post" class="d-inline">
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars($rows['productID']); ?>">
                  <button type="submit" class="btn btn-primary btn-sm">Order Now</button>
                </form>
                <form method="POST" class="d-inline">
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars($rows['productID']); ?>">
                  <input type="submit" name="add to cart" class="btn btn-danger btn-sm" value="Add To Cart"
                    onclick="return confirm('Are you sure you want to add this product')">
                </form> -->
              </div>
            </div>
        <?php
          }
        ?>
    </div>
</section>i


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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> 

  <script>
document.addEventListener("DOMContentLoaded", function() {
    fetch('fetch_products.php')
        .then(response => response.json())
        .then(products => {
            const productCards = document.getElementById('product-cards');
            products.forEach(product => {
                const col = document.createElement('div');
                col.classList.add('col-md-4');

                const card = document.createElement('div');
                card.classList.add('card');

                const img = document.createElement('img');
                img.src = `img/menu/${product.product_image}`;
                img.classList.add('card-img-top');
                img.alt = product.product_name;

                const cardBody = document.createElement('div');
                cardBody.classList.add('card-body');

                const cardTitle = document.createElement('h5');
                cardTitle.classList.add('card-title');
                cardTitle.textContent = product.product_name;

                const cardDescription = document.createElement('p');
                cardDescription.classList.add('card-text');
                cardDescription.textContent = product.product_descrip;

                const cardPrice = document.createElement('p');
                cardPrice.classList.add('card-text');
                cardPrice.textContent = `Price: $${product.product_price}`;

                cardBody.appendChild(cardTitle);
                cardBody.appendChild(cardDescription);
                cardBody.appendChild(cardPrice);
                card.appendChild(img);
                card.appendChild(cardBody);
                col.appendChild(card);
                productCards.appendChild(col);
            });
        })
        .catch(error => console.error('Error fetching products:', error));
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch('fetch_products.php')
        .then(response => response.json())
        .then(products => {
            const productCards = document.getElementById('product-cards');
            products.forEach(product => {
                const col = document.createElement('div');
                col.classList.add('col-md-4');

                const card = document.createElement('div');
                card.classList.add('card');

                const img = document.createElement('img');
                img.src = `img/menu/${product.product_image}`;
                img.classList.add('card-img-top');
                img.alt = product.product_name;

                const cardBody = document.createElement('div');
                cardBody.classList.add('card-body');

                const cardTitle = document.createElement('h5');
                cardTitle.classList.add('card-title');
                cardTitle.textContent = product.product_name;

                const cardDescription = document.createElement('p');
                cardDescription.classList.add('card-text');
                cardDescription.textContent = product.product_descrip;

                const cardPrice = document.createElement('p');
                cardPrice.classList.add('card-text');
                cardPrice.textContent = `Price: $${product.product_price}`;

                cardBody.appendChild(cardTitle);
                cardBody.appendChild(cardDescription);
                cardBody.appendChild(cardPrice);
                card.appendChild(img);
                card.appendChild(cardBody);
                col.appendChild(card);
                productCards.appendChild(col);
            });
        })
        .catch(error => console.error('Error fetching products:', error));
});
</script>


</body>

</html>