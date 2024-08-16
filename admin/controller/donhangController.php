<?php
include_once "model/donhangModel.php" ;

class DonHangController{
    private $orderModel;

    public function __construct(){
        $this->donhangModel = new DonHangModel();
    }
    public function showOrderList(){
        $order_list = $this->donhangModel->getAllOrders();
        include_once 'views/donhangView.php';
    }
    public function showCTDonHang(){
        $id = $_GET['id'];
        $ct_hang = $this->donhangModel->getCTDonHang($id);
        $tong = 0;
        $don=$this->donhangModel->getOrderByID($id);
        $trangthai = $don['trang_thai'];
        foreach ($ct_hang as &$item) {
            $item['tong_tien'] = $item['so_luong'] * $item['don_gia'];
            $tong += $item['tong_tien'];
        }
        include_once 'views/ct_donhangView.php';
    }
    public function updateOrder(){
        $orderID = $_GET['madon'];
        $trangthai = $_GET['trangthai'];
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if ($trangthai == 2){ //Nếu trạng thái cần cập nhật là đang giao hàng thì mới kiểm tra.
            $chitiet = $this->donhangModel->getOrderDetail($orderID);
            foreach ($chitiet as $ct){
                $sp = $this->donhangModel->getProductByID($ct['ma_sp']);
                $ct_ct = $this->donhangModel->getOrderSPDetail($orderID,$sp['ma_sp']);
                if ($sp['so_luong'] < $ct_ct['so_luong']){
                    $_SESSION['message'] = "Sản phẩm " .$sp['ma_sp']. " không đủ số lượng!";
                    $_SESSION['type'] = "error";
                    // echo '<script>alert("Sản phẩm ' .$sp['ma_sp'].' không đủ số lượng!")</script>';
                    return;
                }
            }
            $this->donhangModel->updateProductQuantity($orderID);
        }
        $this->donhangModel->updateOrderStatus($orderID,$trangthai);
        $_SESSION['message'] = "Cập nhật đơn hàng thành công!";
        $_SESSION['type'] = "success";
    }
    public function searchOrder(){
        $data = $_GET['data'];
        $field = $_GET['field'];
        $status=$_GET['status'];
        $startdate = $_GET['startdate'];
        $enddate = $_GET['enddate'];
        $order_list = $this->donhangModel->searchOrder($status,$startdate,$enddate);
        include_once 'views/donhangView.php';
    }
}
$action ='index';
if (isset($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = 'showOrderList';
}
$donhangController = new DonHangController();
switch ($action){
    case 'showOrderList':
        $donhangController->showOrderList();
        break;
    case 'searchOrder':
        $donhangController->searchOrder();
        break;
    case 'showOrderDetail':
        $donhangController->showCTDonHang();
        break;
    case 'updateOrder':
        $donhangController->updateOrder();
        $donhangController->showOrderList();
        break;
    default:
        $donhangController->showOrderList();
}
?>