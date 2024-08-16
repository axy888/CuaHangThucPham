<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/admin.css">
    <title>Quản lý tài khoản</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/adminProduct.js"></script>
    <script src="../js/notification.js"></script>
    <script src="../js/user.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>


<body>
<?php

displayNotification();
?>
    <!-- Thêm tài khoản -->
    <div class="addForm" id = "addAccount" style="display: none;">
    <form class="form_add" id="form_addAccount" action="index.php?action=addAccount" method="post">
            <button type="button" class="closeForm" id="close2" onclick="closeformAddAccount()">X</button>
            <h2>Thêm tài khoản</h2>
            <label for="hoten">Họ tên:</label>
            <input type="text" class="normal" name="txtHoTen" id="hoten"required><br><br>
            <label for="password">Password:</label>
            <input type="password" class="normal" name="txtPassword" id="password"required><br><br>
            <label for="sdt">Số điện thoại:</label>
            <input type="tel" class="normal" name="txtSdt" id="sdt"required><br><br>
            <label for="diachi">Địa chỉ:</label>
            <input type="text" class="normal" name="txtDiaChi" id="diachi"required><br><br>
            <label for="email">Email:</label>
            <input type="email" class="normal" name="txtEmail" id="email"required><br><br>
            <?php
            echo'
            <label for="ma_quyen">Chọn quyền:</label>
            <select name="ma_quyen" id="quyen"required>';
            foreach ($permissions as $permission) {
                if($permission['ma_quyen']!=1)
                {
                    echo '<option value="' . $permission['ma_quyen'] . '">' . $permission['ten_quyen'] . '</option>';
                }
            }
                echo '</select>';
            ?>
            <br>
            <br>
            <input type="hidden" name="ketqua" id="kqInput" value="">
            <button id="btnAddProAccount" class="btn_in_form" type="submit" onclick="checkAddform()">Thêm tài khoản</button>
    </form>
    </div>

    <!-- Sửa tài khoản -->
     <div class="addForm" id="updateAccount" style="display: none;">
        
     <form class="form_add" id="form_updateAccount" action="index.php?action=updateAccount" onsubmit="return confirmUpdate();" method="post">
        <button type="button" class="closeUpdateForm" id="close2" onclick="closeUpdateformAccount()">X</button>

        <h2>Sửa tài khoản</h2>
       
        <label for="username">Username:</label>
        <input type="text" class="normal" name="txtUsernameUpdate" id="usernameUpdate"readonly value=""><br><br>
        <?php
        echo'
        <label for="ma_quyen">Chọn quyền:</label>
         <select name="ma_quyen" id="quyensua"required>';
         foreach ($permissions as $permission) {
            if($permission['ma_quyen']!=1)
            echo '<option value="' . $permission['ma_quyen'] . '">' . $permission['ten_quyen'] . '</option>';
        }
            echo '</select>';
            // $default_ma_quyen = $permission['ma_quyen'];
        ?>
       <br><br>
        Hoạt động<input type="radio" class="trangthai" name="trangthai" id="radioHoatDong" value="on" >&nbsp;
        Đã khóa<input type="radio" name="trangthai" class="trangthai" id="radioDaKhoa" value="off">&nbsp;            
        
        <br><br>
        <input type="hidden" name="ketqua" id="kqInput" value="">
        <button class="btn_in_form" id="btnUpdateAccount"type="submit">Cập nhật</button>
    </form>
    </div> 

<div class="product_view">
<div class="product_view_container">
<h2>QUẢN LÝ TÀI KHOẢN</h2>
    <form action="index.php" method="GET" class="searchAccount">
            <input type="hidden" name="ctrl" value="accountController">
            <input type="hidden" name="action" value="searchAccount">
            Tìm kiếm theo: <select name="field" class="timkiem" id="timkiem">
                <option value="username">Username</option>
                <option value="ma_quyen">Mã quyền</option>
                <option value="trang_thai">Trạng thái</option>
            </select>
            <input type="text" id="search" name="search" placeholder="Nhập tài khoản cần tìm kiếm...">
            
            <label for="startdate">Start: </label>
        <input type="date"  class="startdate" name="startdate" id="">
        <label for="startdate">End: </label>
        <input type="date"  class="enddate" name="enddate" id="">
            <button type="submit">Tìm kiếm</button>


    </form>
    <br>
    <div class="filter-container">
    <form action="index.php" method="GET" class="filter-phieunhap">
        <select name="field" class="sapxep" id="sapxep">
            <option value="">Sắp xếp theo</option>
            <option value="date_asc">Ngày tăng dần</option>
            <option value="date_desc">Ngày giảm dần</option>
        </select>
        <button type="submit">Lọc</button>
    </form>
    </div>
        

    <a class="category_add" id ='themTL'  href="#" onclick="showAddFormAccount()">
    <img src="../img/plus.png" alt="">Thêm tài khoản</a>


    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Username</th>
                <th>Mã quyền</th>
                <th>Password</th>
                <th>Ngày tạo</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($accounts as $account) : 
                 if ($account['ma_quyen']!=1)
                {?>
                <tr>
                    <td><?php echo $account['username']; ?></td>
                    <td><?php echo $account['ma_quyen']; ?></td>
                    <td><?php echo $account['password']; ?></td>
                    <td><?php echo $account['ngay_tao']; ?></td>
                    <td><?php echo $account['trang_thai']; ?></td>
                    <td>
                    <?php $userduocchon=$account['username'];?>
                        <a class="suatk" href="#" onclick="showUpdateFormAccount('<?php echo $userduocchon; ?>','<?php echo $account['trang_thai'];?>','<?php echo $account['ma_quyen'];?>')">
                            <img class="update_icon" src="../img/update.png" alt="">
                        </a>
                    </td>
                </tr>
            <?php } endforeach; ?>
        </tbody> 
    </table>
    </div>
    </div>
</body>
<!-- check chuc nang -->
</html>
