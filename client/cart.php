<?php
include 'header.php';
?>

<?php
    
    include './connect_db.php';
        
    if (!empty($_SESSION['user'])) { //Kiểm tra xem đã đăng nhập chưa?
	
	
	?>
	<?php 
  
  if(isset($_POST['submit'])&&!empty($_POST['soluong'])){ 
		
	  foreach($_POST['soluong'] as $key => $val) { 
		
		  if($val==0) { 
			  unset($_SESSION['cart'][$key]); 
		  }else{ 
			  $_SESSION['cart'][$key]['soluong']=$val; 
		  } 
	  } 
		
  }
  
  if (isset($_GET['action']) && $_GET['action']=='buy'&&!empty($_SESSION['cart'])) { 
	$cnt = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `dondathang`"))+1;
	$MD=strlen($cnt)-1;
	if($MD!=0)
		$MDH=substr("DH00000", 0, -$MD).$cnt;
	else
		$MDH="DH00000".$cnt;	
	
	$date=date('Y/m/d H:i:s',time());
	
	// đơn hàng	
	$result = mysqli_query($con, "INSERT INTO `dondathang`(`MaDonDatHang`, `NgayLap`, `TongThanhTien`, `MaTaiKhoan`, `MaTinhTrang`) VALUES ('".$MDH."','".$date."',".$_SESSION['tongtien'].",'".$_SESSION['user']['MaTaiKhoan']."',1)");
	
	// chi tiết đơn hàng
	$sql="SELECT * FROM sanpham WHERE MaSanPham IN (";           
	foreach($_SESSION['cart'] as $id => $value) { 
		$sql.=$id.","; 
	} 	  
	$sql=substr($sql, 0, -1).")";
	$query=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($query)){
		$subtotal=$_SESSION['cart'][$row['MaSanPham']]['soluong']*$row['GiaSanPham']; 
		$sql="INSERT INTO `chitietdondathang`(`MaChiTietDonDatHang`, `SoLuong`, `GiaBan`, `MaDonDatHang`, `MaSanPham`) VALUES (NULL,".$_SESSION['cart'][$row['MaSanPham']]['soluong'].",".$subtotal.",'".$MDH."','".$row['MaSanPham']."')";		
		$order_detail=mysqli_query($con,$sql);
		
		$upd="UPDATE `sanpham` SET `SoLuongTon`=`SoLuongTon`-".$_SESSION['cart'][$row['MaSanPham']]['soluong'].",`SoLuongBan`=`SoLuongBan`+".$_SESSION['cart'][$row['MaSanPham']]['soluong']." WHERE `MaSanPham`='".$row['MaSanPham']."'";
		
		$sqlupd=mysqli_query($con,$upd);
		
	}		
	if (!$result||!$order_detail||!$sqlupd) {
		$error = "Có lỗi xảy ra trong quá trình thực hiện.";
	}
	else {

		unset($_SESSION['cart']);
		unset($_SESSION['tongtien']);
	}
	?>
	<div class = "container">
        <div class = "error"><?= isset($error) ? $error : "Cảm ơn quý khách đã tin tưởng và đặt hàng" ?></div>
        <a href = "index.php">Quay lại Trang chủ</a>
    </div>
<?php

}?>

