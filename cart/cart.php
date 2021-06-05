<?php
require_once('../db/dbhelper.php');
require_once('../utils/utility.php');
include_once('../layout/header.php');

	$cart = [];
	if(isset($_COOKIE['cart'])) {
		$json = $_COOKIE['cart'];
		$cart = json_decode($json, true);
	}
	$idList = [];
	foreach ($cart as $item) {
		$idList[] = $item['id'];
	}
	if(count($idList) > 0) {
		//đưa idList về dạng mảng 
		$idList = implode(',', $idList);
		//[2, 5, 6] => 2,5,6

		$sql = "select * from product where id in ($idList)";
		$cartList = executeResult($sql);
	} else {
		$cartList = [];
	}
?>
<!-- body -->
<div class="container" style="margin-top:7%;">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>STT </th>
						<th>Hình ảnh </th>
						<th>Tên sản phẩm </th>
						<th>Số lượng </th>
						<th>Giá </th>
						<th>Tổng cộng </th>
						<th></th>
					</tr>
				</thead>
				<tbody>
<?php
	$count = 0;
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
				<td>'.(++$count).'</td>
				<td><img src="'.$item['thumbnail'].'" style="height: 120px"/></td>
				<td>'.$item['title'].'</td>
				<td style="text-align:center;"><input type="button" onclick="tru()" value = "-">  '.$num.'  <button onclick="cong()"> + </button></td>
				<td style="text-align:center;">'.number_format($item['price'], 0, ',', '.').'</td>
				<td style="text-align:center;">'.number_format($num*$item['price'], 0, ',', '.').'</td>
				<td><button class="btn btn-danger" onclick="deleteCart('.$item['id'].')"><i class="fa fa-times" aria-hidden="true"></i></button></td>
			</tr>';
	}
?>
				</tbody>
			</table>
			<p style="font-size: 30px; color: red">
				Total: <?=number_format($total, 0, ',', '.')?>
			</p>

			<a href="checkout.php">
				<button class="btn btn-success" style="width: 100%; font-size: 32px;">Checkout</button>
			</a>
		</div>
	</div>
</div>
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