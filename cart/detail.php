<?php
$title = 'Chi tiết sản phẩm';
include_once('../layout/header.php');
require_once('../db/dbhelper.php');
require_once('../utils/utility.php');

$id = getGet('id');
$product = executeResult('select * from product where id = '.$id, true);
$category_id = $product['category_id'];

$cate_name = executeResult('select category.title as cate_title from category where id = '.$category_id,true);

if ($product == null) {
	header('Location: ../admin/list-product.php');
	die();
}

?>

<link rel="stylesheet" type="text/css" href="../css/detail.css">
<link rel="stylesheet" type="text/css" href="../css/list-product.css">

<body style="background-color: #f8f8f8; ">
	<div class="carrt-wrapper">
		<div style="display: flex; margin-top: 86px;" class="cart1">
			<div class="product-img1">
				<div class="img-display1">
					<div class="img-show1">
						<img src="<?=$product['thumbnail']?>" width="100%">
					</div>
				</div>
			</div>
			<div class="product-content1">
				<h2 class="product-title1"><?=$product['title']?></h2>
			
			<div class="product-rating">
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star-half-alt"></i>
				<span>4.7(21)</span>
			</div>
			<div class="product-price1">
				<!-- <p class="last-price"><span>Giá Cũ:999.000 VND</span></p> -->
				<p class="new-price"><span>Giá: <?=number_format($product['price'], 0, '', '.')?> VND</span></p>
			</div>
			<div class="product-detail1">
				
				<ul>
					<!-- <li>Sản Phẩm Có Sẵn:<span> <?=$product['quantity']?></span></li> -->
					<li>Danh mục:<span> <?=$cate_name['cate_title']?></span></li>
					<!-- <li>Combo khuyến mãi:<span> Mua 3 tặng 1</span></li> -->
					<li>Vận chuyển:<span> <i class="fas fa-shipping-fast"></i> Miễn phí vận chuyển</span></li>
				</ul>
			</div>
			<div class="purchase-info1">
				<input type="number"  name="soluong" id="soluong" value="1" min="1" max="20" step="1" required="true">
				<?php	if(validateToken() != null) {?>
					<button type="button" style="background: #256eff;margin-top: 15px;" onclick="addToCart(<?=$id?>)" class="btn"><i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
				<?php	}else{ ?>
				<a href="../user/login.php">
					<button type="button" style="background: #256eff;"  class="btn"><i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
				</a>
				<?php	} ?>

				<?php	if(validateToken() != null) {?>
					<a>
						<button type="button" class="btn" style="margin-top:15px;" onclick="buyNow(<?=$id?>)">Mua ngay</button>
					</a>
				<?php }else{ ?>
					<a href="../user/login.php" >
						<button type="button" class="btn">Mua ngay</button>
					</a>
				<?php	} ?>

				
			</div>
			<div class="social-links1">
				<p style="margin-bottom: 0px;">Chia Sẻ:</p>
				 <a href = "#">
              		<i class = "fab fa-facebook-f"></i>
            	</a>
            	<a href = "#">
             		<i class = "fab fa-twitter"></i>
            	</a>
            	<a href = "#">
             		<i class = "fab fa-instagram"></i>
            	</a>
            	<a href = "#">
            	  <i class = "fab fa-whatsapp"></i>
            	</a>
            	<a href = "#">
            	  <i class = "fab fa-pinterest"></i>
            	</a>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div style="margin-top: 50px;" class="content">
		<h2>Thông Tin Sản Phẩm: </h2>
			<p><?=$product['content']?></p>
	</div>
</div>

<!-- Phan sp tuong tu  -->
<div class="container" style="width: 90%">
	<div class="row">
		<div class="col-md-12">
			<h2 style="color: black;">Một số sản phẩm tương tự</h2>
		</div>
<?php
$iii = $product['category_id'];
	$sanpham = executeResult('select * from product where category_id = '.$iii.' order by product.updated_at asc limit 8 ');
	if ($sanpham != null) {
		foreach ($sanpham as $item) {
			echo '<div class="col-md-3">
				<div class="product-box">
					<div class="product-img" href="../cart/detail.php>
						<a href="../cart/detail.php?id='.$item['id'].'"><img src="'.$item['thumbnail'].'" style="width: 100%"></a>
					</div>

					<div class="product-content">
						<a style="text-decoration: none;" href="../cart/detail.php?id='.$item['id'].'"><h4 style="height: 34.91px;" >'.$item['title'].'</h4></a>

						<div class="price">
							<p >'.number_format($item['price'], 0, '', '.').' VND</p>
						</div>		
					<button style="margin-bottom: 10px;" class="btn-dark" onclick="addToCart('.$item['id'].')">Thêm vào giỏ</button>
					</div>
		        </div>							
			</div>';
	    }
	}
?>

	</div>
</div>
</body>
<!-- sp tuong tu END -->

<script type="text/javascript">
	function addToCart(id) {
		if ($('#soluong').val() < 0 || $('#soluong').val() % 1 != 0) {
			alert('Vui lòng nhập lại số lượng ');
			return false;
		}

		if ($('#soluong').val() > 20 ) {
			alert('Vui lòng mua số lượng tối đa 20');
			return false;
		}

		$.post('api-product.php', {
			'action': 'add',
			'id': id,
			'num': $('#soluong').val()
		}, function(data) {
			location.reload()
		})
	};

	function buyNow(id) {
		$.post('api-product.php', {
			'action': 'add',
			'id': id,
			'num': 1
		}, function(data) {
			location.replace('cart.php')
		})
	}

</script>

<?php 
	require_once('../layout/footer.php');
?>