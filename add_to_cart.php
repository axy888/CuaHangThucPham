<?php
$con=mysqli_connect("localhost","root","","sieuthi");
mysqli_query($con,"SET NAMES 'utf8'");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_POST['id']))
{
    $productId =$_POST['id'];
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    $query = "SELECT * FROM sanpham WHERE ma_sp = '$productId'";
    $result = mysqli_query($con, $query);
    $product = mysqli_fetch_array($result);

    if(!isset($_SESSION['cart']))
    {
        $_SESSION['cart']=[];
    }

     // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
     if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = $product;
        $_SESSION['cart'][$productId]['quantity'] = $quantity;
    }
    $item = $_SESSION['cart'][$productId];
    // $quantity = $item['quantity'];
    // $totalPrice = $item['don_gia'] * $quantity;
    $cartItems = '';
    // Tính tổng số lượng và tổng giá trị của giỏ hàng
    $totalQuantity = 0;
    $grandTotal = 0;
    $_SESSION["tongtien"]=0;
    foreach ($_SESSION['cart'] as $product) {
       
        $totalQuantity += $product['quantity'];
        $grandTotal += $product['don_gia'] * $product['quantity'];
    }
    $_SESSION["tongtien"]=$grandTotal;
    $cartItems .= '<div class="cart-item" data-id="' . $item["ma_sp"] . '">';
    $cartItems .= '<img src="../img/' . $item["hinh"] . '" alt="' . $item["ten_sp"] . '">';
    $cartItems .= '<div>' . $item["ten_sp"] . '</div>';
    $cartItems .= '<div>' . number_format($item["don_gia"], 0, ',', '.') . ' đ x ' . $item['quantity'] . '</div>';
    $cartItems .= '<button class="remove-from-cart" data-id="' . $item["ma_sp"] . '">Xóa</button>';
    $cartItems .= '</div>';

    $response = [
        'items' => $cartItems,
        'quantity' => $totalQuantity,
        'total' => number_format($grandTotal, 0, ',', '.') . ' đ'
    ];
    
    echo json_encode($response);
    // echo '<div class="cart-item" data-id="' . $item["ma_sp"] . '">';
    // echo '<img src="img/' . $item["hinh"] . '" alt="' . $item["ten_sp"] . '">';
    // echo '<div>' . $item["ten_sp"] . '</div>';
    // echo '<div>' . number_format($item["don_gia"], 0, ',', '.') . ' đ x ' . $item['quantity'] . '</div>';
    // echo '<button class="remove-from-cart" data-id="' . $item["ma_sp"] . '">Xóa</button>';
    // echo '</div>';
    //  echo '<div>Tổng số lượng: ' . $totalQuantity . '</div>';
    // echo '<div>Tổng giá trị: ' . number_format($grandTotal, 0, ',', '.') . ' đ</div>';
}
?>