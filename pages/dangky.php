<meta charset="UTF-8">


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đồ gia dụng</title>
    <link rel="stylesheet" href="../css/trangchu.css">
    <!-- <script src="js/dangnhap.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div id="dangky">
    
    <form id="formDangky" method="POST"  action="dangky.php?chon=xulydangky&action=dangky">
    <h3 class="title_dangnhap">ĐĂNG KÝ TÀI KHOẢN</h3>
        <!-- <label for="username">Mã khách hàng: </label>
        <input type="text" id="makh" name="txtMakh"> -->
        <label for="makh">Tên đăng nhập: </label>
        <input type="text" id="username" name="txtUsername">
        <label for="password">Mật khẩu: </label>
        <input type="password" id="password" name="txtPassword">
        <label for="confirmpassword">Nhập lại mật khẩu: </label>
        <input type="password" id="confirmpassword" name="txtConfirmpassword">
        <label for="email">Email: </label>
        <input type="email" id="email" name="txtEmail">
        <label for="diachi">Địa chỉ: </label>
        <input type="text" id="diachi" name="txtDiachi">
        <label for="sdt">Số điện thoại: </label>
        <input type="tel" id="sdt" name="txtSdt">

        <input type="hidden" name="ketqua" id="kqInput" value="">
        <input type="submit" onclick="dangky()" value="Đăng ký" id="btnDangky">
        <a href="http://localhost/WebBanDoAn/index.php"> <input type="button" value="Hủy" id="btnHuy"></a>
    </form>
    
</div>

</body>

<script>
    function dangky()
    {
            // var makh=document.getElementById("makh").value;
            // var makhRegrex= /^KH\d{5}$/;

            // if(!makhRegrex.test(makh))
            // {
            //     alert("Mã khách hàng không đúng định dạng");
            //     makh.focus()
            //     document.getElementById("kqInput").value = "0"; // Cập nhật giá trị của kqInput
            //         return false;
            // }
        
        var username = document.getElementById("username").value;
        var tenRegrex = /^[a-zA-Z0-9]{6,}$/
        //ít nhất 6 ký tự
        if (username == "") 
        {
        alert("Tên đăng nhập không được rỗng");
        username.focus()
        document.getElementById("kqInput").value = "0"; // Cập nhật giá trị của kqInput
            return false;
        }
        if(!tenRegrex.test(username))
        {
            alert("Tên đăng nhập không đúng định dạng");
            username.focus()
            document.getElementById("kqInput").value = "0"; // Cập nhật giá trị của kqInput
            return false;
        }

        //mật khẩu ít nhất 6 ký tự, có cả chữ và số
        var password=document.getElementById("password").value
        if (password.trim().length <6) 
        {
            alert("Mật khẩu phải có ít nhất 6 ký tự");
            password.focus()
            document.getElementById("kqInput").value = "0"; // Cập nhật giá trị của kqInput
            return false;
        }
        var hasLetter = /[a-zA-Z]/.test(password);
        var hasNumber = /\d/.test(password);
        
        if (!hasLetter || !hasNumber) {
            alert("Mật khẩu phải chứa cả ký tự chữ và số");
            password.focus();
            document.getElementById("kqInput").value = "0"; // Cập nhật giá trị của kqInput
            return false;
        }

        //confirm password phải trùng với password
        var confirmpassword=document.getElementById("confirmpassword").value
        if (confirmpassword.trim() != password) 
        {
            alert("Mật khẩu phải trùng với mật khẩu xác nhận");
            confirmpassword.focus()
            document.getElementById("kqInput").value = "0"; // Cập nhật giá trị của kqInput
            return false;
        }
        
        // bao gồm một phần tên người dùng, ký tự @, tên miền và domain
        var email = document.getElementById("email").value;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!emailRegex.test(email))
        {
            alert("Email không đúng định dạng");
            email.focus()
            document.getElementById("kqInput").value = "0"; // Cập nhật giá trị của kqInput
            return false;
        }

        //địa chỉ phải có ít nhất 10 ký tự
        var diachi=document.getElementById("diachi").value
        if (diachi.trim().length <10) 
        {
            alert("Địa chỉ phải có ít nhất 10 ký tự");
            diachi.focus()
            document.getElementById("kqInput").value = "0"; // Cập nhật giá trị của kqInput
            return false;
        }

        //bắt đầu = số 0 kèm theo đó là 9 chữ số khác
        var sdt = document.getElementById("sdt").value;
        var sdtRegres= /^0\d{9}$/
        if (sdt == "") {
        alert("Số điện thoại  không được rỗng");
        sdt.focus()
        document.getElementById("kqInput").value = "0"; // Cập nhật giá trị của kqInput
            return false;
        }
        if(!sdtRegres.test(sdt))
        {
            alert("Số diện thoại không đúng định dạng");
            sdt.focus()
            document.getElementById("kqInput").value = "0"; // Cập nhật giá trị của kqInput
            return false;
        }

        else
        {
            document.getElementById("kqInput").value = "1"; // Cập nhật giá trị của kqInput
            // alert("đăng ký thành công");
        
            // clearInputs();
        }

    }

    //clear các input người dùng nhập
    function clearInputs() 
    {
        var inputs = document.querySelectorAll('input[type="text"]');
        inputs.forEach(function(input) 
        {
            input.value = '';
        });
    }

// header('Content-Type: application/json');
$(document).ready(function () {
$("#formDangky").submit(function(event) {
      event.preventDefault();
      $.ajax({
        url: "ajax.php?chon=xulydangky&action=dangky", // Thay thế bằng URL đăng ký thực tế
        method: "POST",
        data: $(this).serialize(),
        // dataType: 'json',
        success: function(response) {
            console.log(response)
            var jsonResponse = JSON.parse(response);
            //chuyển đổi chuỗi JSON nhận được từ máy chủ thành một đối tượng JavaScript
            if (jsonResponse.status == 1) {
              alert("Đăng ký thành công!");
            window.location.href = "http://localhost/WebBanDoAn/pages/dangnhap.php";
            // Chuyển hướng đến trang chủ hoặc trang hồ sơ người dùng
          } else {
            alert(jsonResponse.message);
          }
        },
        error: function(xhr, status, error){
            alert("loi: "+error)
        }
      });
    });
})
</script>
</html>