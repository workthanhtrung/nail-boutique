<?php
	require_once('../db/dbhelper.php');
	require_once('../utils/utility.php');
	$user = validateToken();
	$sql = "select  user.fullname from user ";
	$dataList = executeResult($sql);

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo isset($title) ? $title : "Default Title"; ?></title>
	<meta charset="utf-8">				
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="all,follow">
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Herr+Von+Muellerhoff" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	
	<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<style type="text/css">
		.nav-link {
			margin-right: 20px;
		}
		.navbar-light .nav-item:hover .nav-link  {
		    color: #f12020;
		}
		.navbar-light .nav-item .nav-link  {
		   font-size: 14spx;
		}
		.navbar-light .nav-item:hover .nav-link i{
		    color: #f12020;
		    font-weight: bold;
		}

		.navbar-light .dropdown-item:hover,
		.navbar-light .dropdown-item:focus {
		    color: #f12020;
		    background-color: rgba(255,255,255,.5);
		}
		.dropdown:hover .dropdown-menu {
			display: block;
		}
		/*@media screen and (max-width: 900px) {
  		.topnav a:not(:first-child), .dropdown .dropbtn {
    		display: none;
  		}
  		.topnav a.icon {
    		float: right;
    		display: block;
 			}
		}
		@media screen and (max-width: 900px) {
  		.topnav.responsive {position: relative;}
  		.topnav.responsive .icon {
    		position: absolute;
    		right: 0;
    		top: 0;
		}

*/
		.navbar-brand img{
			height: 38px;
		}
		header{
		  position: fixed;
		  top: 0;
		  left: 0;
		  width: 100%;
		  box-sizing: border-box;
		  justify-content: space-between;
		  align-items: center;
		  transition: 0.6s;
		  z-index: 100000;
		}
		.cart {
			border-left: 2px solid #000;
		    margin-right: 49%;
		    padding-left: 19px;
		}
	</style>
</head>
<body style="margin-top: 0px;">
	<header>
		<nav class="navbar navbar-expand-sm  navbar-light " style="background-color: #ffffff; font-size: 15px;">
		<div class="container" style="display: flex;">
			<div>
				<a class="navbar-brand" href="../home/index.php">
    		<img  src="https://static.wixstatic.com/media/4e382d_0d579ec3ec6241af9e1380ed79c56b7b~mv2.png/v1/fill/w_406,h_46,al_c,q_85,usm_0.66_1.00_0.01/Asset%202_3x.webp" alt="logo" style="width:100%;">
    		</a>
			</div>
    		<div class="cart">
		 	<h3>Giỏ Hàng</h3>
		 </div>
		</div>
	</nav>
</header>
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
 		
		
		 
