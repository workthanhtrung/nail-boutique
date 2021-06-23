<?php 
require_once('../utils/utility.php');

if(!empty($_POST)) {
	$action = getPost('action');
	$id = getPost('id');
	$num = getPost('num');

	$cart = [];
	if(isset($_COOKIE['cart'])) {
		$json = $_COOKIE['cart'];
		$cart = json_decode($json, true);
	}

	switch ($action) {
		case 'add':
			$isFind = false;
			for ($i=0; $i < count($cart); $i++) { 
				if($cart[$i]['id'] == $id) {
					$cart[$i]['num'] += $num;
					if ($cart[$i]['num'] > 20) {
						$cart[$i]['num'] = 20;
					}
					$isFind = true;
					break;
					
				}
			}

			if(!$isFind) {
				$cart[] = [
					'id'=>$id,
					'num'=>$num
				];
			}
			setcookie('cart', json_encode($cart), time() + 30*24*60*60, '/');
			break;
			
		case 'delete':
			for ($i=0; $i < count($cart); $i++) { 
				if($cart[$i]['id'] == $id) {
					//xóa ở $cart, vị trí index $1, xóa 1 phần tử 
					array_splice($cart, $i, 1);
					break;
				}
			}
			setcookie('cart', json_encode($cart), time() + 30*24*60*60, '/');
			break;
	}
}