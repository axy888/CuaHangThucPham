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

    <!-- thêm quyền -->
    <div  class="addForm" id = "addPermission" style="display: none;">
        
        <form class="form_add" id="form_addPer" action="index.php?action=addPermission" method="POST">
        <button type="button" id="close2" class="closeForm" onclick="closeformPer()">X</button>
        <h2>Thêm quyền mới</h2>
            <label for="tenquyen">Tên quyền: </label>
            <input type="text" name="ten_quyen" class="normal" required>
            <br>
            <button id="btnAddPer" class="btn_in_form" type="submit">Thêm quyền</button>
        </form>
    </div>

    <!-- SỬa quyền  -->
    <div  class="addForm" id = "updatePermission" style="display: none;">
        
        <form class="form_add" id="form_updatePer" action="index.php?action=updatePermission" onsubmit="return confirmUpdate();" method="POST">
        <button type="button" id="close2" class="closeUpdateForm" onclick="closeUpdateformPer()">X</button>
        <h2>Thông tin quyền</h2>
            <input type="hidden" id="ma_quyen" name="ma_quyen" class="normal" >
            <label for="tenquyen">Tên quyền: </label>
            <input type="text" id="ten_quyen" name="ten_quyen" class="normal" required>
            <br>
            <button id="btnAddPer" class="btn_in_form" type="submit">Cập nhật</button>
        </form>
    </div>

<div class="product_view">
<div class="product_view_container">
<h2>QUẢN LÝ QUYỀN</h2>

    <a id="themquyen" style="width:120px;"class="category_add" href="#"  onclick="showAddFormPer()">
    <img src="../img/plus.png" alt="">Thêm quyền</a>
    

<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>Mã quyền</th>
            <th>Tên quyền</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($permissions as $permission) : ?>
            <?php if ($permission['ma_quyen'] != 2) :?>
            <tr>
                <td><?php echo $permission['ma_quyen']; ?></td>
                <td><?php echo $permission['ten_quyen']; ?></td>
                
                <td>
                    <a href="index.php?action=deletePermission&id=<?php echo $permission['ma_quyen']; ?>"onclick="return confirmDelete();">
                        <img src="../img/delete.png" alt=""></a>
                        <a href="#" onclick="showUpdateFormPer(
                            '<?php echo $permission['ma_quyen']; ?>',
                            '<?php echo $permission['ten_quyen']; ?>')">
                        <img src="../img/update.png" alt=""></a>
                        <a href="index.php?action=viewPermissionDetail&id=<?php echo $permission['ma_quyen']; ?>">
                            <img class="detail_icon" src="../img/detail.png" alt="">
                        </a>
                </td>
            </tr>
        <?php endif;?>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
</div>
</html>