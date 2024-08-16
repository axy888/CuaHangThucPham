<?php
include_once "model/theloaiModel.php" ;

class TheLoaiController
{
    private $theloaiModel;

    public function __construct()
    {
        $this->theloaiModel = new TheLoaiModel();
    }

    public function showCategoryList()
    {
        $categories = $this->theloaiModel->getAllCategories();
        include_once 'views/theloaiView.php';
    }


    public function showAddCategoryForm()
    {
        include_once 'views/theloaiView.php';
    }


    public function addCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten = $_POST['ten'];
            $result = $this->theloaiModel->createCategory($ten);

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if ($result) {
                $_SESSION['message'] = "Thêm thể loại thành công!";
                $_SESSION['type'] = "success";
            } else {
                $_SESSION['message'] = "Thêm thể loại thất bại!";
                $_SESSION['type'] = "error";
            }
        }
    }

    public function deleteCategory()
    {
        if (isset($_GET['id'])) {
            $category_id = $_GET['id'];
            $result = $this->theloaiModel->deleteCategory($category_id);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if ($result) {
                $_SESSION['message'] = "Xóa thể loại thành công!";
                $_SESSION['type'] = "success";
            } else {
                $_SESSION['message'] = "Đã tồn tại sản phẩm thuộc loại này, không thể xóa!";
                $_SESSION['type'] = "error";
            }
        }
    }

    public function updateCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $category_id = $_POST['ma_loai'];
            $ten = $_POST['ten_loai'];
            $result = $this->theloaiModel->updateCategory($category_id, $ten);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if ($result) {
                $_SESSION['message'] = "Sửa thông tin thể loại thành công!";
                $_SESSION['type'] = "success";
            } else {
                $_SESSION['message'] = "Sửa thông tin thể loại thất bại!";
                $_SESSION['type'] = "error";
            }
        }
    }
    public function searchCategory(){
        $data = $_GET['search'];
        $categories = $this->theloaiModel->searchCategory($data);
        include_once "views/theloaiView.php";
    }
}

$action = 'index';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'showCategoryList';
}

$theloaiController = new TheLoaiController();
switch ($action) {
    case 'showCategoryList':
        $theloaiController->showCategoryList();
        break;
    
    case 'addCategory':
        $theloaiController->addCategory();
        $theloaiController->showCategoryList();
        break;
    case 'deleteCategory':
        $theloaiController->deleteCategory();
        $theloaiController->showCategoryList();
        break;
    case 'updateCategory':
        $theloaiController->updateCategory();
        $theloaiController->showCategoryList();
        break;
    case 'searchCategory':
        $theloaiController->searchCategory();
    default:
        $theloaiController->showCategoryList();
}
?>
