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
			margin-right: 13px;
		}
		.navbar-light .nav-item:hover .nav-link  {
		    color: #f12020;
		}
		.navbar-light .nav-item .nav-link  {
			font-size: 18px;
			font-family: Cambria;
			text-transform: uppercase;
			font-weight: bold;
			text-align: center;
  			float: left;
		}
		.navbar-light {
			font-size: 18px;
			font-family: Cambria;
			text-transform: uppercase;
			font-weight: bold;
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
		header .link-icons {
			display: flex;
			flex-grow: 1;
			flex-basis: 0;
			justify-content: flex-end;
			align-items: center;
			position: relative;
		}
		header .link-icons a {
			text-decoration: none;
			color: #394352;
			padding: 0 10px;
		}
		header .link-icons a:hover {
			color: #f12020;
		}
		header .link-icons a i {
			font-size: 25px;
			color: #000;
		}
		header .link-icons a span {
			display: inline-block;
			text-align: center;
			background-color: #000;
			border-radius: 50%;
			color: #FFFFFF;
			font-size: 12px;
			line-height: 16px;
			width: 17px;
			height: 17px;
			font-weight: bold;
			position: absolute;
			top: -4px;
			right: 0;
			border: 1px solid #fff;
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
	</style>
</head>
<body style="margin-top: 0px;">
	<header>
		<nav class="navbar navbar-expand-sm  navbar-light " style="background-color: #ffffff; font-size: 15px;">
		<a class="navbar-brand" href="../home/index.php">
    		<img  src="https://static.wixstatic.com/media/4e382d_0d579ec3ec6241af9e1380ed79c56b7b~mv2.png/v1/fill/w_406,h_46,al_c,q_85,usm_0.66_1.00_0.01/Asset%202_3x.webp" alt="logo" style="width:100%;">
 		</a>
		<div class="container">
		 	<ul class="navbar-nav" style="color: #000000; font-weight: bold;">
			    <li class="nav-item active">
      				<a  class="nav-link" href="../home/index.php">trang chủ </a>	
      			</li>
      			 <li class="nav-item active">
      				<a class="nav-link" href="../home/about.php">giới thiệu </a>	
      			</li>	     	
			    <li class="nav-item active">	    	
			      <a class="nav-link" href="../admin/list-product.php">cửa hàng </a>
			    </li>
			    <li class="nav-item active">
			      	<a href="../home/dichvu.php" class="nav-link">dịch vụ</a>
			      	<!-- <div class="dropdown-menu" style="border: none; font-weight: bold;line-height: 30px;">
				        <a style="font-weight: bold;" class="dropdown-item" href="../home/dichvu.php">Cải tiến móng</a>
				        <a style="font-weight: bold;" class="dropdown-item" href="#">Cắt sửa móng tay & móng chân</a>
				        <a style="font-weight: bold;" class="dropdown-item" href="#">Waxing</a>
				     </div> -->
			    </li>
			    <li class="nav-item active dropdown">
			      <a class="nav-link dropdown-toggle" href="#">góc chia sẻ </a>
			         <div class="dropdown-menu" style="border: none; font-weight: bold;line-height: 30px;">
				        <a style="font-weight: bold;" class="dropdown-item" href="../page/gallery.php">thư viện ảnh </a>
				        <a style="font-weight: bold;" class="dropdown-item" href="../page/tips.php">tips & tricks </a>
				     </div>
			    </li>
			   <li class="nav-item active">
			      <a class="nav-link" href="../home/contact-us.php">liên hệ </a>
			    </li>
			    <li class="nav-item active">
			      <a class="nav-link" href="../home/jointeam.php">tuyển dụng </a>
			    </li>

<?php	if(validateToken() != null) {?>
			<li style="width: 180px;" class="nav-item active dropdown">
		        <a class="nav-link dropdown-toggle" href=""><?=$user['fullname']?></a>
		     <div class="dropdown-menu" style="border: none; font-weight: bold;line-height: 30px;">
		        <a style="font-weight: bold;" class="dropdown-item" href="../user/myacc.php">thông tin tài khoản </a>
		        <a style="font-weight: bold;" class="dropdown-item" href="../user/logout.php">đăng xuất </a>
		     </div>
		    </li>
<?php	}else{ ?>
		<li class="nav-item active">
	      <a class="nav-link" href="../user/login.php"><i class="bi bi-door-open-fill"></i>đăng nhập</a>
	    </li>
<?php	} ?>
  
	  </ul>
	  
<?php
  	$cart = [];
	if(isset($_COOKIE['cart']) && ($_COOKIE['cart'] != null )) {
		$json = $_COOKIE['cart'];
		$cart = json_decode($json, true);
	}
	$count = 0;
	foreach ($cart as $item) {
		$count += $item['num'];
	}
?>

<?php	if(validateToken() != null) {?>
			<div class="link-icons">
				<a href="../cart/cart.php">
				 <button class="btn btn-outline-danger" style="border: none;"><i class="fas fa-shopping-cart"></i><span><?=$count?></span></button>
				</a>
			</div>
				
<?php	} else { ?>
	<div class="link-icons">
		<a href="../user/login.php">
			<button class="btn btn-outline-danger" style="border: none;"><i class="fas fa-shopping-cart"></i><span><?=$count?></span></button>
		</a>
	</div>
<?php	} ?>
	</nav>
	</header>
	<script type="text/javascript">
  		 function changePageTitle() {
            newPageTitle = 'The title has changed!';
            document.title = newPageTitle;
        }
</script>