<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Admin</title>
    <link rel="icon" href="../img/logo.jpg" type="image/jpg" sizes="32x32">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<?php
    session_start();
    $username = "admin999";
    if (isset($_SESSION["makh"])){
        $username = $_SESSION["makh"];
    }
    include_once("model/quyenModel.php");
    $model  = new QuyenModel();
    $tai_khoan  = $model->getQuyenOfUsername($username);
    $quyen = $tai_khoan['ma_quyen'];
    $lstChucNang = $model->getChucNangOfQuyen($quyen);
    //Sau khi lay ds quyen cua chuc nang
    function checkAndHideElements($ma_cn, $idCN, $lstChucNang) {
        $temp=0;
        for ($i = 0; $i < count($lstChucNang); $i++) {
            if ($ma_cn == $lstChucNang[$i]['ma_cn']) {
                $temp=1;
                break; 
            }
        }
        if($temp==0)
        echo "<script>document.getElementById('$idCN').style.display = 'none';</script>";
    }
?>
<div class="left_side_admin">
        <ul>
            <a href="index.php"><img src="/WebBanDoAn/img/logo.jpg" alt="Logo"></a>
            <li><a href="index.php?action=showProductList" id="loadProduct"><i class="fa-solid fa-box"></i>Sản phẩm</a></li>
            <li><a href="index.php?action=showCategoryList" id="loadCategory"><i class="fa-solid fa-list"></i>Thể loại</a></li>
            <li><a href="index.php?action=showSupplierList" id="loadSupplier"><i class="fa-solid fa-building"></i>Nhà cung cấp</a></li>
            <li><a href="index.php?action=showOrderList" id="loadOrder"><i class="fa-solid fa-truck-fast"></i>Đơn hàng</a></li>
            <li><a href="index.php?action=showImportList" id="loadImport"><i class="fa-solid fa-clipboard"></i>Phiếu nhập</a></li>
            <li><a href="index.php?action=showAccountList" id="loadAccount"><i class="fa-solid fa-circle-user"></i>Tài khoản</a></li>
            <li><a href="index.php?action=showUserList" id="loadUser"><i class="fa-solid fa-users"></i>Người dùng</a></li>
            <li><a href="index.php?action=showPermissionList" id="loadPermission"><i class="fa-solid fa-table-columns"></i>Phân quyền</a></li>
            <li><a href="../pages/dangxuat.php"><i class="fa-solid fa-right-from-bracket"></i>Đăng xuất</a></li>
        </ul>
    </div>
    <?php
                checkAndHideElements(1, "loadProduct", $lstChucNang);
                checkAndHideElements(2,"loadCategory", $lstChucNang);
                checkAndHideElements(3,"loadSupplier", $lstChucNang);
                checkAndHideElements(4,"loadOrder", $lstChucNang);
                checkAndHideElements(5,"loadImport", $lstChucNang);
                checkAndHideElements(6,"loadAccount", $lstChucNang);
                checkAndHideElements(7,"loadUser", $lstChucNang);
                checkAndHideElements(8,"loadPermission", $lstChucNang);
            // Repeat the above line for other menu items
                ?>
<?php

include_once("notification.php");
?>
<?php
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        if (str_contains($action, 'Product')) {
            include_once 'controller/sanphamController.php';
        } elseif (str_contains($action, 'Category')) {
            include_once 'controller/theloaiController.php';
        } elseif (str_contains($action, 'Order')) {
            include_once 'controller/donhangController.php';
        }
        elseif (str_contains($action, 'Import')) {
            include_once 'controller/phieunhapController.php';
        }
        elseif (str_contains($action, 'Account')) {
            include_once 'controller/taikhoanController.php';
        }
        elseif (str_contains($action, 'User')) {
            include_once 'controller/nguoidungController.php';
        }
        elseif (str_contains($action, 'Supplier')) {
            include_once 'controller/nccController.php';
        }
        elseif (str_contains($action, 'Permission')) {
            include_once 'controller/quyenController.php';
        }
    }
    
    ?>

</html>