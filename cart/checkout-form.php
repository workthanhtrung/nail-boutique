<?php

if(!empty($_POST))	{
	$cart = [];
	if (isset($_COOKIE['cart'])) {
		$json = $_COOKIE['cart'];
		$cart = json_decode($json, true);
	}

	// || count($cart == 0) ->đoạn này đang lỗi ko chạy.
	if ($cart == null) {
		header('Location: ../admin/list-product.php');
		die();
	}

	$fullname = getPost('fullname');
	$address = getPost('address');
	$phone_number = getPost('phone_number');
	$note = getPost('note');
	$orderdate = date('Y-m-d H:i:s');

	// var_dump($fullname);
	// var_dump($address);
	// var_dump($phone_number);
	// var_dump($note);
	// var_dump($orderdate);
	// die();
	$created_at = $updated_at = date('Y-m-d H:i:s');

	//add order
	$sql = "insert into orders (order_date, address, phone_number, note, created_at, updated_at) values ('$orderdate', '$address', '$phone_number', '$note', '$created_at', '$updated_at')";
	execute($sql);

	//lấy ra id của bảng orders khi order_date = cái vừa add ở trên
	$sql = "select * from orders where order_date = '$orderdate'";
	$order = executeResult($sql, true);

	$orderId = $order['id'];

	//lấy lại phần giỏ để lấy số lượng và giá của từng sp trong cart, để thêm vào bảng order_details 
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

	foreach ($cartList as $item) {
		$num = 0;
		foreach ($cart as $value) {
			if($value['id'] == $item['id']) {
				$num = $value['num'];
				break;
			}
		}

		$sql = "insert into order_details (order_id, product_id, quantity) values ($orderId, ".$item['id'].", $num)";
		execute($sql);
	}
	header('Location: complete.php');
	setcookie('cart', '[]', time() -1000, '/');
} 