<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
              
    ?>
    <div class="main-content">
        <h1><?= !empty($_GET['id'])?"Sửa Tài Khoản":"Thêm Tài Khoản" ?></h1>
        <div id="content-box">
            <?php
            if (isset($_GET['action']) && ($_GET['action'] == 'add'||$_GET['action'] == 'edit') ) {
                
                if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['pass']) && !empty($_POST['pass'])) {
                   
                    
                    if (empty($_POST['name'])) {
                        $error = "Bạn phải nhập Tài Khoản";
                    } elseif (empty($_POST['pass'])) {
                        $error = "Bạn phải nhập Mật Khẩu";
                    } 
                    
                    
                    
                    if (!isset($error)) {
                                                                    
                        if ($_GET['action']=='edit' && !empty($_GET['id'])) { 
                            $result = mysqli_query($con, "UPDATE  `taikhoan` SET `TenDangNhap`='" . $_POST['name'] . "',`MatKhau`='" . $_POST['pass'] . "',`TenHienThi`='" . $_POST['nameshow'] . "',`DiaChi`='" . $_POST['address'] . "',`DienThoai`='" . $_POST['phone'] . "',`Email`='" . $_POST['email'] . "',`BiXoa`='" . $_POST['status'] . "',`MaLoaiTaiKhoan`='1' WHERE `MaTaiKhoan`='" . $_GET['id'] . "'");
                        }
                        else {  
                            
                            $result = mysqli_query($con, "INSERT INTO `taikhoan`(`MaTaiKhoan`, `TenDangNhap`, `MatKhau`, `TenHienThi`, `DiaChi`, `DienThoai`, `Email`, `BiXoa`, `MaLoaiTaiKhoan`) VALUES (NULL,'" . $_POST['name'] . "','" . $_POST['pass'] . "','" . $_POST['nameshow'] . "','" . $_POST['address'] . "','" . $_POST['phone'] . "','" . $_POST['email'] . "','" . $_POST['status'] . "','1');");                  
                        }
                        
                        if (!$result) {
                            $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                        }                      
                    }
                } else {
                    $error = "Bạn chưa nhập thông tin Tài Khoản.";
                }
            ?>
                <div class = "container">
                    <div class = "error"><?= isset($error) ? $error : "Cập nhật thành công" ?></div>
                    <a href = "users.php">Quay lại danh sách Tài Khoản</a>
                </div>
            <?php } else { 
                if(!empty($_GET['id'])){
                    $result=mysqli_query($con,"SELECT * FROM `taikhoan` WHERE `MaTaiKhoan` = ". $_GET['id']);
                    $product=$result->fetch_assoc();
                }               
            ?>
                <form id="product-form" method="POST" action="<?=!empty($product)?"?action=edit&id=".$_GET['id']:"?action=add"?>" enctype="multipart/form-data">
                    <input type="submit" title="Lưu sản phẩm" value="" />
                    <div class="clear-both"></div>
                    <div class="wrap-field">
                        <label>Tên Đăng Nhập: </label>
                        <input type="text" name="name" value="<?=!empty($product)?$product['TenDangNhap']:"" ?>"/>
                        <div class="clear-both"></div>
                    </div>

                    <div class="wrap-field">
                        <label>Mật Khẩu: </label>
                        <input type="password" name="pass" value="<?=!empty($product)?$product['MatKhau']:"" ?>"/>
                        <div class="clear-both"></div>
                    </div>
                    
                    <div class="wrap-field">
                        <label>Tên Hiển Thị: </label>
                        <input type="text" name="nameshow" value="<?=!empty($product)?$product['TenHienThi']:"" ?>"/>
                        <div class="clear-both"></div>
                    </div>

                    <div class="wrap-field">
                        <label>Địa Chỉ: </label>
                        <input type="text" name="address" value="<?=!empty($product)?$product['DiaChi']:"" ?>"/>
                        <div class="clear-both"></div>
                    </div>
                    <script language='javascript'> //kiểm tra số
                    function isNumberKey(evt)
                    {
                    var charCode = (evt.which) ? evt.which : event.keyCode
                    if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                    return true;
                    }                    
                    </script>
                    <div class="wrap-field">
                        <label>Số Điện Thoại: </label>
                        <input type="text" name="phone" onKeyPress="return isNumberKey(event)" value="<?=!empty($product)?$product['DienThoai']:'' ?>" />
                        <div class="clear-both"></div>
                    </div>
                    
                    <div class="wrap-field">
                        <label>Email: </label>
                        <input type="text" name="email" value="<?=!empty($product)?$product['Email']:"" ?>"/>
                        <div class="clear-both"></div>
                    </div>

                    <div class="wrap-field">
                        <label>Tình Trạng: </label>
                        <select name="status" id="" >
                        <option value="0" <?php if(!empty($product)) if (($product['BiXoa'])==0) echo "selected"?>>Hoạt Động</option>
                        <option value="1" <?php if(!empty($product)) if (($product['BiXoa'])==1) echo "selected"?>>Khoá</option>
                        </select>
                        <div class="clear-both"></div>
                    </div>
                    
                </form>
                <div class="clear-both"></div>
                
                <?php } ?>
        </div>
        
    </div>
    <div class="clear-both"></div>
</div>       
    <?php
}
include './footer.php';
?>