<?php
include "../../db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $uid = $_SESSION['uid'];
    $assessment_name = $_POST['assessment_name'];
    $conn->query("INSERT INTO assessment (assessment_name) VALUES ('$assessment_name')");
    ?>
    <script>alert("เพิ่มหัวข้อแบบประเมินสำเร็จ")</script>
    <?php
    header("refresh:0;url=../../manage_evaluation.php");
}else{
    ?>
    <script>alert("เกิดข้อผิดพลาดขึ้น")</script>
    <?php
    header("refresh:0;url=../../manage_evaluation.php");
}

?>