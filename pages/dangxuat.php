<?php
session_start();
session_unset(); // Xóa tất cả các biến phiên
session_destroy(); // Hủy phiên làm việc
header("Location: http://localhost/WebBanDoAn/pages/dangnhap.php");
exit();
?>
