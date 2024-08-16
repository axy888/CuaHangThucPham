<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/admin.css">
    <title>Quản lý sản phẩm</title>
    
    <script src="../js/adminProduct.js"></script>
    <script src="../js/notification.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="product_view">
<div class="product_view_container">
<!-- <div class="addForm">
<div id="form_ctpq" class="form_add">
<a type="button" id="" class="closeForm btnaUpdate" href="index.php?ctrl=permissionController">X</a> -->


    <h2>Chi tiết phân quyền</h2>
    <table class="table table-hover">
    <thead class="table-dark">
            <tr>
                <th>Mã chức năng </th>
                <th>Quản lý</th>
                <th>Thao tác</th>
            </tr>
        </thead>

        <tbody>
    <?php foreach ($chucnangs as $cn) : ?>
        <tr>
            <td><?php echo $cn['ma_cn']; ?></td>
            <td><?php echo $cn['ten_cn']; ?></td>
            <td>
                <?php 
                    $checked = false;
                    foreach($chucnang_cuaquyen as $cnq):
                        if($cnq['ma_cn'] == $cn['ma_cn']) {
                            $checked = true;
                            break;
                        }
                    endforeach;
                ?>
                <input type="checkbox" id="cn<?php echo $cn['ma_cn']; ?>" name="chucnang[]" value="<?php echo $cn['ma_cn']; ?>" <?php echo $checked ? 'checked' : ''; ?>>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

    </table>
    <?php if ($id != 1):
    
    echo'<form id="" class="form_tt_CTPN" onclick="return updateDetail();" action="index.php?action=updatePermissionDetail&id='.$id.'" method="post">
    
            <input type ="submit" value="Cập nhật quyền">
    </form>';
    endif;
    ?>
    </div>
    </div>
    <script>

    function updateDetail() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        const form = document.querySelector('.form_tt_CTPN');
        
        checkboxes.forEach(checkbox => {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'chucnang_status[' + checkbox.value + ']';
            hiddenInput.value = checkbox.checked ? 1 : 0;
            console.log(hiddenInput.name);
            form.appendChild(hiddenInput);
        });

        return true; // Tiếp tục submit form
    }



</script>
</body>
</html>