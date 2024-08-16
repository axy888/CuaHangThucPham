<?php
    $con=mysqli_connect("localhost","root","","sieuthi");
    mysqli_query($con,"SET NAMES 'utf8'");
?>
<div class="notification" id="notification">Thêm thành công</div>

    <div class="search-filter-container">
        <div class="search-container">
            <form action="" method="GET">
                <input type="text" name="search" placeholder="Tìm kiếm...">
                <button type="submit"><i class="fa-solid fa-search"></i></button>
            </form>
        </div>
        <div class="filter-container">
            <form action="" method="GET">
                <select name="sort_by">
                    <option value="">Sắp xếp theo</option>
                    <option value="name_asc">Tên A-Z</option>
                    <option value="name_desc">Tên Z-A</option>
                    <option value="price_asc">Giá thấp đến cao</option>
                    <option value="price_desc">Giá cao đến thấp</option>
                </select>
                <button type="submit">Lọc</button>
            </form>
        </div>
    </div> 
<div class="body_sp">
    <div class="left_side">
        <ul class="menu">
            <li><a href="sanpham.php">Tất cả</a></li>
            <?php
             $strSQL="SELECT * FROM theloai";
             $result= mysqli_query($con,$strSQL);
             while ($row =mysqli_fetch_array($result))
            {
                echo '<li><a href="sanpham.php?category_id='. $row["ma_loai"] . '"><div>'.$row["ten_loai"].'</div></a></li>';
            }
            
            ?>
        </ul>
    </div>
    <!-- Tìm kiếm(Search) -->
    
    
    <div class="mid_side">
   

    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Số sản phẩm mỗi trang
    $items_per_page = 9;

    // Lấy trang hiện tại từ URL, mặc định là trang 1
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $items_per_page;//nếu đang ở page2, offset=9(lấy từ sp 10 tới 17)
    $category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : '';

    // Lấy tổng số sản phẩm theo thể loại và tìm kiếm
    if ($category_id > 0) {
        $query_total = "SELECT COUNT(*) as total FROM sanpham WHERE ma_loai = $category_id";
        if (!empty($search)) {
            $search = mysqli_real_escape_string($con, $search);
            $query_total .= " AND ten_sp LIKE '%$search%'";
        }
    } else {
        $query_total = "SELECT COUNT(*) as total FROM sanpham";
        if (!empty($search)) {
            $search = mysqli_real_escape_string($con, $search);
            $query_total .= " WHERE ten_sp LIKE '%$search%'";
        }
    }

    $result_total = mysqli_query($con, $query_total);
    if ($result_total) {
        $row_total = mysqli_fetch_assoc($result_total);
        $total_items = $row_total['total'];
        $total_pages = ceil($total_items / $items_per_page);

        // Truy vấn để lấy sản phẩm cho trang hiện tại theo thể loại và tìm kiếm
        if ($category_id > 0) {
            $query = "SELECT * FROM sanpham WHERE ma_loai = $category_id";
            if (!empty($search)) {
                $query .= " AND ten_sp LIKE '%$search%'";
            }
            $query .= " LIMIT $offset, $items_per_page";//nếu đang ở page2, offset=9(lấy từ sp 10 tới 17)
        } else {
            $query = "SELECT * FROM sanpham";
            if (!empty($search)) {
                $query .= " WHERE ten_sp LIKE '%$search%'";
            }
             // Thêm điều kiện sắp xếp vào truy vấn
            switch ($sort_by) {
                case 'name_asc':
                    $query .= " ORDER BY ten_sp ASC";
                    break;
                case 'name_desc':
                    $query .= " ORDER BY ten_sp DESC";
                    break;
                case 'price_asc':
                    $query .= " ORDER BY don_gia ASC";
                    break;
                case 'price_desc':
                    $query .= " ORDER BY don_gia DESC";
                    break;
                default:
                    $query .= " ORDER BY ma_sp ASC"; // Mặc định sắp xếp theo ID
                    break;
            }
            $query .= " LIMIT $offset, $items_per_page";
        }

        $result = mysqli_query($con, $query);
        if ($result) {
            while ($row = mysqli_fetch_array($result)) {
                echo '<div class="san_pham">';
                echo '<a href="ct_sp.php?id=' . $row["ma_sp"] . '">';
                echo '<img src="../img/' . $row["hinh"] . '" alt="' . $row["ten_sp"] . '">';
                echo '<div>' . $row["ten_sp"] . '</div>';
                echo '<div class="price-container">';
                echo '<div>' . number_format($row["don_gia"], 0, ',', '.') . ' đ</div>';
                echo '<i class="fa-solid fa-plus add-to-cart" data-id="'.$row["ma_sp"].'"></i>';
                echo '</div>';
                echo '<input type="hidden" class="product-quantity" value="' . $row["so_luong"] . '">';
                echo '</a>';
                echo '</div>';
            }
        } 
    } 

   
        //    echo '</div>';
        //    Hiển thị phân trang
        echo '<div class="pagination">';
        if ($total_pages > 1) {
            //Nếu mã loại có tồn tại trên url thì khi chuyển page vẫn giữ, không thì chuỗi này rỗng
            $category_param = $category_id > 0 ? 'category_id=' . $category_id . '&' : '';
        
            if ($page > 1) {
                echo '<a href="?' . $category_param . 'page=1">&laquo;</a>';//mũi tên link tới page1
                echo '<a href="?' . $category_param . 'page=' . ($page - 1) . '">&lt;</a>';//mũi tên link tới page trước đó
            }
        
            for ($i = 1; $i <= $total_pages; $i++) {
                echo '<a ' . ($i == $page ? 'class="active"' : '') . ' href="?' . $category_param . 'page=' . $i . '">' . $i . '</a>';
            }
            
            //2 mũi tên link tới page kế tiếp và page cuối cùng
            if ($page < $total_pages) {
                echo '<a href="?' . $category_param . 'page=' . ($page + 1) . '">&gt;</a>';
                echo '<a href="?' . $category_param . 'page=' . $total_pages . '">&raquo;</a>';
            }
        }
        echo '</div>';
        
        
           
            ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
