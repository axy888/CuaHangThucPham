<?php
include_once "model/phieunhapModel.php" ;
class PhieuNhapController
{
    private $phieunhapModel;
    public function __construct()
    {
        $this->phieunhapModel= new PhieuNhapModel();
    }

    public function showImportList(){
        $products = $this->phieunhapModel->getAllProductSelect();
        $suppliers = $this->phieunhapModel->getAllSupplierSelect();
        $importList = $this->phieunhapModel->getAllImportReceipt();
        include_once 'views/phieunhapView.php';
    }

    public function addImport()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ma_ncc = $_POST['ma_ncc'];
            $nguoiNhap = $_POST['nguoiNhap'];
            $result = $this->phieunhapModel->addImport($ma_ncc, $nguoiNhap);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if ($result) {
                $_SESSION['message'] = "Thêm phiếu nhập thành công!";
                $_SESSION['type'] = "success";
            } else {
                $_SESSION['message'] = "Thêm phiếu nhập thất bại!";
                $_SESSION['type'] = "error";
            }
        }
    }
    public function addImportDetail()
    {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {

                $ma_phieu=$_POST['ma_phieu_1'];
                $tt=$_POST['txtTrangthai'];
                // $details = [];
                // $i = 1;
                // while (isset($_POST['ma_sp_' . $i])) 
                // {
                    $detail['ma_sp'] = $_POST['ma_sp_1'];
                    $detail['so_luong'] = $_POST['so_luong_1'];
                    $detail['don_gia'] = $_POST['gia_nhap_1'];
                    // $details[] = $detail;
                    // $i++;
                // }

            $result = $this->phieunhapModel->addImportDetail($ma_phieu,$detail);

            if ($result) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['message'] = "Thêm chi tiết phiếu nhập thành công!";
                $_SESSION['type'] = "success";
                header("Location: index.php?action=showImportDetail&id=$ma_phieu&tt=$tt");
                exit();
            } else {
                $_SESSION['message'] = "Thêm chi tiết phiếu nhập thất bại!";
                $_SESSION['type'] = "error";
            }
        }
        }

    public function updateImport()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ma_phieu = $_POST['txtMaphieuUpdate'];
            $ma_sp = $_POST['ma_spUpdate'];
            $so_luong = $_POST['txtSlUpdate'];
            $don_gia = $_POST['txtDongiaUpdate'];
            $so_luong_cu = $_POST['txtSlCu'];
            $don_gia_cu = $_POST['txtDongiaCu'];
            $result = $this->phieunhapModel->updateImport($ma_phieu, $ma_sp, $so_luong, $don_gia,$so_luong_cu,$don_gia_cu);

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if ($result) {
                $_SESSION['message'] = "Sửa chi tiết phiếu nhập thành công!";
                $_SESSION['type'] = "success";
            } else {
                $_SESSION['message'] = "Sửa chi tiết phiếu nhập thất bại!";
                $_SESSION['type'] = "error";
            }
        }
    }

    public function viewImportDetail()
    {
        $products = $this->phieunhapModel->getAllProductSelect();
        $suppliers = $this->phieunhapModel->getAllSupplierSelect();
        $importList = $this->phieunhapModel->getAllImportReceipt();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $tt= $_GET['tt'];
            $importdetaillist = $this->phieunhapModel->getImportDetailById($id);
            include_once 'views/ct_phieunhapView.php';
        }
    }

    public function changeLock()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $id=$_POST['ma_phieu'];
            $tt=1;

            $statusUpdate = $this->phieunhapModel->updateStatus($id,$tt);
            $importdetaillist = $this->phieunhapModel->getImportDetailById($id);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if($statusUpdate)
            {
                $_SESSION['message'] = "Cập nhật trạng thái thành công!";
                $_SESSION['type'] = "success";
            }
            else
            {
                $_SESSION['message'] = "Cập nhật trạng thái thất bại!";
                $_SESSION['type'] = "error";
            }
            include_once 'views/ct_phieunhapView.php';
        }
    }

    public function deleteImportDetail()
    {
        if (isset($_GET['id'])) 
        {
            $id = $_GET['id'];
            $tt=$_GET['tt'];
            $masp = $_GET['masp'];
            $sl = $_GET['sl'];
            $dg = $_GET['dg'];
            $deleteImportDetail = $this->phieunhapModel->deleteImportDetail($id,$masp,$sl,$dg);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if($deleteImportDetail)
            {
                $_SESSION['message'] = "Xóa chi tiết phiếu nhập thành công!";
                $_SESSION['type'] = "success";
            }
            else
            {
                $_SESSION['message'] = "Xóa chi tiết phiếu nhập thất bại!";
                $_SESSION['type'] = "error";
            }
        }
    }

    public function searchImport()
    {
        $item = $_GET['search'];
        $field = $_GET['field'];
        $startdate = $_GET['startdate'];
        $enddate = $_GET['enddate'];
        $giafrom = $_GET['giafrom'];
        $giato = $_GET['giato'];
        $importList = $this->phieunhapModel->findImportByFieldAndDateRange($field, $item, $startdate, $enddate,$giafrom,$giato);
        include_once 'views/phieunhapView.php';
    }

    public function filterImport(){
        $field = $_GET['filter'];
        $importList = $this->phieunhapModel->filterImport($field);
        include_once 'views/phieunhapView.php';
    }

}
$action ='index';
if (isset($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = 'showImportList';
}
$phieunhapController = new PhieuNhapController();
switch ($action){
    case 'showImportList':
        $phieunhapController->showImportList();
        break;
 
    case 'showImportDetail':
        $phieunhapController->viewImportDetail();
        break;
    case 'addImportDetail':
        $phieunhapController->addImportDetail();
        break;
    case 'addImport':
        $phieunhapController->addImport();
        $phieunhapController->showImportList();
        break;
    case 'updateImport':
        $phieunhapController->updateImport();
        $phieunhapController->viewImportDetail();
        break;
    case 'changelockImport':
        $phieunhapController->changeLock();
        $phieunhapController->viewImportDetail();
        break;
    case 'deleteImportDetail':
        $phieunhapController->deleteImportDetail();
        $phieunhapController->viewImportDetail();
        break;
    case 'searchImport':
        $phieunhapController->searchImport();
        break;
    case 'filterImport':
        $phieunhapController->filterImport();
        break;
    default:
        $phieunhapController->showImportList();
}
?>