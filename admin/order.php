<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    if(isset($_GET['action']) && $_GET['action']=='search' && !empty($_POST['search'])){
        $totalRecords = mysqli_query($con, "SELECT * FROM `dondathang`,`taikhoan`,`tinhtrang` where `dondathang`.`MaTinhTrang`=`tinhtrang`.`MaTinhTrang` AND `dondathang`.`MaTaiKhoan`=`taikhoan`.`MaTaiKhoan` AND (`MaDonDatHang` like '%".$_POST['search']."%' OR `taikhoan`.`TenHienThi` like '%".$_POST['search']."%')" );
    }
    else {
        $totalRecords = mysqli_query($con, "SELECT * FROM `dondathang`,`taikhoan`,`tinhtrang` WHERE `dondathang`.`MaTinhTrang`=`tinhtrang`.`MaTinhTrang` AND `dondathang`.`MaTaiKhoan`=`taikhoan`.`MaTaiKhoan`");
    } 
      
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);    
    
    if(isset($_GET['action']) && $_GET['action']=='search' && !empty($_POST['search'])){
        $products = mysqli_query($con, "SELECT * FROM `dondathang`,`taikhoan`,`tinhtrang` where `dondathang`.`MaTinhTrang`=`tinhtrang`.`MaTinhTrang` AND `dondathang`.`MaTaiKhoan`=`taikhoan`.`MaTaiKhoan` AND (`MaDonDatHang` like '%".$_POST['search']."%' OR `taikhoan`.`TenHienThi` like '%".$_POST['search']."%') ORDER BY `dondathang`.`MaDonDatHang` DESC LIMIT " . $item_per_page . " OFFSET " . $offset );
    }
    else {
        $products = mysqli_query($con, "SELECT * FROM `dondathang`,`taikhoan`,`tinhtrang` WHERE `dondathang`.`MaTinhTrang`=`tinhtrang`.`MaTinhTrang` AND `dondathang`.`MaTaiKhoan`=`taikhoan`.`MaTaiKhoan` ORDER BY `dondathang`.`MaDonDatHang` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
   
    ?>
    <div class="main-content">
        <h1>Danh sách Đơn Hàng</h1>
        
        <?php
            if (isset($_GET['action']) && $_GET['action']=='cancel' && !empty($_GET['id'])) { 
                $product1 = mysqli_query($con, "SELECT * FROM `dondathang` Where `dondathang`.`MaDonDatHang` = '". $_GET['id']."';")->fetch_assoc();
                
                if(!empty($product1)){     
                        $result = mysqli_query($con, "UPDATE `dondathang` SET `MaTinhTrang` = '5' WHERE `dondathang`.`MaDonDatHang` = '". $_GET['id']."';"); 
                }
               
                if (!empty($result)&&!$result) {
                    $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                }
                else {?>
                    <div class = "container">
                    <div class = "error"><p style="text-align: center;"> "Huỷ thành công, tải lại sau 3s" </p></div> 
                    <p style="text-align: center;"> <a href = "order.php">Ấn Để Tải lại Quản Lý Tài Khoản</a>   </p>
                    <?php header("refresh: 3; url = order.php") ?>
                    </div>
               <?php }
            }
            
        ?>
        <form id="form-search" action="?action=search" method="post" enctype="multipart/form-data">
            <input type="text" name="search" id="" value="" placeholder="Nhập nội dung">
            <input type="submit" value="Tìm Kiếm">  
        </form>
        <div class="clear-both"></div>
        <div class="product-items">
            
            <ul>
                <li class="product-item-heading">  
                    <div class="product-prop product-users" >Mã Đơn Hàng</div>

                    <div class="product-prop product-users" >Tên Khách Hàng</div>
                    
                    <div class="product-prop product-users" >Ngày Lập</div>
                    
                    <div class="product-prop product-users" >Tổng Tiền</div>
                    <div class="product-prop product-users" >Trạng Thái</div>
                    <div class="product-prop product-button">
                        Huỷ
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
                        
                        <div class="product-prop product-users"><?= $row['MaDonDatHang'] ?></div>
                        <div class="product-prop product-users"><?= $row['TenHienThi'] ?></div>
                        
                        <div class="product-prop product-users"><?= $row['NgayLap'] ?></div>
                        
                        <div class="product-prop product-users"><?= $row['TongThanhTien'] ?></div>
                        <div class="product-prop product-users"><?= $row['TenTinhTrang'] ?></div>
                        
                        <div class="product-prop product-button">
                            <a href="./order?action=cancel&id=<?= $row['MaDonDatHang']?>" >Huỷ</a>
                        </div>
                        <div class="product-prop product-button">
                            <a href="#">Sửa</a>
                        </div>
                        <div class="product-prop product-button">
                            <a href="./order_ detail?id=<?= $row['MaDonDatHang'] ?>">Xem</a>
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