<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/admin.css">
    <title>Chi tiết đơn hàng</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/adminProduct.js"></script>
    <script src="../js/notification.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

<div class="product_view">
<div class="product_view_container">
    <h2>CHI TIẾT ĐƠN HÀNG SỐ <?php echo $id;?></h2>
<table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Mã đơn hàng</th>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ct_hang as $ct) : ?>
                <tr>
                    <td><?php echo $ct['ma_don']; ?></td>
                    <td><?php echo $ct['ma_sp']; ?></td>
                    <td><?php echo $ct['ten_sp']; ?></td>
                    <td><?php echo $ct['don_gia']; ?></td>
                    <td><?php echo $ct['so_luong']; ?></td>
                    <td><?php echo $ct['tong_tien']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>


    </table>
   
    <div id="tongtien_orderDetail">
    Tổng tiền: <?php echo $tong;?><br>
    </div>
              <br>
              
    <?php
// Kiểm tra biến
if ($trangthai == 1) {
    // Nếu giá trị của biến bằng 1, hiển thị nút 1
    echo '<a class="btn_xacnhan" href="index.php?action=updateOrder&madon=' . $id . '&trangthai=2">Xác nhận đơn hàng</a>';

} elseif ($trangthai == 2) {
    // Nếu giá trị của biến bằng 2, hiển thị nút 2
    echo '<a class="btn_xacnhan" href="index.php?action=updateOrder&madon='.$id.'&trangthai=3">Xác nhận giao hàng</a>';
}
?>
</div>
</div>
</body>
</html>
