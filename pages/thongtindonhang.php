<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin đơn hàng</title>
    <link rel="stylesheet" href="../css/trangchu.css"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php
require_once("../header.php");
include_once("ttcnController.php");
?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>
<div class="divThongTin">
<div class="order-container">
        <h2>THÔNG TIN ĐƠN HÀNG</h2>
        <?php 
        
        global $order_list, $ct_hang;
        if($order_list == null) {
            echo "<script>document.querySelector('.divThongTin').style.height = '400px';</script>";
        }
        foreach ($order_list as $order) : ?>
            <?php if ($order['trang_thai'] != 0) : ?>
            <form action="thongtindonhang.php?action=cancelthongtin" method="POST" id="formThongTinDonHang">
                <label class="mdh" for="">Mã đơn hàng:</label>
                <input  class="formThongTinDonHang-input"  type="text" name="txtMadon" id="ma_don" value="<?php echo $order['ma_don']; ?>" readonly><br><br><br>
                <?php foreach ($ct_hang[$order['ma_don']] as $ct) : ?>
                    <label for="password">Mã sản phẩm:</label>
                <img src="../img/<?php echo $ct['hinh']; ?>" alt="">
                <input class="formThongTinDonHang-input"type="text" name="txtMasp" id="ma_sp" value="<?php echo $ct['ma_sp']; ?>" readonly><br>
                <label for="">Tên sản phẩm:</label>
                <input class="formThongTinDonHang-input"type="text" name="txtTensp" id="ten_sp" value="<?php echo $ct['ten_sp']; ?>" readonly><br>
                <label for="">Đơn giá:</label>
                <input class="formThongTinDonHang-input"type="text" name="txtDongia" id="don_gia" value="<?php echo $ct['don_gia']; ?>" readonly><br>
                <label for="">Số lượng:</label>
                <input class="formThongTinDonHang-input"type="text" name="txtSoluong" id="so_luong" value="<?php echo $ct['so_luong']; ?>" readonly><br><br><br>
                    <?php endforeach; ?>
                
                <label for="password">Ngày đặt:</label>
                <input class="formThongTinDonHang-input formThongTinDonHang-nd"class="formThongTinDonHang-nd" type="text" name="txtNgaydat" id="ngay_dat" value="<?php echo $order['ngay_dat']; ?>"readonly><br>
                <label for="password">Tổng tiền:</label>
                <input class="formThongTinDonHang-input formThongTinDonHang-tt"class="formThongTinDonHang-tt" type="text" name="txtTongtien" id="tong_tien" value="<?php echo $order['tong_tien']; ?> đ"readonly> <br>
                <label for="password">Địa chỉ:</label>
                <input class="formThongTinDonHang-dc" type="text" name="txtDiachi" id="diaChi" value="<?php echo $order['dia_chi']; ?>"readonly>   <br>
                <label for="password">Họ và tên:</label>
                <input class="formThongTinDonHang-input"type="text" name="txtHovaTen" id="hovaTen" value="<?php echo $order['ho_ten']; ?>"readonly>   <br>
                <label for="password">Số điện thoại:</label>
                <input class="formThongTinDonHang-input" type="tel" name="txtSdt" id="sdt2" value="<?php echo $order['sdt']; ?>"readonly> <br>
                <label for="password">Trạng thái:</label>
                <?php 
                    $trang_thai_text = '';
                    switch ($order['trang_thai']) {
                        case 1:
                            $trang_thai_text = 'Chưa xử lý';
                            break;
                        case 2:
                            $trang_thai_text = 'Đang giao hàng';
                            break;
                        case 3:
                            $trang_thai_text = 'Đã giao hàng';
                            break;
                        default:
                            $trang_thai_text = 'Không xác định';
                            break;
                    }
                ?>
               <input  class="formThongTinDonHang-tt formThongTinDonHang-input" type="text" name="txtTrangthai" id="trang_thai" value="<?php echo $trang_thai_text; ?>" readonly><br><br>

                <?php if ($order['trang_thai'] == 1) : ?>
            <input type="submit" value="Hủy" id="btnCancel">
        <?php endif; ?>
            </form>
            <br><br>
            <?php endif; ?>
                <?php endforeach; ?>
    </div>
</div>

<?php
require_once("../footer.php");    
?>
</html>