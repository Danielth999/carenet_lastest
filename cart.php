<?php
include 'db.php';
session_start();

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['uid'])) {
    header('Location: login.php');
    exit();
}

$uid = $_SESSION['uid'];
$total = 0;





// ดึงข้อมูลสินค้าในตะกร้าโดยใช้ Prepared Statement
$stmt = $conn->query("SELECT *
                            FROM cart_item ci 
                            JOIN products p ON ci.product_id = p.product_id
                            WHERE ci.cart_id = (
                            SELECT cart_id
                            FROM cart
                            WHERE user_id = '$uid'
                            )");
$cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
// คำนวณยอดรวม
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];  // Changed 'quantity' to 'quantity'
}

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตะกร้าสินค้า</title>
    <link rel="stylesheet" href="globals.css">
    <link rel="stylesheet" href="lib/bootstrap.min.css">
    <style>
        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="nav-mb">
        <?php include "./components/Navbar/Navbar.php"; ?>
    </div>

    <div class="container mt-5">
        <h1 class="mb-4">ตะกร้าสินค้า</h1>

        <?php if (empty($cart)): ?>
            <div class="alert alert-info">
                ตะกร้าสินค้าของคุณว่างเปล่า
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover text-center align-middle">
                    <thead>
                        <tr>
                            <th>รูปภาพ</th>
                            <th>สินค้า</th>
                            <th>ราคา</th>
                            <th>จำนวน</th>
                            <th>รวม</th>
                            <th>การดำเนินการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $index => $item): ?>
                            <tr>
                                <td>
                                    <?php if (empty($item['image'])) :?>
                                  
                                    <?php else:  ?>
                                        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="product-image">
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $item['name']; ?></td>
                                <td><?php echo number_format($item['price'], 2); ?> บาท</td>
                                <td>
                                    <?php echo $item['quantity']; ?>
                                </td>
                                <td><?php echo number_format($item['price'] * $item['quantity'], 2); ?> บาท</td>
                                <td>
                                    <a href="api/products/delete.php?id=<?= $item['cart_item_id']; ?>" class="btn btn-danger btn-sm">
                                        ลบ
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end"><strong>รวมทั้งหมด:</strong></td>
                            <td><strong><?php echo number_format($total, 2); ?> บาท</strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="text-end mt-3">
                <a href="checkout.php" class="btn btn-primary btn-lg">
                    ชำระเงิน
                </a>
            </div>
        <?php endif; ?>
    </div>

    <script src="lib/jquery.js"></script>
    <script src="lib/bootstrap.bundle.js"></script>
</body>

</html>