<?php
// เริ่มต้น session
include 'db.php';
session_start();

// เชื่อมต่อกับฐานข้อมูล
if (isset($_SESSION['uid'])) {
     $uid = $_SESSION['uid'];
}
$stmt = $conn->query("SELECT * FROM messages m JOIN users u ON m.user_id = u.user_id WHERE m.user_id = $uid ORDER BY m.created_at ASC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>ติดต่อ Admin</title>
     <link rel="stylesheet" href="globals.css">
     <link rel="stylesheet" href="lib/bootstrap.min.css">

     <style>
          .chat-container {
               height: 400px;
               overflow-y: auto;
               /* ทำให้สามารถเลื่อนดูข้อความได้ */
          }

          .chat-message {
               margin-bottom: 10px;
               padding: 10px;
               border-radius: 10px;
          }

          .user-message {
               background-color: #007bff;
               color: white;
               margin-left: 20%;
          }

          .admin-message {
               background-color: #e9ecef;
               margin-right: 20%;
          }
     </style>
</head>

<body>

     <!-- Navbar -->
     <div class="nav-mb">
          <?php include "./components/Navbar/Navbar.php"; ?>
     </div>

     <div class="container mt-5">
          <div class="row justify-content-center">
               <div class="col-md-8">
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                         <!-- ปุ่มสำหรับกลับไปหน้ารายการห้องสนทนาสำหรับ admin -->
                         <a href="admin_chat_list.php" class="btn btn-secondary mb-3">กลับไปหน้ารายการ</a>
                    <?php endif; ?>
                    <div class="card">
                         <div class="card-header bg-primary text-white">
                              <div class="d-flex justify-content-between">
                                   <h5 class="mb-0">ติดต่อ Admin</h5>

                              </div>
                         </div>
                         <div class="card-body">
                              <div id="chat-container" class="chat-container mb-3">
                                   <!-- แสดงข้อความทั้งหมด -->
                                   <?php foreach ($messages as $message): ?>
                                        <div class="chat-message  user-message ?>">
                                             <strong><?= $message['username'] ?>:</strong> <?= $message['message'] ?>
                                        </div>
                                   <?php endforeach; ?>
                              </div>
                              <form action="api/messages/create.php" method="POST">
                                   <div class="input-group">
                                        <input type="text" id="message" class="form-control" name="msg" placeholder="พิมพ์ข้อความของคุณที่นี่..." required>
                                        <button class="btn btn-primary" type="submit">
                                             ส่ง
                                        </button>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <!-- Footer -->
     <?php include "./components/Footer/Footer.php"; ?>

     <script src="lib/bootstrap.bundle.js"></script>
</body>

</html>