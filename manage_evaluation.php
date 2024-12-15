<?php
include 'db.php';
session_start();
$search = isset($_GET['search']) ? $_GET['search'] : '';

// หากมีคำค้นหา ให้ใช้ SQL แบบค้นหา
if ($search) {
     $stmt = $conn->query("SELECT * FROM assessment  WHERE assessment_name LIKE '%{$search}%'");
} else {
     // หากไม่มีคำค้นหา ให้ดึงสินค้าทั้งหมดs 
     $stmt = $conn->query("SELECT * FROM assessment");
}


$assessment = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="th">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>จัดการแบบประเมิน</title>
     <link rel="stylesheet" href="style/globals.css">
     <link rel="stylesheet" href="lib/bootstrap.min.css">
</head>

<body>
     <?php include 'navbar.php'; ?>

     <div class="container mt-4">
          <h2>จัดการแบบประเมิน</h2>
          <!-- ฟอร์มสร้างแบบประเมินใหม่ -->
          <form action="api/assessment/create.php" method="post">
               <div class="mb-3">
                    <label for="surveyTitle" class="form-label">ชื่อแบบประเมิน</label>
                    <input type="text" class="form-control" name="assessment_name" id="surveyTitle" required>
               </div>
               <button type="submit" class="btn btn-primary mb-2">สร้างแบบประเมิน</button>
          </form>

          <div class="mb-4">
               <form action="manage_evaluation.php" class="d-flex gap-2" method="get">

                    <input type="search" name="search" class="form-control" placeholder="ค้นหาสมาชิก...">
                    <button class="btn btn-secondary">
                         รีเซ็ต
                    </button>
                    <button class="btn btn-warning">
                         ค้นหา
                    </button>
               </form>
          </div>
          <!-- ตารางแสดงแบบประเมินที่มีอยู่ -->
          <table class="table mt-4">
               <thead>
                    <tr>
                         <th>ID</th>
                         <th>ชื่อแบบประเมิน</th>

                         <th>การดำเนินการ</th>
                    </tr>

               </thead>
               <tbody>
                    <!-- ตัวอย่างข้อมูล (ในระบบจริงควรดึงจากฐานข้อมูล) -->
                    <?php foreach ($assessment as $index => $row) : ?>
                         <form action="api/assessment/update.php" method="post">
                              <tr>
                                   <td><?= ($index + 1) ?></td>
                                   <td>
                                        <input class="form-control" type="text" name="assessment_name" value=" <?= ($row['assessment_name']) ?>" id="">
                                        <input type="hidden" name="assessment_id" value="<?= ($row['assessment_id']) ?>">
                                   </td>

                                   <td>
                                        <button type="submit" class="btn btn-sm btn-primary">แก้ไข</button>

                                        <a class="btn btn-sm btn-danger" href="api/assessment/delete.php?id=<?= $row['assessment_id'] ?>">ลบ</a>

                                   </td>
                              </tr>
                         </form>
                    <?php endforeach; ?>

               </tbody>
               <thead>
                    <tr>
                         <th colspan="3" class="text-center">
                              จำนวนผู้ทำแบบสอบประเมิน
                         </th>
                    </tr>

               </thead>
               <tbody>
                    <?php
                    $stmt = $conn->query("SELECT COUNT(DISTINCT user_id) AS total FROM reviews");
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <tr>
                         <td class="text-center" colspan="3">
                              <?=$result['total']?>:คน
                         </td>
                    </tr>
               </tbody>

          </table>
     </div>


     <script src="lib/bootstrap.bundle.js"></script>
     <script src="lib/jquery.js"></script>
</body>

</html>