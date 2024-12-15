<?php
include 'db.php';
session_start();

if (!isset($_SESSION['login'])) {
     header("Location: sign-in.php");
     exit;
}
if (isset($_SESSION['uid'])) {
     $user_id = $_SESSION['uid'];
     $stmt = $conn->query("SELECT * FROM users JOIN profiles ON users.user_id = profiles.user_id WHERE users.user_id = $user_id");
     $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>ข้อมูลส่วนตัว</title>
     <link rel="stylesheet" href="globals.css">
     <link rel="stylesheet" href="lib/bootstrap.min.css">
</head>
<style>
     .form-container {
          background-color: white;
          border-radius: 15px;
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
          padding: 30px;
          margin-top: 50px;
     }
</style>

<body>
     <div class="nav-mb">
          <?php include 'components/Navbar/Navbar.php' ?>
     </div>
     <div class="container">
          <div class="row justify-content-center">
               <div class="col-md-8">
                    <div class="form-container">
                         <h1 class="text-center mb-4">แก้ไขโปรไฟล์</h1>
                         <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                              <li class="nav-item" role="presentation">
                                   <button class="nav-link active" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                        aria-selected="true">ข้อมูลส่วนตัว</button>
                              </li>
                              <li class="nav-item" role="presentation">
                                   <button class="nav-link" id="password-tab" data-bs-toggle="tab"
                                        data-bs-target="#password" type="button" role="tab" aria-controls="password"
                                        aria-selected="false">เปลี่ยนรหัสผ่าน</button>
                              </li>
                         </ul>

                         <div class="tab-content" id="myTabContent">
                              <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                   aria-labelledby="profile-tab">
                                   <form action="api/profiles/update.php" method="post">
                                        <div class="mb-3 ">
                                             <label for="fullName" class="form-label">ชื่อ-นามสกุล</label>
                                             <div class="d-flex gap-2">
                                                  <input type="text"
                                                       class="form-control ?>"
                                                       name="fname"
                                                       value="<?php echo $user['first_name']; ?>" required>
                                                  <input type="text"
                                                       class="form-control ?>"
                                                       name="lname"
                                                       value="<?php echo $user['last_name']; ?>" required>
                                             </div>
                                        </div>
                                        <div class="mb-3">
                                             <label for="email" class="form-label">อีเมล</label>
                                             <input type="email"
                                                  class="form-control"
                                                  id="email" name="email"
                                                  value="<?php echo $user['email']; ?>" disabled>
                                        </div>
                                        <div class="mb-3">
                                             <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                                             <input type="tel"
                                                  class="form-control"
                                                  id="phone" name="tel"

                                                  maxlength="10"
                                                  value="<?php echo $user['tel']; ?>"
                                                  placeholder="0XX-XXX-XXXX">
                                        </div>
                                        <div class="mb-3">
                                             <label for="address" class="form-label">ที่อยู่</label>
                                             <textarea
                                                  class="form-control "
                                                  id="address" name="address" rows="3"
                                                  placeholder="กรุณาป้อนที่อยู่"><?php echo $user['address']; ?></textarea>
                                        </div>
                                        <button type="submit" name="update_profile"
                                             class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
                                   </form>
                              </div>
                              <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                                   <form action="api/users/reset.php" method="post">
                                        <div class="mb-3">
                                             <label for="currentPassword" class="form-label">รหัสผ่านปัจจุบัน</label>
                                             <input type="password"
                                                  class="form-control <?php echo isset($errors['currentPassword']) ? 'is-invalid' : ''; ?>"
                                                  id="currentPassword" name="pass" required>
                                             <?php if (isset($errors['currentPassword'])): ?>
                                                  <div class="invalid-feedback"><?php echo $errors['currentPassword']; ?>
                                                  </div>
                                             <?php endif; ?>
                                        </div>
                                        <div class="mb-3">
                                             <label for="newPassword" class="form-label">รหัสผ่านใหม่</label>
                                             <input type="password"
                                                  class="form-control <?php echo isset($errors['newPassword']) ? 'is-invalid' : ''; ?>"
                                                  id="newPassword" name="npass" required>
                                             <?php if (isset($errors['newPassword'])): ?>
                                                  <div class="invalid-feedback"><?php echo $errors['newPassword']; ?></div>
                                             <?php endif; ?>
                                        </div>
                                        <div class="mb-3">
                                             <label for="confirmPassword" class="form-label">ยืนยันรหัสผ่านใหม่</label>
                                             <input type="password"
                                                  class="form-control <?php echo isset($errors['confirmPassword']) ? 'is-invalid' : ''; ?>"
                                                  id="confirmPassword" name="cpass" required>
                                             <?php if (isset($errors['confirmPassword'])): ?>
                                                  <div class="invalid-feedback"><?php echo $errors['confirmPassword']; ?>
                                                  </div>
                                             <?php endif; ?>
                                        </div>
                                        <button type="submit"
                                             class="btn btn-primary">เปลี่ยนรหัสผ่าน</button>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>


     <script src="lib/jquery.js"></script>
     <script src="lib/bootstrap.bundle.js"></script>
</body>

</html>