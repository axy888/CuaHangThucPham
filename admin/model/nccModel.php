<?php
require_once("../database/database.php");

class NCCModel
{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }
    public function getAllSuppliers(){
        $query = "SELECT * FROM nhacungcap";
        return $this->db->select($query);
    }

    public function getSupplierById($id)
    {
        $query = "SELECT * FROM nhacungcap WHERE ma_ncc = $id";

        $result = $this->db->select($query);

        return $result[0];
    }
    public function addSupplier($name, $address, $phone, $email){
        $query = "INSERT INTO nhacungcap(ten_ncc, dia_chi, sdt, email) value('$name','$address','$phone','$email')";
        $result = $this->db->execute($query);
        return $result;
    }
    public function updateSupplier($id, $name, $address, $phone, $email){
        $query = "UPDATE nhacungcap set ten_ncc = '$name' , dia_chi = '$address' , sdt = '$phone' , email = '$email' where ma_ncc = $id";
        $result = $this->db->execute($query);
        return $result;
    }
    public function deleteSupplier($id){
        $query = "UPDATE nhacungcap set trang_thai = 'off' where ma_ncc = $id";
        $result = $this->db->execute($query);
        return $result;
    }

    public function findSupplierByField($field,$value)
    {
        $query="SELECT * FROM nhacungcap WHERE $field LIKE '%$value%'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>