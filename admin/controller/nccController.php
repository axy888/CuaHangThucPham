<?php
include_once 'model/nccModel.php';

class NCCController {
    private $nccModel;

    public function __construct(){
        $this->nccModel = new NCCModel();

    }
    public function showSupplierList(){
        $suppliers = $this->nccModel->getAllSuppliers();
        include_once 'views/nccView.php';
    
    }
    
    public function addSupplier(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $ten = $_POST['ten'];
            $diachi = $_POST['diachi'];
            $sdt = $_POST['sdt'];
            $email = $_POST['email'];

            $result = $this->nccModel->addSupplier($ten, $diachi, $sdt, $email);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if ($result) {
                $_SESSION['message'] = "Thêm nhà cung cấp thành công!";
                $_SESSION['type'] = "success";
            } else {
                $_SESSION['message'] = "Thêm nhà cung cấp thất bại!";
                $_SESSION['type'] = "error";
            }
        }
    }

    public function deleteSupplier()
    {
        if (isset($_GET['id'])) {
            $supplierID = $_GET['id'];
            $result = $this->nccModel->deleteSupplier($supplierID);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if ($result) {
                $_SESSION['message'] = "Xóa nhà cung cấp thành công!";
                $_SESSION['type'] = "success";
            } else {
                $_SESSION['message'] = "Xóa nhà cung cấp thất bại!";
                $_SESSION['type'] = "error";
            }
        }
    }

    public function updateSupplier(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $ma_ncc = $_POST['ma_ncc'];
            $ten_ncc = $_POST['ten_ncc'];
            $diachi = $_POST['diachi'];
            $sdt = $_POST['sdt'];
            $email = $_POST['email'];
            $result = $this->nccModel->updateSupplier($ma_ncc,$ten_ncc,$diachi,$sdt,$email);
             if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if ($result) {
                $_SESSION['message'] = "Sửa thông tin thành công!";
                $_SESSION['type'] = "success";
            }
            else{
                $_SESSION['message'] = "Sửa thông tin thất bại!";
                $_SESSION['type'] = "error";
            }
        }
    }

    public function searchSupplier()
    {
        $item = $_GET['search'];
        $field = $_GET['field'];
        $suppliers = $this->nccModel->findSupplierByField($field,$item);
        foreach ($suppliers as $key => $supplier) {
            if ($supplier["trang_thai"] == "off"){
                unset($supplier[$key]);
            }
        }
        include_once 'views/nccView.php';
    }
}

$action = 'index';
if (isset($_GET['action'])){
    $action = $_GET['action'];
}
else{
    $action = 'showSupplierList';
}
$nccController = new NCCController();
switch($action){
    case 'showSupplierList':
        $nccController->showSupplierList();
        break;
    case 'addSupplier':
        $nccController->addSupplier();
        $nccController->showSupplierList();
        break;
    case 'deleteSupplier':
        $nccController->deleteSupplier();
        $nccController->showSupplierList();
        break;
    case 'updateSupplier':
        $nccController->updateSupplier();
        $nccController->showSupplierList();
        break;
    case 'searchSupplier':
        $nccController->searchSupplier();
        break;
    default:
        $nccController->showSupplierList();
}
?>