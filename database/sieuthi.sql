-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 16, 2024 lúc 04:50 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `sieuthi`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chucnang`
--

CREATE TABLE `chucnang` (
  `ma_cn` int(11) NOT NULL,
  `ten_cn` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chucnang`
--

INSERT INTO `chucnang` (`ma_cn`, `ten_cn`) VALUES
(1, 'Sản phẩm'),
(2, 'Thể loại'),
(3, 'Nhà cung cấp'),
(4, 'Đơn hàng'),
(5, 'Phiếu nhập'),
(6, 'Tài khoản'),
(7, 'Người dùng'),
(8, 'Phân quyền');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_donhang`
--

CREATE TABLE `ct_donhang` (
  `ma_don` int(11) DEFAULT NULL,
  `ma_sp` int(11) DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ct_donhang`
--

INSERT INTO `ct_donhang` (`ma_don`, `ma_sp`, `so_luong`) VALUES
(2, 1, 2),
(2, 3, 1),
(2, 4, 1),
(3, 3, 2),
(3, 5, 1),
(3, 6, 2),
(4, 3, 1),
(5, 1, 2),
(5, 3, 1),
(6, 1, 1),
(6, 4, 1),
(6, 7, 1),
(6, 8, 1),
(7, 3, 1),
(7, 1, 1),
(8, 1, 1),
(8, 3, 1),
(9, 1, 1),
(9, 3, 1),
(9, 4, 1),
(10, 1, 3),
(10, 17, 2),
(10, 22, 12),
(10, 14, 1),
(11, 3, 1),
(11, 4, 1),
(11, 18, 1),
(12, 9, 1),
(12, 8, 1),
(12, 20, 1),
(12, 37, 1),
(12, 12, 11),
(13, 16, 1),
(13, 19, 14),
(13, 24, 2),
(13, 43, 3),
(13, 15, 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_phanquyen`
--

CREATE TABLE `ct_phanquyen` (
  `ma_quyen` int(11) NOT NULL,
  `ma_cn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ct_phanquyen`
--

INSERT INTO `ct_phanquyen` (`ma_quyen`, `ma_cn`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(3, 1),
(3, 3),
(3, 2),
(3, 4),
(3, 5),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(5, 7),
(6, 1),
(6, 2),
(6, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_phieunhap`
--

CREATE TABLE `ct_phieunhap` (
  `ma_phieu` int(11) NOT NULL,
  `ma_sp` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `don_gia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ct_phieunhap`
--

INSERT INTO `ct_phieunhap` (`ma_phieu`, `ma_sp`, `so_luong`, `don_gia`) VALUES
(1, 1, 100, 50000),
(1, 3, 100, 190000),
(1, 4, 100, 240000),
(1, 5, 100, 30000),
(2, 6, 100, 20000),
(2, 7, 100, 5000),
(2, 8, 100, 6000),
(2, 9, 100, 40000),
(2, 10, 100, 20000),
(3, 11, 120, 12000),
(3, 12, 100, 17000),
(3, 13, 100, 20000),
(3, 14, 100, 40000),
(3, 15, 100, 3000),
(4, 16, 100, 8000),
(4, 17, 100, 2000),
(4, 18, 100, 20000),
(4, 19, 100, 30000),
(5, 20, 100, 10000),
(5, 21, 100, 8000),
(5, 22, 100, 12000),
(5, 23, 100, 20000),
(5, 24, 100, 45000),
(6, 25, 100, 25000),
(6, 26, 100, 90000),
(6, 27, 100, 5000),
(6, 28, 100, 5000),
(7, 29, 100, 70000),
(7, 30, 100, 40000),
(7, 31, 100, 29000),
(7, 32, 100, 15000),
(7, 33, 100, 6000),
(8, 34, 100, 19000),
(8, 35, 100, 6000),
(8, 36, 120, 25000),
(8, 37, 100, 239000),
(9, 38, 100, 60000),
(9, 39, 100, 20000),
(9, 40, 100, 39000),
(10, 41, 100, 40000),
(10, 42, 100, 9000),
(10, 43, 100, 80000),
(11, 44, 100, 120000),
(11, 45, 100, 10000),
(11, 46, 100, 230000),
(11, 47, 100, 20000),
(12, 52, 100, 6500);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `ma_don` int(11) NOT NULL,
  `ma_kh` varchar(10) NOT NULL,
  `trang_thai` int(11) NOT NULL DEFAULT 1,
  `ngay_dat` date NOT NULL,
  `tong_tien` int(11) NOT NULL,
  `dia_chi` varchar(50) NOT NULL,
  `ho_ten` varchar(20) NOT NULL,
  `sdt` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`ma_don`, `ma_kh`, `trang_thai`, `ngay_dat`, `tong_tien`, `dia_chi`, `ho_ten`, `sdt`) VALUES
(2, 'KH11112', 1, '2024-08-01', 560000, 'tphcm-6-4-233 phạm văn chí', 'tuấn đạt', '0123456789'),
(3, 'KH11112', 1, '2024-08-01', 520000, 'tphcm-6-4-dashdabdsajshj', 'tuấn đạt', '0123456789'),
(5, 'KH11112', 3, '2024-08-02', 310000, 'tphcm-6-4-dashdabdsajshj', 'dat', '0123456789'),
(6, 'KH11112', 1, '2024-08-02', 322000, 'tphcm-6-4-233 phạm văn chí', 'dat', '0123143545'),
(7, 'KH11112', 0, '2024-08-02', 260000, 'tphcm-6-4-ashdajdbajasb', 'dat', '0123456789'),
(8, 'KH11112', 0, '2024-08-02', 260000, 'tphcm-6-4-233 phạm văn chí', 'tuấn đạt', '0123456789'),
(9, 'KH11116', 2, '2024-08-15', 510000, 'tphcm-6-4-285 an dương vương', 'tuấn đạt', '0123143545'),
(10, 'KH11116', 3, '2024-08-15', 400000, 'tphcm-5-5-233 an dương vương', 'dat', '0123456781'),
(11, 'KH11117', 2, '2024-08-16', 490000, 'tphcm-7-7-123 Nguyễn Thị Thập', 'đạt huỳnh', '0123143545'),
(12, 'KH11117', 1, '2024-08-16', 556000, 'tphcm-8-8-183 Lương Văn Can', 'đạt tuấn', '0123456781'),
(13, 'KH11117', 3, '2024-08-16', 1126000, 'tphcm-3-3-133 Bà Huyện Thanh Quan', 'huỳnh tuấn', '0123143544');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `ma_nd` varchar(10) NOT NULL,
  `ten` varchar(20) NOT NULL,
  `sdt` varchar(10) NOT NULL,
  `diachi` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`ma_nd`, `ten`, `sdt`, `diachi`, `email`) VALUES
