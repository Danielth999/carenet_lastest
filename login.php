<?php
include 'db.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>เข้าสู่ระบบ</title>
     <link rel="stylesheet" href="globals.css">
     <link rel="stylesheet" href="lib/bootstrap.min.css">
</head>

<body>
     <div class="nav-mb">
          <?php include 'components/Navbar/Navbar.php' ?>
     </div>
     <div class="container mt-5">
          <div class="row justify-content-center">
               <div class="col-md-6">
                    <div class="card">
                         <div class="card-header">
                              <h3 class="text-center">เข้าสู่ระบบ</h3>
                         </div>
                         <div class="card-body">
                              <?php
                        if(isset($_GET['error'])) {
                            echo '<div class="alert alert-danger">ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง</div>';
                        }
                        ?>
                              <form action="api/users/login.php" method="post">
                                   <div class="mb-3">
                                        <label for="username" class="form-label">ชื่อผู้ใช้</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="ชื่อผู้ใช้" required>
                                   </div>
                                   <div class="mb-3">
                                        <label for="password" class="form-label">รหัสผ่าน</label>
                                        <input type="password" class="form-control" id="password" name="pass" 
                                             required placeholder="*********">
                                   </div>
                                   <button type="submit" class="btn btn-primary w-100">เข้าสู่ระบบ</button>
                              </form>
                         </div>
                         <div class="card-footer text-center">
                              <p>ยังไม่มีบัญชี? <a href="register.php">ลงทะเบียนที่นี่</a></p>
                         </div>
                    </div>
               </div>
          </div>
     </div>


     <script src="lib/jquery.js"></script>
     <script src="lib/bootstrap.bundle.js"></script>
</body>

</html>