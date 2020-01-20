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
 	<div class="badichvu">
 		<div class="container ">
 			<div class="row">
 				<div class="col-sm-4 wow flipInY">
 					<a href=""><img src="../images/images/1dichvu.jpg" alt="" class="img-fluid"></a>
 					<h3><a href="">Giày Nữ Xinh</a></h3>
 					<p>Hình ảnh đôi giày thể thao khỏe khoắn kết hợp với đủ loại trang phục trên đường phố có lẽ đã trở nên quá đỗi quen thuộc. Năm nay với xu hướng giày thể thao kết hợp với các trang phục mùa đông sẽ giúp nàng trở nên cá tính và không kém phần ấm áp đâu nhé !!!.</p>
 					<a href="" class="readmore">Read More</a>
 				</div>
				<div class="col-sm-4 wow flipInY" data-wow-delay="0.2s">
 					<a href=""><img src="../images/images/2dichvu.jpg" alt="" class="img-fluid"></a>
 					<h3><a href="">Giày Nam Thời Trang</a></h3>
 					<p>Chào Đón Lễ Giáng Sinh và Năm Mới Nhằm tri ân khách hàng trong suốt thời gian qua đã luôn tin yêu và ủng hộ ShopALone SALE OFF từ 10% đến 50% tất cả các sản phẩm hiện đang sẵn hàng tại Cửa hàng hoặc các sản phẩm online trên website.</p>
 					<a href="" class="readmore">Read More</a>
 				</div>
				<div class="col-sm-4 wow flipInY" data-wow-delay="0.4s">
 					<a href=""><img src="../images/images/3dichvu.jpg" alt="" class="img-fluid"></a>
 					<h3><a href="">Thời Trang Nữ - Boots, Cao Cổ </a></h3>
 					<p>Mùa đông là thời điểm những đôi boots lên ngôi, những đôi boots sẽ giúp bạn gái trở nên sành điệu và thu hút hơn. Năm nay MWC với 10 mẫu boots siêu hot sẽ giúp các nàng luôn tự tin nhé, cùng ShopAlone tìm hiểu nào !.</p>
 					<a href="" class="readmore">Read More</a>	
 				</div>				
 			</div> <!-- het row -->
 		</div> <!--  het container -->
 	</div>  <!-- het badichvu -->
  	<div class="khoimenu wow fadeInUp">  
 		<div class="tieudekhoimenu text-xs-center">
 			<div class="container">
 				<div class="row">
 					<div class="col-sm-8 push-sm-2">
 						<span class="tieudephu fontdancing">Welcome to SHOPALONE SHOES</span>
                         <h3 class="tieudechinh fontroboto">Mạnh mẽ, Cá Tính, Hợp thời trang <3</h3>
                         <br><br><br>
                         <h4 class="tieudechinh fontroboto">Sản Phẩm Mới <3</h3>
 					</div>
 				</div>
 			</div>
 			
 		</div>   <!-- HET TIEUDEKHOIMENU -->
 	</div>  <!-- HET KHOI MENU -->

 	
<!-- php lấy dữ liệu từ DB-->
<?php
     include './connect_db.php';
     
     $products_new = mysqli_query($con, "SELECT * FROM `sanpham`,`hangsanxuat` Where `sanpham`.`MaHangSanXuat`=`hangsanxuat`.`MaHangSanXuat` ORDER BY `sanpham`.`NgayNhap` DESC LIMIT 10 ");
     $products_hot1 = mysqli_query($con, "SELECT * FROM `sanpham`,`hangsanxuat` Where `sanpham`.`MaHangSanXuat`=`hangsanxuat`.`MaHangSanXuat` ORDER BY `sanpham`.`SoLuongBan` DESC LIMIT 5 OFFSET 0 ");
	 $products_hot2 = mysqli_query($con, "SELECT * FROM `sanpham`,`hangsanxuat` Where `sanpham`.`MaHangSanXuat`=`hangsanxuat`.`MaHangSanXuat` ORDER BY `sanpham`.`SoLuongBan` DESC LIMIT 5 OFFSET 5");
	 
     $maker = mysqli_query($con, "SELECT * FROM `hangsanxuat`");
     mysqli_close($con);
     
