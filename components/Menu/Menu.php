<style>
     .menu-item {
          background: linear-gradient(135deg, #4facfe, #00f2fe);
          color: white;
          text-align: center;
          padding: 40px;
          border-radius: 10px;
          box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
          transition: transform 0.3s ease, box-shadow 0.3s ease;
     }

     .menu-item:hover {
          transform: translateY(-5px);
          box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.15);
     }

     .menu-item h3 {
          font-size: 1.2rem;
          margin: 0;
     }
</style>


<div class="container mt-4">
     <div class="row bg-light border p-3">
          <div class="col-md-3 col-sm-6">
               <div class="menu-item">
                    <a href="product.php">
                         <h3 class="fw-bold text-white">สินค้าทั้งหมด</h3>
                    </a>
               </div>
          </div>
          <div class="col-md-3 col-sm-6">
               <div class="menu-item">
                    <a href="posts.php">
                         <h3 class="fw-bold text-white">ประชาสัมพันธ์</h3>
                    </a>
               </div>
          </div>
          <div class="col-md-3 col-sm-6">
               <div class="menu-item">
                    <a href="evaluation.php">
                         <h3 class="fw-bold text-white">แบบประเมิน</h3>
                    </a>
               </div>
          </div>
          <div class="col-md-3 col-sm-6">
               <div class="menu-item">
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'user'): ?>
                         <a href="user_chat.php">
                              <h3 class="fw-bold text-white">ติดต่อเรา</h3>
                         </a>
                    <?php else: ?>
                         <a href="admin_chat_list.php">
                              <h3 class="fw-bold text-white">ติดต่อเรา</h3>
                         </a>

                    <?php endif; ?>
               </div>
          </div>
     </div>
</div>

<!-- Bootstrap JS -->