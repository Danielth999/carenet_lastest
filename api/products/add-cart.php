<?php
include "../../db.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_SESSION['uid'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // ตรวจสอบว่ามีตะกร้าสำหรับผู้ใช้งานหรือยัง
    $stmt = $conn->query("SELECT * FROM cart WHERE user_id = '$uid'");
    $cart = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cart) {
        // สร้างตะกร้าใหม่ถ้ายังไม่มี
        $conn->query("INSERT INTO cart (user_id) VALUES ('$uid')");
        $cartid = $conn->lastInsertId();
    } else {
        $cartid = $cart['cart_id'];
    }

    // ตรวจสอบว่ามี product_id อยู่แล้วหรือไม่
    $stmt1 = $conn->query("SELECT * FROM cart_item WHERE product_id = '$product_id' AND cart_id = '$cartid'");
    $cart_item = $stmt1->fetch(PDO::FETCH_ASSOC);

    if ($cart_item) {
        // อัปเดตจำนวนสินค้า
        $conn->query("UPDATE cart_item SET quantity = quantity + $quantity WHERE product_id = '$product_id' AND cart_id = '$cartid'");
    } else {
        // เพิ่มสินค้าใหม่ลงในตะกร้า
        $conn->query("INSERT INTO cart_item (cart_id, product_id, quantity) VALUES ('$cartid', '$product_id', '$quantity')");
    }

    echo json_encode(['status' => 'success']);
}
?>
