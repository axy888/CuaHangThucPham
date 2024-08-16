<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/admin.css">
    <title>Chi tiết phiếu nhập</title>
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

    <!-- Thêm chi tiết phiếu -->
      <div  class="addForm" id = "addProduct" style="display: none;">
            <form id="form_addProImpDetail" class="form_add" action="index.php?action=addImportDetail" method="post">
            <button type="button" id="close2" class="closeForm" href="#" onclick="closeform()">X</button>
            <h2>Chi tiết phiếu</h2>
            <!-- Mục nhập chi tiết cho từng mặt hàng -->
            <!-- <div id="chi-tiet">
                <div class="hang"> -->
                    <label for="ma_phieu_1" name="">Phiếu nhập:</label>
                   <input type="text" class="normal" name="ma_phieu_1" readonly value="<?php echo $id  ?>">
                    <input type="hidden" name="txtTrangthai" readonly value="<?php echo $tt?>">
                    <br>
                    <br>
                    <label for="ma_sp_1">Chọn sản phẩm:</label>
                    <select name="ma_sp_1" required>
                        <?php
                    foreach ($products as $product) {
                        echo '<option value="' . $product['ma_sp'] . '">' . $product['ten_sp'] . '</option>';
                    }
                    ?>
                    </select><br><br>
                    <label for="so_luong_1">Số lượng:</label>
                    <input type="number" class="normal" name="so_luong_1" required><br>
                    <br>
                    <label for="gia_nhap_1">Giá nhập:</label>
                    <input type="number" class="normal" step="0.01" name="gia_nhap_1" required><br><br>
                <!-- </div>
            </div> -->
            <button id="btnAddProImpDetail" class="btn_in_form" type="submit">Lưu chi tiết phiếu nhập</button>
        </form>
        </div>

    <!-- Sửa chi tiết phiếu -->
     <div class="addForm" id="updateImport" style="display: none;">
        
     <form class="form_add" id="form_updateImportDetail" onsubmit="return confirmUpdate();" action="index.php?action=updateImport&id=<?php echo $id; ?>&tt=<?php echo $tt; ?>" method="post">
        <button type="button" class="closeUpdateForm" id="close2" onclick="closeUpdateformCTPN()">X</button>

        <h2>Sửa phiếu nhập</h2>
       
        <label for="username">Mã phiếu:</label>
        <input type="text" class="normal" name="txtMaphieuUpdate" id="MaphieuUpdate"readonly value="<?php echo $id; ?>"><br><br>
        <input type="hidden" name="ma_spUpdate" id="MaspUpdate" value="">
        <label for="username">Tên sản phẩm:</label>
        <input type="text" class="normal" name="txtTensanpham" id="sanphamUpdate" readonly value=""><br>
        <br>
        <label for="username">Số lượng:</label>
        <input type="text" class="normal" name="txtSlUpdate" id="slUpdate" value=""><br><br>
        <input type="hidden" name="txtSlCu" id="slCu" value="">
        <label for="username">Đơn giá:</label>
        <input type="text" class="normal" name="txtDongiaUpdate" id="dongiaUpdate" value=""><br><br>
        <input type="hidden" name="txtDongiaCu" id="dongiaCu" value="">
        
        <input type="hidden" name="ketqua" id="kqInput" value="">
        <button id="btnUpdateProImpDetail" class="btn_in_form" type="submit">Sửa phiếu nhập</button>
    </form>
    </div> 


<div class="product_view">
<div class="product_view_container">
    <h2>CHI TIẾT PHIẾU NHẬP SỐ  <?php echo $id;?></h2>
    <?php if ($tt == 0): ?>
    <a class="category_add" style="width:210px" href="#" onclick="showAddForm()">
    <img src="../img/plus.png" alt="">Thêm chi tiết phiếu nhập</a>
    <?php endif; ?>
    
    </br>
    </br>
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Mã phiếu nhập </th>
                <th>Mã sản phẩm</th>
                <th >Số lượng</th>
                <th>Đơn giá</th>
                <?php if ($tt == 0): ?>
                <th>Thao tác</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($importdetaillist as $importdetail) : ?>
                <tr>
                    <td><?php echo $importdetail['ma_phieu']; ?></td>
                    <td><?php echo $importdetail['ma_sp']; ?></td>
                    <td><?php echo $importdetail['so_luong']; ?></td>
                    <td><?php echo $importdetail['don_gia']; ?></td>
                    <?php if ($tt == 0): ?>
                    <td>

                    <!--Tìm tên sp ứng với mã sp-->
                    <?php foreach ($products as $product): ?>
                        <?php if ($product['ma_sp'] === $importdetail['ma_sp']): ?>
                            <?php $tentam = $product['ten_sp']; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>


                        <a onclick="return confirmDelete();" href="index.php?action=deleteImportDetail&id=<?php echo $id; ?>&tt=<?php echo $tt; ?>&masp=<?php echo $importdetail['ma_sp']; ?>&sl=<?php echo $importdetail['so_luong']; ?>&dg=<?php echo $importdetail['don_gia']; ?>">
                        <img class="del_icon" src="../img/delete.png" alt="">
                    </a>
                        <a href="#" onclick="showUpdateForm('<?php echo $importdetail['ma_phieu']; ?>','<?php echo $importdetail['ma_sp'];?>','<?php echo $importdetail['so_luong'];?>','<?php echo $importdetail['don_gia'];?>','<?php echo $tentam;?>')">
                        <img class="update_icon" src="../img/update.png" alt="">
                    </a>
                    </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
     if ($tt == 0):
            echo '<form id="" class="form_tt_CTPN" onsubmit="return confirmUpdate();" action="index.php?action=changelockImport" method="post">';
            echo '
            <input type="hidden" name="changeLock" value="1">
            <input type="hidden" name="ma_phieu" readonly value="' . $id . '">
            <input type ="submit" value="Thay đổi trạng thái">
            </form>';
        endif; 
        ?>

    
</div>
</div>
    <script>
        

    </script>
</body>

</html>