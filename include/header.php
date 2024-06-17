<?php
require_once ('classes/database.php');
$con = new database();
$conn = $con->opencon();


$id = $_SESSION['cust_ID'];
$data = $con->viewdata($id);
?>
<header class="header">

   <section class="flex">
     <a href="#" class="logo">Lafhang House</a>

      <nav class="navbar">
         
         <a href="orders.php">my orders</a>
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE cust_ID= ?");
            $count_cart_items->execute([$id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="cart.php" class="cart-btn">cart<span><?= $total_cart_items; ?></span></a>
         <a href="menu.php">Back to menu</a>
      </nav>
         
      <div id="menu-btn" class="fas fa-bars"></div>
   </section>

</header>

