<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "carenet";
    try{
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user,$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

        // echo "success";
    }catch(PDOException $e){
        echo "fail" . $e->getMessage();
    }

?>