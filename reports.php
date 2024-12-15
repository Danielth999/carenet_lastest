<?php
session_start();
include 'db.php';
$stmt = $conn->query("SELECT Count(user_id) AS total_user FROM users");
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $conn->query("SELECT Count(post_id) AS total_post FROM posts");
$post = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->query("SELECT Count(id) AS total_view FROM visits");
$visit = $stmt->fetch(PDO::FETCH_ASSOC);
// average
$stmt = $conn->query("SELECT AVG(rating) AS average_score FROM reviews");
$average = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานข้อมูล</title>
    <link rel="stylesheet" href="globals.css">
    <link rel="stylesheet" href="lib/bootstrap.min.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-4">
        <h2>รายงานข้อมูล</h2>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">จำนวนสมาชิกทั้งหมด</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $user['total_user'] ?> คน</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">จำนวนโพสประชาสัมพันธ์</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $post['total_post'] ?> โพสต์</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">สถิติการเข้าชมเว็บไซต์</div>
                    <div class="card-body">
                        <!-- ในที่นี้ควรใส่กราฟหรือตารางแสดงสถิติ -->

                        <h5 class="card-title"><?= $visit['total_view'] ?> คน</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">ผลสรุปแบบประเมินล่าสุด</div>
                    <div class="card-body">
                        <!-- ในที่นี้ควรแสดงผลสรุปของแบบประเมินล่าสุด -->
                        <h5 class="card-title">คะแนนเฉลี่ย <?= round($average['average_score'], 2 ) ?> </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="lib/bootstrap.bundle.js"></script>
    <script src="lib/jquery.js"></script>
</body>

</html>