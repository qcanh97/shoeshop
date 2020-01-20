<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;    
    if(isset($_GET['action']) && $_GET['action']=='search' && !empty($_POST['search'])){
        $totalRecords = mysqli_query($con, "SELECT * FROM `sanpham` where `TenSanPham` like '%".$_POST['search']."%'" );
    }
    else {
        $totalRecords = mysqli_query($con, "SELECT * FROM `sanpham`");
    }
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);   
    if(isset($_GET['action']) && $_GET['action']=='search' && !empty($_POST['search'])){
        $products = mysqli_query($con, "SELECT * FROM `sanpham` where `TenSanPham` like '%".$_POST['search']."%' ORDER BY `MaSanPham` DESC LIMIT " . $item_per_page . " OFFSET " . $offset );
    }
    else {
        $products = mysqli_query($con, "SELECT * FROM `sanpham` ORDER BY `MaSanPham` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
    mysqli_close($con);
    ?>
    <div class="main-content">
        <h1>Danh sách sản phẩm</h1>
        <form id="form-search" action="?action=search" method="post" enctype="multipart/form-data">
            <input type="text" name="search" id="" placeholder="Nhập nội dung">
            <input type="submit" value="Tìm Kiếm">  
        </form>
        
        <div class="product-items">
        <div class="clear-both"></div>
            <div class="buttons">
                </br>
                <a href="./product_editing.php">Thêm sản phẩm</a>
            </div>
            <ul>
                <li class="product-item-heading">
                    <div class="product-prop product-img">Ảnh</div>
                    <div class="product-prop product-name">Tên sản phẩm</div>
                    <div class="product-prop product-button">
                        Xóa
                    </div>
                    <div class="product-prop product-button">
                        Sửa
                    </div>
                    <div class="product-prop product-button">
                        xem
                    </div>
                    <div class="product-prop product-price">Giá</div>
                    <div class="product-prop product-price">Tồn Kho</div>
                    <div class="product-prop product-time">Ngày cập nhật</div>
                    <div class="clear-both"></div>
                </li>
                <?php
                while ($row = mysqli_fetch_array($products)) {
                    ?>
                    <li>
                        <div class="product-prop product-img"><img src="../<?= $row['HinhURL'] ?>" alt="<?= $row['HinhURL'] ?>" title="<?= $row['TenSanPham'] ?>" /></div>
                        <div class="product-prop product-name"><?= $row['TenSanPham'] ?></div>
                        <div class="product-prop product-price"><?= number_format ($row['GiaSanPham'],0,",",",") ?> VNĐ</div>
                        <div class="product-prop product-price"><?= $row['SoLuongTon'] ?></div>
                        <div class="product-prop product-button">
                            <a href="./product_delete.php?id=<?= $row['MaSanPham'] ?>">Xóa</a>
                        </div>
                        <div class="product-prop product-button">
                            <a href="./product_editing.php?id=<?= $row['MaSanPham'] ?>">Sửa</a>
                        </div>
                        <div class="product-prop product-button">
                            <a href="./product_view.php?id=<?= $row['MaSanPham'] ?>">Xem</a>
                        </div>
                        <div class="product-prop product-time"><?=  $row['NgayCapNhat'] ?></div>
                        
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
    
    <?php
}
include './footer.php';
?>