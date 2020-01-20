<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    
    if(isset($_GET['action']) && $_GET['action']=='search' && !empty($_POST['search'])){
        $totalRecords = mysqli_query($con, "SELECT * FROM `hangsanxuat` where `TenHangSanXuat` like '%".$_POST['search']."%'" );
    }
    else {
        $totalRecords = mysqli_query($con, "SELECT * FROM `hangsanxuat`");
    }
    
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if(isset($_GET['action']) && $_GET['action']=='search' && !empty($_POST['search'])){
        $products = mysqli_query($con, "SELECT * FROM `hangsanxuat` where `TenHangSanXuat` like '%".$_POST['search']."%' ORDER BY `MaHangSanXuat` DESC LIMIT " . $item_per_page . " OFFSET " . $offset );
    }
    else {
        $products = mysqli_query($con, "SELECT * FROM `hangsanxuat` ORDER BY `MaHangSanXuat` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }

   
    ?>
    <div class="main-content">
        <h1>Danh sách Hãng Sản Xuất</h1>
        <?php
            if (isset($_GET['action']) && $_GET['action']=='delete' && !empty($_GET['id'])) { 
                $result = mysqli_query($con, "DELETE FROM `hangsanxuat` WHERE `hangsanxuat`.`MaHangSanXuat` =". $_GET['id']);
                if (!$result) {
                    $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                }
                else {?>
                    <div class = "container">
                    <div class = "error"><p style="text-align: center;"><?= isset($error) ? $error : "Xoá thành công, tải lại sau 3s" ?></p></div> 
                    <p style="text-align: center;"> <a href = "makerptoduct.php">Ấn Để Tải lại Loại Hãng sản Xuất</a>   </p>
                    <?php header("refresh: 3; url = makerptoduct.php") ?>
                    </div>
               <?php }
            }
            if (isset($_GET['action']) && ($_GET['action'] == 'add'||$_GET['action'] == 'edit') ) {
                if (isset($_POST['name']) && !empty($_POST['name'])) {
                    if (empty($_POST['name'])) {
                        $error = "Bạn phải nhập tên Hãng sản Xuất";
                    }
                    if (isset($_FILES['image']) && !empty($_FILES['image']['name'][0])) {
                        $uploadedFiles = $_FILES['image'];
                        $result = uploadFiles($uploadedFiles);
                        if (!empty($result['errors'])) {
                            $error = $result['errors'];
                        } else {
                            $image = $result['path'];
                        }
                    }
                    if(!isset($image)&& empty($_POST['image'])){
                        $image='';
                    }
                    if(!isset($image) && !empty($_POST['image'])){
                        $image=$_POST['image'];
                    }
                    if (!isset($error)) {
                        if ($_GET['action']=='edit' && !empty($_GET['id'])) { 
                            $result = mysqli_query($con, "UPDATE  `hangsanxuat` SET `TenHangSanXuat`='" .$_POST['name']. "', `LogoURL`='" . $image . "' where `hangsanxuat`.`MaHangSanXuat`=". $_GET['id']);
                        }
                        else { 
                            
                             $result = mysqli_query($con, "INSERT INTO `hangsanxuat` (`MaHangSanXuat`, `TenHangSanXuat`,`LogoURL`, `BiXoa`) VALUES (NULL, '".$_POST['name']."','" . $image . "', '0');");                  
                        }
                        if (!$result) {
                            $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                        }
                    }
                }else {
                    $error = "Bạn chưa nhập thông tin Hãng sản Xuất.";
                }
                ?>
                <div class = "container">
                    <div class = "error"><p style="text-align: center;"><?= isset($error) ? $error : "Cập nhật thành công, tải lại sau 3s" ?><p></div> 
                    <p style="text-align: center;"> <a href = "makerptoduct.php" >Ấn Để Tải lại Hãng sản Xuất Ngay</a> </p>
                    <?php header("refresh: 3; url = makerptoduct.php") ?>
                </div>
            <?php }
            if(!empty($_GET['id'])){
                $result=mysqli_query($con,"SELECT * FROM `hangsanxuat` WHERE MaHangSanXuat = ". $_GET['id']);
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
                <h3><?= !empty($_GET['id'])?"Sửa Hãng Sản Xuất":"Thêm Hãng Sản Xuất" ?></h3>
                <input type="submit" title="Lưu Hãng Sản Xuất" value="" />   
                <div class="clear-both"></div>
                <div class="wrap-field">
                    <label style="width:200px">Tên Hãng Sản Xuất: </label>
                    <input type="text" name="name" value="<?=!empty($product)?$product['TenHangSanXuat']:"" ?>"/>
                    <div class="clear-both"></div>
                </div>
                <div class="wrap-field">
                        <label>Ảnh Logo: </label>
                        <div class="right-wrap-field">
                            <?php
                                if (!empty($product['LogoURL'])) {?>
                                   <img src="../<?= $product['LogoURL'] ?>" style="margin-left: 50px;"/></br>
                                   <input type="hidden" name="image" value="<?= $product['LogoURL']?>" style="margin-left: 50px;">
                            <?php }?>
                            <input type="file" name="image" value="" style="margin-left: 50px;"/>
                        </div>
                        <div class="clear-both"></div>
                </div>
                <div class="wrap-field">
                    
                </div>                   
            </from>
              
            <div class="clear-both"></div>
            <ul>
                <li class="product-item-heading">
                <div class="product-prop product-img">Ảnh</div>
                    <div class="product-prop" style="width:679px; float:left;">Tên Hãng Sản Xuất</div>
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
                        <div class="product-prop product-img"><img src="../<?= $row['LogoURL'] ?>" alt="<?= $row['LogoURL'] ?>" title="<?= $row['TenHangSanXuat'] ?>" /></div>
                        <div class="product-prop product-name"><?= $row['TenHangSanXuat'] ?></div>
                        
                        <div class="product-prop product-button">
                            <a href="./makerptoduct?action=delete&id=<?= $row['MaHangSanXuat']?>" >Xóa</a>
                        </div>
                        <div class="product-prop product-button">
                            <a href="./makerptoduct?id=<?= $row['MaHangSanXuat'] ?>">Sửa</a>
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