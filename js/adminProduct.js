$(document).ready(function () {
    // Tìm kiếm sản phẩm
    $('form.search-form').submit(function (event) {
        
            event.preventDefault();
            var keyword = $('#search').val();
            var field = $('#timkiem').val();
            $.ajax({
                url: 'index.php?action=searchProduct&search=' + keyword + '&field='+field,
                method: 'GET',
                success: function (data) {
                    $('table').html($(data).find('table').html());
                }
            });
        
    });
    $('form.searchCategory').submit(function (event) {
        event.preventDefault();
        var keyword = $('#search').val();
        $.ajax({
            url: 'index.php?action=searchCategory&search=' + keyword,
            method: 'GET',
            success: function (data) {
                $('table').html($(data).find('table').html());
            }
        });
    
    });
    //tìm kiếm đơn hàng
    $('form.timdonhang').submit(function (event) {
        event.preventDefault();

        var status = $('.trangthai:checked').val();
        var startdate = $('.startdate').val();
        var enddate = $('.enddate').val();
    
        var url = 'index.php?action=searchOrder' +
            '&status=' + status +
            '&startdate=' + startdate +
            '&enddate=' + enddate ;

        $.ajax({
            url: url,
            method: 'GET',
            success: function (data) {
                // Update the table content
                var newTableContent = $(data).find('#bangdonhang').html();
        // Tìm bảng trong trang hiện tại bằng ID
                var existingTable = $('#bangdonhang'); // Chỉ chọn bảng có ID này
        // Cập nhật nội dung bảng với dữ liệu mới
                existingTable.html(newTableContent);
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed:', error);
            }
        });
    
    });
    //Sắp xếp sản phẩm
    $('form.filter-sanpham').submit(function (event) {
        event.preventDefault();
        var field = $('#sapxep').val();
        $.ajax({
            url: 'index.php?action=filterProduct&filter=' + field,
            method: 'GET',
            success: function (data) {
                $('table').html($(data).find('table').html());
            }
        });
    
    });

    //Tìm kiếm phiếu nhập
    $('form.searchImport').submit(function (event) {
        event.preventDefault();
        var keyword = $('#search').val();
        var field = $('#timkiem').val();
        var startdate = $('.startdate').val(); // Lấy giá trị của startdate
        var enddate = $('.enddate').val(); // Lấy giá trị của enddate
        var giafrom = $('.giafrom').val(); 
        var giato = $('.giato').val(); 
        $.ajax({
            url: 'index.php?action=searchImport&search=' + keyword + '&field=' + field + '&startdate=' + startdate + '&enddate=' + enddate+ '&giafrom=' + giafrom+ '&giato=' + giato,
            method: 'GET',
            success: function (data) {
                $('table').html($(data).find('table').html());
            }
        });
    });

    //Sắp xếp phiếu nhập
    $('form.filter-phieunhap').submit(function (event) {
        event.preventDefault();
        var field = $('#sapxep').val();
        $.ajax({
            url: 'index.php?action=filterImport&filter=' + field,
            method: 'GET',
            success: function (data) {
                $('table').html($(data).find('table').html());
            }
        });
    
    });

    //Thêm tài khoản
    $("#form_addAccount").submit(function(event) {
        event.preventDefault();
        $.ajax({
        url: "index.php?action=addAccount", // Thay thế bằng URL đăng ký thực tế
        method: "POST",
        data: $(this).serialize(),
        // dataType: 'json',
        success: function(response) {
            var error = response.match(/thêm tài khoản thất bại/);
            var success = response.match(/thêm tài khoản thành công/);
            var trungma=response.match(/tên người dùng đã tồn tại/);
            //chuyển đổi chuỗi JSON nhận được từ máy chủ thành một đối tượng JavaScript
            if (success) {
                alert("Thêm tài khoản thành công!!!")
                window.location.href = "http://localhost/WebBanDoAn/admin/index.php?action=showAccountList";
            } 
            if(error) 
            alert("Thêm tài khoản thất bại!!!")
            if(trungma)alert("Tên người dùng bị trùng")
        },
        error: function(xhr, status, error){
            alert("loi: ");
        }
        });
    });
    //Tìm kiếm tài khoản
    $('form.searchAccount').submit(function (event) {
        event.preventDefault();

        var keyword = $('#search').val();
        var field = $('#timkiem').val();
        var startdate = $('.startdate').val();
        var enddate = $('.enddate').val();
    
        var url = 'index.php?action=searchAccount&search=' + keyword + '&field=' + field+ 
            '&startdate=' + startdate +
            '&enddate=' + enddate ;

        $.ajax({
            url: url,
            method: 'GET',
            success: function (data) {
                $('table').html($(data).find('table').html());
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed:', error);
            }
        });
    
    });
    //Tìm kiếm người dùng
    $('form.searchUser').submit(function (event) {
        
        event.preventDefault();
        var keyword = $('#search').val();
        var field = $('#timkiem').val();
        $.ajax({
            url: 'index.php?action=searchUser&search=' + keyword + '&field='+field,
            method: 'GET',
            success: function (data) {
                $('table').html($(data).find('table').html());
            }
        });
    
    });
    //Tìm kiếm nhà cung cấp
    $('form.searchSupplier').submit(function (event) {
        
        event.preventDefault();
        var keyword = $('#search').val();
        var field = $('#timkiem').val();
        $.ajax({
            url: 'index.php?action=searchSupplier&search=' + keyword + '&field='+field,
            method: 'GET',
            success: function (data) {
                $('table').html($(data).find('table').html());
            }
        });
    
    });
})

