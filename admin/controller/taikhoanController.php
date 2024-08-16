<?php
include_once "model/taikhoanModel.php" ;

class TaiKhoanController{
    private $taikhoanModel;

    public function __construct(){
        $this->taikhoanModel = new TaiKhoanModel();
    }
    public function showAccountList(){
        $accounts = $this->taikhoanModel->getAllAccount();
        $permissions = $this->taikhoanModel->getAllPermisson();
        include 'views/taikhoanView.php';
    }

    public function addAccount()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // $username = $_POST['txtUsername'];
            $ma_quyen=$_POST['ma_quyen'];
            $password=$_POST['txtPassword'];
            $hoten=$_POST['txtHoTen'];
            $sdt=$_POST['txtSdt'];
            $email=$_POST['txtEmail'];
            $diachi=$_POST['txtDiaChi'];
            $kq1=$_POST['ketqua'];
            if($kq1==1)
            {
                $checkID = $this->taikhoanModel->checkTenKH($hoten);
                if($checkID)
                {
                    echo'<script>alert("tên người dùng đã tồn tại")</script>';
                }
                else 
                {
                    $result = $this->taikhoanModel->addAccount($ma_quyen,$password,$hoten,$sdt,$email,$diachi);
        
                    if ($result) 
                    {
                        echo'<script>alert("thêm tài khoản thành công")</script>';
                    } else
                        echo'<script>alert("thêm tài khoản thất bại")</script>';
                }

            }
            else {
                echo'<script>alert("thêm tài khoản thất bại")</script>';
            }
        }
    }

    public function searchAccount()
    {
        $item = $_GET['search'];
        $field = $_GET['field'];
        $startdate = $_GET['startdate'];
        $enddate = $_GET['enddate'];
        $accounts = $this->taikhoanModel->findAccountByFieldAndDateRange($field, $item, $startdate, $enddate);
        include_once 'views/taikhoanView.php';
    }

    public function updateAccount()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $username = $_POST['txtUsernameUpdate'];
            $ma_quyen=$_POST['ma_quyen'];
            $trang_thai = $_POST['trangthai'];
            $result = $this->taikhoanModel->updateAccount($username,$ma_quyen,$trang_thai);

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if ($result) 
            {
                // echo'<script>alert("sửa tài khoản thành công")</script>';
                $_SESSION['message'] = "Sửa thông tin tài khoản thành công!";
                $_SESSION['type'] = "error";
            } else
                // echo'<script>alert("sửa tài khoản thất bại")</script>';  
                $_SESSION['message'] = "Sửa thông tin tài khoản thất bại!";
                $_SESSION['type'] = "success";
            }
            
    }
}
$action ='index';
if (isset($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = 'showAccountList';
}
$taikhoanController = new TaiKhoanController();
switch ($action){
    case 'showAccountList':
        $taikhoanController->showAccountList();
        break;
    case 'addAccount':
        $taikhoanController->addAccount();
        // $taikhoanController->showAccountList();
        break;
    case 'searchAccount':
        $taikhoanController->searchAccount();
        break;
    case 'updateAccount':
        $taikhoanController->updateAccount();
        $taikhoanController->showAccountList();
        break;
    
    default:
        $taikhoanController->showAccountList();
}
?>