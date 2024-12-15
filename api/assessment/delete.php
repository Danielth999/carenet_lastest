<?php
include "../../db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $aid = $_GET['id'];
    $conn->query("DELETE FROM assessment WHERE assessment_id = '$aid'");
    ?>
    <script>alert("ลบสำเร็จ")</script>
    <?php
    header("refresh:0;url=../../manage_evaluation.php");
}else{
    ?>
    <script>alert("เกิดข้อผิดพลาดขึ้น")</script>
    <?php
    header("refresh:0;url=../../manage_evaluation.php");
}

?>