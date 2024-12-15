<?php
include 'db.php';
session_start();
$stmt = $conn->query("SELECT * FROM assessment ");
$assessments = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_SESSION['disabled'])) {
     $disabled = $_SESSION['disabled'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>แบบประเมิน</title>
     <link rel="stylesheet" href="globals.css">
     <link rel="stylesheet" href="lib/bootstrap.min.css">
</head>
<style>
     .form-container {
          background-color: white;
          border-radius: 15px;
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
     }
</style>

<body>
     <div class="nav-mb">
          <?php include 'components/Navbar/Navbar.php' ?>
     </div>
     <div class="container mt-5">
          <div class="row justify-content-center">
               <div class="col-md-8">
                    <div class="form-container p-4 p-md-5">
                         <h1 class="text-center mb-4">แบบประเมินเว็บไซต์</h1>
                         <form method="POST" action="api/reviews/create.php">
                              <div class="mb-3">
                                   <label class="form-label">ความพึงพอใจโดยรวม</label>
                              </div>
                              <?php foreach ($assessments as $index => $row) : ?>
                                   <div class="mb-3">
                                        <label for="usability" class="form-label"><?= ($index + 1) . '.' . $row['assessment_name']; ?></label>
                                        <select class="form-select" id="usability" name="question_<?= $row['assessment_id']; ?>" required>
                                             <option value="">เลือกคำตอบ</option>
                                             <option value="5">ดีมาก</option>
                                             <option value="4">ดี</option>
                                             <option value="3">ปานกลาง</option>
                                             <option value="2">พอใช้</option>
                                             <option value="1">แย่</option>
                                        </select>
                                   </div>
                              <?php endforeach; ?>

                              <div class="text-center">

                                   <button type="submit" class="btn btn-primary btn-lg">ส่งแบบประเมิน</button>

                              </div>
                         </form>
                         <?php
                         $stmt = $conn->query("SELECT COUNT(DISTINCT user_id) AS total FROM reviews");
                         $result = $stmt->fetch(PDO::FETCH_ASSOC);
                         ?>
                         <div class="d-flex justify-content-end">
                              <p>จำนวนผู้ทำแบบประเมิน <?= $result['total'] ?></p>
                         </div>
                    </div>

               </div>
          </div>



          <script src="lib/jquery.js"></script>
          <script src="lib/bootstrap.bundle.js"></script>
</body>

</html>