<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/admin.css">
    <title>Quản lý nhà cung cấp</title>
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

    <!-- Thêm nhà cung cấp -->
    <div id = "addSupplier" class="addForm" style="display:none;">
        <form class="form_add" id="form_addSup" action="index.php?action=addSupplier" method="post">
            <button type="button" id="close2"  class="closeForm" onclick="closeformAddSup()">X</button>
            <h2 style="width:300px;">Thêm nhà cung cấp</h2>
            <label for="ten">Tên nhà cung cấp:</label>
            <input type="text" name="ten" class="normal" required><br>
            <br>
            <label for="diachi">Địa chỉ: </label>
            <!-- <input type="text" name = 'diachi' class="normal" required> -->
            <textarea name="diachi" id="" rows="4"></textarea><br><br><br><br>
            <br>
            <label for="sdt">Số điện thoại: </label>
            <input type="tel" name="sdt" class="normal" required><br>
            <br>
            <label for="email">Email: </label>
            <input type="text" name="email" class="normal" id=""><br>
            
            <button id="btnAddSup" class="btn_in_form" type="submit">Thêm</button>
        </form>
    </div>

    <!-- Sửa nhà cung cấp  -->
    <div id = "updateSupplier" class="addForm" style="display:none;">
        <form class="form_add" id="form_updateSup" action="index.php?action=updateSupplier" method="post">
            <button type="button" id="close2"  class="closeUpdateForm" onclick="closeUpdateformSup()">X</button>
            <h2 style="width:300px; text-align:center;">Sửa thông tin</h2>
            <label for="ma">Mã nhà cung cấp: </label>
            <input type="text"  readonly name="ma_ncc" id="ma_ncc" value="" class="normal"><br><br>
            <label for="ten">Tên nhà cung cấp:</label>
            <input type="text" name="ten_ncc" id="ten_ncc" class="normal" required><br>
            <br>
            <label for="diachi">Địa chỉ: </label>
            <!-- <input type="text" name = 'diachi' class="normal" required> -->
            <textarea name="diachi" id="diachi" rows="4" class="normal"></textarea><br><br><br><br>
            <br>
            <label for="sdt">Số điện thoại: </label>
            <input type="tel" name="sdt" id="sdt" class="normal" required><br>
            <br>
            <label for="email">Email: </label>
            <input type="text" name="email" id="email" class="normal" id=""><br>
            
            <button id="btnAddSup" class="btn_in_form" type="submit">Cập nhật</button>
        </form>
    </div>

<div class="product_view">
<div class="product_view_container">
    <h2>QUẢN LÝ NHÀ CUNG CẤP</h2>

     <!-- Tìm kiếm -->
     <form action="index.php" method="GET" class="searchSupplier">
        <!-- <input type="hidden" name="action" value="searchProduct"> -->
        Tìm kiếm theo: <select name="field" class="timkiem" id="timkiem">
            <option value="ma_ncc">Mã nhà cung cấp</option>
            <option value="ten_ncc">Tên nhà cung cấp</option>
            <option value="dia_chi">Địa chỉ</option>
            <option value="sdt">Số điện thoại</option>
            <option value="email">Email</option>
        </select>
        <input type="text" id="search" name="search" placeholder="Nhập thông tin cần tìm kiếm...">
        <button type="submit">Tìm kiếm</button>
    </form>
    <br>

    <a class="category_add" id = 'themSP' href="#" onclick="showAddFormSup()" style="width:170px;">
    <img src="../img/plus.png" alt="">Thêm nhà cung cấp</a>

    
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Mã nhà cung cấp</th>
                <th>Tên nhà cung cấp</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($suppliers as $supplier) : 
                if($supplier['trang_thai']!="off")
                {?>
                <tr>
                    <td><?php echo $supplier['ma_ncc']; ?></td>
                    <td><?php echo $supplier['ten_ncc']; ?></td>
                    <td><?php echo $supplier['dia_chi']; ?></td>
                    <td><?php echo $supplier['sdt']; ?></td>
                    <td><?php echo $supplier['email']; ?></td>
                    
                    <td>
                        
                        <a class ="xoancc"  href="index.php?action=deleteSupplier&id=<?php echo $supplier['ma_ncc']; ?>" onclick="return confirmDelete();">
                            <img class="del_icon" src="../img/delete.png" alt="">
                        </a>
                        <a href="#" onclick="showUpdateFormSup(
                            '<?php echo $supplier['ma_ncc']; ?>',
                            '<?php echo $supplier['ten_ncc']; ?>',
                            '<?php echo $supplier['dia_chi']; ?>',
                            '<?php echo $supplier['sdt']; ?>',
                            '<?php echo $supplier['email']; ?>')">
                        <img src="../img/update.png" alt=""></a>
                    </td>
                </tr>
            <?php }endforeach; ?>
        </tbody>



    </table>
    </div>
    </div>
</body>

</html>
