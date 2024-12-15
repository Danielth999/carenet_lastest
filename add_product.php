<?php
include 'db.php';
session_start();

// Check if the user is logged in and has the right permissions
// This is a placeholder - implement your actual authentication logic
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มโพสต์ประชาสัมพันธ์</title>
    <link rel="stylesheet" href="globals.css">
    <link rel="stylesheet" href="lib/bootstrap.min.css">
    <style>
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
       
    </style>
</head>
<body>
    <div class="nav-mb">
        <?php include './components/Navbar/Navbar.php' ?>
    </div>

    <div class="container mt-5">
        <div class="form-container">
            <h1 class="mb-4">เพิ่มสินค้า</h1>
            <form action="api/products/create.php" enctype="multipart/form-data" method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">ชื่อสินค้า</label>
                    <input type="text" class="form-control" id="" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">ราคา</label>
                    <input type="number" class="form-control" id="title" name="price" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">รายละเอียด</label>
                    <textarea class="form-control" id="content" name="detail" rows="6" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="image_url" class="form-label">URL รูปภาพ</label>
                    <input type="file" class="form-control" id="image"  name="image">
                </div>
                <button type="submit" class="btn btn-primary">เพิ่มสินค้า</button>
                <a href="index.php" class="btn btn-secondary ms-2">ยกเลิก</a>
            </form>
        </div>
    </div>

    <?php include './components/Footer/Footer.php' ?>

    <script src="lib/bootstrap.bundle.js"></script>
    <script src="lib/jquery.js"></script>
</body>
</html>

