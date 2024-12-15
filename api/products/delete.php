<?php
include "../../db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $pid = $_GET['id'];
    $conn->query("DELETE FROM cart_item WHERE cart_item_id = '$pid'");
    header("refresh:0;url=../../cart.php");
}else{
    ?>
    <script>alert("เกิดข้อผิดพลาดขึ้น")</script>
    <?php
    header("refresh:0;url=../../cart.php");
}

?>