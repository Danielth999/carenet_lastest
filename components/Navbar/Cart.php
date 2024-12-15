<?php
$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;
$stmt = $conn->query("SELECT COUNT(*) AS total
FROM cart_item ci 
JOIN cart c ON ci.cart_id = c.cart_id
WHERE c.user_id = '$uid'");
$count_cart = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<div class="position-relative">
     <a href="cart.php" class="nav-link text-white">
          <img width="30" height="30" src="https://www.svgrepo.com/show/533043/cart-shopping.svg" alt="">
          <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle"><?= $count_cart['total'] ?></span>
     </a>
</div>