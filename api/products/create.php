<?php
include "../../db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $price = $_POST['price'];

    $imageurl = null;
    if($_FILES['image']['name']){
        $imagename = uniqid() . "_" . basename($_FILES['image']['name']);
        $imageurl = 'http://localhost/carenet/uploads/' . $imagename;
        move_uploaded_file($_FILES['image']['tmp_name'] , "../../uploads/" . $imagename);
    }
    $conn->query("INSERT INTO products (name , detail , price , image) VALUES ('$name','$detail','$price','$imageurl')");
    ?>
    <script>alert("เพิ่มสินค้าสำเร็จ")</script>
    <?php
    header("refresh:0;url=../../index.php");
}

?>