<?php
$title = 'Chi tiết sản phẩm';
include_once('../layout/header.php');
require_once('../db/dbhelper.php');
require_once('../utils/utility.php');

$id = getGet('id');
$product = executeResult('select * from product where id = '.$id, true);

if ($product == null) {
	header('Location: ../admin/list-product.php');
	die();
}

$cart = '[]';
if (isset($_COOKIE['cart'])) 
	$cart = $_COOKIE['cart'];

?>

<div class="container">
	<div class="row"  style="margin-top:10%;">
		<div class="col-md-7">
			<img src="<?=$product['thumbnail']?>" style="width: 100%">
		</div>
		<div class="col-md-5">
			<p style="font-size: 26px;color: black;"><?=$product['title']?></p>
			<p style="font-size: 26px;color: black;">Còn lại: <?=$product['quantity']?></p>
			<p style="font-size: 26px; color: red"><?=number_format($product['price'], 0, '', '.')?> VND</p>
			<input type="number" name="soluong" id="soluong" value="1" min="1" step="1" style="width: 100px;color: black;margin-bottom: 30px;" required="true">
			<div class="col-md-12" style="display: flex;">
				<button class="btn btn-success col-md-6" onclick="addToCart(<?=$id?>)" style="width: 100%; font-size: 26px;height:50px;margin-top: 10px;">Add to cart</button>
				<a href="checkout.php" class="col-md-6">
					<button class="btn btn-danger" style="width: 100%; font-size: 26px; margin-top: 10px;">Checkout</button>
				</a>
			</div>
		</div>
		<div class="col-md-9" style="color: black; margin-top: 30px;margin-bottom: 50px; margin-left: 50px;">
			<h1 style="color: black;">Một số thông tin về sản phẩm</h1>
			<?=$product['content']?>
		</div>
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
			echo '<div class="col-md-3"style="margin-top: 20px; margin-bottom: 20px; ">
				<a href="detail.php?id='.$item['id'].'"><img src="'.$item['thumbnail'].'" style="width: 100%;color: black;"></a>
				<a href="detail.php?id='.$item['id'].'"><p style="font-size: 16px;color: black;">'.$item['title'].'</p></a>
				<p style="font-size: 16px; color: red">'.number_format($item['price'], 0, '', '.').' VND</p>
				</div>';
		    }
		}
?>
	</div>
</div>
<!-- sp tuong tu END -->

<script type="text/javascript">
	function addToCart(id) {
		if ($('#soluong').val() < 0 || $('#soluong').val() % 1 != 0) {
			alert('Vui lòng nhập số lượng > 0');
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