<?php
    $con=mysqli_connect("localhost","root","","sieuthi");
    mysqli_query($con,"SET NAMES 'utf8'");
?>
<div class="notification" id="notification">Thêm thành công</div>

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
    <div class="mid_side_ct_sp">
            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if(isset($_GET['id']))
            {
                $productId =$_GET['id'];
                $query = "SELECT * FROM sanpham WHERE ma_sp = '$productId'";
                $result = mysqli_query($con, $query);
                $product = mysqli_fetch_array($result);
                // $item = $product;
                echo '<div class="ct_sp_item" data-id="' . $product["ma_sp"] . '">';
                echo '<img src="../img/' . $product["hinh"] . '" alt="' . $product["ten_sp"] . '">';
                echo '<div class="ct_sp_item2">';
                echo '<div>' . $product["ten_sp"] . '</div>';
                if($product["ma_loai"]>=1 && $product["ma_loai"]<=4)
                {
                    echo '<div style="color:orange">' .'Giá: '. $product["don_gia"] . 'đ/kg'.'</div>';
                }
                else 
                {
                    echo '<div style="color:orange">' .'Giá: '. $product["don_gia"] . 'đ'.'</div>';
                }
                echo '<div>' . $product["mo_ta"] . '</div>';
                echo '<input type="hidden" class="product-quantity" value="' . $product["so_luong"] . '">';
                echo '<div class="quantity-control">';
                echo '<span>Số lượng: </span>';
                echo '<button class="decrease-qty">-</button>';
                echo '<input type="number" id="quantity" name="quantity" value="1" min="1">';
                echo '<button class="increase-qty">+</button>';
                echo '</div>';
                echo '<button id="buy-now">Thêm vào giỏ hàng</button>';
                echo '</div>';
                echo '</div>';
            }
            ?>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    var decreaseQtyButton = document.querySelector('.decrease-qty');
    var increaseQtyButton = document.querySelector('.increase-qty');
    var quantityInput = document.getElementById('quantity');
    var buyNowButton = document.getElementById('buy-now');

    decreaseQtyButton.addEventListener('click', function() {
        var currentQty = parseInt(quantityInput.value);
        if (currentQty > 1) {
            quantityInput.value = currentQty - 1;
        }
    });

    increaseQtyButton.addEventListener('click', function() {
        var currentQty = parseInt(quantityInput.value);
        quantityInput.value = currentQty + 1;
    });

    buyNowButton.addEventListener('click', function() {
        var productId = document.querySelector('.ct_sp_item').getAttribute('data-id');
        var quantity = quantityInput.value;
        var productElement = $(this).closest('.ct_sp_item');
        // Assuming you have a function addToCart to handle adding the product to the cart
        addToCart(productId, quantity,productElement);
    });

    function addToCart(productId, quantity,productElement) {
        var productQuantity = productElement.find('.product-quantity').val();
        console.log(productQuantity);
            if (productQuantity <= 0) {
                showNotification('Sản phẩm tạm thời hết hàng, vui lòng quay lại sau', 'error');
                return; // Không tiếp tục thực hiện ajax request nếu hết hàng
            }
        $.ajax({
            url: '../add_to_cart.php',
            type: 'POST',
            data: { id: productId, quantity: quantity },
            success: function(response) {
                var jsonResponse = JSON.parse(response);
                var cartItem = $('.cart-container').find('.cart-item[data-id="' + productId + '"]');
                if (cartItem.length) {
                    cartItem.replaceWith(jsonResponse.items);
                    showNotification('Thêm thành công','success');
                    $('.total_infor').html('<div>Tổng tiền: ' + jsonResponse.total + '</div>');
                    totalInfoContainer.show();
                    
                } 
                else {
                    $('.cart-container').append(jsonResponse.items);
                    showNotification('Thêm thành công','success');
                    $('.total_infor').html('<div>Tổng tiền: ' + jsonResponse.total + '</div>');
                    totalInfoContainer.show();
                    
                }
            }
        });
    }
    function showNotification(message,type) {
                var notification = $('#notification');
                notification.text(message);
                if (type === 'error') {
                    notification.css('background-color', 'red');
                }
                    else
                    {
                        notification.css('background-color', '#4CAF50');
                    }
                notification.fadeIn();
                setTimeout(function() {
                    notification.fadeOut();
                }, 2000);
            }
});
    $(document).ready(function() {
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

        

    });
    

    let currentIndex = 0;
    const productsToShow = 5;

    function slide(direction) {
        const content = document.querySelector('.sp_lienquan_content');
        const products = document.querySelectorAll('.san_pham_lien_quan');
        const totalProducts = products.length;
        
        if (direction === 1 && currentIndex < totalProducts - productsToShow) {
            currentIndex++;
        } else if (direction === -1 && currentIndex > 0) {
            currentIndex--;
        }

        const moveDistance = currentIndex * (250); // Di chuyển khoảng cách của một sản phẩm
        content.style.transform = `translateX(-${moveDistance}px)`;
    }


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

    <div class="sp_lienquan">
        <h2>Sản phẩm liên quan:</h2>
        <div class="carousel-container">
            <button class="carousel-arrow prev-arrow" onclick="slide(-1)">&#10094;</button>
            <div class="sp_lienquan_content">
                <?php
                    $productId=($_GET['id']);
                    $query1 = "SELECT ma_loai FROM sanpham WHERE ma_sp = '$productId'";
                    $result1=mysqli_query($con, $query1);
                    $row1 = mysqli_fetch_assoc($result1);
                    $ma_loai = $row1['ma_loai'];
                    $query="SELECT * FROM sanpham WHERE ma_loai ='$ma_loai'";
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<div class="san_pham_lien_quan">';
                            echo '<a href="ct_sp.php?id=' . $row["ma_sp"] . '">';
                            echo '<img src="../img/' . $row["hinh"] . '" alt="' . $row["ten_sp"] . '">';
                            echo '<div>' . $row["ten_sp"] . '</div>';
                            echo '<div class="price-container">';
                            echo '<div style="color:green">' . number_format($row["don_gia"], 0, ',', '.') . ' đ</div>';
                            echo '<i class="fa-solid fa-plus add-to-cart" data-id="'.$row["ma_sp"].'"></i>';
                            echo '</div>';
                            echo '<input type="hidden" class="product-quantity" value="' . $row["so_luong"] . '">';
                            echo '</a>';
                            echo '</div>';
                        }
                    }
                ?>
            </div>
            <button class="carousel-arrow next-arrow" onclick="slide(1)">&#10095;</button>
        </div>
    </div>

