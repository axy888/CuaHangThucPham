<?php
include_once "model/quyenModel.php" ;
class QuyenController
{
    private $quyenModel;

    public function __construct(){
        $this->quyenModel = new QuyenModel();
    }

    public function showPermissionList(){
        $permissions = $this->quyenModel->getAllPermisson();
        include_once 'views/quyenView.php';
    }
    public function viewPermissionDetail() {
        if (isset($_GET["id"])){
            $id = $_GET["id"];
            $chucnangs = $this->quyenModel->getAllChucNang();
            $permissionDetails = $this->quyenModel->getCTPQ_OfCN($id);
            $permissions = $this->quyenModel->getAllPermisson();
            $chucnang_cuaquyen= $this->quyenModel->getChucNangOfQuyen($id);
            // include_once 'views/quyenView.php';
            include_once 'views/ct_phanquyenView.php';
        }
    }

    public function addPermission()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten = $_POST["ten_quyen"];
            $result=$this->quyenModel->addPermission($ten);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        if ($result) {
            $_SESSION['message'] = "Thêm quyền thành công!";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "Thêm quyền thất bại!";
            $_SESSION['type'] = "error";
        }

        }
    }

    public function updatePermisson(){
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            $mq = $_POST["ma_quyen"];
            $tq = $_POST['ten_quyen'];
            $kq = $this->quyenModel->updatePermission($mq,$tq);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        if ($kq) {
            $_SESSION['message'] = "Cập nhật quyền thành công!";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "Cập nhật quyền thất bại!";
            $_SESSION['type'] = "error";
        }
        }
    }
    public function deletePermission(){
        if (isset($_GET['id'])){
            $id = $_GET['id'];
            $kq = $this->quyenModel->deletePermission($id);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        if ($kq) {
            $_SESSION['message'] = "Xóa quyền thành công!";
            $_SESSION['type'] = "error";
        } else {
            $_SESSION['message'] = "Xóa quyền thất bại!";
            $_SESSION['type'] = "success";
        }
        }
    }

    public function updatePermissionDetail()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['chucnang_status'])) {
                $chucnang = $this->quyenModel->getAllMaChucNang();
                $chucnang_status = $_POST['chucnang_status'];
                $ma_quyen = $_GET['id'];
                foreach ($chucnang as $cn) {
                    $ma_cn = $cn['ma_cn'];
                    $status = isset($chucnang_status[$ma_cn]) ? $chucnang_status[$ma_cn] : 0;
                    $check_ma_quyen = $this->quyenModel->getChucNangOfQuyen($ma_quyen);
                    if ($check_ma_quyen) {
                        if ($status == 0) {
                            // Xóa khỏi bảng nếu status = 0
                            $this->quyenModel->delCTPQ($ma_quyen, $ma_cn);
                        }
                        if ($status == 1) {
                            // Thêm vào bảng nếu status = 1
                            $check_cn=$this->quyenModel->checkMaChucNang($ma_quyen,$ma_cn);
                            if(!$check_cn)
                                $this->quyenModel->addCTPQ($ma_quyen, $ma_cn);
                            }
                    } 
                        if(!$check_ma_quyen) 
                        {
                            if ($status == 1) {
                            // Thêm vào bảng nếu status = 1
                            $this->quyenModel->addCTPQ($ma_quyen, $ma_cn);
                            }
                        }
                }
                echo '<script>alert("Cập nhật quyền thành công")</script>';
            } else {
                echo '<script>alert("Không có chức năng nào được chọn")</script>';
            }
        }
    }


}
$action ='index';
if (isset($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = 'showPermissionList';
}
$permissonController = new QuyenController();
switch ($action){
    case 'showPermissionList':
        $permissonController->showPermissionList();
        break;
    case 'viewPermissionDetail':
        $permissonController->viewPermissionDetail();
        break;
    case 'showAddPermissionForm':
        $permissonController->showAddPermissionForm();
        break;
    case 'addPermission':
        $permissonController->addPermission();
        $permissonController->showPermissionList();
        break;
    case 'updatePermission':
        $permissonController->updatePermisson();
        $permissonController->showPermissionList();
        break;
    case 'deletePermission':
        $permissonController->deletePermission();
        $permissonController->showPermissionList();
        break;
    case 'updatePermissionDetail':
        $permissonController->updatePermissionDetail();
        $permissonController->viewPermissionDetail();
        break;

    default:
        $permissonController->showPermissionList();
}
?>