<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
      
?>
<div class="main-content">
        <h1>Chi Tiết Sản Phẩm</h1>
        <div id="content-box">
            <?php if(!empty($_GET['id'])){
                    $result=mysqli_query($con,"SELECT * FROM `sanpham` WHERE MaSanPham = ". $_GET['id']);
                    $product=$result->fetch_assoc();
                    
                    $Type = mysqli_query($con, "SELECT `TenLoaiSanPham` FROM `loaisanpham` WHERE `MaLoaiSanPham`=".$product['MaLoaiSanPham'])->fetch_assoc();
                    $maker = mysqli_query($con, "SELECT `TenHangSanXuat` FROM `hangsanxuat` WHERE `MaHangSanXuat`=".$product['MaHangSanXuat'])->fetch_assoc();
                    $product['TenLoaiSanPham']=$Type['TenLoaiSanPham'];
                    $product['TenHangSanXuat']=$maker['TenHangSanXuat'];
                    
                }               
            ?>
            <form id="product-form" method="POST" action="" enctype="multipart/form-data">
                <div class="clear-both"></div>
                <div class="wrap-field">
                    <label style="width:900px">Tên sản phẩm: <?= $product['TenSanPham']?> </label>
                    
                    <div class="clear-both"></div>
                </div>
                    
                <div class="wrap-field">
                    <label style="width:900px">Giá sản phẩm: <?= number_format ($product['GiaSanPham'],0,",",",")?> VNĐ </label>
                    <div class="clear-both"></div>
                </div>
                    
                <div class="wrap-field">
                    <label style="width:900px">Tồn Kho: <?= $product['SoLuongTon']?> </label>
                    <div class="clear-both"></div>
                </div>

                <div class="wrap-field">
                    <label style="width:900px">Lượt Xem: <?= $product['SoLuotXem']?> </label>
                    <div class="clear-both"></div>
                </div>

                <div class="wrap-field">
                    <label style="width:900px">Số lượng bán: <?= $product['SoLuongBan']?> </label>
                    <div class="clear-both"></div>
                </div>

                <div class="wrap-field">
                    <label style="width:900px">Loại Sản Phẩm: <?= $product['TenLoaiSanPham']?></label>
                    <div class="clear-both"></div>
                </div>

                <div class="wrap-field">
                    <label style="width:900px">Hãng Sản Xuất: <?= $product['TenHangSanXuat']?></label> 
                    <div class="clear-both"></div>
                </div>

                <div class="wrap-field">
                    <label style="width:900px">Ngày Nhập: <?= $product['NgayNhap']?> </label>
                    <div class="clear-both"></div>
                </div>

                <div class="wrap-field">
                    <label style="width:900px">Ngày Cập Nhật Cuối: <?= $product['NgayCapNhat']?> </label>
                    <div class="clear-both"></div>
                </div>

                <div class="wrap-field">
                    <label>Ảnh đại diện: </label>
                    <div class="right-wrap-field">
                        <img src="../<?= $product['HinhURL'] ?>" />
                    </div>
                    <div class="clear-both"></div>
                    </br>
                </div>     
                <div class="wrap-field">
                    <label style="width:900px">Nội Dung slogan: <?= $product['slogan']?> </label>
                    <div class="clear-both"></div>
                </div>   
                <div class="wrap-field">
                
                    <label >Nội dung: </label>
                </br><hr>
                    <?=$product['MoTa']?>
                <hr>
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