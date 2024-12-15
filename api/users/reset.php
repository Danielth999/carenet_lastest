<?php
include "../../db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $uid = $_SESSION['uid'];
    $pass = $_POST['pass'];
    $npass = $_POST['npass'];
    $cpass = $_POST['cpass'];
    $stmt = $conn->query("SELECT * FROM users WHERE user_id = '$uid'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!password_verify($pass , $result['password'])){
        ?>
        <script>alert("รหัสผ่านปัจจุบันไม่ถูกต้อง")</script>
        <?php
        header("refresh:0;url=../../profile.php");
        exit;
    }
    if($npass !== $cpass){
        ?>
        <script>alert("รหัสผ่านไม่ตรงกัน")</script>
        <?php
        header("refresh:0;url=../../profile.php");
        exit;
    }
    $hashpass = password_hash($npass , PASSWORD_DEFAULT);
    $conn->query("UPDATE users SET password = '$hashpass'");
    ?>
    <script>alert("เปลี่ยนรหัสผ่านสำเร็จ")</script>
    <?php
    header("refresh:0;url=../../profile.php");
}

?>