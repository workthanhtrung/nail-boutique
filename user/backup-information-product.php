<?php 
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

	//tìm những order có order_id cần xem ở trong bảng details
	$sql = "select order_details.*, category.title as cate_title, product.title as product_title, product.price as product_price, product.thumbnail as thumbnail, orders.order_date as order_date
	from order_details 
		left join orders on orders.id = order_details.order_id
  	left join product on order_details.product_id = product.id
  	left join category on category.id = product.category_id
			where order_id in ($idList)";
	$orderdetail = executeResult($sql);
	// var_dump($orderdetail);
?>

<div class="container" style="margin-top:5%;">
	<div class="row">
		<div class="col-md-3" style="display: block; margin-top: 10%;">
			<li class="active" style="list-style: none;">
              <a  class="nav-link" href="../user/myacc.php" style="color: black; text-decoration-line: none;">Tài khoản của tôi</a>  
            </li>
            <li class=" active" style="list-style: none;">
              <a class="nav-link" href="../user/information-product.php" style="color: black; text-decoration-line: none;">Đơn hàng</a> 
            </li> 
		</div>
		<div class="col-md-9">
			<table class="table table-bordered">
						<thead>
							<tr>
								<th>STT</th>
								<th>Tên sản phẩm</th>
								<th style="width: 30%;">Hình ảnh</th>
								<th>Giá</th>
								<th>Số lượng sản phẩm</th>
								<th>Tổng số tiền</th>
                <th>Ngày mua hàng </th>
							
							</tr>
						</thead>
						<tbody>
			<?php
			$count = 0;
			foreach ($orderdetail as $item) {
				echo '<tr>
						<th>'.(++$count).'</th>
						<th>'.$item['product_title'].'</th>
						<th><img src="'.$item['thumbnail'].'"style="width:70%; height: 100px ; text-align:center" ></th>
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
		</div>			
	</div>
</div>

<?php 
	require_once('../layout/footer.php');
?>