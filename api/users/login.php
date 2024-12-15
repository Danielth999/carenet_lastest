<?php
include "../../db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $pass = $_POST['pass'];
   
    $stmt = $conn->query("SELECT * FROM users WHERE  email = '$email'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt && password_verify($pass , $result['password'])){
        $_SESSION['uid'] = $result['user_id'];
        $_SESSION['uname'] = $result['username'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['role'] = $result['role'];
        $_SESSION['login'] = true;
        $_SESSION['visit'] = "active";
        ?>
        <script>alert("เข้าสู่ระบบสำเร็จ")</script>
        <?php
        header("refresh:0;url=../../index.php");
        exit;
    }else{
        ?>
        <script>alert("อีเมลหรือรหัสผ่านผิด")</script>
        <?php
        header("refresh:0;url=../../login.php");
        exit;
    }
 
    ?>
    <script>alert("มีบางอย่างผิดพลาด")</script>
    <?php
    header("refresh:0;url=../../login.php");
}

?>