<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
      
?>
<div class="main-content">
        <h1>Chi Tiết Hoá Đơn</h1>
        <div id="content-box">
            <?php if(!empty($_GET['id'])){
                    $result=mysqli_query($con,"SELECT * FROM `dondathang` ,`taikhoan`,`tinhtrang` WHERE `dondathang`.`MaTinhTrang`=`tinhtrang`.`MaTinhTrang` AND `dondathang`.`MaTaiKhoan`=`taikhoan`.`MaTaiKhoan` AND `dondathang`.`MaDonDatHang`='".$_GET['id']."'");  
                    $info=$result->fetch_assoc();
                    $products=mysqli_query($con, "SELECT * FROM `chitietdondathang`,`sanpham`,`loaisanpham`,`hangsanxuat` WHERE `chitietdondathang`.`MaSanPham`=`sanpham`.`MaSanPham` AND `sanpham`.`MaLoaiSanPham`=`loaisanpham`.`MaLoaiSanPham` AND `sanpham`.`MaHangSanXuat`=`hangsanxuat`.`MaHangSanXuat` AND `chitietdondathang`.`MaDonDatHang`='".$_GET['id']."'");
                    
                }               
            ?>
            <form id="product-form" method="POST" action="" enctype="multipart/form-data">
                <!-- don hang -->
                <div class="clear-both"></div>
                <div class="wrap-field">
                    <h3>Thông Tin Phiếu</h3>
                    <div class="clear-both"></div>
                </div>
                <div class="product-items">
                    <div class="wrap-field">
                        <label style="width:900px">Mã Đơn Đặt Hàng: <?= $info['MaDonDatHang']?> </label>
                        <div class="clear-both"></div>
                    </div>
                        
                    <div class="wrap-field">
                        <label style="width:900px">Ngày Lập: <?= $info['NgayLap']?> </label>
                        <div class="clear-both"></div>
                    </div>

                    <div class="wrap-field">
                        <label style="width:900px"> Tổng Tiền: <?= $info['TongThanhTien']?> </label>
                        <div class="clear-both"></div>
                    </div>

                    <div class="wrap-field">
                        <label style="width:900px">  Trạng Thái: <span style="color: #70c500;"> <?= $info['TenTinhTrang']?></span> </label>
                        <div class="clear-both"></div>
                    </div>
                </div>
                

                <!-- khach hang -->
                <div class="wrap-field">
                        </br>
                        <h3>Thông Tin Khách Hàng</h3>
                        <div class="clear-both"></div>
                </div>
                <div class="product-items">
                    

                    <div class="wrap-field">
                        <label style="width:900px">Tên Khách Hàng: <?= $info['TenHienThi']?> </label>
                        <div class="clear-both"></div>
                    </div>


                    <div class="wrap-field">
                        <label style="width:900px">Địa Chỉ: <?= $info['DiaChi']?> </label>
                        <div class="clear-both"></div>
                    </div>

                    <div class="wrap-field">
                        <label style="width:900px">Điên Thoại: <?= $info['DienThoai']?> </label>
                        <div class="clear-both"></div>
                    </div>

                    <div class="wrap-field">
                        <label style="width:900px">Email: <?= $info['Email']?> </label>
                        <div class="clear-both"></div>
                    </div>
                </div>
                
                <!-- Sản Phẩm -->
                <div class="wrap-field">
                    </br>
                    <h3>Thông Tin Đơn Hàng</h3>
                    <div class="clear-both"></div>
                </div>
                <div class="wrap-field">
                <div class="product-items">
                    <ul>
                    <li class="product-item-heading">  
                        <div class="product-prop product-img">Ảnh</div>
                        <div class="product-prop product-order">Tên sản phẩm</div>
                        <div class="product-prop product-order-price">Giá</div>
                        <div class="product-prop product-order-price"> Số Lượng</div>
                        <div class="product-prop product-order-price"> Tổng Tiền</div>
                        <div class="product-prop product-order">Tên Loại</div>
                        <div class="product-prop product-order">Tên Hãng</div>   
                        <div class="clear-both"></div>
                    </li>
                    <?php
                  
                    while ($row = mysqli_fetch_array($products)) { 
                        ?>
                        <li>  
                            
                            <div class="product-prop product-img"><img src="../<?= $row['HinhURL'] ?>" alt="<?= $row['HinhURL'] ?>" title="<?= $row['TenSanPham'] ?>" /></div>
                            <div class="product-prop product-order"><?= $row['TenSanPham'] ?></div>
                            <div class="product-prop product-order-price"><?= $row['GiaSanPham'] ?></div>
                            <div class="product-prop product-order-price"><?= $row['SoLuong'] ?></div>
                            <div class="product-prop product-order-price"><?= $row['SoLuong']*$row['GiaSanPham'] ?></div>
                            <div class="product-prop product-order"><?= $row['TenLoaiSanPham'] ?></div>
                            <div class="product-prop product-order"><?= $row['TenHangSanXuat'] ?></div>
                            <div class="clear-both"></div>
                        </li>
                    <?php } ?>
                </ul>               
                </div>
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