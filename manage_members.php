<?php
include 'db.php';
session_start();
// ตรวจสอบว่ามีคำค้นหาหรือไม่
$search = isset($_GET['search']) ? $_GET['search'] : '';

// หากมีคำค้นหา ให้ใช้ SQL แบบค้นหา
if ($search) {
     $stmt = $conn->query("SELECT * FROM users WHERE username LIKE '%{$search}%'");
} else {
     // หากไม่มีคำค้นหา ให้ดึงสินค้าทั้งหมดs 
     $stmt = $conn->query("SELECT * FROM users");
}


$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="th">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>จัดการสมาชิก</title>
     <link rel="stylesheet" href="style/globals.css">
     <link rel="stylesheet" href="lib/bootstrap.min.css">
</head>

<body>
     <?php include 'navbar.php'; ?>

     <div class="container mt-4">
          <h2>จัดการสมาชิก</h2>

          <!-- ฟอร์มเพิ่มสมาชิก -->
          <div class="card mb-4">
               <div class="card-header">
                    เพิ่มสมาชิกใหม่
               </div>
               <div class="card-body">
                    <form action="api/users/create.php" method="post">
                         <div class="mb-3">
                              <label for="name" class="form-label">ชื่อ</label>
                              <input type="text" class="form-control" id="name" name="uname" required>
                         </div>
                         <div class="mb-3">
                              <label for="email" class="form-label">อีเมล</label>
                              <input type="email" class="form-control" id="email" name="email" required>
                         </div>
                         <div class="mb-3">
                              <label for="password" class="form-label">รหัสผ่าน</label>
                              <input type="password" class="form-control" id="password" name="pass" required>
                         </div>
                         <button type="submit" class="btn btn-primary">เพิ่มสมาชิก</button>
                    </form>
               </div>
          </div>

          <!-- ช่องค้นหา -->
          <div class="mb-4">
               <form action="manage_members.php" class="d-flex gap-2" method="get">

                    <input type="search" name="search" class="form-control" placeholder="ค้นหาสมาชิก...">
                    <button class="btn btn-secondary">
                         รีเซ็ต
                    </button>
                    <button class="btn btn-warning">
                         ค้นหา
                    </button>
               </form>
          </div>

          <!-- ตารางแสดงรายชื่อสมาชิก -->
          <table class="table" id="memberTable">
               <thead>
                    <tr>
                         <th>ID</th>
                         <th>ชื่อ</th>
                         <th>อีเมล</th>
                         <th>สิทธิ์</th>
                         <th>การดำเนินการ</th>
                    </tr>
               </thead>
               <tbody>
                    <!-- ตัวอย่างข้อมูล (ในระบบจริงควรดึงจากฐานข้อมูล) -->
                    <?php if (count($users) === 0): ?>
                         <tr>
                              <td colspan="5" class="text-center">ไม่พบข้อมูล

                              </td>
                         </tr>
                    <?php else : ?>
                         <?php foreach ($users as $index => $user): ?>
                              <form action="api/users/update.php" method="post">
                                   <tr>
                                        <td><?= ($index + 1) ?></td>
                                        <td>
                                             <input disabled type="text"  class="form-control" value=" <?= $user['username'] ?>">
                                             <input type="hidden" name="uid" value="<?= $user['user_id'] ?>">
                                        </td>
                                        <td>
                                             <input disabled type="text"  class="form-control" value=" <?= $user['email'] ?>">
                                        </td>
                                        <td>
                                             <select name="role" id="" class="form-control">
                                                  <option value=""><?= $user['role'] ?></option>
                                                  <option value="admin">admin</option>
                                                  <option value="user">user</option>
                                             </select>
                                        </td>
                                        <td>
                                             <button type="submit" class="btn btn-sm btn-primary">แก้ไข</button>

                                             <a class="btn btn-sm btn-danger" href="api/users/delete.php?id=<?= $user['user_id'] ?>">ลบ</a>
                                        </td>
                                   </tr>
                              </form>
                         <?php endforeach; ?>
                    <?php endif; ?>
               </tbody>
          </table>
     </div>

     <script src="lib/bootstrap.bundle.js"></script>
     <script src="lib/jquery.js"></script>

</body>

</html>