<div class="dropdown ">
     <button class="btn btn-outline-light border-0  dropdown-toggle" type="button" data-bs-toggle="dropdown"
          aria-expanded="false">

          <img width="30" height="30" class="rounded-circle border"
               src="https://www.svgrepo.com/show/440009/person-circle.svg" alt="">
          <?php if (isset($_SESSION['uname'])) : ?>
               <span class="fw-bold"> <?php echo $_SESSION['uname'] ?></span>
          <?php endif; ?>
     </button>
     <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="profile.php">ข้อมูลส่วนตัว</a></li>
          <!-- only admin can see -->

          <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') : ?>
               <li><a class="dropdown-item" href="add_product.php">เพิ่มสินค้า</a></li>
          <?php endif ; ?>

          <li><a class="dropdown-item" href="reports.php">ระบบจัดการ</a></li>
          <li><a class="dropdown-item text-danger" href="logout.php">ออกจากระบบ</a></li>
     </ul>
</div>