<?php 
$title = "Nail | Thông Tin";
require_once('../db/dbhelper.php');
require_once('../utils/utility.php');
require_once('../layout/header.php');
	$user = validateToken();
	$id = $user['id'];
	$fullname = $user['fullname'];
	// var_dump($id);
	// var_dump($fullname);

	//lấy ra các đơn hàng có user id = id đã đăng nhập
	$order_id = executeResult('select id from orders where user_id = '.$id);
	//var dump ra thì nó vẫn đang là 1 mảng 
	// var_dump($order_id);

	$idList = [];
	foreach ($order_id as $item) {
		//push id của các item trong order_id vào idList
		$idList[] = $item['id'];
	}
	if(count($idList) > 0) {
		//đưa idList mảng về dạng chuỗi 
		$idList = implode(',', $idList);
		//[2, 5, 6] => 2,5,6

		//lấy ra được các order có id ở trong idList dưới dạng mảng.
		$sql = "select * from orders where id in ($idList)";
		$orderList = executeResult($sql);
	}
	// var_dump($orderList);
	$num_page = 5;
				$page = 1;
				if (isset($_GET['page'])) {
					$page = $_GET['page'];
				}
				$index = ($page - 1) * $num_page;

				$sql = "select count(*) total from order_details where order_id in ($idList)";

				$countList = executeResult($sql, true);
				$total = $countList['total'];

				//lay so sp chia cho so sp tren 1 trang -> ra duoc so trang, lam tron len.
				$totalPage = ceil($total/$num_page);
	//tìm những order có order_id cần xem ở trong bảng details
	$sql = "select order_details.*, category.title as cate_title, product.title as product_title, product.price as product_price, product.thumbnail as thumbnail, orders.order_date as order_date
						from order_details 
							left join orders on orders.id = order_details.order_id
					  	left join product on order_details.product_id = product.id
					  	left join category on category.id = product.category_id
								where order_id in ($idList)
									order by orders.order_date desc
								 		limit ".$index.','.$num_page;
	$orderdetail = executeResult($sql);
	// var_dump($orderdetail);
	
?>
<link rel="stylesheet" type="text/css" href="../css/myacc.css">
<div class="container" style="margin-top:5%;">
	<div class="row">
		<div class="col-md-2" style="display: block; margin-top: 6%;">
			<div class="nut" style="top: 0%;width: 210px;">
				<a href="../user/myacc.php" style="text-decoration: none;">
				 <button type="button" class="button" style="outline: none;">
				  <span class="button__text">Tài khoản</span>
				  <span class="button__icon">
				    <ion-icon name="cloud-download-outline"><i class="fas fa-user"></i></ion-icon>
				  </span>
				</button>
				</a>
				<a href="../user/information-product.php" style="text-decoration: none;">
				  <button type="button" class="button" style="margin-top: 20px;outline: none;">
				    <span class="button__text">Đơn mua</span>
				    <span class="button__icon">
				      <ion-icon name="cloud-download-outline"><i class="fas fa-check"></i></i></ion-icon>
				    </span>
				  </button>
				</a>
			</div>
		</div>
		<div class="col-md-10">
			<div class="table-responsive">
						<table class="table" style="background-color: #fff;">
							<thead class="thead-dark">
								<tr style="text-transform: uppercase;">
									<th scope="col" class="text-white">STT</th>
									<th scope="col" class="text-white">Tên Sản Phẩm</th>
									<th scope="col" class="text-white">Hình Ảnh</th>
									<th scope="col" class="text-white">Số Tiền</th>
									<th scope="col" class="text-white">Số Lượng</th>
									<th scope="col" class="text-white">Tổng Cộng</th>
									<th scope="col" class="text-white">Ngày Mua</th>
								</tr>
							</thead>
							<tbody>
			<?php

			$count = $index;
			foreach ($orderdetail as $item) {
				echo '<tr>
						<th>'.(++$count).'</th>
						<th>'.$item['product_title'].'</th>
						<th><img src="'.$item['thumbnail'].'"style="width:120px; height: 120px ; text-align:center" ></th>
						<th>'.number_format($item['product_price'], 0, ',', '.').' VNĐ</th>
						<th>'.$item['quantity'].'</th>
						<th>'.number_format($item['total_price'], 0, ',', '.').' VNĐ</th>
						<th>'.$item['order_date'].'</th>
					</tr>
				';
			}
			?>
						</tbody>
					</table>
					<ul class="pagination">
					<?php
						if ($page > 1 ) {
							echo '<li class="page-item"><a class="page-link" href="?page='.($page -1).'">Previous</a></li>';
						}

						$pageList = [1, $page-1 ,$page, $page+1, $totalPage];

						$isFirst = $isBefore = false;
						for ($i=1; $i <= $totalPage; $i++) { 
							if (!in_array($i, $pageList)) {
								if (!$isFirst && $i < $page) {
									$isFirst = true;
									echo '<li class="page-item"><a class="page-link" href="?page='.($page - 2).'">...</a></li>';
								}
								if (!$isBefore && $i > ($page+1)) {
									$isBefore = true;
									echo '<li class="page-item"><a class="page-link" href="?page='.($page + 2).'">...</a></li>';
								}
								continue;
							}
							if ($i == $page) {
								echo '<li class="page-item active"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
							} else {
								echo '<li class="page-item"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
							}
						}
						if ($page < $totalPage) {
							echo '<li class="page-item"><a class="page-link" href="?page='.($page +1).'">Next</a></li>';
						}
					?>
				</ul>
		</div>			
	</div>
</div>
</div>

<?php 
	require_once('../layout/footer.php');
?>