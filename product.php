<?php
include 'db.php';
session_start();

// ตรวจสอบว่ามีคำค้นหาหรือไม่
$search = isset($_GET['search']) ? $_GET['search'] : '';

// หากมีคำค้นหา ให้ใช้ SQL แบบค้นหา
if ($search) {
     $stmt = $conn->query("SELECT * FROM products WHERE name LIKE '%{$search}%'");
} else {
     // หากไม่มีคำค้นหา ให้ดึงสินค้าทั้งหมดs 
     $stmt = $conn->query("SELECT * FROM products");
}

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Product List</title>
     <link rel="stylesheet" href="globals.css">
     <link rel="stylesheet" href="lib/bootstrap.min.css">
</head>
<style>
     .btn-cart {
          background: linear-gradient(135deg, #4facfe, #00f2fe);
          color: white;
          text-align: center;
          border: none;
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          transition: transform 0.3s, box-shadow 0.3s;
     }

     .card:hover {
          transform: translateY(-5px);
          box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
     }

     .card img {
          border-radius: 10px 10px 0 0;
          height: 180px;
          object-fit: cover;
     }

     .card-body {
          padding: 20px;
     }
</style>

<body>
     <!-- Navbar -->
     <div class="nav-mb">
          <?php include 'components/Navbar/Navbar.php'; ?>
     </div>

     <!-- Product Section -->
     <div>
          <div class="container mx-auto mt-4">
               <div class="row bg-light border p-2 mb-4">
                    <div class="col-md-12">
                         <?php if ($search): ?>
                              <h3 class="fw-bold text-center">ผลการค้นหา: <?= ($search)  ?></h3>
                         <?php else: ?>
                              <h3 class="fw-bold text-center">รายการสินค้าทั้งหมด</h3>
                         <?php endif; ?>
                    </div>
               </div>
               <div class="row">
                    <?php if (count($products) > 0): ?>
                         <?php foreach ($products as $product): ?>
                              <div class="col-md-3 col-sm-6 g-3">
                                   <div class="card">
                                   <img src="<?= $product['image'] ?>" class="card-img-top" alt="Product Image">                                        <div class="card-body">
                                             <h5 class="card-title"><?= ($product['name']) ?></h5>
                                             <p class="card-text"><?= ($product['detail']) ?></p>
                                             <div class="d-flex justify-content-center gap-2">
                                                  <a href="#" class="btn btn-cart">เพิ่มลงตะกร้า</a>
                                                  <a href="#" class="btn btn-danger fw-bold"><?= $product['price'] ?>฿</a>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         <?php endforeach; ?>
                    <?php else: ?>
                         <div class="col-12">
                              <p class="text-center text-muted">ไม่พบสินค้าที่คุณค้นหา</p>
                         </div>
                    <?php endif; ?>
               </div>
          </div>
     </div>
     <script src="lib/bootstrap.bundle.js"></script>
     <script src="lib/jquery.js"></script>
     <script>
          $(document).ready(function() {
               // เมื่อผู้ใช้พิมพ์ในช่องค้นหาและกด Enter
               $('#searchInput').on('keypress', function(e) {
                    if (e.which == 13) { // ตรวจสอบว่ากด Enter
                         let searchQuery = $(this).val();
                         window.location.href = `product.php?search=${searchQuery}`;
                    }
               });
          });
     </script>
</body>

</html>