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

<div class="container mx-auto mt-4">
     <div class="row bg-light border p-2 mb-4">
          <div class="col-md-12">
               <h3 class="fw-bold text-center">รายการสินค้าใหม่</h3>
          </div>
     </div>
     <div class="row">
          <?php
          // ดึงข้อมูลสินค้า 10 รายการล่าสุด
          $stmt = $conn->query("SELECT * FROM products ORDER BY product_id DESC LIMIT 10");
          $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
          ?>
          <?php if (count($products) > 0): ?>
               <?php foreach ($products as $product): ?>
                    <div class="col-md-3 col-sm-6 g-3">
                         <div class="card">
                              <img src="<?= empty($product['image']) ? 'images/placeholder.jpg' : $product['image'] ?>" class="card-img-top object-fit-fill" alt="Product Image">
                              <div class="card-body">
                                   <h5 class="card-title"><?= mb_strimwidth($product['detail'], 0, 25, '...') ?></h5>
                                   <p class="card-text"><?= mb_strimwidth($product['detail'], 0, 35, '...') ?></p>
                                   <div class="d-flex justify-content-center gap-2">
                                        <form class="add-to-cart-form">
                                             <input type="hidden" value="<?= $product['product_id'] ?>" name="product_id">
                                             <input type="hidden" name="quantity" value="1">
                                             <button type="submit" class="btn btn-cart">เพิ่มลงตะกร้า</button>
                                        </form>
                                        <a href="#" class="btn btn-danger fw-bold">฿<?= number_format($product['price'], 2) ?></a>
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

<!-- jQuery (Include this before your JS script) -->
<script src="lib/jquery.js"></script>

<script>
     // เพิ่มสินค้าลงตะกร้าด้วย jQuery AJAX
     $(document).ready(function() {
          $('.add-to-cart-form').on('submit', function(e) {
               e.preventDefault();
               var formData = $(this).serialize();
               $.ajax({
                    url: 'api/products/add-cart.php', // API endpoint
                    method: 'POST', // วิธีการส่งข้อมูล
                    data: formData, // ข้อมูลที่ส่งไป
                    dataType: 'json', // รูปแบบข้อมูลที่รับกลับมา
                    success: function(data) {
                         // ถ้าผลลัพธ์เป็น success
                         if (data.status === 'success') {
                              // reload หน้าเว็บ
                              location.reload();
                         } else {
                              alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง');
                         }
                    }

               });
          });
     });
</script>