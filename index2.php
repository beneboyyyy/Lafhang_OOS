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

  <?php include('include/user_nav.php'); ?>


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
                <p class="card-text"><strong>Stocks:</strong> <?php echo htmlspecialchars($rows['product_stock']); ?></p>
                <form action="update.php" method="post" class="d-inline">
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars($rows['productID']); ?>">
                  <button type="submit" class="btn btn-primary btn-sm">Order Now</button>
                </form>
                <form method="POST" class="d-inline">
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars($rows['productID']); ?>">
                  <input type="submit" name="add to cart" class="btn btn-danger btn-sm" value="Add To Cart"
                    onclick="return confirm('Are you sure you want to add this product')">
                </form>
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