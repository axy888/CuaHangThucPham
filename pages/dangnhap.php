<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form đăng nhập</title>
    <link rel="stylesheet" href="../css/trangchu.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- <link rel="icon" href="../admin/images/DOVODUNG.png" type="image/png" sizes="32x32"> -->
</head>
<body>
    <div id="dangnhap">
        <form action="dangnhap.php?chon=xulydangnhap&action=dangnhap" method="POST" id="formDangnhap">
        <h3 class="title_dangnhap">ĐĂNG NHẬP TÀI KHOẢN</h3>
        <label for="makh">Tên đăng nhập: </label>
        <input type="text" id="makh" name="txtTenKH">
        <label for="password">Mật khẩu: </label>
        <input type="password" id="password" name="txtPassword">
        
        <a href="dangky.php">Đăng ký ngay</a>
        <input type="submit" value="Đăng nhập" id="btnDangnhap">
       <a href="http://localhost/WebBanDoAn/index.php"> <input type="button" value="Hủy" id="btnHuy"></a>
    </form>
</div>

<script>
    
$(document).ready(function () {
$("#formDangnhap").submit(function(event) {
    event.preventDefault();
    $.ajax({
    url: "ajax.php?chon=xulydangnhap&action=dangnhap", // Thay thế bằng URL đăng ký thực tế
    method: "POST",
    data: $(this).serialize(),
    // dataType: 'json',
    success: function(response) {
        var jsonResponse = JSON.parse(response);
        console.log(jsonResponse)
        //chuyển đổi chuỗi JSON nhận được từ máy chủ thành một đối tượng JavaScript
        if (jsonResponse.status == 1) {
            alert("Đăng nhập thành công!");
            window.location.href = "http://localhost/WebBanDoAn/index.php";
            // Chuyển hướng đến trang chủ hoặc trang hồ sơ người dùng
        } 
        else if (jsonResponse.status == 2){
            alert("Đăng nhập thành công!");
            window.location.href = "http://localhost/WebBanDoAn/admin/index.php";
        }
        else if((jsonResponse.status == 3))
        {
            alert("Tài khoản hiện đang bị khóa!");
        }
        else alert(jsonResponse.message);
    },
    error: function(xhr, status, error){
        alert("loi: "+error)
    }
    });
});
})
</script>
</body>
</html>