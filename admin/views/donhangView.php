<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/admin.css">
    <title>WebBanDoAn</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/adminProduct.js"></script>
    <script src="../js/notification.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<?php

displayNotification();
?>
<body>

<div class="product_view">
<div class="product_view_container">

    <h2>QUẢN LÝ ĐƠN HÀNG</h2>
    <form action="index.php" id="timdonhang" class = "timdonhang" method="GET">
        Trạng thái: 
        &nbsp;All<input type="radio" class="trangthai" name="trangthai" id="" value="all" checked>
        Chưa xử lý<input type="radio" class="trangthai" name="trangthai" id="" value="1">
        Đang giao hàng<input type="radio" name="trangthai" class="trangthai" id="" value="2">
        Đã giao hàng <input type="radio" name="trangthai" class="trangthai" id="" value="3">
        Đã hủy <input type="radio" name="trangthai" class="trangthai" id="" value="0">
        <br>
        <label for="startdate">Start: </label>
        <input type="date"  class="startdate" name="startdate" id="">
        <label for="startdate">End: </label>
        <input type="date"  class="enddate" name="enddate" id="">
        <button type="submit">Tìm kiếm</button>
    </form>

    <table class="table table-hover" id = "bangdonhang">
        <thead class="table-dark">
            <tr>
                <th>Mã đơn hàng</th>
                <th>Mã khách hàng</th>
                <th>Trạng thái</th>
                <th>Ngày đặt hàng</th>
                <th>Họ tên người nhận</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order_list as $order) : ?>
                <tr>

                    <td><?php echo $order['ma_don']; ?></td>
                    <td><?php echo $order['ma_kh']; ?></td>
                    <?php if ($order['trang_thai'] == 1){
                        echo '<td>Chưa xử lý</td>';
                    }elseif($order['trang_thai'] == 2){
                        echo '<td>Đang giao hàng</td>';
                    }elseif($order['trang_thai'] == 3){
                        echo '<td>Đã giao hàng</td>';
                    }else{
                        echo '<td>Đã hủy đơn</td>';
                    }
                    ?>
                    <td><?php echo $order['ngay_dat']; ?></td>
                    <td><?php echo $order['ho_ten']; ?></td>
                    <td><?php echo $order['sdt']; ?></td>
                    <td><?php echo $order['dia_chi']; ?></td>
                    <td>
                    <a  id="viewOrderDetails" href="index.php?action=showOrderDetail&id=<?php echo $order['ma_don']; ?>">

                    <img class="update_icon" src="../img/detail.png" alt="Xem chi tiết đơn hàng"></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
</div>
</body>
</html>
