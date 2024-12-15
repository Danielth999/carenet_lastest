<?php
include "../../db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $uid = $_SESSION['uid'];
    $pid = $_POST['pid'];
    $content = $_POST['content'];


    $conn->query("INSERT INTO comments (user_id , post_id , content) VALUES ('$uid','$pid','$content')");
   
    header("refresh:0;url=../../posts_comments.php?id=" . $pid);
}else{
    echo "เกิดข้อผิดพลาด";
    header("refresh:0;url=../../posts_comments.php?id=" . $pid);
}

?>