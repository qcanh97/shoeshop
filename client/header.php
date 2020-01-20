<!DOCTYPE html>
<html lang="en"><head>
	<title> Shop-Alone Sản Phẩm </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">  
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700&amp;subset=vietnamese" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700" rel="stylesheet">
	
	
  
  

	<script type="text/javascript" src="../vendor/bootstrap.js"></script>


 	<script type="text/javascript" src="../vendor/isotope.pkgd.min.js"></script>
 	<script type="text/javascript" src="../vendor/imagesloaded.pkgd.min.js"></script>
 	<script type="text/javascript" src="../jquery/client_product.js"></script>

	<link rel="stylesheet" href="../vendor/bootstrap.css">
	<link rel="stylesheet" href="../vendor/font-awesome.css">
	<link rel="stylesheet" href="../css/clientcss.css">
 </head>
<body >

		<?php
		session_start();
		?>
 	<div class="topheader">
 		<div class="container">
 			<div class="row">
 				<div class="col-sm-6 wow jello">
 					<div class="mangxh float-sm-left text-xs-center text-sm-left">
						<a href="https://www.facebook.com/tan.james.99"><i class="fa fa-facebook"></i></a>
						<a href="https://twitter.com/login?lang=vi"><i class="fa fa-twitter"></i></a>
						<a href="https://www.pinterest.com/hvtan1999/"><i class="fa fa-pinterest"></i></a>
						<a href="https://aboutme.google.com/u/0/?referer=gplus"><i class="fa fa-google-plus"></i></a>
 					 </div>
 					<div class="datgiay">
 						Gọi cho tôi: 0385460381 - JAMES
 					 </div>
 				</div>
 				<div class="col-sm-6 ">
					 <?php if (empty($_SESSION['user'])) { ?>
				 	<div class="datmon openingtop float-sm-right text-sm-left text-xs-center" style="border-left: none; border-right: none; ">
						 <a href="registration.php"> <button type="button" class="btn btn-default btndkdn" >Đăng ký</button></a>
					</div>
 					<div class="datmon openingtop float-sm-right text-sm-left text-xs-center" style="border-left: none; border-right: none; ">
 						<a href="login.php"><button type="button" class="btn btn-default btndkdn" >Đăng nhập</button></a>
					 </div>
					<?php } else  { 
        			if(!empty($_SESSION['user']))      
						$currentUser = $_SESSION['user']; ?>
						<div class="datmon openingtop float-sm-right text-sm-left text-xs-center" style="border-left: none; border-right: none; ">
 						<a href="logout.php"><button type="button" class="btn btn-default btndkdn" >Đăng xuất</button></a>
					 	</div>	
						<p style="color: white; float: right;">Xin chào <span style="color: wheat;"><?= !empty($currentUser)?$currentUser['TenHienThi']:"" ?></span></p>					
					<?php } ?>
 				</div>
 			</div> <!-- het row -->
 		</div> <!-- het container -->
 	</div> <!-- het topheader  -->
  	<div class="logovamenu">
	    <nav class="navbar navbar-light  fontroboto">
	    	<div class="container">    	
			      <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#mtren">
			       
			      </button>
			      <div class="collapse navbar-toggleable-xs" id="mtren">
			        <a class="navbar-brand text-xs-center text-sm-left" href="#"><img src="../images/images/logo.png" alt=""></a>

			        <ul class="nav navbar-nav float-sm-right">
			          <li class="nav-item">
			        <a class="nav-link" href="./index.php">Trang Chủ</a>
			          </li>
			          <li class="nav-item">
			            <a class="nav-link" href="./about.php">Giới thiệu</a>
			          </li>
			          <li class="nav-item">
			            <a class="nav-link" href="./news.php">Tin tức</a>
			          </li>
			          <li class="nav-item">
			            <a class="nav-link" href="./product.php">Sản Phẩm</a>

			          </li>
			          <li class="nav-item">
			            <a class="nav-link" href="./contact.php">Contact</a>
			          </li>
			         <li class="nav-item datgiaymenu">
			            <a class="nav-link btn btn-warning wow bounce" data-wow-iteration="3" href="cart.php" >Giỏ Hàng</a>
			          </li>
			        </ul>
			      </div>
	      </div> <!-- het container -->
	    </nav>
 	</div> <!-- het logo va menu -->

