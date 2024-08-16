<?php
include_once "model/sanphamModel.php" ;
class SanPhamController
{
    private $sanphamModel;
    private $productlist;
    private $categoryModel;
    
    public function __construct()
    {
        $this->sanphamModel = new SanPhamModel();
        $this->productlist = $this->sanphamModel->getAllProducts();
    }
    public function getList(){
        return $this->productlist;
    }
    public function showProductList()
    {   
        $categories = $this->sanphamModel->getListCategory();
        $products = $this->sanphamModel->getAllProducts();
        foreach ($products as $key => $product) {
            if ($product["trang_thai"] == "off"){
                unset($products[$key]);
            }
        }
        include_once 'views/sanphamView.php';
    }
    public function getProductByID($id){
        foreach($this->productlist as $product){
            if($product['ma_sp'] == $id){
                return $product;
            }
        }
    }

    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten = $_POST['ten'];
            $iddanhmuc = $_POST['id_danh_muc'];
            $anh = $_POST['anh'];
            $gia = $_POST['gia'];
            $mota=$_POST['mota'];

            $result = $this->sanphamModel->addProduct($iddanhmuc,$ten,$gia,$mota,$anh);

            if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
            if ($result) {
                $_SESSION['message'] = "Thêm sản phẩm thành công!";
                $_SESSION['type'] = "success";
            } else {
                $_SESSION['message'] = "Thêm sản phẩm thất bại!";
                $_SESSION['type'] = "error";
            }
            
        }
    }

    public function deleteProduct()
    {
        if (isset($_GET['id'])) {
            $productID = $_GET['id'];
            $result = $this->sanphamModel->deleteProduct($productID);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if ($result) {
                $_SESSION['message'] = "Xóa sản phẩm thành công!";
                $_SESSION['type'] = "success";
            } else {
                $_SESSION['message'] = "Xóa sản phẩm thất bại!";
                $_SESSION['type'] = "error";
            }
        }
    }

    public function showUpdateProductForm()
    {
        if (isset($_GET['id'])) {
            $product_id = $_GET['id'];
            $categories = $this->sanphamModel->getListCategory();
            $productChoose = $this->sanphamModel->getProductByID($product_id);
            include_once 'views/sanphamView.php';
        }
    }
    public function searchProducts(){
        
        $item = $_GET['search'];
        $field = $_GET['field'];
        
        $products = $this->sanphamModel->findProductByField($field,$item);
        foreach ($products as $key => $product) {
            if ($product["trang_thai"] == "off"){
                unset($products[$key]);
            }
        }
        include_once 'views/sanphamView.php';
    }

    public function filterProducts(){
        $field = $_GET['filter'];
        
        $products = $this->sanphamModel->filterProduct($field);
        foreach ($products as $key => $product) {
            if ($product["trang_thai"] == "off"){
                unset($products[$key]);
            }
        }
        include_once 'views/sanphamView.php';
    }
    public function updateProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $product_id = $_POST['ma_sp'];
            $sp = $this->sanphamModel->getProductByID($product_id);
            $the_loai = $_POST['the_loai'];
            $ten_sp = $_POST['ten_sp'];
            $don_gia = $_POST['don_gia'];
            $mo_ta = $_POST['mo_ta'];
            $hinh = $_POST['hinh'];
            if ($hinh == ""){
                $hinh = $sp['hinh'];
            }
            $result = $this->sanphamModel->updateProduct($product_id,$the_loai,$ten_sp,$don_gia,$mo_ta,$hinh);

             if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if ($result) {
                $_SESSION['message'] = "Sửa thông tin sản phẩm thành công!";
                $_SESSION['type'] = "success";
            } else {
                $_SESSION['message'] = "Sửa thông tin sản phẩm thất bại!";
                $_SESSION['type'] = "error";
            }
        }
    }
}

$action = 'index';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'showProductList';
}

$sanphamController = new SanPhamController();
switch ($action) {
    case 'showProductList':
        $sanphamController->showProductList();
        break;
    case 'addProduct':
        $sanphamController->addProduct();
        $sanphamController->showProductList();
        break;
    case 'deleteProduct':
        $sanphamController->deleteProduct();
        $sanphamController->showProductList();
        break;
    case 'showUpdateProductForm':
        $sanphamController->showUpdateProductForm();
        break;
    case 'updateProduct':
        $sanphamController->updateProduct();
        $sanphamController->showProductList();
        break;
    case 'searchProduct':
        $sanphamController->searchProducts();
    case 'filterProduct':
        $sanphamController->filterProducts();
    default:
        $sanphamController->showProductList();
}
?>
