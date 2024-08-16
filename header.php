<header class="header">
    <div class="header-left">
    <a href="http://localhost/WebBanDoAn/index.php"><img src="/WebBanDoAn/img/logo.jpg" alt="Logo"></a>
            <ul>
                <li><a href="http://localhost/WebBanDoAn/index.php"><i class="fa-solid fa-house"></i>Trang Chủ</a></li>
                <li><a href="http://localhost/WebBanDoAn/pages/sanpham.php"><i class="fa-solid fa-cart-shopping"></i>Sản phẩm</a></li>
            </ul>
    </div>
    <div class="header-right">
        <ul>
            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION["nguoidung"])) {
                // Người dùng đã đăng nhập
                echo '
                <li class="dropdown">
                    <a href="#" class="dropbtn"><i class="fa-solid fa-user"></i>' . $_SESSION["ten"] . '</a>
                    <div class="dropdown-content">
                        <a href="http://localhost/WebBanDoAn/pages/thongtincanhan.php">Thông tin tài khoản</a>
                        <a href="http://localhost/WebBanDoAn/pages/thongtindonhang.php?action=showTT">Thông tin đơn hàng</a>
                        <a href="http://localhost/WebBanDoAn/pages/dangxuat.php"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
                    </div>
                </li>
                ';
            }
             else {
                // Người dùng chưa đăng nhập
                echo '<li><a href="http://localhost/WebBanDoAn/pages/dangky.php">Đăng ký</a></li>';
                echo '<li><a href="http://localhost/WebBanDoAn/pages/dangnhap.php"><i class="fa-solid fa-user"></i>Đăng nhập</a></li>';
            }
        ?>
        </ul>
    </div>
</header>
