<?php
include "../../db.php";
session_start();
if(!isset($_SESSION['verify_email'])){
        ?>
    <script>alert("โปรดยืนยันอีเมลก่อน")</script>
        <?php
    header("refresh:0;url=../../comfirm.php");
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $npass = $_POST['npass'];
  $cpass = $_POST['cpass'];
  if($npass !== $cpass){
    ?>
    <script>alert("รหัสผ่านไม่ตรงกัน")</script>
    <?php
    header("refresh:0;url=../../forgot.php");
    exit;
}
$hashpass = password_hash($pass , PASSWORD_DEFAULT);

$conn->query("INSERT INTO users (password) VALUES ('$hashpass')");
?>
<script>alert("เปลี่ยนรหัสผ่านสำเร็จ")</script>
<?php
header("refresh:0;url=../../forgot.php");

  
}
?>