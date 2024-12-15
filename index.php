<?php
include 'db.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Home</title>
     <link rel="stylesheet" href="globals.css">
     <link rel="stylesheet" href="lib/bootstrap.min.css">
</head>

<body>
     <div class="nav-mb">
          <?php include 'components/Navbar/Navbar.php' ?>
     </div>
     <!-- hero -->
     <div>
          <?php include 'components/Hero/Hero.php' ?>
     </div>
     <!-- menu -->
     <div>
          <?php include 'components/Menu/Menu.php' ?>
     </div>
     <div>
          <?php include 'components/Product/Product.php' ?>
     </div>

     <div class="position-fixed  bg-all px-4  py-3 text-white rounded-circle" style="left:1.5%; bottom: 2%;">
          <div>

               <span>
               <?php include 'visit.php'; ?>
               </span>
          </div>
     </div>

     <script src="lib/jquery.js"></script>
     <script src="lib/bootstrap.bundle.js"></script>
</body>

</html>