?>

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
                    while ($row = mysqli_fetch_array($products_new)) {?>
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
  	<div class="slidemonan  wow fadeInUp">
 		<div class="container">
 			<div class="row">
 				<div class="col-sm-12">
 					<h4>Mẫu giày hot của tháng này </h4>
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
 								 <div class="carousel-item ">
 									<div class="row">
 										<!--php tải sản phẩm HOT-->
                                         <?php
                                        while ($row = mysqli_fetch_array($products_hot2)) {?>
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
 							<a class="left carousel-control" href="#slidemonanduoi" role="button" data-slide="prev">
 								<span class="icon-prev" aria-hidden="true"></span>
 								<span class="sr-only">Previous</span>
 							</a>
 							<a class="right carousel-control" href="#slidemonanduoi" role="button" data-slide="next">
 								<span class="icon-next" aria-hidden="true"></span>
 								<span class="sr-only">Next</span>
 							</a>
 						</div>
 				</div> <!-- het colsm12 cu giày -->
 			</div>  <!-- HET ROW -->
 		</div> <!-- HET CONTAINER -->

 	</div>  <!-- HET SLIDE mon -->



	

	<div class="khoidatmon text-xs-center wow fadeInUp" data-wow-delay="0s">
		<div class="container">

		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<div class="thongtindatmon fontroboto">
					<h2 class="fontroboto">Đặt Online</h2>
					<p class="tt ">Đặt hàng chua bao giờ dễ dàng như thế này cho đến khi đến với chúng tôi! ShopAlone Shoes!!</p>
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

	<div class="phanhoinguoidung wow  fadeInUp" data-wow-delay="0s">
		<div class="container">
			<div class="row">
				<div class="col-sm-10 push-sm-1 text-xs-center">
					<div id="slidetestimnial" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slidetestimnial" data-slide-to="0" class="active"></li>
							<li data-target="#slidetestimnial" data-slide-to="1"></li>
							<li data-target="#slidetestimnial" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner" role="listbox">
							<div class="carousel-item active">
							 	 <i class="fa fa-quote-right"></i>
							 	 <div class="quote">
							 	 	Hơn 5 năm phát triển, SHOPAlone luôn mang đến những mẫu giày chất lượng tốt nhất với giá cả hợp lí nhất đến tay người tiêu dùng với hệ thống cửa hàng Số 1 Sài Gòn và bán online khắp Việt Nam.
							 	 </div>
							 	 <b class="fontdancing tennguoi"> JAMES  </b>

							</div> 
							 <div class="carousel-item ">
							 	 <i class="fa fa-quote-right"></i>
							 	 <div class="quote">
							 	 	Hệ thống chi nhánh toàn thành phố thuận tiện cho việc đi lại <3
							 	 </div>
							 	 <b class="fontdancing tennguoi"> Cảnh :))) </b>

							</div> 
							<div class="carousel-item ">
							 	 <i class="fa fa-quote-right"></i>
							 	 <div class="quote">
							 	 	Cửa hàng trang bị thiết bị điều hòa phục vụ chu đáo, nhân viên thân thiện cùng hệ thống đặt hàng online hiện đạnh, nhanh chóng
							 	 <b class="fontdancing tennguoi"> Đắc :))) </b>

							</div> 
							
						</div>
						 
					</div>
				</div>
			</div>
		</div>
	</div>  <!-- HET PHAN HOI NGUOI DUNG -->

	<div class="tintuchome wow   " data-wow-delay="0s">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-xs-center wow  flipInY" data-wow-delay="0s">
					<div class="tdtintuchome">
						<span class="fontdancing">Chi Nhánh khác</span>
						<h2 class="fontroboto">Cập nhật thường xuyên </h2>
					</div>
				</div>

				<div class="col-md-4 col-sm-6 col-xs-12 wow  flipInY" data-wow-delay="0s">

					<div class="mottinchuan">
						<a href=""><img src="../images/images/f1.jpg" alt=""></a>
						<a href="" class="tieudetin1 fontoswarld">Các mẫu giày mới nhật sẽ được cập nhật thường xuyên cho khách hàng!</a>
						<div class="ngaythang1">10 June 2019 by <span class="vang"> JAMES</span></div>
						<p class="fontroboto">SHOP cung cấp ra thị trường rất nhiều sản phẩm giày chất lượng, mẫu mã đa dạng, style mới nhất... mang đến cho Quý Khách Hàng cảm giác mạnh mẽ, tự tin, cá tính và thanh lịch. ALONE SHOP  luôn mong muốn mang lại cho bạn cảm giác thoải mái với những kiểu giày thời thượng phong cách Hàn Quốc như: giày boot, giày oxford, giày mọi, giày thời trang nam nữ....! </p>

						<div class="docthem mb-2">
							<div class="like float-xs-right fontroboto">7363 like</div>
							<a href="" class="rm fontroboto">Read More</a>
						</div>
					</div>
				</div> 
				<div class="col-md-4 col-sm-6 col-xs-12 wow  flipInY" data-wow-delay="0s">
					<div class="mottinchuan">

						<a href=""><img src="../images/images/f1-03.jpg" alt=""></a>
						<a href="" class="tieudetin1 fontoswarld">Nhân viên nhiệt huyết, hiếu khách</a>
						<div class="ngaythang1">10 June 2019  by <span class="vang"> Cảnh </span></div>
						<p class="fontroboto">Đội ngũ nhân viên chu đáo tận tụy và luôn luôn tận tâm với khách hàng ! </p>

						<div class="docthem mb-2">
							<div class="like float-xs-right fontroboto">1439 like</div>
							<a href="" class="rm fontroboto">Read More</a>
						</div> 
					</div> 

				</div> 
				<div class="col-md-4 col-sm-6 col-xs-12 wow  flipInY" data-wow-delay="0s">
					<div class="mottinchuan">

						<a href=""><img src="../images/images/f1-02.jpg" alt=""></a>
						<a href="" class="tieudetin1 fontoswarld">Trang thiết bị phục vụ khách hàng tiện nghi</a>
						<div class="ngaythang1">10 June 2019  by <span class="vang">Đắc</span></div>
						<p class="fontroboto">SHOP cung cấp ra thị trường rất nhiều sản phẩm giày chất lượng, mẫu mã đa dạng, style mới nhất... mang đến cho Quý Khách Hàng cảm giác mạnh mẽ, tự tin, cá tính và thanh lịch.  SHOP ALONE SHOES  luôn mong muốn mang lại cho bạn cảm giác thoải mái với những kiểu giày thời thượng phong cách Hàn Quốc như: giày boot, giày oxford, giày mọi, giày thời trang nam nữ.... </p>

						<div class="docthem mb-2">
							<div class="like float-xs-right fontroboto">4380 like</div>
							<a href="" class="rm fontroboto">Read More</a>
						</div>
					</div>

				</div> 

			</div>
		</div>

	</div>  <!-- HET TIN TUC O TRANG HOME -->

  <!-- footer -->
  <?php
include 'footer.php';
?>