<?php
include "../../db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    if($pass !== $cpass){
        ?>
        <script>alert("รหัสผ่านไม่ตรงกัน")</script>
        <?php
        header("refresh:0;url=../../regis.php");
        exit;
    }
    $stmt = $conn->query("SELECT * FROM users WHERE username = '$uname' OR email = '$email'");
    if($stmt->rowCount() > 0){
        ?>
        <script>alert("ชื่อผู้ใช้หรืออีเมลถูกใช้งานแล้ว")</script>
        <?php
        header("refresh:0;url=../../regis.php");
        exit;
    }
    $hashpass = password_hash($pass , PASSWORD_DEFAULT);
    $conn->query("INSERT INTO users (username , email , password) VALUES ('$uname','$email','$hashpass')");
    $uid = $conn->lastInsertID();
    $conn->query("INSERT INTO profiles (user_id) VALUES ('$uid')");
    ?>
    <script>alert("สมัครสมาชิกสำเร็จ")</script>
    <?php
    header("refresh:0;url=../../login.php");
}

?>