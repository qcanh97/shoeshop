
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Đăng Nhập Admin</title>	
  <!-- Import Bootstrap and JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
  </script>
  <link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
  <script 
    src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js">    
  </script>            
  <!-- My CSS and JQuery -->
  <link href="../css/stylelogin.css" rel="stylesheet">
  <script type="text/javascript" src="../jquery/index.js"></script> 
</head>
    <body>
        <?php
        session_start();
        include './connect_db.php';
        $error = false;
        if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $result = mysqli_query($con, "SELECT * FROM `taikhoan` WHERE (`TenDangNhap` ='" . $_POST['username'] . "' AND `MatKhau` = '" . $_POST['password'] . "' AND `MaLoaiTaiKhoan` =2)");
            if (!$result) {
                $error = mysqli_error($con);
            } else {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['current_user'] = $user;
                
            }
            mysqli_close($con);
            if ($error !== false || $result->num_rows == 0) {
                ?>
                <div class="container">
                    <div id="login-notify" class="box-content">
                        <h1>Thông báo</h1>
                        <h4><?= !empty($error) ? $error : "Thông tin đăng nhập không chính xác" ?></h4>
                        <a href="./index.php">Quay lại</a>
                    </div>
                </div>               
                <?php
                exit;
            }
            ?>
        <?php } ?>
        <?php if (empty($_SESSION['current_user'])) { ?>
            <div class="container-fluid bg">
                <div class="row justify-content-center">
                    <div class="col-md-3 col-sm-6 col-xs-12 row-container">
                        <form action="./index.php" method="Post" autocomplete="off">
                        <h1>Đăng Nhập Admin</h1>
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
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Nhớ Mật Khẩu</label>
                            
                        </div>   
                        <button type="submit" class="btn btn-success btn-block my-3">Đăng Nhập</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        } else {
            $currentUser = $_SESSION['current_user'];
            ?>
            <!-- <div id="login-notify" class="box-content">
                Xin chào <?= $currentUser['TenDangNhap'] ?><br/>
                <a href="./product_listing.php">Quản lý sản phẩm</a><br/>
                <a href="./edit.php">Đổi mật khẩu</a><br/>
                <a href="./logout.php">Đăng xuất</a> 
            -->
            <?php header("Location: ./product_listing.php");?>
            </div>
        <?php } ?>
    </body>
</html>