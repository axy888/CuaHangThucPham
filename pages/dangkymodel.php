<?php
require_once("../database/database.php");

class DangkyModel{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function checkTenKH($tenkh)
    {
        $query = "SELECT COUNT(*) as count FROM nguoidung WHERE ten = '$tenkh'";
        $result = $this->db->select($query);
        return $result[0]['count'] > 0;
    }

    public function addUser($username,$sdt,$diachi,$email,$password,$currentDateTime)
    {
        $hashedPassword = md5($password);
        $query = "SELECT ma_nd FROM nguoidung WHERE ma_nd LIKE 'KH%' ORDER BY ma_nd DESC LIMIT 1";
        $resulttemp = $this->db->select($query);

        if ($resulttemp && count($resulttemp) > 0) {
            $lastId = $resulttemp[0]['ma_nd'];
            $number = (int)substr($lastId, 2); // cắt chuỗi lấy các số sau "KH"
            $newId = 'KH' . str_pad($number + 1, 5, '0', STR_PAD_LEFT); //+1 rồi đệm các số 0 vào cho đủ 5 số
        } else {
            // If there is no existing ID, start with KH00001
            $newId = 'KH00001';
        }
        $strNguoidung="INSERT INTO nguoidung(ma_nd,ten,sdt,diachi,email) 
        VALUE ('$newId','$username','$sdt','$diachi','$email')";
        $strTaiKhoan="INSERT INTO taikhoan(username,password,ngay_tao) 
        VALUE ('$newId','$hashedPassword','$currentDateTime')";
         $result = $this->db->execute($strNguoidung);
         $result2 = $this->db->execute($strTaiKhoan);
         if($result && $result2)
         {
            return $result;
         }
    }

    public function findUserByUserNameAndPass($tenkh, $password)
    {
        $hashedPassword = md5($password);
        $strNguoidung = "SELECT ma_nd FROM nguoidung WHERE ten = '$tenkh'";
        $resultNguoidung = $this->db->select($strNguoidung);

        if ($resultNguoidung && count($resultNguoidung) > 0) {
            $makh = $resultNguoidung[0]['ma_nd'];

           
            $strTaiKhoan = "SELECT * FROM taikhoan WHERE username = '$makh' AND password = '$hashedPassword'";
            $resultTaiKhoan = $this->db->select($strTaiKhoan);

            if ($resultTaiKhoan && count($resultTaiKhoan) > 0) {
                return $resultTaiKhoan[0]; 
            } else {
                return null; 
            }
        } else {
            return null; 
        }
    }


    public function findNguoiDungByUserName($makh)
    {
        $strNguoiDung = "SELECT * FROM nguoidung WHERE ma_nd = '$makh'";
        $result = $this->db->select($strNguoiDung);
        if ($result && count($result)>0) {
            return $result[0]; // Trả về dữ liệu người dùng nếu tìm thấy
        } else {
            return null;
        }
    }

    public function updateNguoiDung($makh,$username,$diachi,$sdt,$email)
    {
        $strNguoidung="UPDATE nguoidung SET ten = '$username', sdt = '$sdt', diachi = '$diachi', email = '$email' WHERE ma_nd = '$makh'";
        $result = $this->db->execute($strNguoidung);
        if($result)
         {
            return $result;
         }
    }

    public function updatePassword($makh,$newpassword)
    {
        $hashedPassword = md5($newpassword);
        $strTaiKhoan="UPDATE taikhoan SET password = '$hashedPassword' WHERE username = '$makh'";
        $result = $this->db->execute($strTaiKhoan);
        if($result)
         {
            return $result;
         }
    }

    public function addDonHang($ma_kh, $trang_thai, $ngay_dat, $tong_tien, $dia_chi, $ho_ten, $sdt)
    {
        $insert_donhang_query = "INSERT INTO donhang (ma_kh, trang_thai, ngay_dat, tong_tien, dia_chi, ho_ten, sdt) 
        VALUES ('$ma_kh', '$trang_thai', '$ngay_dat', '$tong_tien', '$dia_chi', '$ho_ten', '$sdt')";
        $result = $this->db->execute($insert_donhang_query);
        if ($result) {
            return $this->db->getLastInsertedId();
        }
        return false;
    }

    public function addCtDonHang($ma_don,$ma_sp,$so_luong)
    {
        $insert_ct_donhang_query = "INSERT INTO ct_donhang (ma_don, ma_sp, so_luong) VALUES ('$ma_don', '$ma_sp', '$so_luong')";
        return $this->db->execute($insert_ct_donhang_query);
    }

    public function getAllOrders($ma_kh)
    {
        $strOrder = "SELECT * FROM donhang WHERE ma_kh = '$ma_kh'";
        return $this->db->select($strOrder);

    }

    public function getCTDonHang($id) {
        $query = "
            SELECT 
                ct_donhang.ma_don AS ma_don,
                ct_donhang.ma_sp AS ma_sp,
                sanpham.ten_sp AS ten_sp, 
                ct_donhang.so_luong AS so_luong,
                sanpham.don_gia AS don_gia,
                sanpham.hinh AS hinh
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


    public function updateOrder($ma_don,$tt)
    {
        $strOrder="UPDATE donhang SET trang_thai = '0' WHERE ma_don = '$ma_don'";
        $result = $this->db->execute($strOrder);
        if($result)
         {
            return $result;
         }
    }

}
?>