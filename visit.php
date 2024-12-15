<?php
include "db.php";


if(isset($_SESSION['visit']) && $_SESSION['visit'] == "active"){
    $conn->query("UPDATE visits SET visit = visit + 1");
    $_SESSION['visit'] = "inactive";
}
$stmt = $conn->query("SELECT visit FROM visits");
$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo $row['visit'];

?>