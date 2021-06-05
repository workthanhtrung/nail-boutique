<?php
require_once('../db/dbhelper.php');
require_once('../utils/utility.php');
include_once('../layout/header.php');

require_once('checkout-form.php');

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
		$idList = implode(',', $idList);
		//[2, 5, 6] => 2,5,6

		$sql = "select * from product where id in ($idList)";
		$cartList = executeResult($sql);
	} else {
		$cartList = [];
	}
?>
<!-- body -->
<form method="post">
	<div class="container" style="margin-top:7%;">
		<div class="row">
			<div class="col-md-5">
				<h3>Thông tin giao hàng </h3>
				<div class="form-group">
				  <label for="usr">Tên người nhận:</label>
				  <input required="true" type="text" class="form-control" id="usr" name="fullname">
				</div>
				<div class="form-group">
				  <label for="address">Địa chỉ: </label>
				  <input required="true" type="text" class="form-control" id="address" name="address">
				</div>
				<div class="form-group">
				  <label for="phone_number">Số điện thoại: </label>
				  <input required="true" type="text" class="form-control" id="phone_number" name="phone_number">
				</div>
				<div class="form-group">
				  <label for="note">Ghi chú: </label>
				  <textarea class="form-control" rows="4" name="note" id="note"></textarea>
				</div>
			</div>
			<div class="col-md-7">
				<h3>Giỏ hàng </h3>
				<table class="table table-bordered table-responsive">
					<thead>
						<tr>
							<th>STT </th>
							<th>Tên sản phẩm </th>
							<th>Số lượng </th>
							<th>Giá </th>
							<th>Tổng cộng </th>
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
				<td>'.$item['title'].'</td>
				<td>'.$num.'</td>
				<td>'.number_format($item['price'], 0, ',', '.').'</td>
				<td>'.number_format($num*$item['price'], 0, ',', '.').'</td>
			</tr>';
	}
?>
					</tbody>
				</table>
				<p style="font-size: 30px; color: red">
					Total: <?=number_format($total, 0, ',', '.')?>
				</p>

				<button class="btn btn-success" style="width: 100%; font-size: 32px;">Hoàn thành </button>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
	function deleteCart(id) {
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