<?php
require_once("../database/database.php");

class TaiKhoanModel{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllAccount(){
        $query = "SELECT * FROM taikhoan";
        return $this->db->select($query);
    }

    public function addAccount($ma_quyen, $password,$hoten,$sdt,$email,$diachi)
    {
        $hashedPassword=md5($password);
        $prefix = match ($ma_quyen) {
            "2" => 'KH%',
            "3" => 'QLK%',
            "4" => 'QLD%',
            "5" => 'QLND%',
            "6" => 'NV%',
            default => 'KH%' // Mặc định là KH% nếu không khớp
        };

        $query="SELECT username FROM taikhoan WHERE username LIKE '$prefix' ORDER BY username DESC LIMIT 1";
        $resulttemp = $this->db->select($query);

        if ($resulttemp && count($resulttemp) > 0) {
            $lastId = $resulttemp[0]['username'];
            $number = (int)substr($lastId, strlen($prefix) - 1); // Cắt chuỗi lấy các số sau prefix
            $newId = substr($prefix, 0, -1) . str_pad($number + 1, 5, '0', STR_PAD_LEFT); //+1 rồi đệm các số 0 vào cho đủ 5 số
        } 
        else {
            // Nếu không có ID hiện tại, bắt đầu với KH00001 hoặc prefix + 00001
            $newId = substr($prefix, 0, -1) . '00001';
        }

        $strTaiKhoan="INSERT INTO taikhoan(username,ma_quyen,password,ngay_tao) 
        VALUE ('$newId','$ma_quyen','$hashedPassword',CURDATE())";
        $strNguoidung="INSERT INTO nguoidung(ma_nd,ten,sdt,diachi,email) 
        VALUE ('$newId','$hoten','$sdt','$diachi','$email')";
         $result = $this->db->execute($strNguoidung);
         $result2 = $this->db->execute($strTaiKhoan);
         if($result && $result2)
         {
            return $result;
         }
    }

    public function updateAccount($username,$ma_quyen,$tt){
        $sql = "UPDATE taikhoan set ma_quyen = $ma_quyen, trang_thai='$tt' where username = '$username' && username != 'admin'";
        return $this->db->execute($sql);
    }

    public function deleteAccount($username){
        $sql = "UPDATE taikhoan set trang_thai = 'off' where username LIKE '$username%'";
        return $this->db->execute($sql);
    }

    public function getAllPermisson(){
        $query = "SELECT * from quyen";
        return $this->db->select($query);
    }

    public function checkTenKH($tenkh)
    {
        $query = "SELECT COUNT(*) as count FROM nguoidung WHERE ten = '$tenkh'";
        $result = $this->db->select($query);
        return $result[0]['count'] > 0;
    }

    public function findAccountByFieldAndDateRange($field, $item, $startdate, $enddate)
    {
        $sql = "SELECT * FROM taikhoan WHERE ";
        $sql .= "$field LIKE '%$item%'";
    
        // Nếu startdate và enddate không rỗng, thêm điều kiện về ngày tháng
        if (!empty($startdate)) {
            $sql .= " AND ngay_tao >= '$startdate'";
        }
    
        // Nếu enddate không rỗng, thêm điều kiện về ngày tháng kết thúc
        if (!empty($enddate)) {
            $sql .= " AND ngay_tao <= '$enddate'";
        }

        return $this->db->select($sql);
    }
    
}
?>