// confirm thao tác xóa sửa
function confirmDelete() {
    return confirm("Bạn có chắc chắn muốn thực hiện thao tác xóa không?");
}

function confirmUpdate() {
    return confirm("Bạn có chắc chắn muốn thực hiện thao tác cập nhật không?");
}

// form thêm
function showAddForm() {
    var formThem = document.getElementById("addProduct");
    formThem.style.display = 'block';
    // Hoặc thêm các hành động khác ở đây
}
function closeform(){
    const closeFormBtn = document.getElementById('closeForm');
    const myForm = document.getElementById('addProduct');
    console.log(closeFormBtn);
    console.log(myForm);
    myForm.style.display = 'none'; // Ẩn form
}

// form sửa sản phẩm
function showUpdateFormProduct(ma_sp,ten_sp,ma_loai,so_luong,don_gia,mo_ta,hinh) 
{
   
    var formSua = document.getElementById("updateProduct");
    var ma_sp_old = document.getElementById("ma_sp");
    var ten_sp_old = document.getElementById("ten_sp");
    var don_gia_old = document.getElementById("don_gia");
    var mo_ta_old = document.getElementById("mo_ta");

    var select_ma_loai = document.getElementById("the_loai2");
    var current_image = document.getElementById("current_image");
    formSua.style.display = 'block';
    ma_sp_old.value=ma_sp;
    ten_sp_old.value=ten_sp;
    current_image.src = '../img/' + hinh;
    don_gia_old.value=don_gia;
    mo_ta_old.value=mo_ta;

    // select_ma_loai.value = ma_loai;
    for (var i = 0; i < select_ma_loai.options.length; i++) {
        if (select_ma_loai.options[i].value === ma_loai) {
            select_ma_loai.options[i].selected = true;
            break;
        }
    }
}

function closeUpdateform()
{
    const closeFormBtn = document.getElementById('closeUpdateForm');
    const myForm = document.getElementById('updateProduct');
    myForm.style.display = 'none'; // Ẩn form
}

//sửa thể loại
function showUpdateFormCt(ma_loai,ten_loai)
{
    var formSua = document.getElementById("updateProduct");
    var ma_loai_old = document.getElementById("ma_loai");
    var ten_loai_old = document.getElementById("ten_loai");
    formSua.style.display = 'block';
    ma_loai_old.value=ma_loai;
    ten_loai_old.value=ten_loai;
}

//sửa chi tiết phiếu nhập
function showUpdateForm(ma_phieu,ma_sp,so_luong,don_gia,tentam) 
{
    var formThem = document.getElementById("updateImport");
    var inputTensp = document.getElementById("sanphamUpdate");
    var inputSL = document.getElementById("slUpdate");
    var inputDG = document.getElementById("dongiaUpdate");
    var inputMasp = document.getElementById("MaspUpdate");
    var inputSLcu = document.getElementById("slCu");
    var inputDGcu = document.getElementById("dongiaCu");
    formThem.style.display = 'block';
    inputSL.value = so_luong;
    inputDG.value = don_gia;
    inputTensp.value = tentam;
    inputMasp.value = ma_sp;
    inputSLcu.value = so_luong;
    inputDGcu.value = don_gia;
    
}

