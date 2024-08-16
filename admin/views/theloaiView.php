<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/admin.css">
    <title>Quản lý thể loại</title>
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

<!-- Thêm thể loại -->
    <div  class="addForm" id = 'addProduct' style="display: none;">
        <form class="form_add" id="form_addProCt" action="index.php?action=addCategory" method="POST">
        <button type="button" id="close2" class="closeForm" onclick="closeform()">X</button>
        <h2>Thêm thể loại</h2><br>
            <label for="ten">Tên loại: </label>
            <input type="text" name = "ten" required class="normal"><br><br>
            <button id="btnAddProCt" class="btn_in_form" type='submit'>Thêm thể loại</button>
        </form>
    </div>


<!-- Sửa thể loại -->
<div  class="addForm" id = 'updateProduct' style="display: none;">
        
        
        <form class="form_add" id="form_updateProCt" action="index.php?action=updateCategory" onsubmit="return confirmUpdate();" method="POST">
        <button type="button" id="close2" class="closeUpdateForm" onclick="closeUpdateform()">X</button>
        <h3>Sửa thông tin thể loại</h3><br>
            <label for="ma">Mã loại: </label>
            <input type="text"  readonly name="ma_loai" id="ma_loai" value="" class="normal"><br><br>
            <label for="ten">Tên loại: </label>
            <input type="text" name = "ten_loai" id="ten_loai" required class="normal"><br><br><br><br>
            <button id="btnUpdateProCt" class="btn_in_form" type='submit'>Cập nhật</button>
        </form>
    </div>

<div class="product_view">
<div class="product_view_container">

    <h2>QUẢN LÝ THỂ LOẠI</h2>

    <!-- Tìm kiếm -->
    <form action="index.php" method="GET" class="searchCategory">
        <input type="hidden" name="action" value="searchCategory">
        <input type="text" id="search" name="search" placeholder="Nhập tên thể loại...">
        <button type="submit">Tìm kiếm</button>
    </form>

    <a class="category_add" id = 'themSP' href="#" onclick="showAddForm()">
            <img src="../img/plus.png" alt="">Thêm thể loại</a>

<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>Mã loại</th>
            <th>Tên loại</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach ($categories as $category) { 
                if ($category['da_xoa'] == 0)
                {
                ?>
                <tr>
                    <td><?php echo $category['ma_loai']; ?></td>
                    <td><?php echo $category['ten_loai']; ?></td>
                    
                    <td>
                        <a href="index.php?action=deleteCategory&id=<?php echo $category['ma_loai']; ?>"onclick="return confirmDelete();">
                        <img src="../img/delete.png" alt=""></a>
                        <a href="#" onclick="showUpdateFormCt(
                            '<?php echo $category['ma_loai']; ?>',
                            '<?php echo $category['ten_loai']; ?>')">
                        <img src="../img/update.png" alt=""></a>
                    </td>
                </tr>
            <?php }}
         ?>
    </tbody>
</table>

</div>
</div>
</html>