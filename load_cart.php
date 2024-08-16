<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$totalQuantity = 0;
$grandTotal = 0;
$cartItems = '';

foreach ($_SESSION['cart'] as $product) {
    $cartItems .= '<div class="cart-item" data-id="' . $product["ma_sp"] . '">';
    $cartItems .= '<img src="/WebBanDoAn/img/' . $product["hinh"] . '" alt="' . $product["ten_sp"] . '">';
    $cartItems .= '<div>' . $product["ten_sp"] . '</div>';
    $cartItems .= '<div>' . number_format($product["don_gia"], 0, ',', '.') . ' đ x ' . $product['quantity'] . '</div>';
    $cartItems .= '<button class="remove-from-cart" data-id="' . $product["ma_sp"] . '">Xóa</button>';
    $cartItems .= '</div>';
    $totalQuantity += $product['quantity'];
    $grandTotal += $product['don_gia'] * $product['quantity'];
}

$response = [
    'items' => $cartItems,
    'quantity' => $totalQuantity,
    'total' => $grandTotal
];

echo json_encode($response);

?>