<script>
    $(document).ready(function() {
        //thêm giỏ hàng
        $('.add-to-cart').click(function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định
            var productId = $(this).data('id');
            var productQuantity = $(this).closest('.san_pham').find('.product-quantity').val();
            if (productQuantity <= 0) {
                showNotification('Sản phẩm tạm thời hết hàng, vui lòng quay lại sau', 'error');
                return; // Không tiếp tục thực hiện ajax request nếu hết hàng
            }
            $.ajax({
                url: '../add_to_cart.php',
                type: 'POST',
                data: { id: productId },
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
                    var cartItem = $('.cart-container').find('.cart-item[data-id="' + productId + '"]');
                    if (cartItem.length) {
                        // Nếu sản phẩm đã tồn tại, cập nhật sản phẩm
                        cartItem.replaceWith(jsonResponse.items);
                        showNotification('Thêm thành công','success');
                        $('.total_infor').html('<div>Tổng tiền: ' + jsonResponse.total + '</div>');
                        totalInfoContainer.show();
                    } 
                    else {
                        // Nếu sản phẩm chưa tồn tại, thêm sản phẩm vào giỏ hàng
                        $('.cart-container').append(jsonResponse.items);
                        showNotification('Thêm thành công','success');
                        
                        $('.total_infor').html('<div>Tổng tiền: ' + jsonResponse.total + '</div>');
                        totalInfoContainer.show();
                    }
                    
                }
            });
        });
        //xóa giỏ hàng
        $('.right_side').on('click', '.remove-from-cart', function() {
            var productId = $(this).data('id');
            $.ajax({
                url: '../remove_from_cart.php',
                type: 'POST',
                data: { id: productId },
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    if (jsonResponse.status=="success") {
                        $('.right_side').find('.cart-item[data-id="' + productId + '"]').remove();
                        $('.total_infor').html('<div>Tổng tiền: ' + jsonResponse.total + '</div>');
                    }else{
                        $('.right_side').append(response);
                    }
                   
                }
            });
        });

        //hiển thị giỏ hàng
            $('.right_side').on('click', 'i.fa-cart-shopping', function() {
            var cartContainer = $('.cart-container');
            var totalInfoContainer = $('.total_infor');
            var btnThanhToan = $('.btn_thanhtoan');
            if (cartContainer.is(':visible')) {
                cartContainer.hide(); 
                totalInfoContainer.hide();
                btnThanhToan.css('visibility', 'hidden');// Ẩn giỏ hàng nếu đang hiển thị
            } 
            else {
                $.ajax({
                    url: '../load_cart.php',
                    type: 'GET',
                    success: function(response) {
                        var jsonResponse = JSON.parse(response);
                        cartContainer.html(jsonResponse.items);  // Chèn nội dung giỏ hàng
                        totalInfoContainer.html('<div>Tổng tiền: ' + jsonResponse.total + 'đ'+'</div>');
                        cartContainer.show();  // Hiển thị giỏ hàng
                        if(jsonResponse.total != 0)
                        {
                            totalInfoContainer.show();
                            btnThanhToan.css('visibility', 'visible');
                        }
                    }
                });
            }
        });

        function showNotification(message,type) {
                var notification = $('#notification');
                if (type === 'error') {
                    notification.css('background-color', 'red');}
                    else
                    {
                        notification.css('background-color', '#4CAF50');
                    }
                notification.text(message);
                notification.fadeIn();
                setTimeout(function() {
                    notification.fadeOut();
                }, 2000);
            }

    });
    

</script>
    <div class="right_side">
        <i class="fa-solid fa-cart-shopping"></i>
        <div class="cart-container" style="display: none;">
       
        </div>
        <div class="total_infor" style="display: none;">
            
        </div>
    
<a href="<?php echo isset($_SESSION["nguoidung"]) ? 'thanhtoan.php' : 'dangnhap.php'; ?>" class="btn_thanhtoan">Thanh toán</a>

    </div>
</div>


