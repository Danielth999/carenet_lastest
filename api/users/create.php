<?php
include "../../db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $stmt = $conn->query("SELECT * FROM users WHERE username = '$uname' OR email = '$email'");
    if($stmt->rowCount() > 0){
        ?>
        <script>alert("ชื่อผู้ใช้หรืออีเมลถูกใช้งานแล้ว")</script>
        <?php
        header("refresh:0;url=../../manage_members.php");
        exit;
    }
    $hashpass = password_hash($pass , PASSWORD_DEFAULT);
    $conn->query("INSERT INTO users (username , email , password) VALUES ('$uname','$email','$hashpass')");
    $uid = $conn->lastInsertID();
    $conn->query("INSERT INTO profiles (user_id) VALUES ('$uid')");
    ?>
    <script>alert("เพิ่มสมาชิกสำเร็จ")</script>
    <?php
    header("refresh:0;url=../../manage_members.php");
}

?>