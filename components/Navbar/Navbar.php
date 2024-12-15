<!-- i want fix the navbar to be fixed -->
<style>
     .navbar-fixed {
          position: fixed;
          top: 0;
          left: 0;
          right: 0;
          z-index: 1030;

     }
</style>

<nav class="py-3 bg-all navbar-fixed ">
     <div class="container mx-auto">
          <div class="d-flex justify-content-between align-items-center">
               <!-- Logo -->
               <div class="">
                    <a href="index.php" class="text-white text-decoration-none">
                         <h1 class="fw-bold m-0">CareNet</h1>
                    </a>
               </div>

               <!-- Search Bar -->
               <div class="d-none d-md-flex w-50 mx-3">
                    <form action="product.php" class="w-100" method="get">
                         <input type="search" name="search" class="form-control" placeholder="ค้นหาชื่อสินค้า">
                    </form>
               </div>

               <!-- Menu -->
               <div class="d-flex align-items-center gap-3">
                    <?php if (isset($_SESSION['login'])) : ?>
                         <!-- cart  -->
                         <?php include 'components/Navbar/Cart.php'; ?>
                         <!-- dropdown -->
                         <?php include 'components/Navbar/Dropdown.php'; ?>
                    <?php else : ?>
                         <!-- sign in -->
                         <?php include 'components/Navbar/SignIn.php'; ?>
                    <?php endif; ?>
                  
               </div>

               <!-- Mobile Search Bar -->
               <div class="d-md-none mt-2">
                    <input type="search" class="form-control" placeholder="Search">
               </div>
          </div>
</nav>