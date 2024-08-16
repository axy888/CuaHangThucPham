<?php
require_once("../database/database.php");
class PhieuNhapModel
{
    private $db;
    public function __construct()
    {
        $this->db= new Database();
    }
    public function getAllImportReceipt(){
        $query = "SELECT * FROM phieunhap";
        return $this->db->select($query);
    }

    public function getImportById($id)
    {
        $query = "SELECT * FROM phieunhap WHERE ma_phieu = $id";
        $result = $this->db->select($query);
        return $result[0];
    }

    public function addImport($ma_ncc, $nguoiNhap)
    {
        $query_add_receipt = "INSERT INTO phieunhap (ma_ncc, ngay_tao, nguoi_nhap) 
                              VALUES ('$ma_ncc', CURDATE(),'$nguoiNhap')";
       return $this->db->execute($query_add_receipt);
        
    }

    public function updateImport($id, $masp, $sl, $dg,$so_luong_cu,$don_gia_cu)
    {

        $query_update_Ct="UPDATE ct_phieunhap 
                            SET so_luong=$sl , don_gia=$dg
                            WHERE ma_phieu=$id and ma_sp=$masp and so_luong=$so_luong_cu and don_gia=$don_gia_cu";
        $this->db->execute($query_update_Ct);

        $query_update_total = "UPDATE phieunhap 
                                    SET tong_tien = (tong_tien - (($so_luong_cu * $don_gia_cu) - ($sl * $dg)))
                                    WHERE ma_phieu = $id";

        $this->db->execute($query_update_total);

        $query_update_inventory = "UPDATE sanpham 
                                       SET so_luong = so_luong - ($so_luong_cu-$sl)
                                       WHERE ma_sp = $masp";
          return  $this->db->execute($query_update_inventory);

    }

    public function addImportDetail($id_nhap_kho, $detail)
    {
        // Thêm chi tiết các sản phẩm nhập kho
        // foreach ($details as $detail) 
        // {
            $ma_sp = $detail['ma_sp'];
            $so_luong = $detail['so_luong'];
            $don_gia = $detail['don_gia'];

            $query_insert_detail = "INSERT INTO ct_phieunhap (ma_phieu, ma_sp, so_luong, don_gia)
                                    VALUES ($id_nhap_kho, $ma_sp, $so_luong, $don_gia)";
            $this->db->execute($query_insert_detail);


            // Cập nhật số lượng tồn kho cho các sản phẩm
            $id_san_pham = $detail['ma_sp'];
            $so_luong = $detail['so_luong'];

            $query_update_inventory = "UPDATE sanpham 
                                       SET so_luong = so_luong + $so_luong 
                                       WHERE ma_sp = $id_san_pham";
            $this->db->execute($query_update_inventory);


            // Cập nhật tổng tiền cho phiếu nhập kho
            $query_update_total = "UPDATE phieunhap 
                                    SET tong_tien = (
                                        SELECT SUM(so_luong * don_gia) 
                                        FROM ct_phieunhap 
                                        WHERE ma_phieu = $id_nhap_kho
                                    )
                                    WHERE ma_phieu = $id_nhap_kho";
            return $this->db->execute($query_update_total);
        // }
    }

    public function getAllSupplierSelect()
    {
        $query = "SELECT * FROM nhacungcap";
        return $this->db->select($query);
    }
    
    public function getAllProductSelect()
    {
        $query = "SELECT * FROM sanpham";
        return $this->db->select($query);
    }

    public function getSupplyById($id)
    {
        $query = "SELECT * FROM nhacungcap WHERE ma_ncc = $id";
        $result = $this->db->select($query);
        return $result[0];
    }

    public function getImportDetailById($id)
    {
        $query = "SELECT * FROM ct_phieunhap WHERE ma_phieu = $id";
        return  $this->db->select($query);
       
    }

    public function deleteImportDetail($id,$masp,$sl,$dg)
    {
        $query_delete_Ct="DELETE FROM ct_phieunhap WHERE ma_phieu=$id and ma_sp=$masp and so_luong=$sl and don_gia=$dg";
        $this->db->execute($query_delete_Ct);
        $query_update_total = "UPDATE phieunhap 
                                    SET tong_tien = (tong_tien-($sl*$dg))
                                    WHERE ma_phieu = $id";
        $this->db->execute($query_update_total);
         $query_update_inventory = "UPDATE sanpham 
                                       SET so_luong = so_luong - $sl 
                                       WHERE ma_sp = $masp";
          return  $this->db->execute($query_update_inventory);
    }

    public function updateStatus($id,$tt)
    {
        $query_update_import = "UPDATE phieunhap 
                                    SET trang_thai=$tt
                                    WHERE ma_phieu = $id";
            return $this->db->execute($query_update_import);
    }

    public function findImportByFieldAndDateRange($field, $item, $startdate, $enddate,$giafrom,$giato)
    {
        // Xây dựng câu truy vấn SQL cơ bản
        $sql = "SELECT * FROM phieunhap WHERE ";
    
        // Thêm điều kiện về trường (field) và mục (item)
        $sql .= "$field LIKE '%$item%'";
    
        // Nếu startdate và enddate không rỗng, thêm điều kiện về ngày tháng
        if (!empty($startdate)) {
            $sql .= " AND ngay_tao >= '$startdate'";
        }
    
        // Nếu enddate không rỗng, thêm điều kiện về ngày tháng kết thúc
        if (!empty($enddate)) {
            $sql .= " AND ngay_tao <= '$enddate'";
        }

        if (!empty($giafrom)) {
            $sql .= " AND tong_tien >= '$giafrom'";
        }

        if (!empty($giato)) {
            $sql .= " AND tong_tien <= '$giato'";
        }
        // Thực hiện truy vấn và trả về kết quả
        return $this->db->select($sql);
    }

    public function findImportDetailByFieldAndDateRange($field, $item, $soluongfrom, $soluongto,$giafrom,$giato)
    {
        // Xây dựng câu truy vấn SQL cơ bản
        $sql = "SELECT * FROM ct_phieunhap WHERE ";
    
        // Thêm điều kiện về trường (field) và mục (item)
        $sql .= "$field LIKE '%$item%'";
    
        // Nếu startdate và enddate không rỗng, thêm điều kiện về ngày tháng
        if (!empty($soluongfrom)) {
            $sql .= " AND so_luong >= '$soluongfrom'";
        }
    
        // Nếu enddate không rỗng, thêm điều kiện về ngày tháng kết thúc
        if (!empty($soluongto)) {
            $sql .= " AND so_luong <= '$soluongto'";
        }

        if (!empty($giafrom)) {
            $sql .= " AND don_gia >= '$giafrom'";
        }

        if (!empty($giato)) {
            $sql .= " AND don_gia <= '$giato'";
        }
        // Thực hiện truy vấn và trả về kết quả
        return $this->db->select($sql);
    }

    public function filterImport($field) {
        $orderBy = "";
        
        switch ($field) {
            case 'price_asc':
                $orderBy = "ORDER BY tong_tien ASC";
                break;
            case 'price_desc':
                $orderBy = "ORDER BY tong_tien DESC";
                break;
            case 'date_asc':
                $orderBy = "ORDER BY ngay_tao ASC";
                break;
            case 'date_desc':
                $orderBy = "ORDER BY ngay_tao DESC";
                break;
            default:
                $orderBy = ""; // Không có sắp xếp nếu giá trị không hợp lệ
                break;
        }
    
        $sql = "SELECT * FROM phieunhap $orderBy";
        return $this->db->select($sql);
    }
}
?>