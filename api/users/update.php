<?php
include "../../db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $uid = $_POST['uid'];
    $role = $_POST['role'];
  
    $conn->query("UPDATE users SET role = '$role' WHERE user_id = '$uid'");
    ?>
    <script>alert("อัพเดทข้อมูลสำเร็จ")</script>
    <?php
    header("refresh:0;url=../../manage_members.php");
}else{
    ?>
    <script>alert("เกิดข้อผิดพลาดขึ้น")</script>
    <?php
}

?>