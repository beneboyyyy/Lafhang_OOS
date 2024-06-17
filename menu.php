<?php
require_once('classes/database.php');
$con = new database();
session_start();

$id = $_SESSION['cust_ID'];
$data = $con->viewdata($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $productID = $_POST['id'];
    $cust_id = $id;
    $price = $con->getProductPrice($productID);
    $qty = 1; // Set default quantity to 1 or modify as needed

    // You may want to add validation and checks here

    // Add product to cart
    $con->addCart(null, $cust_id, $productID, $price, $qty);
    echo "<script>alert('Product added to cart successfully');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<?php include 'include/user_nav.php'; ?>

<section id="Menu" class="pt-md-5">
    <h2 class="text-center my-5">Menu</h2>
    <div class="card-container d-flex flex-wrap justify-content-center">
        <?php
        $data = $con->viewProduct();
        foreach ($data as $rows) {
        ?>
        <div class="card">
            <div class="card-body text-center">
                <?php if (!empty($rows['product_image'])): ?>
                    <img src="<?php echo htmlspecialchars($rows['product_image']); ?>" alt="Product Image" class="profile-img img-fluid">
                <?php else: ?>
                    <img src="path/to/default/profile/pic.jpg" alt="Default Profile Picture" class="profile-img img-fluid">
                <?php endif; ?>
                <h5 class="card-title"><?php echo htmlspecialchars($rows['product_name']); ?></h5>
                <p class="card-text"><strong>Description:</strong> <?php echo htmlspecialchars($rows['product_descrip']); ?></p>
                <p class="card-text"><strong>Price:</strong> <?php echo htmlspecialchars($rows['product_price']); ?></p>
                <p class="card-text"><strong>Stocks:</strong> <?php echo htmlspecialchars($rows['product_stock']); ?></p>
                <form action="update.php" method="post" class="d-inline">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($rows['productID']); ?>">
                    <button type="submit" class="btn btn-primary btn-sm">Order Now</button>
                </form>
                <form method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($rows['productID']); ?>">
                    <input type="submit" name="add_to_cart" class="btn btn-danger btn-sm" value="Add To Cart" onclick="return confirm('Are you sure you want to add this product')">
                </form>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<?php include 'include/alert.php'; ?>
</body>
</html>

    