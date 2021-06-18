<?php
$title = "Trang thanh toán ";
require_once('../db/dbhelper.php');
require_once('../utils/utility.php');
include_once('../cart/header-checkout.php');

require_once('checkout-form.php');

if (validateToken() == null) {
	header('Location: ../user/login.php');
	die();
}

//dùng token tìm thông tin user_id trong bảng user 
$token = '';
	if(isset($_COOKIE['token'])) {
		$token = $_COOKIE['token'];
		
		$find_id = "select * from user where token = '$token'";
		$user = executeResult($find_id, true);
}
//

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

<body style="background-color: #f8f8f8;">
<link rel="stylesheet" type="text/css" href="checkout.css">

<!-- body -->

<form method="post">
	<div class="container" style="margin-top:10%;margin-bottom:10%;">
		<div class="row">
			<div class="col-md-5" >
				<div class="thanh"></div>
				<h3><span class="fas fa-map-marker-alt"></span>Địa Chỉ Nhận Hàng </h3>
				<div class="form-group" style="display:none;">
				  <label for="userid">userid:</label>
				  <input type="number" class="form-control" id="userID" name="userID" value="<?=$user['id']?>">
				</div>
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
				<div class="container">
					<h3> Sản Phẩm</h3>
					<div class="table-responsive">
						<table class="table" style="background-color: #fff;">
							<thead class="thead-dark">
								<tr >
									<th scope="col" class="text-white">STT</th>
									<th scope="col" class="text-white">Tên Sản Phẩm</th>
									<th scope="col" class="text-white">Số Lượng</th>
									<th scope="col" class="text-white">Số Tiền</th>
									<th scope="col" class="text-white">Tổng Cộng</th>
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
							<div class="thanhtoan" style="">
								<div  style="background-color: #ffffff;height: 50px;">
									<span style="float: left;font-size: 23px;font-weight: bold;margin-top: 10px;">Phương thức thanh toán</span>
									<span style="float: right;margin-top: 10px;">Thanh toán khi nhận hàng</span>
									
								</div>
								<p><span >Tổng tiền hàng:</span><span style="margin-left: 68%"><?=number_format($total, 0, ',', '.')?>đ</span></p>
								<p><span>Phí vận chuyển:</span><span style="margin-left: 68%">20.000đ</span></p>
								<p><span>Tổng thanh toán:</span><span style="margin-left: 68%;font-size: 25px;font-weight: bold;"><?=number_format($total + 20000, 0, ',', '.')?>đ</span></p>
								<div style="height: 50px;border-top: 1px dashed rgba(0,0,0,.09);">
									<button style="float: right;margin-top: 19px;margin-right: 32px;" class="btn btn-dark">Đặt Hàng</button>
							</div>	
						</div>
					</div>
				</div>
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
	include_once('../home/footer.php');
?>