?> 
   
    <div class="container">
        <div class="row">
		<form method="post" action="cart.php" style="width: -webkit-fill-available;"> 
            <table class="table table-bordered" id="table-products">
                <thead>
                    <tr >
                        <th>ID</th>

                        <th>Tên Sản Phẩm</th>

                        <th>Giá Tiền</th>

                        <th>Số Lượng</th>

                        <th>Thành Tiền</th>
					</tr>
					
                </thead>
                <tbody>
					<!-- php giỏ hàng -->
				<?php if(isset($_SESSION['cart'])){ 
						$sql="SELECT * FROM sanpham WHERE MaSanPham IN ("; 
          
						foreach($_SESSION['cart'] as $id => $value) { 
							$sql.=$id.","; 
						} 
						
						$sql=substr($sql, 0, -1).")";
						
						$temp=0;
						$query=mysqli_query($con,$sql);
						
						$totalprice=0;
						while($row=mysqli_fetch_array($query)){
							$temp=$temp+1;
							$subtotal=$_SESSION['cart'][$row['MaSanPham']]['soluong']*$row['GiaSanPham']; 
                        	$totalprice+=$subtotal; 
					?>					 
                    <tr >
						
                        <th><?=$temp?></th>
                        <th><?= $row['TenSanPham'] ?></th>
						<th><?= number_format ($row['GiaSanPham'],0,",",",") ?> VNĐ</th>
						<th><input type="text" name="soluong[<?= $row['MaSanPham'] ?>]" size="5" value="<?= $_SESSION['cart'][$row['MaSanPham']]['soluong'] ?>" /></th>                         
                        <th><?= number_format(($_SESSION['cart'][$row['MaSanPham']]['soluong']*$row['GiaSanPham']),0,",",",") ?> VNĐ</th>
					</tr>
					<?php } //hết while
					?>
                    <tr >
                        <th></th>
                         <th></th>
                          <th></th>
                        <th>Tổng tiền:</th>
                        <th><?=number_format($totalprice,0,",",",")?> VNĐ</th>
					</tr>
					<?php
					$_SESSION['tongtien']=$totalprice;
					}// hết if
					
					?>
					<!-- hết php cart -->
				</tbody>
			</table>
			<br /> 
    	<button type="submit" name="submit">cập nhật giỏ hàng</button> 
	</form> <!-- hết form -->

	</div>
	<div class="clear-both"></div>
	<br>

        <div>
			<a href="./cart?action=buy"><button  type="submit" class="btn btn-lg btn-success" id="button-clear">Đặt Hàng</button></a>
            
        </div>
		
        <div class="text-right">

            <hr/>
            <address>
                Developed by Tan James
            </address>
     
		</div>
	</div> <!-- het container -->
	<?php } else { ?>
    <div class="container">
		<br>
		<br>
        <div class="box-content">
            Bạn chưa đăng nhập. Mời bạn quay lại đăng nhập <a href="login.php">tại đây</a>
        </div>
    </div>
<?php } ?>




<div class="khoidatmon text-xs-center wow fadeInUp" data-wow-delay="0s">
		<div class="container">

		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<div class="thongtindatmon fontroboto">
					<h2 class="fontroboto">Đặt Online</h2>
					<p class="tt ">Đặt hàng chưa bao giờ dễ dàng như thế này cho đến khi đến với chúng tôi! ShopAlone Shoes!!</p>
					<p class="giodb">Thứ 2 đến Thứ 6 <span class="vang"> 9:00 am - 23:00 pm </span>Thứ 7 và Chủ Nhật <span class="vang"> 10:00 am - 22:00 pm</span>
	Note:Đóng cửa vào tất cả các ngày nghĩ, lễ !.</p>
					<div class="dtdb fontoswarld">03 85 460 381</div>
				</div>
				

			</div>
			<div class="col-sm-3"></div>

			<div class="col-sm-10 push-sm-1">
			
				<div class=".formdatmon">
					<div class="row">
						<div class="col-sm-12">
							<h2 class="text-xs-center fontroboto">
								Đặt Giày Online ngay bên dưới!
							</h2>

						</div>
						
						<div class="col-sm-4">						 
								<div class="form-group">								 
									<input type="text" class="form-control" placeholder="Tên của bạn * ">
								</div>	 
						</div>
						<div class="col-sm-4">						 
								<div class="form-group">								 
									<input type="email" class="form-control" placeholder="Xin thêm địa chỉ email nè :  * ">
								</div>	 
						</div>
						<div class="col-sm-4">						 
								<div class="form-group">								 
									<input type="number" class="form-control" placeholder="Cho mình xin thêm sdt nữa nhé :  * ">
								</div>	 
						</div>
						<div class="col-sm-4">						 
								<div class="form-group">								 
									<input type="date" class="form-control" placeholder="Ngày sinh của bạn để nhận ưu đãi khi tới sinh nhật nhé :  * ">
								</div>	 
						</div>
						
						<div class="col-sm-4">						 
								<div class="form-group">								 
									<input type="time" class="form-control" placeholder="Time * ">
								</div>	 
						</div>
						<div class="col-sm-4">						 
								<div class="form-group">								 
									<input type="number" class="form-control" placeholder="Bạn muốn ghi chú gì thêm :  * ">
								</div>	 
						</div>

						<div class="col-sm-12 text-xs-center">
							<a href="
							" class="btn btn-warning datmon2">
								OK hoàn tất đặt hàng!
							</a>
						</div>
						

					</div>
					 
				</div> <!-- het form dat hang -->
			</div>
		</div> <!-- het row -->
			
		</div><!--  het container -->
		
	</div>  <!-- HET DAT BAN -->

	

	

  <!-- footer -->
  <?php
include 'footer.php';
?>