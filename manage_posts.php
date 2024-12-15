<?php
include 'db.php';
session_start();
// ตรวจสอบว่ามีคำค้นหาหรือไม่
$search = isset($_GET['search']) ? $_GET['search'] : '';

// หากมีคำค้นหา ให้ใช้ SQL แบบค้นหา
if ($search) {
    $stmt = $conn->query("SELECT * FROM posts JOIN users ON posts.user_id = users.user_id WHERE posts.title LIKE '%{$search}%'");
} else {
    // หากไม่มีคำค้นหา ให้ดึงสินค้าทั้งหมดs 
    $stmt = $conn->query("SELECT * FROM posts");
}


$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการโพสประชาสัมพันธ์</title>
    <link rel="stylesheet" href="style/globals.css">
    <link rel="stylesheet" href="lib/bootstrap.min.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-4">
        <h2>จัดการโพสประชาสัมพันธ์</h2>
        <!-- ฟอร์มสร้างโพสใหม่ -->
        <form method="post" action="api/posts/add.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="postTitle" class="form-label">หัวข้อโพส</label>
                <input type="text" name="title" class="form-control" id="postTitle" required>
            </div>
            <div class="mb-3">
                <label for="postContent" class="form-label">เนื้อหา</label>
                <textarea class="form-control" name="content" id="postContent" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="postContent" class="form-label">รูปภาพ</label>
                <input type="file" name="image" class="form-control" id="postTitle">
            </div>
            <button type="submit" class="btn btn-primary mb-2">สร้างโพสต์</button>
        </form>

        <!-- ช่องค้นหา -->
        <div class="mb-4">
            <form action="manage_posts.php" class="d-flex gap-2" method="get">

                <input type="search" name="search" class="form-control" placeholder="ค้นหาสมาชิก...">
                <button class="btn btn-secondary">
                    รีเซ็ต
                </button>
                <button class="btn btn-warning">
                    ค้นหา
                </button>
            </form>
        </div>
        <!-- ตารางแสดงโพสที่มีอยู่ -->
        <table class="table mt-4 text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>หัวข้อ</th>
                    <th>เนื้อหา</th>
                    <th>รูปภาพ</th>
                    <th>ผู้เข้าชม</th>
                    <th>วันที่สร้าง</th>
                    <th>การดำเนินการ</th>
                </tr>
            </thead>
            <tbody>
                <!-- ตัวอย่างข้อมูล (ในระบบจริงควรดึงจากฐานข้อมูล) -->
                <?php if (count($posts) === 0): ?>
                    <tr>
                        <td colspan="5" class="text-center">
                            ไม่พบข้อมูล
                        </td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($posts as $index => $row): ?>
                        <form action="api/posts/update.php" method="post">
                            <tr>
                                <td><?= ($index + 1) ?></td>
                                <td>
                                    <textarea name="title" class="form-control" id=""><?= $row['title'] ?></textarea>
                                    <input type="hidden" name="pid" value="<?= $row['post_id'] ?>">
                                </td>
                                <td>
                                    <textarea name="content" class="form-control" id=""><?= $row['content'] ?></textarea>

                                </td>
                                <td>
                                    <img src="<?= $row['image']  ?>" width="150" alt="">
                                </td>
                                <td>
                                    <?= $row['view'] ?>
                                </td>
                                <td>
                                    <?= $row['created_at'] ?>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-sm btn-primary">แก้ไข</button>
                                    <a class="btn btn-sm btn-danger" href="api/posts/delete.php?id=<?= $row['post_id'] ?>">ลบ</a>
                                </td>
                            </tr>
                        </form>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>


    <script src="lib/bootstrap.bundle.js"></script>
    <script src="lib/jquery.js"></script>
</body>

</html>