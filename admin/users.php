<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    if(isset($_GET['action']) && $_GET['action']=='search' && !empty($_POST['search'])){
        $totalRecords = mysqli_query($con, "SELECT * FROM `taikhoan` where `MaLoaiTaiKhoan`=1 AND (`TenDangNhap` like '%".$_POST['search']."%' OR `TenHienThi` like '%".$_POST['search']."%' OR `DienThoai` like '%".$_POST['search']."%' OR `Email` like '%".$_POST['search']."%')" );
    }
    else {
        $totalRecords = mysqli_query($con, "SELECT * FROM `taikhoan` Where `MaLoaiTaiKhoan`=1");
    } 
    
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if(isset($_GET['action']) && $_GET['action']=='search' && !empty($_POST['search'])){
        $products = mysqli_query($con, "SELECT * FROM `taikhoan` where `MaLoaiTaiKhoan`=1 AND (`TenDangNhap` like '%".$_POST['search']."%' OR `TenHienThi` like '%".$_POST['search']."%' OR `DienThoai` like '%".$_POST['search']."%' OR `Email` like '%".$_POST['search']."%') ORDER BY `MaTaiKhoan` DESC LIMIT " . $item_per_page . " OFFSET " . $offset );
    }
    else {
        $products = mysqli_query($con, "SELECT * FROM `taikhoan` Where `MaLoaiTaiKhoan`=1 ORDER BY `MaTaiKhoan` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
    
    
   
    ?>
    <div class="main-content">
        <h1>Danh sách Tài Khoản</h1>
        
        <?php
            if (isset($_GET['action']) && $_GET['action']=='lock' && !empty($_GET['id'])) { 
                $product1 = mysqli_query($con, "SELECT * FROM `taikhoan` Where `taikhoan`.`MaTaiKhoan` = ". $_GET['id'].";")->fetch_assoc();
                if(!empty($product1)){
                    if($product1['BiXoa']=='0')
                        $result = mysqli_query($con, "UPDATE `taikhoan` SET `BiXoa` = '1' WHERE `taikhoan`.`MaTaiKhoan` = ". $_GET['id'].";");
                    else {
                        $result = mysqli_query($con, "UPDATE `taikhoan` SET `BiXoa` = '0' WHERE `taikhoan`.`MaTaiKhoan` = ". $_GET['id'].";");
                    }
                }
               
                if (!empty($result)&&!$result) {
                    $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                }
                else {?>
                    <div class = "container">
                    <div class = "error"><p style="text-align: center;"><?= $product1['BiXoa']==0 ? "Khoá thành công, tải lại sau 3s" : "Mở Khoá thành công, tải lại sau 3s" ?></p></div> 
                    <p style="text-align: center;"> <a href = "users.php">Ấn Để Tải lại Quản Lý Tài Khoản</a>   </p>
                    <?php header("refresh: 3; url = users.php") ?>
                    </div>
               <?php }
            }
            
        ?>
        <form id="form-search" action="?action=search" method="post" enctype="multipart/form-data">
            <input type="text" name="search" id="" placeholder="Nhập nội dung">
            <input type="submit" value="Tìm Kiếm">  
        </form>
        
        <div class="product-items">
        <div class="clear-both"></div>
            <div class="buttons">
            </br>
                <a href="./users_editting.php">Thêm Tài Khoản</a>
            </div>
            <ul>
                <li class="product-item-heading">  
                    <div class="product-prop product-users" >Tên Đăng Nhập</div>

                    <div class="product-prop product-users" >Tên Hiện Thị</div>
                    
                    <div class="product-prop product-users" >Điện Thoại</div>
                    
                    <div class="product-prop product-users" >Email</div>
                    <div class="product-prop product-users" >Tình Trạng</div>
                    <div class="product-prop product-button">
                        Khoá
                    </div>
                    <div class="product-prop product-button">
                        Sửa
                    </div>
                    <div class="product-prop product-button">
                        Xem
                    </div>
                    
                    <div class="clear-both"></div>
                </li>
                <?php
                while ($row = mysqli_fetch_array($products)) {
                    ?>
                    <li>  
                        
                        <div class="product-prop product-users"><?= $row['TenDangNhap'] ?></div>
                        <div class="product-prop product-users"><?= $row['TenHienThi'] ?></div>
                        
                        <div class="product-prop product-users"><?= $row['DienThoai'] ?></div>
                        
                        <div class="product-prop product-users"><?= $row['Email'] ?></div>
                        <div class="product-prop product-users"><?= $row['BiXoa']==0?"Hoạt Động":"<span style='color: red;'>Khoá</span>" ?></div>
                        
                        <div class="product-prop product-button">
                            <a href="./users?action=lock&id=<?= $row['MaTaiKhoan']?>" ><?= $row['BiXoa']==0?"lock":"unlock"?></a>
                        </div>
                        <div class="product-prop product-button">
                            <a href="./users_editting?id=<?= $row['MaTaiKhoan'] ?>">Sửa</a>
                        </div>
                        <div class="product-prop product-button">
                            <a href="./users_view?id=<?= $row['MaTaiKhoan'] ?>">Xem</a>
                        </div>
                        <div class="clear-both"></div>
                    </li>
                <?php } ?>
            </ul>
            <?php
            include './pagination.php';
            ?>
            <div class="clear-both"></div>
        </div>
    </div>
    <div class="clear-both"></div>
    </div>
    </div>
    <?php
}
include './footer.php';
?>