<?php
require_once('../db/dbhelper.php');
require_once('../utils/utility.php');
include_once('../home/header.php');

	$cart = [];
	if(isset($_COOKIE['cart'])) {
		$json = $_COOKIE['cart'];
		$cart = json_decode($json, true);
	}

	$idList = [];
	foreach ($cart as $item) {
		//push id của các item trong cart vào idList
		$idList[] = $item['id'];
	}
	if(count($idList) > 0) {
		//đưa idList mảng về dạng chuỗi 
		$idList = implode(',', $idList);
		//[2, 5, 6] => 2,5,6

		$sql = "select * from product where id in ($idList)";
		$cartList = executeResult($sql);
	} else {
		$cartList = [];
	}
?>

<link rel="stylesheet" type="text/css" href="cart.css">
<body>
<?php if($count > 0) { ?>
	<section class="mt-5">
		<div class="container">
			<div class="table-responsive">
				<table class="table" style="background-color: #fff; margin-top: 40px;">
					<thead class="thead-dark">
						<tr >
							<th scope="col" class="text-white">Sản phẩm</th>
							<th scope="col" class="text-white">Đơn giá</th>
							<th scope="col" class="text-white">Số lượng</th>
							<th scope="col" class="text-white">Số tiền</th>
							<th scope="col" class="text-white">Thao tác</th>
						</tr>
					</thead>
					<tbody>

<?php
	// $count = 0;
	$total = 0;

	foreach ($cartList as $item) {
		$num = 0;
		foreach ($cart as $value) {
			if($value['id'] == $item['id']) {
				$num = $value['num'];
				break;
			}
		}
		$total += $num*$item['price'];
		echo '
						<tr>
							<td>
								<div class="main">
									<div class="d-flex">
										<img src="'.$item['thumbnail'].'" width="145px" height="98px">
									</div>
									<div class="des" style="margin-top: 10px;">
										<p>'.$item['title'].'</p>
									</div>
								</div>
							</td>
							<td>
								<h6 style="margin-top: 50%;">'.number_format($item['price'], 0, ',', '.').'</h6>
							</td>
							<td>
								<form>
									<div class="soluong">
										<button type="button" class="soluong-btn1"><i class="fas fa-minus" alt="minus"></i></button>
										<input required="true" class="input-number " id="total1"  type="number" oninput="this.value = Math.abs(this.value)" pattern="[0-9]" value="'.$num.'" min="1" name="soluong" >
										<button type="button" class="soluong-btn2"><i class="fas fa-plus"  alt="plus"></i></button>
									</div>
								</form>
							</td>
							<td>
								<h5 style="margin-top: 45%;">'.number_format($num*$item['price'], 0, ',', '.').'</h5>
							</td>
							<td>
								<div style="display: flex;margin-top: 10%;">
									<a href="../admin/list-product.php"><button style="margin-right: 15px;" class="btn btn-dark">Tìm sản phẩm khác</br>cùng loại</button></a>
									<button class="btn btn-danger" onclick="deleteCart('.$item['id'].')" style="text-align: center;">Xóa</button>
								</div>
							</td>
						</tr>';
	}
 ?>
   
				</tbody>
			</table>
		</div>
	</div>
</section>

			<div class="col-lg-8 offset-lg-2" style="margin-left: 16.666667%;">
		<div class="checkout" style="background-color: #fff;">
			<ul>
				<h4 style="float: left;margin-top: 12px;">Tổng số sản phẩm: <?=$count?></h4>
				<li class="cart-total">
					<span>Tổng cộng: <?=number_format($total, 0, ',', '.')?>đ</span>
					<a href="checkout.php"><button style="float: right;margin-right: 38px;text-transform: uppercase;" class="btn btn-dark">mua hàng</button></a>
				</li>	
			</ul>
		</div>
	</div>
		</div>
	</div>
</div>
<?php }else{ ?>
	<div class="" style="text-align: center; margin-top: 200px;">
		<i style="font-size: 140px;" class="fas fa-cart-plus"></i>
		<h6 style="margin-top: 10px;">Giỏ hàng của bạn còn trống</h6>
		<a href="../admin/list-product.php"><button class="btn btn-dark" style="margin-top: 10px;">Mua ngay</button></a>
	</div>
<?php } ?>
<script type="text/javascript">
	// function cong()	{
	// 	var number = document.getElementById('$num').value;
	// 	number = number + 1;
	// 	var_dump(number);
	// 	die();
	// }
	// function tru()	{
	// 	var number = document.getElementById('$num').value;
	// 	number = number - 1;
	// 	var_dump('$num');
	// 	die();
	// }
	
	var $button1 = $('.soluong-btn1');
	var $button2 = $('.soluong-btn2');
	var $counter = $('#total1');

	
	
	$button1.click(function(){
		if ($counter.val() > 1) {
			$counter.val( parseInt($counter.val()) - 1 );
		}
		});
	$button2.click(function(){
	$counter.val( parseInt($counter.val()) + 1 );
	});
	// var count = 1;
	// var countEl = document.getElementById(".input-numbers");
	// function plus(){
 //    	count++;
 //    	countEl.value = count;
	// }
	
	
	
	function deleteCart(id) {
		option = confirm('Bạn chắc chắn muốn xóa sản phẩm này ??')
		if (!option) return

		$.post('api-product.php', {
			'action': 'delete',
			'id': id
		}, function(data) {
			location.reload()
		})

	}
</script>
<?php
	include_once('../layout/footer.php');
?>