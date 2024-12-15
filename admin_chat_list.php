<?php
include 'db.php';
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
     header('Location: login.php');
     exit();
}

// Fetch users who have sent messages
$stmt = $conn->query("SELECT * FROM messages m
JOIN users u ON m.user_id = u.user_id 
ORDER BY m.created_at DESC
");

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="th">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>รายการผู้ใช้ที่ส่งข้อความ</title>
     <link rel="stylesheet" href="globals.css">
     <link rel="stylesheet" href="lib/bootstrap.min.css">
     <style>
          .user-list {
               max-height: 600px;
               overflow-y: auto;
          }

          .user-item {
               cursor: pointer;
               transition: background-color 0.3s;
          }

          .user-item:hover {
               background-color: #f8f9fa;
          }
     </style>
</head>

<body>
     <div class="nav-mb">
          <?php include "./components/Navbar/Navbar.php"; ?>
     </div>

     <div class="container mt-5">
          <h2 class="mb-4">รายการผู้ใช้ที่ส่งข้อความ</h2>
          <div class="user-list list-group">
               
                   <table class="table text-center align-middle  table-hover">
                    <thead>
                         <tr>
                              <th>
                                   #
                              </th>
                              <th>
                                   ชื่อผู้ใช้
                              </th>
                              <th>
                                   ข้อความล่าสุด
                              </th>
                              <th>
                                   เวลา
                              </th>
                         </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $index => $user): ?>
                         <tr>
                              <td>
                                   <?= ($index + 1) ?>
                              </td>
                              <td>
                                   <?= $user['username'] ?>
                              </td>
                              <td>
                                   <?= $user['message'] ?>
                              </td>
                              <td>
                                      <?= date('d/m/Y H:i:s', strtotime($user['created_at'])) ?>
                              </td>     
                         </tr>
                         <?php endforeach; ?>
                    </tbody>
                   </table>
              
          </div>
     </div>


     <script src="lib/bootstrap.bundle.js"></script>
</body>

</html>