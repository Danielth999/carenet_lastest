<?php
include "../../db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $aid = $_POST['assessment_id'];
    $aname = $_POST['assessment_name'];

    $conn->query("UPDATE assessment SET assessment_name = '$aname' WHERE assessment_id = '$aid'");
    ?>
    <script>alert("อัพเดทข้อมูลสำเร็จ")</script>
    <?php
    header("refresh:0;url=../../manage_evaluation.php");
}else{
    ?>
    <script>alert("เกิดข้อผิดพลาดขึ้น")</script>
    <?php
    header("refresh:0;url=../../manage_evaluation.php");
}

?>