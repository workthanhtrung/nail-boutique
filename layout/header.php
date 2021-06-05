<?php
require_once '../db/dbhelper.php';
	$categoryList = executeResult("select * from category");
	// var_dump($categoryList);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

	<!-- Font Awesome 4.7 CDN -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- css -->
	<link rel="stylesheet" type="text/css" href="../layout/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg heading">
	<a class="navbar-brand" href="../home/trangchu.php">
		<img src="https://static.wixstatic.com/media/4e382d_0d579ec3ec6241af9e1380ed79c56b7b~mv2.png/v1/fill/w_406,h_46,al_c,q_85,usm_0.66_1.00_0.01/Asset%202_3x.webp" alt="logo" style="width:100%;">
	</a>
	<ul>
		<li>
			<a href="../home/trangchu.php">trang chủ</a>
		</li>
		<li>
			<a href="../home/about.php">giới thiệu</a>
		</li>
		<li class="dropdown">
  			<a class="dropdown-toggle" href="../admin/list-product.php" data-toggle="dropdown">sản phẩm</a>
		      	<div class="dropdown-menu" style="border: none; font-weight: bold;">
		      		<!-- list do ra tu database-->
			        <ol style="list-style-type: none;width: 300px;">
						<?php
		            		foreach ($categoryList as $item) {
		            			echo '<li>
		            				<a href="../admin/list-product.php?id='.$item['id'].'">'.$item['title'].'</a>';
		            			echo "</li>";
		            		}
			              ?>
	             	</ol>
			    </div>
			</li>
		<li>
			<a href="../page/gallery.php">thư viện ảnh</a>
		</li>
		<li>
			<a href="../page/tips.php">tips chia sẻ</a>
		</li>
		<li>
			<a href="../home/contact-us.php">liên hệ</a>
		</li>
		<li>
			<a href="../user/login.php"><i class="fa fa-user" aria-hidden="true"></i> đăng nhập</a>
		</li>
	</ul>
<?php
	$cart = [];
	if(isset($_COOKIE['cart'])) {
		$json = $_COOKIE['cart'];
		$cart = json_decode($json, true);
	}
	$count = 0;
	foreach ($cart as $item) {
		$count += $item['num'];
	}
?>
		<a href="../cart/cart.php">
			<button type="button" class="btn btn-outline-danger btn-sm" style="font-size: 23px;border: none;margin-left:50px;">
				<i class="fa fa-shopping-cart" aria-hidden="true"></i> Giỏ hàng <span style="font-weight: bold; color: black;"><?=$count?></span>
			</button>
		</a>
	</div>
</nav>