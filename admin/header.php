<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>AloneShop-trang quản trị (admin)</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Import Bootstrap and JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
        </script>
        <link rel="stylesheet" 
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
        <script 
            src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js">    
        </script>            
        <!-- My CSS and JQuery -->
        <link rel="stylesheet" type="text/css" href="../css/admin_style.css" >
        <script src="../ckeditor/ckeditor.js"></script>
        <script src="../jquery/index.js"></script>
    </head>
    <body>
        <?php
        session_start();
        include './connect_db.php';
        include './function.php';
        if (!empty($_SESSION['current_user'])) { //Kiểm tra xem đã đăng nhập chưa?
        ?>
        <div class="container-fluid">
            <div id="admin-heading-panel">
                <div class="container">
                    <div class="left-panel">
                        Xin chào <span>Admin</span>
                    </div>
                    <div class="right-panel">
                        <img height="24" src="../images/home.png" />
                        <a target="_blank" href="../client/index.php">Trang chủ</a>
                        <img height="24" src="../images/logout.png" />
                        <a href="logout.php">Đăng xuất</a>
                    </div>
                </div>
            </div>
            <div id="content-wrapper">
                <div class="container">
                    <div class="left-menu">
                        <div class="menu-heading">Admin Menu</div>
                            <div class="menu-items">
                                <ul>
                                    <li><a href="product_listing.php">Sản phẩm</a></li>
                                    <li><a href="typeproduct.php">Loại Sản Phẩm</a></li>
                                    <li><a href="makerptoduct.php">Nhà sản xuất</a></li>
                                    <li><a href="users.php">Tài khoản người dùng</a></li>
                                    <li><a href="order.php">Đơn hàng</a></li>                               
                                    <li><a href="#">Thêm Quản Lý</a></li>
                                    <li><a href="#">Đổi Mật Khẩu</a></li>
                                    <li><a href="logout.php">Đăng Xuất</a></li>
                                </ul>
                            </div>
                        </div>
        <?php } ?>