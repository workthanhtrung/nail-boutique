<?php
// session_start();

$title = 'Product Page';
include_once('../layout/header.php');
require_once('../db/dbhelper.php');
require_once('../utils/utility.php');
require_once('../cart/api-product.php');



if ($id = getGet('id')) {
	$productList = executeResult('select * from product where category_id = '.$id);	
} else {
	$productList = executeResult('select * from product');
} 

if ($productList == null) {
	header('Location: ../admin/list-product.php');
	die();
}

		

?>
<!-- body START -->
<div class="container">
	<div class="panel panel-primary" style="margin-top:7%;">
		<div class="panel-heading">
			Tìm sản phẩm
			<form method="get">
				<input type="text" name="search" class="form-control" style="margin-top: 15px; margin-bottom: 15px; width:50%;" placeholder="Tìm kiếm theo tên">
			</form>
		</div>
	</div>

	<div class="row">
<?php
if (!empty($_GET)) {
	if (isset($_GET['search'])) {
		$search = $_GET['search'];

	$sql = 'select * from product where title like "%'.$_GET['search'].'%"';
	$productList = executeResult($sql);
	}
}

foreach ($productList as $item) {
	echo '<div class="col-md-3" style="border: solid 2px #e9e6e6; padding: 20px;">
			<a href="../cart/detail.php?id='.$item['id'].'"><img src="'.$item['thumbnail'].'" style="width: 100%"></a>
			<a href="../cart/detail.php?id='.$item['id'].'"><p style="font-size: 16px;">'.$item['title'].'</p></a>
			<p style="font-size: 16px; color: red">'.number_format($item['price'], 0, '', '.').' VND</p>
			<button class="btn btn-success" onclick="addToCart(<?=$id?>)">Thêm vào giỏ</button>
		</div>';
}
?>
	
	</div>
</div>

<script type="text/javascript">
	function addToCart(id) {
		$.post('../cart/api-product.php', {
			'action': 'add',
			'id': $item['id'],
			'num': 1
		}, function(data) {
			location.reload()
		})
	}
</script>
<!-- body END -->
<?php
include_once('../layout/footer.php');
?>