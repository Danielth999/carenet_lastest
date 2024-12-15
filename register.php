<?php
include 'db.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>สมัครสมาชิก</title>
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
                              <h3 class="text-center">ลงทะเบียน</h3>
                         </div>
                         <div class="card-body">
                              <form action="api/users/regis.php" method="post">
                                   <div class="mb-3">
                                        <label for="username" class="form-label">ชื่อผู้ใช้</label>
                                        <input type="text" class="form-control" id="username" name="uname" required placeholder="john_doe">
                                   </div>
                                   <div class="mb-3">
                                        <label for="email" class="form-label">อีเมล</label>
                                        <input type="email" class="form-control" id="email" name="email" required placeholder="john_doe@gmail.com">
                                   </div>
                                   <div class="mb-3">
                                        <label for="password" class="form-label">รหัสผ่าน</label>
                                        <input type="password" class="form-control" id="password" name="pass" required placeholder="*********">
                                   </div>
                                   <div class="mb-3">
                                        <label for="confirm_password" class="form-label">ยืนยันรหัสผ่าน</label>
                                        <input type="password" class="form-control" id="confirm_password" name="cpass" required placeholder="*********">
                                   </div>
                                   <button type="submit" class="btn btn-primary w-100">ลงทะเบียน</button>
                              </form>
                         </div>
                         <div class="card-footer text-center">
                              <p>มีบัญชีอยู่แล้ว? <a href="sign-in.php">เข้าสู่ระบบที่นี่</a></p>
                         </div>
                    </div>
               </div>
          </div>
     </div>


     <script src="lib/jquery.js"></script>
     <script src="lib/bootstrap.bundle.js"></script>
</body>

</html>