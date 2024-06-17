<?php
require_once('classes/database.php'); // Adjust the path if necessary

// Create a new instance of the database connection
$con = new database();
$conn = $con->opencon(); // Assuming opencon() method is defined in database class

session_start();

if (isset($_POST['place_order'])) {
    // Sanitize inputs
    $name = filter_var($_POST['cust_name'], FILTER_SANITIZE_STRING);
    $number = filter_var($_POST['cust_phone'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['cust_email'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['Adressline1'] . ', ' . $_POST['Barangay'] . ', ' . $_POST['city'] . ', ' . $_POST['Province'], FILTER_SANITIZE_STRING);
    $address_type = filter_var($_POST['address_type'], FILTER_SANITIZE_STRING);
    $method = filter_var($_POST['method'], FILTER_SANITIZE_STRING);

    // Verify cart or single product order
    $id = $_SESSION['cust_ID'];
    $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE cust_ID = ?");
    $verify_cart->execute([$id]);

    if (isset($_GET['get_id'])) {
        // Single product order
        $get_product = $conn->prepare("SELECT * FROM `product` WHERE productID = ? LIMIT 1");
        $get_product->execute([$_GET['get_id']]);
        if ($get_product->rowCount() > 0) {
            $fetch_p = $get_product->fetch(PDO::FETCH_ASSOC);
            $product_price = $fetch_p['product_price'];

            // Insert order into orders table
            $insert_order = $conn->prepare("INSERT INTO `orders` (cust_ID, productID, total_amount, method, qty) VALUES (?, ?, ?, ?, ?)");
            $insert_order->execute([$id, $fetch_p['productID'], $product_price, $method, 1]);

            // Redirect to orders.php or handle success
            if ($insert_order) {
                $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE cust_ID = ?");
                $delete_cart_id->execute([$id]);
                header('location: orders.php');
                exit; // Ensure no further execution after redirection
            } else {
                $warning_msg[] = 'Failed to place order.';
            }
        } else {
            $warning_msg[] = 'Product not found.';
        }
    } elseif ($verify_cart->rowCount() > 0) {
        // Cart order
        while ($f_cart = $verify_cart->fetch(PDO::FETCH_ASSOC)) {
            $select_product = $conn->prepare("SELECT * FROM `product` WHERE productID = ?");
            $select_product->execute([$f_cart['productID']]);
            $fetch_product = $select_product->fetch(PDO::FETCH_ASSOC);
            $product_price = $fetch_product['product_price'];

            // Insert order into orders table
            $insert_order = $conn->prepare("INSERT INTO `orders` (cust_ID, productID, total_amount, method, qty) VALUES (?, ?, ?, ?, ?)");
            $insert_order->execute([$id, $f_cart['productID'], $product_price, $method, $f_cart['qty']]);
        }

        // Delete cart items after placing order
        $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE cust_ID = ?");
        $delete_cart_id->execute([$id]);

        // Redirect to orders.php or handle success
        if ($insert_order) {
            header('location: orders.php');
            exit; // Ensure no further execution after redirection
        } else {
            $warning_msg[] = 'Failed to place order.';
        }
    } else {
        $warning_msg[] = 'Your cart is empty.';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
   <link rel="stylesheet" href="styles.css">
</head>
<body>
   
<?php include 'include/user_nav.php'; ?>

<section class="container py-5">
    <h1 class="text-center mb-5">Checkout Summary</h1>
    <div class="row">
        <div class="col-md-7">
            <form action="" method="POST">
                <h3 class="mb-4">Billing Details</h3>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="cust_name" class="form-label">Your Name <span class="text-danger">*</span></label>
                        <input type="text" id="cust_name" name="cust_name" required maxlength="50" placeholder="Enter your name" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="cust_phone" class="form-label">Your Number <span class="text-danger">*</span></label>
                        <input type="number" id="cust_phone" name="cust_phone" required maxlength="11" placeholder="Enter your number" class="form-control" min="0" max="9999999999">
                    </div>
                    <div class="col-md-6">
                        <label for="cust_email" class="form-label">Your Email <span class="text-danger">*</span></label>
                        <input type="email" id="cust_email" name="cust_email" required maxlength="50" placeholder="Enter your email" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="method" class="form-label">Payment Method <span class="text-danger">*</span></label>
                        <select id="method" name="method" class="form-select" required>
                            <option value="cash on delivery">Cash on Delivery</option>
                            <option value="credit or debit card">Credit or Debit Card</option>
                            <option value="ewallets">Gcash or Maya</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="address_type" class="form-label">Address Type <span class="text-danger">*</span></label>
                        <select id="address_type" name="address_type" class="form-select" required>
                            <option value="home">Home</option>
                            <option value="office">Office</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="Adressline1" class="form-label">Address Line 01 <span class="text-danger">*</span></label>
                        <input type="text" id="Adressline1" name="Adressline1" required maxlength="50" placeholder="e.g. flat & building number" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="Barangay" class="form-label">Barangay <span class="text-danger">*</span></label>
                        <input type="text" id="Barangay" name="Barangay" required maxlength="50" placeholder="e.g. street name & locality" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label">City Name <span class="text-danger">*</span></label>
                        <input type="text" id="city" name="city" required maxlength="50" placeholder="Enter your city name" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="Province" class="form-label">Province Name <span class="text-danger">*</span></label>
                        <input type="text" id="Province" name="Province" required maxlength="50" placeholder="Enter your province name" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4" name="place_order">Place Order</button>
            </form>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Cart Items</h3>
                    <?php
                    $grand_total = 0;
                    if (isset($_GET['get_id'])) {
                        $select_get = $conn->prepare("SELECT * FROM `product` WHERE productID = ?");
                        $select_get->execute([$_GET['get_id']]);
                        while ($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)) {
                            $image_path = '' . $fetch_get['product_image'];
                            if (file_exists($image_path)) {
                    ?>
                    <div class="d-flex mb-3">
                        <img src="<?= $image_path; ?>" class="img-fluid me-3" alt="" style="width: 100px;">
                        <div>
                            <h5 class="mb-1"><?= $fetch_get['product_name']; ?></h5>
                            <p class="mb-0">₱ <?= $fetch_get['product_price']; ?> x 1</p>
                        </div>
                    </div>
                    <?php
                            } else {
                                echo '<p class="text-danger">Image not found: ' . $image_path . '</p>';
                            }
                        }
                    } else {
                        $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE cust_ID = ?");
                        $select_cart->execute([$id]);
                        if ($select_cart->rowCount() > 0) {
                            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                                $select_products = $conn->prepare("SELECT * FROM `product` WHERE productID = ?");
                                $select_products->execute([$fetch_cart['productID']]);
                                $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
                                $image_path = '' . $fetch_product['product_image'];
                                if (file_exists($image_path)) {
                                    $sub_total = ($fetch_cart['qty'] * $fetch_product['product_price']);
                                    $grand_total += $sub_total;
                    ?>
                    <div class="d-flex mb-3">
                        <img src="<?= $image_path; ?>" class="img-fluid me-3" alt="" style="width: 100px;">
                        <div>
                            <h5 class="mb-1"><?= $fetch_product['product_name']; ?></h5>
                            <p class="mb-0">₱ <?= $fetch_product['product_price']; ?> x <?= $fetch_cart['qty']; ?></p>
                        </div>
                    </div>
                    <?php
                                } else {
                                    echo '<p class="text-danger">Image not found: ' . $image_path . '</p>';
                                }
                            }
                        } else {
                            echo '<p class="text-muted">Your cart is empty</p>';
                        }
                    }
                    ?>
                    <div class="d-flex justify-content-between border-top pt-3 mt-3">
                        <span class="fw-bold">Grand Total:</span>
                        <p class="mb-0">₱ <?= $grand_total; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
