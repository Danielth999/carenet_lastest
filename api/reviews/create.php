<?php
include "../../db.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $uid = $_SESSION['uid'];
    
    foreach($_POST as $key => $values){
        if(strpos($key , 'question_') === 0){
            $tid = str_replace('question_', '' ,$key);
            $rating = $_POST["question_$tid"];
            $stmt = $conn->query("SELECT 1 FROM reviews WHERE user_id = '$uid' AND assessment_id = '$tid'");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() == 0){
                $conn->query("INSERT INTO reviews (assessment_id , user_id , rating) VALUES ('$tid','$uid','$rating')");
                $_SESSION['disabeld'] = "disabled";
                header("refresh:0;url=../../evaluation.php");
            }   
            $_SESSION['disabeld'] = "disabled";
            header("refresh:0;url=../../evaluation.php");
        }
    }
}
?>