function closeUpdateformCTPN()
{
    const closeFormBtn = document.getElementById('closeUpdateForm');
    const myForm = document.getElementById('updateImport');
    myForm.style.display = 'none'; // Ẩn form
}

// form thêm tài khoản
function showAddFormAccount() {
    var formThem = document.getElementById("addAccount");
    formThem.style.display = 'block';
    // Hoặc thêm các hành động khác ở đây
}
function closeformAddAccount(){
    const closeFormBtn = document.getElementById('closeForm');
    const myForm = document.getElementById('addAccount');
    myForm.style.display = 'none'; // Ẩn form
}

//form sửa tài khoản
function closeUpdateformAccount()
{
    const closeFormBtn = document.getElementById('closeUpdateForm');
    const myForm = document.getElementById('updateAccount');
    myForm.style.display = 'none'; // Ẩn form
}

function showUpdateFormAccount(userduocchon,trang_thai,ma_quyen) 
{
    var formThem = document.getElementById("updateAccount");
    var inputUsername = document.getElementById("usernameUpdate");
    var radioHoatDong = document.getElementById("radioHoatDong");
    var radioDaKhoa = document.getElementById("radioDaKhoa");
    var selectQuyen = document.getElementById("quyensua");
    formThem.style.display = 'block';
    inputUsername.value = userduocchon;
    if (trang_thai === "on") {
        radioHoatDong.checked = true;
        radioDaKhoa.checked = false;
    } else {
        radioHoatDong.checked = false;
        radioDaKhoa.checked = true;
    }


    selectQuyen.value = ma_quyen;
    for (var i = 0; i < selectQuyen.options.length; i++) {
        if (selectQuyen.options[i].value === ma_quyen) {
            selectQuyen.options[i].selected = true;
            break;
        }
    }
    
}

//Thêm nhà cung cấp
function showAddFormSup() {
    var formThem = document.getElementById("addSupplier");
    formThem.style.display = 'block';
    // Hoặc thêm các hành động khác ở đây
}
function closeformAddSup(){
    const closeFormBtn = document.getElementById('closeForm');
    const myForm = document.getElementById('addSupplier');
    console.log(closeFormBtn);
    console.log(myForm);
    myForm.style.display = 'none'; // Ẩn form
}

//Sửa nhà cung cấp
function showUpdateFormSup(ma_ncc,ten_ncc,dia_chi,sdt,email) 
{
   
    var formSua = document.getElementById("updateSupplier");
    var ma_ncc_old = document.getElementById("ma_ncc");
    var ten_ncc_old = document.getElementById("ten_ncc");
    var diachi_old = document.getElementById("diachi");
    var sdt_old = document.getElementById("sdt");
    var email_old = document.getElementById("email");

    formSua.style.display = 'block';
    ma_ncc_old.value=ma_ncc;
    ten_ncc_old.value=ten_ncc;
    diachi_old.value = dia_chi;
    sdt_old.value=sdt;
    email_old.value=email;

}

function closeUpdateformSup()
{
    const closeFormBtn = document.getElementById('closeUpdateForm');
    const myForm = document.getElementById('updateSupplier');
    myForm.style.display = 'none'; // Ẩn form
}

// Phân quyền
function showAddFormPer() {
    var formThem = document.getElementById("addPermission");
    formThem.style.display = 'block';
    // Hoặc thêm các hành động khác ở đây
}
function closeformPer(){
    const closeFormBtn = document.getElementById('closeForm');
    const myForm = document.getElementById('addPermission');
    console.log(closeFormBtn);
    console.log(myForm);
    myForm.style.display = 'none'; // Ẩn form
}

function showUpdateFormPer(ma_quyen,ten_quyen) 
{
    if(ma_quyen=="1")
    {
        alert("Không thể sửa quyền admin")
        return;
    }
    var formSua = document.getElementById("updatePermission");
    var ma_quyen_old = document.getElementById("ma_quyen");
    var ten_quyen_old = document.getElementById("ten_quyen");

    formSua.style.display = 'block';
    ma_quyen_old.value=ma_quyen;
    ten_quyen_old.value=ten_quyen;
}

function closeUpdateformPer()
{
    const closeFormBtn = document.getElementById('closeUpdateForm');
    const myForm = document.getElementById('updatePermission');
    myForm.style.display = 'none'; // Ẩn form
}
