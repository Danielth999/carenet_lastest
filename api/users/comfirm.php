<?php
include "../../db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $email = $_POST['email'];
  $stmt = $conn->query("SELECT * FROM users WHERE email = '$email'");
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  if($stmt->rowCount() > 0){
    $_SESSION['verify_email'] = $result['email'];
    ?>
<script>alert("ยืนยันอีเมลสำเร็จ")</script>
    <?php
    header("refresh:0;url=../../forgot.php");
  }else{
    ?>
    <script>alert("ไม่มีอีเมลนี้ในระบบ")</script>
        <?php
        header("refresh:0;url=../../comfirm.php");
  }
}
?>