('KH11112', 'dat124', '0123143546', 'dasjdakdaksdhkah', 'dat124@gmail.com'),
('KH11111', 'dat123', '0123456789', 'dasjdakdaksdhkah', 'dat123@gmail.com'),
('admin999', 'admin999', '0123456789', 'dasjdakdaksdhkah', 'admin@gmail.com'),
('KH11113', 'dat111', '0123143545', 'asd,jadhakjsdkjsak', 'dat123@gmail.com'),
('KH11114', 'dat112', '0123143544', 'dasjdakdaksdhkah', 'dat123@gmail.com'),
('NV00001', 'tundaa5', '0123143545', 'ashdajdbajasb', 'dat123@gmail.com'),
('QLK00001', 'tundaa', '0123143545', '233 phạm văn chí', 'dat123@gmail.com'),
('KH11115', 'tundaa2', '0123143543', 'ashdajdbajasb', 'dat123@gmail.com'),
('QLK00002', 'tundaa3', '0123143544', 'ashdajdbajasb', 'dat123@gmail.com'),
('QLK00003', 'tundaa6', '0123143545', 'ashdajdbajasb', 'dat123@gmail.com'),
('KH11116', 'tuandat123', '0123143545', 'dasjdakdaksdhkah', 'dat321@gmail.com'),
('KH11117', 'dat125', '0123143543', 'djasdakdakjsdh', 'dat125@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `ma_ncc` int(11) NOT NULL,
  `ten_ncc` varchar(100) NOT NULL,
  `dia_chi` varchar(100) NOT NULL,
  `sdt` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `trang_thai` varchar(10) NOT NULL DEFAULT 'on'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhacungcap`
--

INSERT INTO `nhacungcap` (`ma_ncc`, `ten_ncc`, `dia_chi`, `sdt`, `email`, `trang_thai`) VALUES
(1, 'Công ty Nông Sản Vạn Phước', '67/16 Bình Hưng Hòa B, Q. Bình Tân, TP. Hồ Chí Minh', '0899339611', 'info@nsvpvietnam.vn', 'on'),
(2, 'Công Ty TNHH Thương Mại Xuất Nhập Khẩu Sao Khuê', 'Số 180/15 Đường Nguyễn Hữu Cảnh, P. 22, Q. Bình Thạnh , TP. Hồ Chí Minh', '0908261003', 'info@ctskvietnam.vn', 'on'),
(3, 'Công ty Cổ phần Sữa Vinamilk', '67/16 Bình Hưng Hòa B, Q. Bình Tân, TP. Hồ Chí Minh', '0899339611', 'info@nsvpvietnam.vn', 'on'),
(4, 'CÔNG TY CỔ PHẦN VIỆT NAM KỸ NGHỆ SÚC SẢN(VISSAN)', '420 Nơ Trang Long, P. 13, Quận Bình Thạnh, TP.HCM', '19001960', 'vissanco@vissan.com.vn', 'on'),
(5, 'Công Ty Cổ Phần Sản Xuất Và Kinh Doanh Thực Phẩm Tây Đô', 'Cụm Công nghiệp Trường An, Xã An Khánh, Huyện Hoài Đức, Hà Nội', '0779388868', 'banhkeotaydo999@gmail.com', 'on'),
(6, 'Công Ty Cổ Phần Hàng Tiêu Dùng Đại Thuận', '59-61 Nguyễn Trường Tộ, Phường 13, Quận 4, Thành phố Hồ Chí Minh', '0944868800', 'daithuan1988@gmail.com', 'on'),
(7, 'Công ty TNHH Nước giải khát SUNTORY PEPSICO Việt Nam', '88 Đường Đồng Khởi, Quận 1, Thành phố Hồ Chí Minh', '0938219437', 'talent.acquisition@suntorypepsico.vn', 'on'),
(8, 'Công ty URC Việt Nam', 'Số 42 VSIP, Đại Lộ Tự Do, Khu công nghiệp Việt Nam - Singapore, Phường An Phú, Thành phố Thuận An ', '18001726', 'info@urcvn.com', 'on'),
(9, 'Công Ty Cổ Phần Nông Sản Thực Phẩm Thành Nam', '168/42 DX006, KP. 8, P. Phú Mỹ, TP. Thủ Dầu Một, Bình Dương', '0971001003', 'thucphambinhduong03@gmail.com', 'on'),
(10, 'Công Ty TNHH MTV Cánh Đồng Xanh', 'Kiốt Số 2, Chợ Hàng Bông Phú Hòa, P. Phú Hòa, TP. Thủ Dầu Một, Bình Dương', '0899750799', 'canhdongxanh05@gmail.com', 'on'),
(11, 'Công ty TNHH PIC Việt Nam', '123  54 kjasdnkasjdkasndkjajksdakdnakjsdnjakbsda', '0123456789', 'dat123@gmail.com', 'off');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieunhap`
--

CREATE TABLE `phieunhap` (
  `ma_phieu` int(11) NOT NULL,
  `ma_ncc` int(11) NOT NULL,
  `ngay_tao` date NOT NULL,
  `nguoi_nhap` varchar(20) NOT NULL,
  `tong_tien` int(11) NOT NULL DEFAULT 0,
  `trang_thai` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phieunhap`
--

INSERT INTO `phieunhap` (`ma_phieu`, `ma_ncc`, `ngay_tao`, `nguoi_nhap`, `tong_tien`, `trang_thai`) VALUES
(1, 1, '2024-08-08', 'Nguyễn Văn A', 51000000, 1),
(2, 2, '2024-08-08', 'dat123', 9100000, 0),
(3, 4, '2024-07-07', 'dat123', 9440000, 1),
(4, 3, '2024-06-12', 'dat123', 6000000, 0),
(5, 1, '2024-05-01', 'dat123', 9500000, 1),
(6, 5, '2024-08-11', 'admin999', 12500000, 0),
(7, 6, '2024-08-11', 'admin999', 16000000, 1),
(8, 7, '2024-08-11', 'admin999', 29400000, 0),
(9, 8, '2024-08-11', 'admin999', 11900000, 1),
(10, 9, '2024-08-11', 'admin999', 12900000, 0),
(11, 10, '2024-08-11', 'admin999', 38000000, 1),
(12, 1, '2024-08-11', 'admin999', 650000, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `ma_quyen` int(11) NOT NULL,
  `ten_quyen` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`ma_quyen`, `ten_quyen`) VALUES
(1, 'Admin'),
(2, 'Khách hàng'),
(3, 'Quản lý kho'),
(4, 'Quản lý đơn hàng'),
(5, 'Quản lý người dùng'),
(6, 'Nhân viên'),
(12, 'abc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `ma_sp` int(11) NOT NULL,
  `ten_sp` varchar(30) NOT NULL,
  `ma_loai` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `don_gia` int(11) NOT NULL,
  `mo_ta` varchar(100) NOT NULL,
  `hinh` varchar(20) NOT NULL,
  `trang_thai` varchar(10) NOT NULL DEFAULT 'on'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`ma_sp`, `ten_sp`, `ma_loai`, `so_luong`, `don_gia`, `mo_ta`, `hinh`, `trang_thai`) VALUES
(1, 'Táo NewZealand Mỹ', 1, 96, 50000, 'Táo nhập khẩu tươi mới vừa ngon vừa bổ', 'tao.jpg', 'on'),
(2, 'Cà rốt Đà Lạt', 2, 0, 15000, 'Cà rốt Đà Lạt giống tốt giá rẻ', 'carrot.jpg', 'on'),
(3, 'Thịt bò Úc', 3, 98, 210000, 'Thịt bò Úc bổ sung chất sắt', 'thitbo.jpg', 'on'),
(4, 'Tôm tươi Nha Trang', 4, 98, 250000, 'Tôm sú sạch không kháng sinh tươi ngon', 'tom.jpg', 'on'),
(5, 'Cá hộp ba cô gái', 5, 100, 40000, 'Cá hộp ba cô gái chất lượng 105g', 'cahop.jpg', 'on'),
(6, 'Sữa tươi Vinamilk', 6, 100, 30000, 'Sữa tươi Vinamilk lên men tự nhiên 100% ', 'suatuoi.jpg', 'on'),
(7, 'Muối iot', 7, 100, 10000, 'Muối biển tinh sấy cao cấp tốt cho trí não', 'muoi.jpg', 'on'),
(8, 'Coca Cola', 8, 100, 12000, 'Nước ngọt Coca Cola', 'cocacola.jpg', 'on'),
(9, 'Bánh quy Oreo', 9, 100, 50000, 'Bánh quy socola Oreo Mini ', 'oreo.jpg', 'on'),
(10, 'Yến mạch Quaker', 10, 100, 30000, 'Yến mạch ăn liền Quaker gói 300g', 'yenmach.jpg', 'on'),
(11, 'Đu đủ', 1, 120, 15000, 'Đu đủ vàng ngọt liệm', 'dudu.jpg', 'on'),
(12, 'Khoai lang', 2, 100, 20000, 'Khoai lang Nhật', 'khoailang.jpg', 'on'),
(13, 'Thịt heo Vissan', 3, 100, 25000, 'Heo 2 lát Vissan', 'heo2lat.jpg', 'on'),
(14, 'Cá điêu hồng', 4, 99, 60000, 'Cá điêu hồng nguyên con', 'dieuhong.jpg', 'on'),
(15, 'Mì Gói Hảo Hảo', 5, 88, 8000, 'Mì hảo hảo ăn liền không phẩm màu', 'migoi.jpg', 'on'),
(16, 'Kẹo Dẻo bibica', 9, 99, 10000, 'Kẹo dẻo tăng lực bibica', 'keodeo.jpg', 'on'),
(17, 'Nước Suối Aquafina', 8, 98, 5000, 'Nước suối tinh khiết', 'aquafina.jpg', 'on'),
(18, 'Bột nêm Know', 7, 99, 30000, 'Bột nêm dinh dưỡng từ thịt thăng,xương ống', 'botnem.jpg', 'on'),
(19, 'Sữa ông thọ', 6, 86, 40000, 'Dầu gội dưỡng tóc', 'suaongtho.jpg', 'on'),
(20, 'Ngũ cốc ăn liền nestlie', 10, 100, 15000, 'Ngũ cốc nestlie cực ngon', 'ngucoc.jpg', 'on'),
(21, 'Bánh mì Kinh Đô', 9, 100, 10000, 'Bánh mì tươi ngon không chất bảo quản', 'banhmi.jpg', 'on'),
(22, 'Sữa chua yomost', 6, 88, 15000, 'Sữa chua vị dâu tốt cho da mặt', 'suachuayomost.jpg', 'on'),
(23, 'Ức gà có da', 3, 100, 30000, 'Ức gà tươi', 'ucgacoda.jpg', 'on'),
(24, 'Cá basa cắt khúc', 4, 98, 65000, 'Cá basa tươi mới dinh dưỡng đầy đặn', 'cabasa.jpg', 'on'),
(25, 'Heo 2 lát 150g', 5, 100, 35000, 'Thịt heo đống hộp chất lượng bổ dưỡng', 'heo2lat.jpg', 'on'),
(26, 'Cà Phê Trung Nguyên', 8, 100, 100000, 'Cà phê hòa tan chất lượng cao', 'caphe.jpg', 'on'),
(27, 'Đường Biên Hòa', 7, 100, 15000, 'Đường mía thiên nhiên biên hòa gói 1kg', 'duong.jpg', 'on'),
(28, 'Muối Vĩnh Hảo', 7, 100, 10000, 'Muối hạt Vĩnh Hảo Sosal Group 1kg', 'muoi.jpg', 'on'),
(29, 'Nước Mắm Hưng Thịnh', 7, 100, 85000, 'Nước mắm cá cơm Hưng Thịnh 750ml', 'nuocmam.jpg', 'on'),
(30, 'Bột ngũ cốc Vitapro', 10, 100, 50000, 'Bột ngũ cốc kết hợp từ các loại đậu,mang đến cho bạn dinh dưỡng, thơm ngon', 'ngucocvita.jpg', 'on'),
(31, 'Dầu Ăn Simply', 7, 100, 45000, 'Dầu ăn simply cao cấp tốt cho sức khỏe', 'dauan.jpg', 'on'),
(32, 'Nước Tương Maggi', 7, 100, 25000, 'Nước tương magi được lên men tự nhiên, đậm đà', 'nuoctuong.jpg', 'on'),
(33, 'Cốt nấu phở bò Ông Chà Và', 7, 100, 10000, 'Gia vị nêm nếm sẵn cho phở bò', 'giavinemsan.jpg', 'on'),
(34, 'Kẹo dẻo chupachup', 9, 100, 30000, 'Kẹo dẻo chupachup đủ loại đủ vị', 'keochupa.jpg', 'on'),
(35, 'Snack hình cua Poca', 9, 100, 12000, 'Snack hình cua vị tảo biển 60g', 'snack.jpg', 'on'),
(36, 'Cá lóc sấy khô', 4, 120, 35000, 'Cá lóc sấy khô đông lạnh', 'caloc.jpg', 'on'),
(37, 'Mực nang', 4, 100, 259000, 'Mực nang ướp lạnh cao cấp', 'mucnang.jpg', 'on'),
(38, 'Bưởi da xanh nguyên trái', 1, 100, 75000, 'Bưởi da xanh trái từ 1kg trở lên', 'buoi.jpg', 'on'),
(39, 'Cam sành Vĩnh Long', 1, 100, 30000, 'Cam sành Vĩnh Long tươi ngon mọng nước', 'camsanh.jpg', 'on'),
(40, 'Cam vàng Úc', 1, 100, 50000, 'Cam vàng giá tốt có một không hai nhập khẩu từ Úc', 'camvang.jpg', 'on'),
(41, 'Lê đường', 1, 100, 50800, 'Lê đường ngon ngọt bổ dưỡng cực kì', 'le.jpg', 'on'),
(42, 'Thanh long ruột trắng', 1, 100, 16300, 'Thanh long ruột trắng, xốp, ngọt thanh', 'thanhlong.jpg', 'on'),
(43, 'Táo Ninh Thuận', 1, 97, 110000, 'Táo Ninh Thuận giòn ngọt tươi ngon', 'taoninhthuan.jpg', 'on'),
(44, 'Chanh dây', 1, 100, 150000, 'Chanh dây trái từ 50g trở lên', 'chanhday.jpg', 'on'),
(45, 'Chuối sứ', 1, 100, 20000, 'Chuối sứ xanh sạch đẹp', 'chuoisu.jpg', 'on'),
(46, 'Dưa hấu', 1, 100, 250000, 'Dưa hấu đỏ ít hột ngọt liệm', 'duahau.jpg', 'on'),
(47, 'Dưa gang', 1, 100, 30000, 'Dưa gang tươi nguyên trái ngọt túi giá tốt', 'duagang.jpg', 'on'),
(48, 'Kiwi Mỹ', 1, 0, 299000, 'Kiwi Mỹ cực kì tốt cho sức khỏe', 'kiwi.jpg', 'on'),
(52, 'Củ dền', 2, 100, 13000, 'Củ dền đỏ ngọt', 'cuden.jpg', 'on'),
(53, 'Tôm tươi', 4, 0, 20000, 'Đặc sản Vũng Tàu tươi ngon bổ dưỡng', 'tom.jpg', 'off'),
(54, 'Tôm tươi', 4, 0, 20000, 'asfmnbvcx', 'tom.jpg', 'off'),
(55, 'Tôm tươi', 4, 0, 23000, 'sdasdasda', 'tom.jpg', 'off'),
(56, 'Tôm tươi', 4, 0, 23000, 'asdasdbcvbc', 'tom.jpg', 'off'),
(57, 'Tôm tươi', 1, 0, 233000, 'asdacvxv', 'aquafina.jpg', 'off'),
(58, 'Táo bi đỏ mỹ', 1, 0, 49999, 'dsadxcvxcvxcvxcv', 'botnem.jpg', 'on'),
(59, 'dao thái', 8, 0, 260000, 'asjdbakdsbamsd bamhbd ', 'banhmi.jpg', 'off'),
(60, 'Sa tế tôm Chinsu', 7, 0, 11000, 'Sa tế tôm Chinsu ớt sả tươi hũ 90g làm từ nguyên liệu tôm, ớt , sả tươi sạch với vị cay thơm nồng', 'sate.jpg', 'on'),
(61, 'Bơ thực vật Meizan', 7, 0, 19000, 'Bơ thực vật Meizan hũ 200g được làm từ nguyên liệu tự nhiên,có vị mặn dịu tự nhiên', 'bo.jpg', 'on'),
(62, 'Bánh que Dorkbua', 9, 0, 84500, 'Bánh que Dorkbua Kids vị truyền thống gói 240g dành cho trẻ em với bao bì dễ thương', 'banhque.jpg', 'on');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `username` varchar(10) NOT NULL,
  `ma_quyen` int(1) NOT NULL DEFAULT 2,
  `password` varchar(50) NOT NULL,
  `trang_thai` varchar(5) NOT NULL DEFAULT 'on',
  `ngay_tao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`username`, `ma_quyen`, `password`, `trang_thai`, `ngay_tao`) VALUES
('KH11112', 2, '2e678024cabebdfe17a5aeef0163fe6d', 'on', '2024-07-23'),
('KH11111', 1, '2e678024cabebdfe17a5aeef0163fe6d', 'on', '2024-07-25'),
('admin999', 1, '00ba7ceab606427071d5d755ea99e976', 'on', '2024-08-11'),
('KH11113', 2, '4c9b4c8687ec51f68c2186100b7d96ea', 'on', '2024-08-11'),
('KH11114', 2, 'c23aed0993bc104df7f9a86762666ffc', 'on', '2024-08-11'),
('NV00001', 6, '2e678024cabebdfe17a5aeef0163fe6d', 'on', '2024-08-12'),
('QLK00001', 3, '2e678024cabebdfe17a5aeef0163fe6d', 'on', '2024-08-12'),
('KH11115', 2, '2e678024cabebdfe17a5aeef0163fe6d', 'on', '2024-08-12'),
('QLK00002', 3, '2e678024cabebdfe17a5aeef0163fe6d', 'on', '2024-08-12'),
('QLK00003', 3, '2e678024cabebdfe17a5aeef0163fe6d', 'on', '2024-08-12'),
('KH11116', 2, '2e678024cabebdfe17a5aeef0163fe6d', 'on', '2024-08-15'),
('KH11117', 2, '0782d6bf31c766e57c657756ff628a39', 'on', '2024-08-16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theloai`
--

CREATE TABLE `theloai` (
  `ma_loai` int(11) NOT NULL,
  `ten_loai` varchar(20) NOT NULL,
  `da_xoa` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `theloai`
--

INSERT INTO `theloai` (`ma_loai`, `ten_loai`, `da_xoa`) VALUES
(1, 'Trái cây', 0),
(2, 'Rau củ', 0),
(3, 'Thịt', 0),
(4, 'Hải sản', 0),
(5, 'Đồ hộp', 0),
(6, 'Sữa', 0),
(7, 'Gia vị', 0),
(8, 'Đồ uống', 0),
(9, 'Bánh kẹo', 0),
(10, 'Ngũ cốc', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`ma_don`);

--
-- Chỉ mục cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`ma_ncc`);

--
-- Chỉ mục cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD PRIMARY KEY (`ma_phieu`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`ma_quyen`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`ma_sp`);

--
-- Chỉ mục cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`ma_loai`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `ma_don` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `ma_ncc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  MODIFY `ma_phieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `quyen`
--
ALTER TABLE `quyen`
  MODIFY `ma_quyen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `ma_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT cho bảng `theloai`
--
ALTER TABLE `theloai`
  MODIFY `ma_loai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
