function thanhtoan()
    {
        var ten=document.getElementById("ten").value;
        if(ten == "")
        {
            alert("Tên người nhận không được rỗng");
            document.getElementById("kqThanhtoan").value = "0";
            return false;
        }

        if(ten.trim().length <2)
        {
            alert("Tên người nhận phải có ít nhất 2 kí tự");
            document.getElementById("kqThanhtoan").value = "0";
            return false;
        }

        var sdt=document.getElementById("so_dien_thoai").value;
        var sdtRegres= /^0\d{9}$/

        if(!sdtRegres.test(sdt))
        {
            alert("Số điện thoại không hợp lệ");
            document.getElementById("kqThanhtoan").value = "0";
            return false;
        }
        var tinh=document.getElementById("tinh").value;
        if(tinh == "")
        {
            alert("Tỉnh không được để trống");
            document.getElementById("kqThanhtoan").value = "0";
            return false;
        }
        var quan=document.getElementById("quan").value;
        if(quan == "")
        {
            alert("Quận không được để trống");
            document.getElementById("kqThanhtoan").value = "0";
            return false;
        }
        var phuong=document.getElementById("phuong").value;
        if(phuong == "")
        {
            alert("Phường không được để trống");
            document.getElementById("kqThanhtoan").value = "0";
            return false;
        }
        var dia_chi=document.getElementById("dia_chi").value;
        if(dia_chi == "")
        {
            alert("Địa chỉ không được để trống");
            document.getElementById("kqThanhtoan").value = "0";
            return false;
        }
        document.getElementById("kqThanhtoan").value = "1";
            return true;

    }

    function checkAddform()
    {
        var username = document.getElementById("hoten").value;
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
        }

    }
