<?php
require_once("../database/database.php");

class DonHangModel{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function getAllOrders(){
        $query = "SELECT * FROM donhang";
        return $this->db->select($query);
    }
    public function searchOrder($trangthai, $startdate = null, $enddate = null) {
        // Khởi tạo câu truy vấn
        if ($trangthai=='all'){
            $query = "SELECT * FROM donhang WHERE trang_thai LIKE '%%'";
        }
        else{
            $query = "SELECT * FROM donhang WHERE trang_thai LIKE '$trangthai'";
        }
        // Thêm điều kiện cho ngày bắt đầu nếu không trống
        if (!empty($startdate)) {
            $query .= " AND ngay_dat >= '$startdate'";
        }
    
        // Thêm điều kiện cho ngày kết thúc nếu không trống
        if (!empty($enddate)) {
            $query .= " AND ngay_dat <= '$enddate'";
        }
    
        return $this->db->select($query);
    }
    public function getCTDonHang($id) {
        // Giả sử bảng sản phẩm là 'sanpham' và bảng chi tiết đơn hàng là 'ct_donhang'
        $query = "
            SELECT 
                ct_donhang.ma_don AS ma_don,
                ct_donhang.ma_sp AS ma_sp,
                sanpham.ten_sp AS ten_sp, 
                ct_donhang.so_luong AS so_luong,
                sanpham.don_gia AS don_gia
            FROM 
                ct_donhang
            JOIN 
                sanpham 
            ON 
                ct_donhang.ma_sp = sanpham.ma_sp
            WHERE 
                ct_donhang.ma_don = $id";  // Chỉ lấy dữ liệu cho mã đơn hàng đã cho
    
        return $this->db->select($query);  // Trả về kết quả của truy vấn
    }
    public function updateOrderStatus($orderID, $status){
        $sql1= "UPDATE donhang set trang_thai = $status where ma_don = $orderID ";
        $this->db->execute($sql1);
    }
    public function updateProductQuantity($orderID){
        $sql = "UPDATE sanpham AS p JOIN ct_donhang AS od ON p.ma_sp = od.ma_sp SET p.so_luong = p.so_luong - od.so_luong WHERE od.ma_don = $orderID";
        $result = $this->db->execute($sql);
        return $result;
    }
    public function getOrderDetail($orderID){
        $sql = "SELECT * FROM ct_donhang WHERE ma_don = $orderID";
        $result = $this->db->select($sql);
        return $result;
    }
    public function getOrderSPDetail($orderID,$masp){
        $sql = "SELECT * FROM ct_donhang WHERE ma_don = $orderID and ma_sp = $masp";
        $result = $this->db->select($sql);
        return $result[0];
    }
    public function getProductByID($id)
    {
        $query = "SELECT * FROM sanpham WHERE ma_sp = $id";
        $result = $this->db->select($query);
        return $result[0];
    }
    public function getOrderByID($orderid){
        $sql = "SELECT * FROM donhang Where ma_don = $orderid";
        $result = $this->db->select($sql);
        return $result[0];
    }
}
?>