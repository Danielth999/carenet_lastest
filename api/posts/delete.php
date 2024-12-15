<?php
include "../../db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $pid = $_GET['id'];
    $conn->query("DELETE FROM posts WHERE post_id = '$pid'");
    ?>
    <script>alert("ลบสำเร็จ")</script>
    <?php
    header("refresh:0;url=../../manage_posts.php");
}else{
    ?>
    <script>alert("เกิดข้อผิดพลาดขึ้น")</script>
    <?php
    header("refresh:0;url=../../manage_posts.php");
}

?>