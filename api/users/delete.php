<?php
include "../../db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $uid = $_GET['id'];
    $conn->query("DELETE FROM users WHERE user_id = '$uid'");
    ?>
    <script>alert("ลบสำเร็จ")</script>
    <?php
    header("refresh:0;url=../../manage_members.php");
}else{
    ?>
    <script>alert("เกิดข้อผิดพลาดขึ้น")</script>
    <?php
    header("refresh:0;url=../../manage_members.php");
}

?>