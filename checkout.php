<?php
// You can add any necessary PHP logic here, such as updating database records or sending confirmation emails
$orderNumber = "ORD" . rand(10000, 99999); // Generate a random order number for this example
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ชำระเงินสำเร็จ</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="globals.css">
    <link rel="stylesheet" href="lib/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card border-success">
                    <div class="card-header bg-success text-white">
                        <h1 class="text-center"> ชำระเงินสำเร็จ</h1>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">ขอบคุณสำหรับการสั่งซื้อ</h2>
                        <p class="card-text text-center">การชำระเงินของคุณเสร็จสมบูรณ์แล้ว</p>
                        <p class="card-text text-center">หมายเลขคำสั่งซื้อของคุณคือ: <strong><?php echo $orderNumber; ?></strong></p>
                        <hr>
                        <div class="text-center">
                            <p>คุณจะได้รับอีเมลยืนยันการสั่งซื้อในไม่ช้า</p>
                            <p>หากคุณมีคำถามใดๆ กรุณาติดต่อฝ่ายบริการลูกค้าของเรา</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-grid gap-2">
                            <a href="index.php" class="btn btn-primary btn-lg">กลับไปยังหน้าหลัก</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="lib/jquery.js"></script>
    <script src="lib/bootstrap.bundle.js"></script>
</body>

</html>