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

<link rel="stylesheet" type="text/css" href="../cart/test.css">
<link rel="stylesheet" type="text/css" href="../admin/list-product.css">
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
				<p class="last-price"><span>Giá Cũ:999.000 VND</span></p>
				<p class="new-price"><span>Giá Mới:<?=number_format($product['price'], 0, '', '.')?> VND</span></p>
			</div>
			<div class="product-detail1">
				
				<ul>
					<li>Sản Phẩm Có Sẵn:<span> <?=$product['quantity']?></span></li>
					<li>Danh Mục:<span><?=$cate_name['cate_title']?></span></li>
					<li>Combo Khuyến Mãi:<span> Mua 1 tặng 1</span></li>
					<li>Vận Chuyển:<span> <i class="fas fa-shipping-fast"></i>Miễn Phí Vận Chuyển</span></li>
				</ul>
			</div>
			<div class="purchase-info1">
				<input type="number" oninput="this.value = Math.abs(this.value)" pattern="[0-9]" name="soluong" id="soluong" value="1" min="1" max="<?=$product['quantity']?>" step="1" required="true">
				<?php	if(validateToken() != null) {?>
					<button type="button" style="background: #256eff;" onclick="addToCart(<?=$id?>)" class="btn"><i class="fas fa-shopping-cart"></i> Thêm Vào Giỏ Hàng</button>
				<?php	}else{ ?>
				<a href="../user/login.php">
					<button type="button" style="background: #256eff;"  class="btn"><i class="fas fa-shopping-cart"></i> Thêm Vào Giỏ Hàng</button>
				</a>
				<?php	} ?>

				<?php	if(validateToken() != null) {?>
					<a href="cart.php" onclick="addToCart1('.$item['id'].')">
						<button type="button" class="btn">Mua Hàng</button>
					</a>
				<?php }else{ ?>
				<a href="../user/login.php" >
						<button type="button" class="btn">Mua Hàng</button>
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
	$sanpham = executeResult('select * from product where category_id =' .$product['category_id'],);
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
	}
</script>

<?php 
	require_once('../layout/footer.php');
?>