<?php

include_once("dangkymodel.php");
class ThongtinController{

    private $dangkymodel;
    
    public function __construct(){
        $this->dangkymodel = new DangkyModel();
    }

    public function showThongTin()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        global $order_list, $ct_hang;
        $order_list = $this->dangkymodel->getAllOrders($_SESSION["nguoidung"]);
        foreach ($order_list as $order)
        {
            $ma_don=$order['ma_don'];
            $ct_hang[$ma_don]= $this->dangkymodel->getCTDonHang($ma_don);
        }
        
        require_once "thongtindonhang.php";
    }


    public function sua()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $makh= $_POST['txtMakh'];
            $username= $_POST['txtUsername'];
            $email= $_POST['txtEmail'];
            $diachi= $_POST['txtDiachi'];
            $sdt= $_POST['txtSdt'];
            $kq1=$_POST['ketquasuathongtin'];
            if($kq1==1)
            {
                $sua = $this->dangkymodel->updateNguoiDung($makh,$username,$diachi,$sdt,$email);
                if($sua)
                {
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION["ten"]=$username;
                    $_SESSION["sdt"]= $sdt;
                    $_SESSION["diachi"]=$diachi;
                    $_SESSION["email"]= $email;
                    echo json_encode(array('status' => 1)); 
                }
            }
            else 
            echo json_encode(array('status' => 0)); 

        }
    }

    public function suapass()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $password= $_POST['txtPassword'];
            $newpassword= $_POST['txtNewPassword'];
            $kq1=$_POST['ketqua'];
            if($kq1==1)
            {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $suapass = $this->dangkymodel->updatePassword($_SESSION["nguoidung"],$newpassword);
                if($suapass)
                {
                    $_SESSION["pass"]=$newpassword;
                    echo json_encode(array('status' => 1));
                }
                 
            }
            else
            echo json_encode(array('status' => 0));
        }
    }

    public function cancelthongtin()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $ma_don= $_POST['txtMadon'];
            $trang_thai=$_POST['txtTrangthai'];
            $sua = $this->dangkymodel->updateOrder($ma_don,$trang_thai);
            if($sua)
            {
                echo'<script>alert("Hủy đơn thành công")</script>'; 
            }
            else 
            echo'<script>alert("Hủy đơn thất bại")</script>';
        }
    }

    public function addDonHang()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ma_kh = $_SESSION["nguoidung"];
            $trang_thai = 1;
            $ngay_dat = date('Y-m-d H:i:s');
            $tong_tien = $_SESSION["tongtien"];
            $ho_ten = $_POST['txtTen'];
            $sdt = $_POST['txtSdt'];
            $dia_chi = $_POST['txtTinh'] . '-' . $_POST['txtQuan'] . '-' . $_POST['txtPhuong'] . '-' . $_POST['txtDiaChi'];
            $kq1=$_POST['ketquathanhtoan'];
            if($kq1==1)
            {
                $ma_don = $this->dangkymodel->addDonHang($ma_kh, $trang_thai, $ngay_dat, $tong_tien, $dia_chi, $ho_ten, $sdt);
    
    
                foreach ($_SESSION['cart'] as $item) {
                    $ma_sp = $item['ma_sp'];
                    $so_luong = $item['quantity'];
                    $this->dangkymodel->addCtDonHang($ma_don, $ma_sp, $so_luong);
                }
                echo json_encode(array('status' => 1));
                unset($_SESSION['cart']);
                
            }
            else echo json_encode(array('status' => 0));
            // header('Location: sanpham.php');
        }
    }
}
$action = 'index';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'loginView';
}
$ttcnController = new ThongtinController();
switch ($action) {
    case 'showTT':
        $ttcnController->showThongTin();
        break;
    // case 'registerView':
    //     $thongtinController->registerView();
    //     break;
    case 'sua':
        $ttcnController->sua();
        break;
    case 'suapass':
        $ttcnController->suapass();
        break;
    case 'cancelthongtin':
        $ttcnController->cancelthongtin();
        $ttcnController->showThongTin();
        break;
    case 'thanhtoan':
        $ttcnController->addDonHang();
        break;
    default:
        $ttcnController->showThongTin();
}
?>