<?php
include "../../db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $uid = $_SESSION['uid'];
    $message = $_POST['msg'];

    $conn->query("INSERT INTO messages (user_id ,message) VALUES ('$uid','$message')");
    ?>
    <script>alert("ส่งข้อความถึงแอดมินสำเร็จ")</script>
    <?php
    header("refresh:0;url=../../user_chat.php");
}

?>