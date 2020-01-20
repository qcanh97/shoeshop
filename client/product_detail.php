<?php
include 'header.php';
?>
<!-- header -->
<div class="slide">
 	<div id="slidehome" class="carousel slide slidecon" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#slidehome" data-slide-to="0" class="active"></li>
				<li data-target="#slidehome" data-slide-to="1"></li>
				<li data-target="#slidehome" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner" role="listbox">
				<div class="carousel-item active">
 							
 							<div class="chu">
 								<h2 class=" fontoswarld"><h3 class="tieudechinh fontroboto">Sale Giày Xinh - Đón Giáng Sinh</h3></h2>
 								<p  >Bão sale đón giáng sinh cùng ShopAlone  </p>
 								<a href="" class="nutslide fontoswarld btn btn-warning">Mua Ngay</a>
 							</div>
 							<img src="../images/images/slide01.jpg" alt="">
 						</div>
 						<div class="carousel-item">
 							<div class="chu">
 								<h2 class=" fontoswarld">Bão Sale đón Giáng Sinh </h2>
 								<p>Sale ngay 70% , Mại Zô! </p>
 								<a href="" class="nutslide fontoswarld btn btn-warning">Mua Ngay</a>
 							</div>
 							<img src="../images/images/slide02.jpg" alt="">
 						</div>
 						<div class="carousel-item">
 							<div class="chu">
 								<h2 class=" fontoswarld">Giày Nam Nữ - Chất Lượng</h2>
 								<p>Sale từ mùa hè đến mùa Noel nhaaa <3 </p>
 								<a href="" class="fontoswarld nutslide btn btn-warning"> Buy Now</a>
 							</div>
 							<img src="../images/images/01.jpg" alt="">
 						</div>
			</div>
			<a class="left carousel-control" href="#slidehome" role="button" data-slide="prev">
				<span class="icon-prev" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#slidehome" role="button" data-slide="next">
				<span class="icon-next" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
		 

 
 	</div> <!-- het slide  -->




 	<div class="badichvu badichvuabout">
 		<div class="container ">
 			<div class="row">
 				<div id="mota">		
                    <div class="title-bl visible-xs visible-sm">
						<h2>Chi Tiết Sản Phẩm</h2>
							

                    <?php if(!empty($_GET['id'])){
                        include './connect_db.php';
                     $sql="SELECT * FROM `sanpham` WHERE MaSanPham = ". $_GET['id'];  
                    $result=mysqli_query($con,$sql);
                   
                    $product=$result->fetch_assoc();
                    
                    $Type = mysqli_query($con, "SELECT `TenLoaiSanPham` FROM `loaisanpham` WHERE `MaLoaiSanPham`=".$product['MaLoaiSanPham'])->fetch_assoc();
                    $maker = mysqli_query($con, "SELECT `TenHangSanXuat` FROM `hangsanxuat` WHERE `MaHangSanXuat`=".$product['MaHangSanXuat'])->fetch_assoc();
                    $product['TenLoaiSanPham']=$Type['TenLoaiSanPham'];
                    $product['TenHangSanXuat']=$maker['TenHangSanXuat'];
                    $products_hot1 = mysqli_query($con, "SELECT * FROM `sanpham` Where `sanpham`.`MaLoaiSanPham`=".$product['MaLoaiSanPham']." ORDER BY `sanpham`.`SoLuongBan` DESC LIMIT 5 OFFSET 0 ");
                    $upda= mysqli_query($con,"UPDATE `sanpham` SET `SoLuotXem`=`SoLuotXem`+1 WHERE MaSanPham = ". $_GET['id']);
                }               
            ?>
			<div class="badichvu">
 		
 			<div class="row">
             <div class="col-sm-4"></div>
 				<div class="col-sm-4 wow flipInY">
 					<a href=""><img src="..<?= $product['HinhURL'] ?>" alt="" class="img-fluid"></a>
 					<h3><a href=""><?= $product['TenSanPham']?></a></h3>
 					
 				</div>
				<div class="col-sm-4 wow flipInY" data-wow-delay="0.2s">
 					
 					<h3><a href="">Giá: <?= number_format ($product['GiaSanPham'],0,",",",")?> VNĐ</a></h3>
 					<p>Số lượt xem: <?= $product['SoLuotXem']?></p>
 					<p>Loại Sản Phẩm: <?= $product['TenLoaiSanPham']?></p>
 					<P>Số lượng bán: <?= $product['SoLuongBan']?></P>
 					<p>Nhà sản xuất: <?= $product['TenHangSanXuat']?></p>
 					<p><a href="product.php">Sản Phẩm Khác</a></p>
 					<p><a href="product.php?action=add&id=<?= $product['MaSanPham']?>" class="muangay">MUA NGAY</a></p>
 					
 				</div>				
             </div> <!-- het row -->
             <div class="row">
             <div class="col-sm-2"></div>
             <div class="col-sm-8">
             <?= $product['MoTa']?>
            </div>  
             </div>
 		</div> <!--  het container -->
 	</div>  <!-- het badichvu -->									
     </div>
     </div>							
     </div>						
     </div>
						
	<div class="slidemonan  wow fadeInUp">
 		<div class="container">
 			<div class="row">
 				<div class="col-sm-12">
 					<h4>Sản phẩm tương tự</h4>
 				</div>
 			</div>

 			<div class="row">
 			<div class="col-sm-12">
 						<div id="slidemonanduoi" data-interval="3000" class="carousel slide" data-ride="carousel">
 							<ol class="carousel-indicators">
 								<li data-target="#slidemonanduoi" data-slide-to="0" class="active"></li>
 								<li data-target="#slidemonanduoi" data-slide-to="1"></li>
 								<li data-target="#slidemonanduoi" data-slide-to="2"></li>
 							</ol>
 							<div class="carousel-inner" role="listbox">
 								<div class="carousel-item active">
 									<div class="row">
 										

 										<!--php tải sản phẩm HOT-->
                                         <?php
										while ($row = mysqli_fetch_array($products_hot1)) {?>
										
 										<div class="sanpham">
										 <a href="./product_detail.php?id=<?=$row['MaSanPham']?>"><img src="..<?= $row['HinhURL'] ?>" alt="" class="anhspslide"></a>
 											
 											<div class="tensp">
 												<div class="gia float-xs-right"><?= number_format ($row['GiaSanPham'],0,",",",") ?>VNĐ</div>
 												<div class="ten"><?= $row['TenSanPham'] ?></div>
 											</div>
 											<div class="tencongthuc">
                                                 
                                             <?= $row['slogan'] ?>
 											</div>
                                         </div> <!-- SAN PHAM -->
                                         <?php } ?> <!-- đóng while -->

 	
 									</div> <!-- het row -->

 								</div>  <!-- HET CAROUSEL ITEM -->
 								 
								

 								</div>
 							
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 	
 				
 								 

 <!-- footer -->
 <?php
include 'footer.php';
?>

</div>
 	 


