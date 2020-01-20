<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    $Type = mysqli_query($con, "SELECT * FROM `loaisanpham`");
    $maker = mysqli_query($con, "SELECT * FROM `hangsanxuat`");  
           
    ?>
    <div class="main-content">
        <h1><?= !empty($_GET['id'])?"Sửa Sản Phẩm":"Thêm Sản Phẩm" ?></h1>
        <div id="content-box">
            <?php
            if (isset($_GET['action']) && ($_GET['action'] == 'add'||$_GET['action'] == 'edit') ) {
                if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['price']) && !empty($_POST['price'])) {
                    
                    if (empty($_POST['name'])) {
                        $error = "Bạn phải nhập tên sản phẩm";
                    } elseif (empty($_POST['price'])) {
                        $error = "Bạn phải nhập giá sản phẩm";
                    } elseif (!empty($_POST['price']) && is_numeric(str_replace('.', '', $_POST['price'])) == false) {
                        $error = "Giá nhập không hợp lệ";
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
                        $date=date('Y/m/d H:i:s',time());                                            
                        if ($_GET['action']=='edit' && !empty($_GET['id'])) { 
                            $result = mysqli_query($con, "UPDATE  `sanpham` SET `TenSanPham` ='" . $_POST['name'] . "',`HinhURL`='" . $image . "',`GiaSanPham`=". $_POST['price'] .",`SoLuongTon`=". $_POST['inventory'] .",`slogan`='" . $_POST['slogan'] . "',`MoTa`='". $_POST['content'] . "',`MaLoaiSanPham`=". $_POST['type'] . ",`MaHangSanXuat`=". $_POST['maker'] . " WHERE `sanpham`.`MaSanPham`=". $_GET['id']);
                        }
                        else {  
                            
                            $result = mysqli_query($con, "INSERT INTO `sanpham` (`MaSanPham`, `TenSanPham`, `HinhURL`, `GiaSanPham`, `NgayNhap`,`NgayCapNhat`, `SoLuongTon`, `SoLuongBan`, `SoLuotXem`,`slogan`, `MoTa`, `BiXoa`, `MaLoaiSanPham`, `MaHangSanXuat`) VALUES (NULL,'" . $_POST['name'] . "','" . $image . "'," . $_POST['price'] . ", '" . $date . "','". $date ."'," . $_POST['inventory'] . ",0,0,'" . $_POST['slogan'] . "','" . $_POST['content'] . "',0," . $_POST['type'] . "," . $_POST['maker'] . ");");                  
                        }
                        
                        if (!$result) {
                            $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                        }                      
                    }
                } else {
                    $error = "Bạn chưa nhập thông tin sản phẩm.";
                }
            ?>
                <div class = "container">
                    <div class = "error"><?= isset($error) ? $error : "Cập nhật thành công" ?></div>
                    <a href = "product_listing.php">Quay lại danh sách sản phẩm</a>
                </div>
            <?php } else { 
                if(!empty($_GET['id'])){
                    $result=mysqli_query($con,"SELECT * FROM `sanpham` WHERE MaSanPham = ". $_GET['id']);
                    $product=$result->fetch_assoc();
                }               
            ?>
                <form id="product-form" method="POST" action="<?=!empty($product)?"?action=edit&id=".$_GET['id']:"?action=add"?>" enctype="multipart/form-data">
                    <input type="submit" title="Lưu sản phẩm" value="" />
                    <div class="clear-both"></div>
                    <div class="wrap-field">
                        <label>Tên sản phẩm: </label>
                        <input type="text" name="name" value="<?=!empty($product)?$product['TenSanPham']:"" ?>"/>
                        <div class="clear-both"></div>
                    </div>
                    <script language='javascript'> //kiểm tra số
                    function isNumberKey(evt)
                    {
                    var charCode = (evt.which) ? evt.which : event.keyCode
                    if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                    return true;
                    }                    
                    </script>
                    <div class="wrap-field">
                        <label>Giá sản phẩm: </label>
                        <input type="text" name="price" onKeyPress="return isNumberKey(event)" value="<?=!empty($product)?$product['GiaSanPham']:0 ?>" />
                        <div class="clear-both"></div>
                    </div>
                    
                    <div class="wrap-field">
                        <label><?= !empty($_GET['id'])?"Tồn Kho":"Số Lượng Nhập" ?></label>
                        <input type="text" name="inventory" onKeyPress="return isNumberKey(event)" value="<?=!empty($product)?$product['SoLuongTon']:0 ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Loại Sản Phẩm: </label>
                        <select name="type" id="" >
                        <?php
                         while ($row = mysqli_fetch_array($Type)) {                           
                        ?>                        
                            <option value="<?= $row['MaLoaiSanPham'] ?>" <?php if(!empty($product)) if ($row['MaLoaiSanPham']==$product['MaLoaiSanPham']) echo "selected"?>> <?= $row['TenLoaiSanPham'] ?> </option>
                        <?php } ?>
                        </select>
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Hãng Sản Xuất: </label>
                        <select name="maker" id="">
                        <?php
                         while ($row = mysqli_fetch_array($maker)) {                           
                        ?>                        
                            <option value="<?= $row['MaHangSanXuat'] ?>" <?php if(!empty($product)) if ($row['MaHangSanXuat']==$product['MaHangSanXuat']) echo "selected"?>>  
                            <?= $row['TenHangSanXuat'] ?>
                            </option>
                        <?php } ?>
                        </select>
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Ảnh đại diện: </label>
                        <div class="right-wrap-field">
                            <?php
                                if (!empty($product['HinhURL'])) {?>
                                   <img src="../<?= $product['HinhURL'] ?>" /></br>
                                   <input type="hidden" name="image" value="<?= $product['HinhURL']?>">
                            <?php }?>
                            <input type="file" name="image" value=""/>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Nội Dung slogan: </label>
                        <input type="text" name="slogan" value="<?=!empty($product)?$product['slogan']:"" ?>"/>
                        <div class="clear-both"></div>
                    </div>                                       
                    <div class="wrap-field">
                        <label>Nội dung: </label>
                        <textarea name="content" id="product-content">
                        <?=!empty($product)?$product['MoTa']:"" ?>
                        </textarea>
                        <div class="clear-both"></div>
                    </div>
                </form>
                <div class="clear-both"></div>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('product-content');
                </script>
                <?php } ?>
        </div>
        
    </div>
    <div class="clear-both"></div>
</div>       
    <?php
}
include './footer.php';
?>