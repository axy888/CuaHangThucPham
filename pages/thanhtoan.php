<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/trangchu.css">
    <title>WebBanDoAn</title>
    <script src="../js/user.js"></script>
    <script src="../js/notification.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div class="notification" id="notification">Thêm thành công</div>
    <?php
        require_once("../header.php");
     ?>   
     <form action="thanhtoan.php?action=thanhtoan" class="form_thanh_toan" id="formThanhToan"method="POST">
        <div class="form_thanh_toan1">
            <h2>Thông tin giao hàng</h2>
            <label for="ten">Tên người nhận(*):</label>
            <input type="text" id="ten" name="txtTen" require><br>
            <label for="ten">Số điện thoại(*):</label>
            <input type="tel" id="so_dien_thoai" name="txtSdt" require><br>
            <label for="ten">Tỉnh/Thành phố(*):</label>
            <input type="text" id="tinh" name="txtTinh" require><br>
            <label for="ten">Quận/Huyện(*):</label>
            <input type="text" id="quan" name="txtQuan" require><br>
            <label for="ten">Phường/Xã(*):</label>
            <input type="text" id="phuong" name="txtPhuong" require><br>
            <label for="ten">Địa chỉ(*):</label>
            <input type="text" id="dia_chi" name="txtDiaChi" require><br>
        </div><br>
        
        <div class="form_thanh_toan2">
        <table>
        <tr>
            <th>Sản phẩm</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Tổng tiền</th>
            <th>Thao tác</th>
        </tr>
        <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $totalQuantity = 0;
            $grandTotal = 0;

            foreach ($_SESSION['cart'] as $item) {
                $totalQuantity += $item['quantity'];
                $grandTotal += $item['don_gia'] * $item['quantity'];
                ?>
                <tr data-id="<?php echo $item['ma_sp']; ?>">
                    <td>
                        <div class="product-info">
                            <img src="../img/<?php echo $item['hinh']; ?>" alt="<?php echo $item['ten_sp']; ?>">
                            <span><?php echo $item['ten_sp']; ?></span>
                        </div>
                    </td>
                    <td><?php echo number_format($item['don_gia'], 0, ',', '.'); ?> đ</td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo number_format($item['don_gia'] * $item['quantity'], 0, ',', '.'); ?> đ</td>
                    <td><button class="remove-from-cart" data-id="<?php echo $item['ma_sp']; ?>">Xóa</button></td>
                </tr>
                <?php
            }
            $_SESSION["tongtien"]=$grandTotal;
            ?>
           
            <?php
        } else {
            echo '<tr><td colspan="5">Giỏ hàng của bạn đang trống.</td></tr>';
        }
        ?>
    </table>
        </div>
        <div class="form_thanh_toan3">
                <div class="payment-method">
                <h3>Phương thức thanh toán</h3>
                <div>
                    <input type="radio" id="cod" name="payment_method" value="cod">
                    <label for="cod">COD</label>
                    <input type="radio" id="transfer" name="payment_method" value="transfer">
                    <label for="transfer">Chuyển khoản</label>
                </div>
            </div>
            <div id="cod_details" class="payment-details cod">
                <h4>COD</h4>
                <div>Nhận hàng mới thanh toán</div>
            </div>
            <div id="transfer_details" class="payment-details transfer">
                <h4>Chuyển khoản</h4>
                <div>Nội dung chuyển khoản: Tên người nhận_Thanh toán đơn hàng</div>
            </div>
            <br>
            <div class="total-info">
                <div>Tổng cộng: <span id="total_amount"><?php echo $grandTotal?> đ</span></div>
                <div>Phí vận chuyển: Miễn phí</div>
                <div>Tổng thanh toán: <span id="final_amount"><?php echo $grandTotal?> đ</span></div>
            </div>
        </div>
        <div class="form_thanh_toan4">
        <input type="hidden" name="ketquathanhtoan" id="kqThanhtoan" value="">
        <input type="button" onclick="window.location.href='sanpham.php'" value="Quay lại">
        <input type="submit"  id="btnThanhtoan" value="Thanh toán" onclick="thanhtoan()">
    </div>
     </form>
      <?php 
        require_once("../footer.php");
        // if (isset($_GET['action'])) 
        // {
        //     include_once("thongtinController.php");
        // }
    ?>
</body>

<script>
    $(document).ready(function() {
        //xóa giỏ hàng
        $('.form_thanh_toan2').on('click', '.remove-from-cart', function() {
            var productId = $(this).data('id');
            $.ajax({
                url: '../remove_from_cart.php',
                type: 'POST',
                data: { id: productId },
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    if (jsonResponse.status=="success") {
                        // $('.right_side').find('.cart-item[data-id="' + productId + '"]').remove();
                        // $('.total_infor').html('<div>Tổng tiền: ' + jsonResponse.total + '</div>');
                    }else{
                        // $('.right_side').append(response);
                    }
                   
                }
            });
        });
    });
    $("#formThanhToan").submit(function(event) {
      event.preventDefault();
      $.ajax({
        url: "ttcnController.php?action=thanhtoan", // Thay thế bằng URL đăng ký thực tế
        method: "POST",
        data: $(this).serialize(),
        // dataType: 'json',
        success: function(response) {
            var jsonResponse = JSON.parse(response);
            console.log(jsonResponse);  
            if (jsonResponse.status==1) {
            alert("Xác nhận đơn hàng thành công!");
            window.location.href = "sanpham.php";
            // Chuyển hướng đến trang chủ hoặc trang hồ sơ người dùng
          } if(jsonResponse.status==0) showNotification('Xác nhận đơn hàng thất bại','error');
          
        },
        error: function(xhr, status, error){
            alert("loi: ");
        }
      });
    });

    document.getElementById('cod').addEventListener('change', function() {
        document.getElementById('cod_details').style.display = 'block';
        document.getElementById('transfer_details').style.display = 'none';
    });

    document.getElementById('transfer').addEventListener('change', function() {
        document.getElementById('transfer_details').style.display = 'block';
        document.getElementById('cod_details').style.display = 'none';
    });

    
</script>
</html>