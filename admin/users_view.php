<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
      
?>
<div class="main-content">
        <h1>Chi Tiết Tài Khoản</h1>
        <div id="content-box">
            <?php if(!empty($_GET['id'])){
                    $result=mysqli_query($con,"SELECT * FROM `taikhoan` WHERE MaTaiKhoan = ". $_GET['id']);
                    $product=$result->fetch_assoc();
    
                }               
            ?>
            <form id="product-form" method="POST" action="" enctype="multipart/form-data">
                
                <div class="clear-both"></div>
                <div class="wrap-field">
                    <label style="width:900px">Tên Đăng Nhập: <?= $product['TenDangNhap']?> </label>
                    <div class="clear-both"></div>
                </div>
                    
                <div class="wrap-field">
                    <label style="width:900px">Tên Hiển Thị: <?= $product['TenHienThi']?> </label>
                    <div class="clear-both"></div>
                </div>

                <div class="wrap-field">
                    <label style="width:900px"> Mật Khẩu: <?= $product['MatKhau']?> </label>
                    <div class="clear-both"></div>
                </div>
                    
                <div class="wrap-field">
                    <label style="width:900px">Địa Chỉ: <?= $product['DiaChi']?> </label>
                    <div class="clear-both"></div>
                </div>

                <div class="wrap-field">
                    <label style="width:900px">Điên Thoại: <?= $product['DienThoai']?> </label>
                    <div class="clear-both"></div>
                </div>

                <div class="wrap-field">
                    <label style="width:900px">Email: <?= $product['Email']?> </label>
                    <div class="clear-both"></div>
                </div>

                <div class="wrap-field">
                    <label style="width:900px">Tình Trạng: <?= $product['BiXoa']==0?"Hoạt Động":"Khoá"?></label>
                    <div class="clear-both"></div>
                </div>

                       
            </form>            
            <div class="clear-both"></div>            
        </div>
    </div>
    <div class="clear-both"></div>
</div>
<div class="clear-both"></div>
</div>
</div>
<?php
}
include './footer.php';
?>