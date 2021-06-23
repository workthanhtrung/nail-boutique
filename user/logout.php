
<?php

require_once('../db/dbhelper.php');
require_once('../utils/utility.php');

//lấy từ cookie tên là 'token' (nếu có), xóa token từ bảng user

	$token = '';
	if(isset($_COOKIE['token'])) {
		$token = $_COOKIE['token'];
		$cur_cart = [];
		if (isset($_COOKIE['cart'])) {
				$cur_cart = $_COOKIE['cart'];
				var_dump($cur_cart);

				$sql = "update user set current_cart = '$cur_cart' where token = '$token'";
				execute($sql);
			}

		$sql = "update user set token = null where token = '$token'";
		execute($sql);

	}
setcookie('cart', '', time() -3000, '/');
setcookie('token', '', time() -3000, '/');
header('Location: ../home/index.php');