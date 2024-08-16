<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['id'])) {
    $productId = $_POST['id'];

    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }
    
    $totalQuantity = 0;
    $grandTotal = 0;
    foreach ($_SESSION['cart'] as $product) {
        $totalQuantity += $product['quantity'];
        $grandTotal += $product['don_gia'] * $product['quantity'];
    }

    $response = [
        'status' => "success",
        'quantity' => $totalQuantity,
        'total' => number_format($grandTotal, 0, ',', '.') . ' đ'
    ];
    echo json_encode($response);
}
?>
