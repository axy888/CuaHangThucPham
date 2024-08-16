<?php
require_once("../database/database.php");

class SanPhamModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
   
    public function getAllProducts()
    {
        $query = "SELECT * FROM sanpham";
        return $this->db->select($query);
    }

    public function getListCategory()
    {
        $query = "SELECT * FROM theloai";
        return $this->db->select($query);
    }

    public function getProductByID($id)
    {
        $query = "SELECT * FROM sanpham WHERE ma_sp = $id";
        $result = $this->db->select($query);
        return $result[0];
    }

    public function addProduct($ma_loai, $ten_sp, $don_gia, $mo_ta,$hinh)
    {
        $query = "INSERT INTO sanpham(ma_loai, ten_sp, don_gia, so_luong, mo_ta, hinh) VALUE ($ma_loai, '$ten_sp', $don_gia, 0, '$mo_ta','$hinh')";
        return $this->db->execute($query);
    }

    public function deleteProduct($id)
    {
        $query = "UPDATE sanpham SET trang_thai = 'off' where ma_sp = $id";
        return $this->db->execute($query);
    }
    public function findProductByField($field,$data){
        $sql = "SELECT * FROM sanpham WHERE $field like '%$data%'";
        return $this->db->select($sql);
    }
    public function filterProduct($field) {
        $orderBy = "";
        
        switch ($field) {
            case 'name_asc':
                $orderBy = "ORDER BY ten_sp ASC";
                break;
            case 'name_desc':
                $orderBy = "ORDER BY ten_sp DESC";
                break;
            case 'price_asc':
                $orderBy = "ORDER BY don_gia ASC";
                break;
            case 'price_desc':
                $orderBy = "ORDER BY don_gia DESC";
                break;
            default:
                $orderBy = ""; // Không có sắp xếp nếu giá trị không hợp lệ
                break;
        }
    
        $sql = "SELECT * FROM sanpham $orderBy";
        return $this->db->select($sql);
    }
    
    public function updateProduct($id,$maloai, $tensp, $don_gia,$mo_ta,$hinh)
    {
        $query = "UPDATE sanpham SET ma_loai = $maloai , ten_sp = '$tensp', don_gia = $don_gia , mo_ta = '$mo_ta' , hinh = '$hinh' WHERE ma_sp = $id";
        return $this->db->execute($query);
    }
}
?>
