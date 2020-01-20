<?php
include 'header.php';
include './connect_db.php';
if (isset($_GET['action']) && ($_GET['action'] == 'add')){
    $sql="INSERT INTO `taikhoan`(`MaTaiKhoan`, `TenDangNhap`, `MatKhau`, `TenHienThi`, `DiaChi`, `DienThoai`, `Email`, `BiXoa`, `MaLoaiTaiKhoan`) VALUES (NULL,'". $_POST['tendangnhap'] ."','". $_POST['matkhau'] ."','". $_POST['hovaten'] ."','". $_POST['diachi'] ."','". $_POST['sdt'] ."','". $_POST['email'] ."',0,1)";    
    $result = mysqli_query($con,$sql);   
    if (!$result) {
        $error = "Có lỗi xảy ra trong quá trình thực hiện.";
    }?>
    <div class = "container">
        <div class = "error"><?= isset($error) ? $error : "Đăng ký thành công" ?></div>
         <a href = "index.php">Quay lại trang chủ</a>
    </div>
<?php }//het if
?>
            
            
	<div class="container-fluid">
        <span class="header-contact header-page clearfix">
           
        </span>
        <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
                <form accept-charset='UTF-8' action='?action=add' id='' method='post'>
                    <input name='form_type' type='hidden' value='create_customer'>
                    <input name='utf8' type='hidden' value='✓'>
                    <h1>Tạo tài khoản</h1>
                        
                    
                    <div class="form-group">
                            
                            <input required type="text" value="" name="hovaten" placeholder="Họ và Tên" id="first_name" class="text" size="30" />
                        </div>
                        <div class="form-group">
                            
                            <input required type="text" value="" placeholder="Số điện thoại" name="sdt" id="Số Điện Thoại" class="Số Điện Thoại text" size="30" />
                        </div>
                        
                        <div class="form-group">
                            
                            <input required type="text" value="" placeholder="Địa chỉ của bạn" name="diachi" id="Địa chỉ" class="Địa chỉ text" size="30" />
                        </div>
                        <div class="form-group">
                            
                            <input required type="text" value="" placeholder="Email" name="email" id="email" class="text" size="30" />
                        </div>
                        <div class="form-group">
                            
                            <input required type="text" value="" placeholder="Tên đăng nhập" name="tendangnhap" id="Tên đăng nhập" class="Tên đăng nhập text" size="30" />
                        </div>
                        <div class="form-group">
                            
                            <input required type="password" value="" placeholder="Mật khẩu" name="matkhau" id="password" class="password text" size="30" />
                        </div>
                        <div class="form-group">
                            <input class="btn" type="submit" value="Đăng ký" />			
                        </div>
                        <div class="form-group">
                            <a class="come-back" href="index.php">Quay lại trang chủ</a>
                        </div>
                        <div class="form-group">
                            <a class="come-back" href="dangnhap.html">Đăng Nhập Ngay</a>
                        </div>
                    </form>
                </div>
        <div class="col-md-4"></div></div>
    </div>

   <!-- footer -->
   <?php
include 'footer.php';
?>