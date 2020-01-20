<?php
include 'header.php';
        
        
        unset($_SESSION['user']);
        ?>
         <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div id="user_logout" class="box-content">
                    <h1>Đăng xuất tài khoản thành công</h1>
                    <a href="./login.php">Đăng nhập lại</a>
                    <br>
                    <a href="./index.php">về trang chủ</a>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    <?php
include './footer.php';
?>