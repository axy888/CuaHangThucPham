<?php
include("dangkymodel.php");
class DangkyController{

    private $dangkymodel;
    
    public function __construct(){
        $this->dangkymodel = new DangkyModel();
    }

    public function dangnhap()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $tenkh= $_POST['txtTenKH'];
            $password= $_POST['txtPassword'];
            
            $dangnhap = $this->dangkymodel->findUserByUserNameAndPass($tenkh,$password);

            if($dangnhap)
            {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if($dangnhap['ma_quyen']==2)
                {
                    $_SESSION["trang_thai"] = $dangnhap['trang_thai'];
                    if($_SESSION["trang_thai"]=="on")
                    {
                        $_SESSION["pass"]=$password;
                        $_SESSION["nguoidung"] = $dangnhap['username'];
                        $_SESSION["makh"] = $dangnhap['username'];
                        $nguoidung = $this->dangkymodel->findNguoiDungByUserName($dangnhap['username']);
                        $_SESSION["ten"]=$nguoidung['ten'];
                        $_SESSION["sdt"]=$nguoidung['sdt'];
                        $_SESSION["diachi"]=$nguoidung['diachi'];
                        $_SESSION["email"]=$nguoidung['email'];
                        echo json_encode(array('status' => 1));
                    }
                    else echo json_encode(array('status' => 3));
    
                }
                if($dangnhap['ma_quyen']!=2)
                {
                    $_SESSION["makh"] = $dangnhap['username'];
                    $_SESSION["trang_thai"] = $dangnhap['trang_thai'];
                    $nguoidung = $this->dangkymodel->findNguoiDungByUserName($dangnhap['username']);
                    $_SESSION["ten"]=$nguoidung['ten'];
                    if($_SESSION["trang_thai"]=="on")
                    {
                        echo json_encode(array('status' => 2));
                    }
                    else echo json_encode(array('status' => 3));
                }
            }
            else 
            {
                echo json_encode(array('status' => 0, 'message' => 'có lỗi xảy ra'));
            }
        }
    }

    public function dangky()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            // $makh= $_POST['txtMakh'];
            $username= $_POST['txtUsername'];
            $password= $_POST['txtPassword'];
            $confirmpassword= $_POST['txtConfirmpassword'];
            $email= $_POST['txtEmail'];
            $diachi= $_POST['txtDiachi'];
            $sdt= $_POST['txtSdt'];
            $currentDateTime = date('Y-m-d');
            $kq1=$_POST['ketqua'];
            if($kq1==1)
            {
                $checkTenKH=$this->dangkymodel->checkTenKH($username);
                if($checkTenKH)
                {
                    echo json_encode(array('status' => 0, 'message' => 'Tên người dùng đã tồn tại'));
                }
                // if (!empty($errors)) {
                //     echo json_encode($errors);
                //     return;
                // }
                else
                {
                    $dangky = $this->dangkymodel->addUser($username,$sdt,$diachi,$email,$password,$currentDateTime);
                    if ($dangky) {
                        $ketquadangky=1;
                        // echo json_encode($ketquadangky);
                        echo json_encode(array('status' => 1));
                    
                    } else {
                        echo json_encode(array('status' => 0));
                }
                }
            }
            // else 
            // {
            //     echo json_encode(array('status' => 0, 'message' => 'có lỗi xảy ra'));
            // }
        }
    }

    public function sua()
    {
        // if($_SERVER['REQUEST_METHOD']=='POST')
        // {
        //     $makh= $_POST['txtMakh'];
        //     $username= $_POST['txtUsername'];
        //     $email= $_POST['txtEmail'];
        //     $diachi= $_POST['txtDiachi'];
        //     $sdt= $_POST['txtSdt'];
        //     $sua = $this->dangkymodel->updateNguoiDung($makh,$username,$diachi,$sdt,$email);
        //     if($sua)
        //     {
        //         echo '<script>alert("Sửa thành công!");
                    
        //             </script>'; 
        //     }
        // }
    }
}
$action = 'index';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'loginView';
}
$dangkyController = new DangkyController();
switch ($action) {
    case 'loginView':
        $dangkyController->showdangnhap();
        break;
    // case 'registerView':
    //     $dangkyController->registerView();
    //     break;
    case 'dangky':
        $dangkyController->dangky();
        break;
    case 'dangnhap':
        $dangkyController->dangnhap();
        break;
    case 'sua':
        $dangkyController->sua();
        break;
    // default:
    //     $dangkyController->showdangnhap();
}
?>