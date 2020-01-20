<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    if(isset($_GET['action']) && $_GET['action']=='search' && !empty($_POST['search'])){
        $totalRecords = mysqli_query($con, "SELECT * FROM `loaisanpham` where `TenLoaiSanPham` like '%".$_POST['search']."%'" );
    }
    else {
        $totalRecords = mysqli_query($con, "SELECT * FROM `loaisanpham`");
    }
    
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if(isset($_GET['action']) && $_GET['action']=='search' && !empty($_POST['search'])){
        $products = mysqli_query($con, "SELECT * FROM `loaisanpham` where `TenLoaiSanPham` like '%".$_POST['search']."%' ORDER BY `MaLoaiSanPham` DESC LIMIT " . $item_per_page . " OFFSET " . $offset );
    }
    else {
        $products = mysqli_query($con, "SELECT * FROM `loaisanpham` ORDER BY `MaLoaiSanPham` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
    
    ?>
    <div class="main-content">
        <h1>Danh sách Loại sản phẩm</h1>
        <?php
            if (isset($_GET['action']) && $_GET['action']=='delete' && !empty($_GET['id'])) { 
                $result = mysqli_query($con, "DELETE FROM `loaisanpham` WHERE `loaisanpham`.`MaLoaiSanPham` =". $_GET['id']);
                if (!$result) {
                    $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                }
                else {?>
                    <div class = "container">
                    <div class = "error"><p style="text-align: center;"><?= isset($error) ? $error : "Xoá thành công, tải lại sau 3s" ?></p></div> 
                    <p style="text-align: center;"> <a href = "typeproduct.php">Ấn Để Tải lại Loại sản phẩm Ngay</a>   </p>
                    <?php header("refresh: 3; url = typeproduct.php") ?>
                    </div>
               <?php }
            }
            if (isset($_GET['action']) && ($_GET['action'] == 'add'||$_GET['action'] == 'edit') ) {
                if (isset($_POST['name']) && !empty($_POST['name'])) {
                    if (empty($_POST['name'])) {
                        $error = "Bạn phải nhập tên Loại sản phẩm";
                    }
                    if (!isset($error)) {
                        if ($_GET['action']=='edit' && !empty($_GET['id'])) { 
                            $result = mysqli_query($con, "UPDATE  `loaisanpham` SET `TenLoaiSanPham`='" .$_POST['name']. "' where `loaisanpham`.`MaLoaiSanPham`=". $_GET['id']);
                        }
                        else { 
                            
                             $result = mysqli_query($con, "INSERT INTO `loaisanpham` (`MaLoaiSanPham`, `TenLoaiSanPham`, `BiXoa`) VALUES (NULL, '".$_POST['name']."', '0');");                  
                        }
                        if (!$result) {
                            $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                        }
                    }
                }else {
                    $error = "Bạn chưa nhập thông tin sản phẩm.";
                }
                ?>
                <div class = "container">
                    <div class = "error"><p style="text-align: center;"><?= isset($error) ? $error : "Cập nhật thành công, tải lại sau 3s" ?><p></div> 
                    <p style="text-align: center;"> <a href = "typeproduct.php" >Ấn Để Tải lại Loại sản phẩm Ngay</a> </p>
                    <?php header("refresh: 3; url = typeproduct.php") ?>
                </div>
            <?php }
            if(!empty($_GET['id'])){
                $result=mysqli_query($con,"SELECT * FROM `Loaisanpham` WHERE MaLoaiSanPham = ". $_GET['id']);
                $product=$result->fetch_assoc();
            }
        ?>
        <form id="form-search" action="?action=search" method="post" enctype="multipart/form-data">
            <input type="text" name="search" id="" placeholder="Nhập nội dung">
            <input type="submit" value="Tìm Kiếm">  
        </form>
        <div class="product-items">
        <div class="clear-both"></div>
            <form id="product-form" method="POST" action="<?=!empty($product)?"?action=edit&id=".$_GET['id']:"?action=add"?>" enctype="multipart/form-data">
                <h3><?= !empty($_GET['id'])?"Sửa Loại Sản Phẩm":"Thêm Loại Sản Phẩm" ?></h3>
                <input type="submit" title="Lưu sản phẩm" value="" />   
                <div class="clear-both"></div>
                <div class="wrap-field">
                    <label style="width:200px">Tên Loại sản phẩm: </label>
                    <input type="text" name="name" value="<?=!empty($product)?$product['TenLoaiSanPham']:"" ?>"/>
                    <div class="clear-both"></div>
                </div>
            </from>
            <ul>
                <li class="product-item-heading">
                    
                    <div class="product-prop" style="width:817px; float:left;">Tên Loại sản phẩm</div>
                    <div class="product-prop product-button">
                        Xóa
                    </div>
                    <div class="product-prop product-button">
                        Sửa
                    </div>
                    
                    <div class="clear-both"></div>
                </li>
                <?php
                while ($row = mysqli_fetch_array($products)) {
                    ?>
                    <li>  
                        <div class="product-prop product-name"><?= $row['TenLoaiSanPham'] ?></div>
                        
                        <div class="product-prop product-button">
                            <a href="./typeproduct?action=delete&id=<?= $row['MaLoaiSanPham']?>" >Xóa</a>
                        </div>
                        <div class="product-prop product-button">
                            <a href="./typeproduct?id=<?= $row['MaLoaiSanPham'] ?>">Sửa</a>
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