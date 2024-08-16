<?php
include_once("model/nguoidungModel.php");

class NguoiDungController{
    private $nguoidungModel;

    public function __construct(){
        $this->nguoidungModel = new NguoiDungModel();
    }
    public function showUserList(){
        $users = $this->nguoidungModel->getAllUser();
        include_once 'views/nguoidungView.php';
    }

    public function searchUser()
    {
        $item = $_GET['search'];
        $field = $_GET['field'];
        $users = $this->nguoidungModel->findUserByField($field, $item);
        include_once 'views/nguoidungView.php';
    }
}
$action ='index';
if (isset($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = 'showUserList';
}
$nguoidungController = new NguoiDungController();
switch ($action){
    case 'showUserList':
        $nguoidungController->showUserList();
        break;
    case 'searchUser':
        $nguoidungController->searchUser();
        break;
    default:
        $nguoidungController->showUserList();
}
?>