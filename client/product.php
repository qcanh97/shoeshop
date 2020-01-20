<?php
include 'header.php';
?>
<!-- giỏ hàng -->
<?php 

  include './connect_db.php';
  if(isset($_GET['action']) && $_GET['action']=="add"){ 
		
	  $id=intval($_GET['id']); 
		
	  if(isset($_SESSION['cart'][$id])){ 
			
		  $_SESSION['cart'][$id]['soluong']++; 
			
	  }else{ 
		$query_s = mysqli_query($con, "SELECT * FROM `sanpham` WHERE `MaSanPham`={$id}");  
		   
		  if(!empty($query_s)){ 
			  $row_s=$query_s->fetch_assoc(); 
				
			  $_SESSION['cart'][$row_s['MaSanPham']]=array( 
					  "soluong" => 1, 
					  "gia" => $row_s['GiaSanPham'] 
				  ); 
				
				  
		  }else{ 
				
			  $message="Thêm sản phẩm vào giỏ hàng thất bại"; 
				
		  } 
			
	  } 
		
  } 

?>
<!-- header -->
	<div class="khoimenu wow fadeInUp bannerkieu2dong">  
 		<div class="tieudekhoimenu text-xs-center">
 			<div class="container">
 				<div class="row">
 					<div class="col-sm-8 push-sm-2">
 						<span class="tieudephu fontdancing">WELCOME</span>
 						<h3 class="tieudechinh fontroboto">LIST SẢN PHẨM NẰM BÊN DƯỚI </h3>
 					</div>
 				</div>
 			</div>
 			
     </div>   <!-- HET TIEUDEKHOIMENU -->
     <!-- php lấy dữ liệu từ DB-->
     <?php
     include './connect_db.php';
     
     $products = mysqli_query($con, "SELECT * FROM `sanpham`,`hangsanxuat` Where `sanpham`.`MaHangSanXuat`=`hangsanxuat`.`MaHangSanXuat` ");
     $maker = mysqli_query($con, "SELECT * FROM `hangsanxuat`");
     mysqli_close($con);
     
     ?>
     
 	</div>  <!-- HET KHOI MENU -->
 		<div class="thucdonct wow fadeInUp">
 		<div class="tieudect text-xs-center fontroboto">
             <a href="" data-monan="*">All </a>
             <!-- tạo fontroboto -->
            <?php
            while ($row = mysqli_fetch_array($maker)) {?>
            <a href="" data-monan=".<?= $row['TenHangSanXuat'] ?>"><?= $row['TenHangSanXuat'] ?></a>
            <?php } ?> <!-- đóng while -->

 			
 		</div>

 	<div class="noidungct">
 			 <div class="container">
 			 	<div class="row nhieumon">
                    <!--php tải sản phẩm -->
					<?php
					if(isset($message)){ 
						echo "<h2>$message</h2>"; 
					} 
                    while ($row = mysqli_fetch_array($products)) {?>
                    <div class="col-xs-12 col-sm-6 col-md-4   motmon <?= $row['TenHangSanXuat'] ?>">
 			 			<div class="row">
 			 				<div class="col-xs-3 col-sm-4">
							  <a href="./product_detail.php?id=<?=$row['MaSanPham']?>">
							  	<div class="anhmon">
 			 						<div class="tagnew">NEW</div>
 			 						<img src="..<?= $row['HinhURL'] ?>" alt="" class="img-fluid">
 			 					</div>
							  </a>
 			 						
 			 				</div>
 			 				<div class="col-xs-9 col-sm-8">
 			 					<div class="tenmon">
								  <a href="./product_detail.php?id=<?=$row['MaSanPham']?>">
								  <div class="tren">
 			 							<span class="float-xs-right"><?= number_format ($row['GiaSanPham'],0,",",",") ?>VNĐ</span>
 			 							<b class="ten"><?= $row['TenSanPham'] ?></b>
 			 						</div>
								  </a>
 			 						
 			 						<div class="duoi">
 			 							<a class="nav-link btn btn-warning wow bounce" data-wow-iteration="3" href="product.php?action=add&id=<?= $row['MaSanPham']?>" >Mua Ngay</a>
 			 							<?= $row['slogan'] ?>
 			 						</div>
 			 					</div>
 			 				</div>
 			 			</div> <!-- het row -->
 			 		</div>  <!-- het motmon -->
                    <?php } ?> <!-- đóng while -->
                    
                  </div> <!-- het row -->
                  
 			 </div>  <!-- het container -->
 			
 		</div>  <!-- het noidungct -->
 	</div>  <!-- HET SanPham -->

   <!-- footer -->
 <?php
include 'footer.php';
?>