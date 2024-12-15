<?php
include "../../db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $pid = $_POST['pid'];
    $title= $_POST['title'];
    $content = $_POST['content'];

    $conn->query("UPDATE posts SET title = '$title' , content = '$content' WHERE post_id = '$pid'");
    ?>
    <script>alert("อัพเดทข้อมูลสำเร็จ")</script>
    <?php
    header("refresh:0;url=../../manage_posts.php");
}else{
    ?>
    <script>alert("เกิดข้อผิดพลาดขึ้น")</script>
    <?php
    header("refresh:0;url=../../manage_posts.php");
}

?>