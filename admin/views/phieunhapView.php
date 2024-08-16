<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/admin.css">
    <title>Quản lý nhập hàng</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/adminProduct.js"></script>
    <script src="../js/notification.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
<?php

displayNotification();
?>
     <!-- Thêm phiếu nhập -->
     <div  class="addForm" id = 'addProduct' style="display: none;">
        <form class="form_add" id="form_addProImp" action="index.php?action=addImport" method="POST">
        <button type="button" id="close2" class="closeForm" onclick="closeform()">X</button>
        <h2>Thêm phiếu nhập</h2><br>
            <label for="ma_ncc">Chọn nhà cung cấp:</label><br><br>
            <select name="ma_ncc" id="" required>
                <?php
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                foreach($suppliers as $supplier){
                    if ($supplier['trang_thai'] == "on")
                        echo '<option value="' . $supplier['ma_ncc'] . '">' . $supplier['ten_ncc'] . '</option>';
                }
                ?>

            </select><br><br>
            <label for="nguoiNhap">Người  nhập:</label>
         <input type="text" name="nguoiNhap" value="<?php echo $_SESSION["ten"]; ?>" readonly style="border: none;" class="normal">
         <br>
         <br>
            
            <button id="btnAddProImp" class="btn_in_form" type='submit'>Thêm phiếu</button>
        </form>
    </div>
<div class="product_view">
<div class="product_view_container">

    <h2>QUẢN LÝ PHIẾU NHẬP</h2>

    <form action="index.php" method="GET" class="searchImport">
            <input type="hidden" name="ctrl" value="importController">
            <input type="hidden" name="action" value="searchImport">
            Tìm kiếm theo: <select name="field" class="timkiem" id="timkiem">
                <option value="ma_phieu">Mã phiếu nhập</option>
                <option value="ma_ncc">Mã nhà cung cấp</option>
                <option value="tennv">Nhân viên</option>
            </select>
            <input type="text" id="search" name="search" placeholder="Nhập phiếu cần tìm">
            <label for="startdate">Start: </label>
        <input type="date"  class="startdate" name="startdate" id="">
        <label for="startdate">End: </label>
        <input type="date"  class="enddate" name="enddate" id="">
        <br><br>
        <label for="giafrom">Giá từ: </label>
        <input type="text"  class="giafrom" name="giafrom" id="">
        <label for="giato">đến: </label>
        <input type="text"  class="giato" name="giato" id="">
            <button type="submit">Tìm kiếm</button>
    </form>

    <div class="filter-container">
    <form action="index.php" method="GET" class="filter-phieunhap">
        <select name="field" class="sapxep" id="sapxep">
            <option value="">Sắp xếp theo</option>
            <option value="price_asc">Giá thấp đến cao</option>
            <option value="price_desc">Giá cao đến thấp</option>
            <option value="date_asc">Ngày tăng dần</option>
            <option value="date_desc">Ngày giảm dần</option>
        </select>
        <button type="submit">Lọc</button>
    </form>
    </div>

    <a id ="thempn" class="category_add" href="#" onclick="showAddForm()">
    <img src="../img/plus.png" alt="">Thêm phiếu nhập</a>
    <br>
    
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th >Mã phiếu nhập</th>
                <th>Mã nhà cung cấp</th>
                <th>Ngày nhập</th>
                <th>Nhân viên nhập hàng</th>
                <th>Tổng tiền</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($importList as $import) : ?>
                <tr>
                    <td><?php echo $import['ma_phieu']; ?></td>
                    <td><?php echo $import['ma_ncc']; ?></td>
                    <td><?php echo $import['ngay_tao']; ?></td>
                    <td><?php echo $import['nguoi_nhap']; ?></td>
                    <td><?php echo $import['tong_tien']; ?></td>
                    
                    <td>
                        
                        
                        <a href="index.php?action=showImportDetail&id=<?php echo $import['ma_phieu']; ?>&tt=<?php echo $import['trang_thai'];?>">
                            <img class="detail_icon" src="../img/detail.png" alt="">
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
</body>

</html>
