<?php
require_once ('classes/database.php');
$con = new database();
$conn = $con->opencon();


$id = $_SESSION['cust_ID'];
$data = $con->viewdata($id);
// Assuming the profile picture URL is stored in the session or fetched from the database
$profilePicture = $_SESSION['cust_image'] ?? 'path/to/default/profile_picture.jpg';
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
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
</head>
<body>
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
            <a class="nav-link mx-lg-2 active" aria-current="page" href="index2.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-lg-2" href="menu.php">Menu</a>
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
    <li class="nav-item mx-lg-2 pe-2 dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['cust_user']; ?></span> 
            <img src="<?php echo $data['cust_image']; ?>" width="30" height="30" class="rounded-circle mr-1" alt="Profile Picture"> 
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
            <a class="dropdown-item" href="#">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                Settings
            </a>
            <a class="dropdown-item" href="#">
                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                Activity Log
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link mx-lg-2 pe-2" href="#"><i class="bi bi-search"></i></a>
    </li>
    <?php
    $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE cust_ID = ?");
    $count_cart_items->execute([$id]);
    $total_cart_items = $count_cart_items->rowCount();
    ?>
    <li class="nav-item">
        <a class="nav-link mx-lg-2 pe-2" href="cart.php"><i class="bi bi-cart"></i><span><?= $total_cart_items; ?></span></a>
    </li>
</ul>

    <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
      aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>


<!-- Navbar end -->
</body>
</html>