<?php
require_once ('classes/database.php');
$con = new database();
$conn = $con->opencon();

session_start();

$id = $_SESSION['cust_ID'];
$data = $con->viewdata($id);


if (isset($_POST['update_cart'])) {
    $cart_id = $_POST['cartID'];
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);

    $update_qty = $conn->prepare("UPDATE `cart` SET qty = ? WHERE cartID = ?");
    $update_qty->execute([$qty, $cart_id]);

    $success_msg[] = 'Cart quantity updated!';
}

if (isset($_POST['delete_item'])) {
    $cart_id = $_POST['cartID'];
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);

    $verify_delete_item = $conn->prepare("SELECT * FROM `cart` WHERE cartID = ?");
    $verify_delete_item->execute([$cart_id]);

    if ($verify_delete_item->rowCount() > 0) {
        $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE cartID = ?");
        $delete_cart_id->execute([$cart_id]);
        $success_msg[] = 'Cart item deleted!';
    } else {
        $warning_msg[] = 'Cart item already deleted!';
    }
}

if (isset($_POST['empty_cart'])) {
    $verify_empty_cart = $conn->prepare("SELECT * FROM `cart` WHERE cust_ID = ?");
    $verify_empty_cart->execute([$id]);

    if ($verify_empty_cart->rowCount() > 0) {
        $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE cust_ID = ?");
        $delete_cart_id->execute([$id]);
        $success_msg[] = 'Cart emptied!';
    } else {
        $warning_msg[] = 'Cart already emptied!';
    }
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

    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


</head>

<body>

<?php include 'include/header.php'; ?>

    <section class="products">
        <h1 class="heading">shopping cart</h1>
        <div class="box-container">
            <?php
            $grand_total = 0;
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE cust_ID = ?");
            $select_cart->execute([$id]);

            if ($select_cart->rowCount() > 0) {
                while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                    $select_products = $conn->prepare("SELECT * FROM `product` WHERE productID = ?");
                    $select_products->execute([$fetch_cart['productID']]);

                    if ($select_products->rowCount() > 0) {
                        $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <form action="" method="POST" class="box">
                            <input type="hidden" name="cartID" value="<?= $fetch_cart['cartID']; ?>">
                            <img src="<?= htmlspecialchars($fetch_product['product_image']); ?>" class="image" alt="">
                            <h3 class="name"><?= $fetch_product['product_name']; ?></h3>
                            <div class="flex">
                                <p class="price">₱ <?= $fetch_cart['price']; ?></p>
                                <input type="number" name="qty" required min="1" value="<?= $fetch_cart['qty']; ?>" max="99"
                                    maxlength="2" class="qty">
                                <button type="submit" name="update_cart" class="fas fa-edit"></button>
                            </div>
                            <p class="sub-total">Sub total : ₱
                                <span><?= $sub_total = ($fetch_cart['qty'] * $fetch_cart['price']); ?></span></p>
                            <input type="submit" value="Delete" name="delete_item" class="delete-btn"
                                onclick="return confirm('Delete this item?');">
                        </form>
                        <?php
                        $grand_total += $sub_total;
                    } else {
                        echo '<p class="empty">Product was not found!</p>';

                    }
                }
            } else {
                echo '<p class="empty">Your cart is empty!</p>';
                '<a href="menu.php" class="btn"></a>';
            }
            ?>
        </div>

        <?php if ($grand_total != 0) { ?>
            <div class="cart-total">
                <p>Grand total :₱ <span> <?= $grand_total; ?></span></p>
                <form action="" method="POST">
                    <input type="submit" value="Empty cart" name="empty_cart" class="delete-btn"
                        onclick="return confirm('Empty your cart?');">
                </form>
                <a href="checkout.php" class="btn">Proceed to checkout</a>
            </div>
        <?php } ?>



    </section>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>

</body>
</html>