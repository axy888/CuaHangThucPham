<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <link rel="stylesheet" href="../css/trangchu.css"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php
require_once("../header.php");

?>
<div class="divThongTin">
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>
    <form action="thongtincanhan.php?action=sua" method="POST" id="formThongTinNguoiDung">
        <h2>CHỈNH SỬA THÔNG TIN CÁ NHÂN</h2>
        <div>
            <label for="name">Tên tài khoản</label>
            <input type="text" id="makh" name="txtMakh" readonly value="<?php echo $_SESSION["nguoidung"]; ?>">
            
            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="username" name="txtUsername" value="<?php echo $_SESSION["ten"]; ?>">
        </div>
        <div>
            <label for="phonenumber">Số điện thoại:</label>
            <input type="tel" id="sdt" name="txtSdt" value="<?php echo $_SESSION["sdt"]; ?>">
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="txtEmail" value="<?php echo $_SESSION["email"]; ?>">
        </div>
        <div>
            <label for="address">Địa chỉ:</label>
            <input type="text" id="diachi" name="txtDiachi" value="<?php echo $_SESSION["diachi"]; ?>">
        </div>
        <input type="hidden" name="ketquasuathongtin" id="kqSuaTT" value="">
        <input style="align-item:right;background-color:rgb(51, 62, 72);padding:0% 2% 0% 2%;color:white;" type="submit" onclick="suathongtin()" value="Lưu" id="btnSaveThongTin2">
    </form>
    <br>
    
    <form action="thongtincanhan.php?action=suapass" method="POST" id="formThongTinPassWord">
        <h2>CHỈNH SỬA PASSWORD</h2>
        <div>
            <label for="password">Password cũ:</label>
            <input type="password" id="password" name="txtPassword" autocomplete="on">
        </div>
        <div>
            <label for="newpassword">Password mới:</label>
            <input type="password" id="newpassword" name="txtNewPassword" autocomplete="on">
        </div>
        <div>
            <label for="confirmpassword">Xác nhận mật khẩu:</label>
            <input type="password" id="confirmpassword" name="txtConfirmPassword" autocomplete="on">
        </div>
        
            <input type="hidden" name="ketqua" id="kqInput" value="">
            <input type="hidden" name="passhientai" id="passhientai" value="<?php echo $_SESSION["pass"]; ?>">
        <input style="align-item:right;background-color:rgb(51, 62, 72);padding:0% 2% 0% 2%;color:white;" type="submit" onclick="dangky()" value="Lưu" id="btnSaveThongTin">
        
    </form>
    <br>

    
</div>
<?php
require_once("../footer.php");    
?>
</body>
<script>
     function dangky()
    {
       
        var password=document.getElementById("password").value;
        var newpassword=document.getElementById("newpassword").value;
        if (password.trim().length <6) 
        {
            alert("Mật khẩu phải có ít nhất 6 ký tự");
            document.getElementById("kqInput").value = "0"; // Cập nhật giá trị của kqInput
            return false;
        }
        var passhientai=document.getElementById("passhientai").value;
        if(password.trim() != passhientai.trim())
        {
            alert("Mật khẩu không đúng");
            document.getElementById("kqInput").value = "0"; // Cập nhật giá trị của kqInput
            return false;
        }
        if (newpassword.trim().length <6) 
        {
            alert("Mật khẩu phải có ít nhất 6 ký tự");
            document.getElementById("kqInput").value = "0"; // Cập nhật giá trị của kqInput
            return false;
        }
        var hasLetter = /[a-zA-Z]/.test(password);
        var hasNumber = /\d/.test(password);
        
        if (!hasLetter || !hasNumber) {
            alert("Mật khẩu phải chứa cả ký tự chữ và số");
            document.getElementById("kqInput").value = "0"; // Cập nhật giá trị của kqInput
            return false;
        }

        //confirm password phải trùng với password
        var confirmpassword=document.getElementById("confirmpassword").value
        if (confirmpassword.trim() != newpassword.trim()) 
        {
            alert("Mật khẩu phải trùng với mật khẩu xác nhận");
            document.getElementById("kqInput").value = "0"; // Cập nhật giá trị của kqInput
            return false;
        }
        
            document.getElementById("kqInput").value = "1"; // Cập nhật giá trị của kqInput
            return true;

    }

    function suathongtin()
    {
        var email = document.getElementById("email").value;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!emailRegex.test(email))
        {
            alert("Email không đúng định dạng");
            
            document.getElementById("kqSuaTT").value = "0"; // Cập nhật giá trị của kqInput
            return false;
        }

        //địa chỉ phải có ít nhất 10 ký tự
        var diachi=document.getElementById("diachi").value;
        if (diachi.trim().length <10) 
        {
            alert("Địa chỉ phải có ít nhất 10 ký tự");
            document.getElementById("kqSuaTT").value = "0"; // Cập nhật giá trị của kqInput
            return false;
        }

        //bắt đầu = số 0 kèm theo đó là 9 chữ số khác
        var sdt = document.getElementById("sdt").value;
        var sdtRegres= /^0\d{9}$/;
        if (sdt == "") 
        {
        alert("Số điện thoại  không được rỗng");
        
        document.getElementById("kqSuaTT").value = "0"; // Cập nhật giá trị của kqInput
            return false;
        }
        if(!sdtRegres.test(sdt))
        {
            alert("Số diện thoại không đúng định dạng");
           
            document.getElementById("kqSuaTT").value = "0"; // Cập nhật giá trị của kqInput
            return false;
        }
            document.getElementById("kqSuaTT").value = "1";
            return true; // Cập nhật giá trị của kqInput

    }

    $(document).ready(function () {
$("#formThongTinNguoiDung").submit(function(event) {
      event.preventDefault();
      $.ajax({
        url: "ttcnController.php?action=sua", // Thay thế bằng URL đăng ký thực tế
        method: "POST",
        data: $(this).serialize(),
        // dataType: 'json',
        success: function(response) {
            var jsonResponse = JSON.parse(response);
            console.log(jsonResponse);  
            if (jsonResponse.status==1) {
            alert("Sửa thông tin thành công!");
            window.location.href = "sanpham.php";
            // Chuyển hướng đến trang chủ hoặc trang hồ sơ người dùng
          } if(jsonResponse.status==0) alert("Sửa thông tin thất bại!");
          
        },
        error: function(xhr, status, error){
            alert("loi: ");
        }
      });
    });
    $("#formThongTinPassWord").submit(function(event) {
          event.preventDefault();
          $.ajax({
            url: "ttcnController.php?action=suapass", // Thay thế bằng URL đăng ký thực tế
            method: "POST",
            data: $(this).serialize(),
            // dataType: 'json',
            success: function(response) {
                try {
                var jsonResponse = JSON.parse(response);
                if (jsonResponse.status==1) {
                    alert("Sửa mật khẩu thành công!");
                    window.location.href = "sanpham.php";
            // Chuyển hướng đến trang chủ hoặc trang hồ sơ người dùng
          }     if(jsonResponse.status==0) alert("Sửa mật khẩu thất bại!");
        }
          catch (e) {
                console.error("Parsing error:", e);
                console.log("Response received: ", response);
            }
              
            },
            error: function(xhr, status, error){
                alert("loi: ");
            }
          });
        });
})

</script>

</html>
