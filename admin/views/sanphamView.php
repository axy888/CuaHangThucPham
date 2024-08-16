<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/admin.css">
    <title>Quản lý sản phẩm</title>
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

    <!-- Thêm sản phẩm -->
    <div  class="addForm" id = 'addProduct' style="display: none;">
        
        
        <form class="form_add" id="form_addPro" action="index.php?action=addProduct" method="POST">
        <button type="button" id="close2" class="closeForm" onclick="closeform()">X</button>
        <h2>Thêm sản phẩm</h2><br>
            <label for="ten">Tên sản phẩm: </label>
            <input type="text" class="normal" name = "ten" required ><br><br>
            <label for="id_danh_muc">Chọn danh mục: </label>
            <select name="id_danh_muc" id="" required>
                <?php
                foreach($categories as $category){
                    if ($category['da_xoa'] == 0)
                        echo '<option value="' . $category['ma_loai'] . '">' . $category['ten_loai'] . '</option>';
                }
                ?>
            </select><br><br>
            <label for="anh">Hình ảnh: </label>
            <input type="file" id="anh" class="normal" name = 'anh' accept="images/*"><br>
            <br>
            <label for="gia">Giá: </label>
            <input type="number" name="gia" class="normal" required><br><br>
            <label for="mota">Mô tả: </label>
            
            <textarea name="mota" id="" rows="5"></textarea>
            <br><br><br><br><br>
            <button id="btnAddPro" class="btn_in_form" type='submit'>Thêm sản phẩm</button>
        </form>
    </div>

    <!-- Sửa sản phẩm -->
    <div  class="addForm" id = 'updateProduct' style="display: none;">
        <form class="form_add" id="form_updatePro" action="index.php?action=updateProduct" onsubmit="return confirmUpdate();" method="POST">
        <button type="button" id="close2" class="closeUpdateForm" onclick="closeUpdateform()">X</button>
        <h3>Sửa thông tin sản phẩm</h3><br>
            <label for="ma">Mã sản phẩm: </label>
            <input type="text"  readonly name="ma_sp" id="ma_sp" value="" class="normal"><br><br>
            <label for="ten">Tên sản phẩm: </label>
            <input type="text" name = "ten_sp" id="ten_sp" required class="normal"><br><br>
            <label for="the_loai">Chọn danh mục: </label>
            <select name="the_loai" id="the_loai2" required>
                <?php
                foreach($categories as $category){
                    if ($category['da_xoa'] == 0)
                        echo '<option value="' . $category['ma_loai'] . '">' . $category['ten_loai'] . '</option>';
                }
                ?>
            </select><br><br>
            <label for="anh">Hình ảnh hiện tại: </label>
            <img id="current_image" src="" alt="Current Image" style="width:100px;height:100px;"><br>
            <label for="anh">Hình ảnh mới: </label>
            <input type="file" id="anh" name="hinh" accept="image/*" class="normal">
            <br><br>
            <label for="gia">Giá: </label>
            <input type="number" name="don_gia" id="don_gia"required class="normal"><br><br>
            <label for="mota">Mô tả: </label>
            
            <textarea name="mo_ta" id="mo_ta" rows="5"></textarea>
            <br><br><br><br><br><br>
            <button id="btnUpdatePro" class="btn_in_form" type='submit'>Cập nhật</button>
        </form>
    </div>

<div class="product_view">
<div class="product_view_container">

    <h2>QUẢN LÝ SẢN PHẨM</h2>

    <!-- Tìm kiếm -->
    <form action="index.php" method="GET" class="search-form">
        <!-- <input type="hidden" name="action" value="searchProduct"> -->
        Tìm kiếm theo: <select name="field" class="timkiem" id="timkiem">
            <option value="ma_sp">Mã sản phẩm</option>
            <option value="ma_loai">Mã loại</option>
            <option value="ten_sp">Tên sản phẩm</option>
            <option value="don_gia">Đơn giá</option>
            <option value="mo_ta">Mô tả</option>
        </select>
        <input type="text" id="search" name="search" placeholder="Nhập tên sản phẩm cần tìm kiếm">
        <button type="submit">Tìm kiếm</button>
    </form>

    <div class="filter-container">
        <form action="index.php" method="GET" class="filter-sanpham">
        <!-- <input type="hidden" name="action" value="filterProduct"> -->
            <select name="field" class="sapxep" id="sapxep">
                <option value="">Sắp xếp theo</option>
                <option value="name_asc">Tên A-Z</option>
                <option value="name_desc">Tên Z-A</option>
                <option value="price_asc">Giá thấp đến cao</option>
                <option value="price_desc">Giá cao đến thấp</option>
            </select>
            <button type="submit">Lọc</button>
        </form>
        </div>

    <a class="category_add" id = 'themSP' href="#" onclick="showAddForm()">
            <img src="../img/plus.png" alt="">Thêm sản phẩm</a>

<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Mã loại</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Mô tả</th>
            <th>Hình</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach ($products as $product) { 
                ?>
                <tr>
                    <td><?php echo $product['ma_sp']; ?></td>
                    <td><?php echo $product['ten_sp']; ?></td>
                    <td><?php echo $product['ma_loai']; ?></td>
                    <td><?php echo $product['so_luong']; ?></td>
                    <td><?php echo $product['don_gia']; ?></td>
                    <td><?php echo $product['mo_ta']; ?></td>
                    <td><img src="../img/<?php echo $product['hinh']; ?>" alt="<?php echo $product['ten_sp']; ?>" style="width:100px;height:100px;"></td>
                    <td>
                        <a href="index.php?action=deleteProduct&id=<?php echo $product['ma_sp']; ?>"onclick="return confirmDelete();">
                        <img src="../img/delete.png" alt=""></a>
                        <a href="#" onclick="showUpdateFormProduct(
                            '<?php echo $product['ma_sp']; ?>',
                            '<?php echo $product['ten_sp']; ?>',
                            '<?php echo $product['ma_loai']; ?>',
                            '<?php echo $product['so_luong']; ?>',
                            '<?php echo $product['don_gia']; ?>',
                            '<?php echo $product['mo_ta']; ?>',
                            '<?php echo $product['hinh']; ?>')">
                        <img src="../img/update.png" alt=""></a>
                    </td>
                </tr>
            <?php }
         ?>
    </tbody>
</table>

</div>
</div>

<script>

</script>
</html>