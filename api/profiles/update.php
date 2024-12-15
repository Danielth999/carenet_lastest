<?php
include "../../db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $uid = $_SESSION['uid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];
  
    $conn->query("UPDATE profiles SET first_name = '$fname' , last_name = '$lname' , tel = '$tel' , address = '$address' WHERE user_id = '$uid'");
    ?>
    <script>alert("อัพเดทข้อมูลสำเร็จ")</script>
    <?php
    header("refresh:0;url=../../profile.php");
}else{
    ?>
    <script>alert("เกิดข้อผิดพลาดขึ้น")</script>
    <?php
    header("refresh:0;url=../../profile.php");
}

?>