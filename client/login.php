<?php
include 'header.php';
include './connect_db.php';
        $error = false;
        if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $result = mysqli_query($con, "SELECT * FROM `taikhoan` WHERE (`TenDangNhap` ='" . $_POST['username'] . "' AND `MatKhau` = '" . $_POST['password'] . "' AND `MaLoaiTaiKhoan` =1 AND `BiXoa`=0)");
            if (!$result) {
                $error = mysqli_error($con);
            } else {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['user'] = $user;
                
            }
            mysqli_close($con);
            if ($error !== false || $result->num_rows == 0) {
                ?>
                <div class="container">
                    <div id="login-notify" class="box-content">
                        <br>
                        <br>
                        <h1>Thông báo</h1>
                        <h4><?= !empty($error) ? $error : "Thông tin đăng nhập không chính xác" ?></h4>
                        <a href="./index.php">Quay lại trang chủ</a>
                    </div>
                </div>               
                <?php
                exit;
            }
        } 
               
       if (empty($_SESSION['user'])) { ?>
        
	<div class="container-fluid">
        <span class="header-contact header-page clearfix">
           
        </span>
        <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
                    <form action="./login.php" method="Post" autocomplete="off">
                        <h1>Đăng Nhập </h1>
                        <div class="form-group">
                            <label for="text">Tên Tài Khoản</label>
                            <input type="text" class="form-control" id="text" name="username" placeholder="Tên Tài Khoản">
                            <!--<p class="emailError"></p>-->
                        </div>
                        <div class="form-group">
                            <label for="password" class="label">Mật Khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Mật Khẩu">            
                            <p class="passwordError"></p>
                        </div>
                          
                        <button type="submit" class="btn btn-success btn-block my-3">Đăng Nhập</button>
                    </form>
                </div>
        <div class="col-md-4"></div></div>
    </div>
    <?php
    } else  { 
         header("Location: ./index.php");
         } ?>
   
    </body>
</html>
   <!-- footer -->
   <?php
include 'footer.php';
?>