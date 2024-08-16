<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/admin.css">
    <title>Quản lý người dùng</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/adminProduct.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

<div class="product_view">
<div class="product_view_container">
    <h2>QUẢN LÝ NGƯỜI DÙNG</h2>
    <form action="index.php" method="GET" class="searchUser">
            Tìm kiếm theo: <select name="field" class="timkiem" id="timkiem">
                <option value="ma_nd">Mã người dùng</option>
                <option value="ten">Họ và tên</option>
                <option value="sdt">Số điện thoại</option>
                <option value="diachi">Địa chỉ</option>
                <option value="email">Email</option>
            </select>
            <input type="text" id="search" name="search" placeholder="Nhập user cần tìm kiếm">
            <button type="submit">Tìm kiếm</button>
    </form>
    <br>


    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Mã người dùng</th>
                <th>Họ tên</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ nhận hàng</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td ><?php echo $user['ma_nd']; ?></td>
                    <td><?php echo $user['ten']; ?></td>
                    <td ><?php echo $user['sdt']; ?></td>
                    <td><?php echo $user['diachi']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>

        

    </table>
</div>
</div>
</body>

</html>
