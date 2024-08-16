<?php
require_once("../database/database.php");

class TheLoaiModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllCategories()
    {
        $query = "SELECT * FROM theloai";
        return $this->db->select($query);
    }

    public function getCategoryById($id)
    {
        $query = "SELECT * FROM theloai WHERE ma_loai = $id";
        $result = $this->db->select($query);
        return $result[0];
    }

    public function createCategory($ten)
    {
        $query = "INSERT INTO theloai(ten_loai) VALUE ('$ten')";
        return $this->db->execute($query);
    }

    public function deleteCategory($id)
    {
        $query0 = "UPDATE theloai set da_xoa = 1 where ma_loai = $id";
        $this->db->execute($query0);
        $query = "DELETE FROM theloai WHERE ma_loai = $id AND ma_loai NOT IN (SELECT ma_loai FROM sanpham)";
        return $this->db->execute($query);
    }
    public function searchCategory($data){
        $query = "SELECT * FROM theloai where ten_loai LIKE '%$data%'";
        return $this->db->select($query);
    }
    public function updateCategory($id, $ten)
    {
        $query = "UPDATE theloai SET ten_loai = '$ten' WHERE ma_loai = $id";
        return $this->db->execute($query);
    }
}
?>
