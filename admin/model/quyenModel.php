<?php
require_once("../database/database.php");

class QuyenModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
   
    public function getAllPermisson()
    {
        $query = "SELECT * FROM quyen";
        return $this->db->select($query);
    }
    public function getPermissionByID($id){
        $sql = "SELECT * FROM quyen where ma_quyen = $id";
        $kq = $this->db->select($sql);
        return $kq[0];
    }
    public function getAllChucNang(){
        $query = "SELECT * from chucnang";
        return $this->db->select($query);
    }

    public function getAllMaChucNang(){
        $query = "SELECT ma_cn from chucnang";
        return $this->db->select($query);
    }

    public function checkMaChucNang($ma_quyen,$ma_cn){
        $query = "SELECT * from ct_phanquyen WHERE ma_quyen = '$ma_quyen' AND ma_cn = '$ma_cn'";
        return $this->db->select($query);
    }

    public function getCTPQ_OfCN($ma_quyen){
        $query = "SELECT cq.ma_quyen, cq.ma_cn, cn.ten_cn FROM ct_phanquyen cq join quyen q on cq.ma_quyen = q.ma_quyen join chucnang cn on cq.ma_cn = cn.ma_cn where cq.ma_quyen = $ma_quyen";
        return $this->db->select($query);
    }

    public function getChucNangOfQuyen($ma_quyen){
        $sql = "SELECT * from ct_phanquyen where ma_quyen = $ma_quyen";
        return $this->db->select($sql);
    }
    public function getQuyenOfUsername($username){
        $sql = "SELECT * from taikhoan where username LIKE '$username%'";
        $kq = $this->db->select($sql);
        return $kq[0];
    }

    public function addCTPQ($ma_quyen,$ma_cn)
    {
        $sql = "INSERT INTO ct_phanquyen (ma_quyen, ma_cn) VALUES ('$ma_quyen', '$ma_cn')";
        return $this->db->execute($sql);
    }

    public function delCTPQ($ma_quyen,$ma_cn)
    {
        $sql = "DELETE FROM ct_phanquyen WHERE ma_quyen = '$ma_quyen' AND ma_cn = '$ma_cn'";
        return $this->db->execute($sql);
    }

    public function addPermission($ten_quyen){
        $query = "INSERT INTO quyen(ten_quyen) value('$ten_quyen')";
        $kq = $this->db->execute($query);
       
        return $kq;
    }

    public function deletePermission($ma_quyen){
        $query = "DELETE FROM quyen WHERE ma_quyen = $ma_quyen and ma_quyen != 1 and ma_quyen NOT IN (SELECT ma_quyen FROM taikhoan);";
        $result = $this->db->execute($query);
        if($result){
            $query2 = "DELETE FROM ct_phan_quyen where  ma_quyen = $ma_quyen and ma_quyen !=1";
            return $this->db->execute($query2);
        }
        return false;
    }
    public function updatePermission($maquyen,$ten_quyen){
        $sql = "UPDATE quyen set ten_quyen = '$ten_quyen' where ma_quyen = '$maquyen' AND ma_quyen != 1";
        return $this->db->execute($sql);
    }
}
?>
