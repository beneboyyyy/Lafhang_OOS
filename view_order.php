<?php
require_once('classes/database.php'); // Adjust the path if necessary

// Create a new instance of the database connection
$con = new database();
$conn = $con->opencon(); // Assuming opencon() method is defined in database class

session_start();

if (isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    $get_id = '';
    header('location:orders.php');
}

if (isset($_POST['cancel'])) {
    $update_orders = $conn->prepare("UPDATE `orders` SET status = ? WHERE orderID = ?");
    $update_orders->execute(['canceled', $get_id]);
    header('location:orders.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'include/header.php'; ?>

<section class="order-details">
    <h1 class="heading">order details</h1>
    <div class="box-container">
        <?php
        $grand_total = 0;
        $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE orderID = ? LIMIT 1");
        $select_orders->execute([$get_id]);
        if ($select_orders->rowCount() > 0) {
            while ($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                $select_product = $conn->prepare("SELECT * FROM `product` WHERE productID = ? LIMIT 1");
                $select_product->execute([$fetch_order['productID']]);
                if ($select_product->rowCount() > 0) {
                    while ($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {
                        $sub_total = ($fetch_order['total_amount'] * $fetch_order['qty']);
                        $grand_total += $sub_total;
        ?>
                        <div class="box">
                            <div class="col">
                                <p class="title"><i class="fas fa-calendar"></i><?= $fetch_order['orderdate']; ?></p>
                                <img src="<?= $fetch_product['product_image']; ?>" class="image" alt="">
                                <p class="price">₱ <?= $fetch_order['total_amount']; ?> x <?= $fetch_order['qty']; ?></p>
                                <h3 class="name"><?= $fetch_product['product_name']; ?></h3>
                                <p class="grand-total">grand total : <span>₱<?= $grand_total; ?></span></p>
                            </div>
                            <div class="col">
    <p class="title">billing address</p>
    <p class="user"><i class="fas fa-user"></i><?= isset($fetch_order['cust_FN']) ? $fetch_order['cust_FN'] : 'N/A'; ?></p>
    <p class="user"><i class="fas fa-phone"></i><?= isset($fetch_order['cust_phone']) ? $fetch_order['cust_phone'] : 'N/A'; ?></p>
    <p class="user"><i class="fas fa-envelope"></i><?= isset($fetch_order['cust_email']) ? $fetch_order['cust_email'] : 'N/A'; ?></p>
    <p class="user"><i class="fas fa-map-marker-alt"></i><?= isset($fetch_order['address']) ? $fetch_order['address'] : 'N/A'; ?></p>
    
    <p class="title">status</p>
    <p class="status" style="color:<?php 
        if ($fetch_order['status'] == 'delivered') {
            echo 'green';
        } elseif ($fetch_order['status'] == 'canceled') {
            echo 'red';
        } else {
            echo 'orange';
        } 
    ?>"><?= $fetch_order['status']; ?></p>
    
    <?php if ($fetch_order['status'] == 'canceled') { ?>
        <a href="checkout.php?get_id=<?= $fetch_product['productID']; ?>" class="btn">order again</a>
    <?php } else { ?>
        <form action="" method="POST">
            <input type="submit" value="cancel order" name="cancel" class="delete-btn" onclick="return confirm('Cancel this order?');">
        </form>
    <?php } ?>
</div>

        <?php
                    }
                } else {
                    echo '<p class="empty">product not found!</p>';
                }
            }
        } else {
            echo '<p class="empty">no orders found!</p>';
        }
        ?>
    </div>
</section>

</body>
</html>
