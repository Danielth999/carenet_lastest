<?php
include "../../db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $uid = $_SESSION['uid'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $imageurl = null;
    if($_FILES['image']['name']){
        $imagename = uniqid() . "_" . basename($_FILES['image']['name']);
        $imageurl = 'http://localhost/carenet/uploads/' . $imagename;
        move_uploaded_file($_FILES['image']['tmp_name'] , "../../uploads/" . $imagename);
    }
    $conn->query("INSERT INTO posts (user_id , title , content , image) VALUES ('$uid','$title','$content','$imageurl')");
    ?>
    <script>alert("เพิ่มโพสสำเร็จ")</script>
    <?php
    header("refresh:0;url=../../manage_posts.php");
}

?>