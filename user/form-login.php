<?php
require_once('../db/dbhelper.php');
require_once('../utils/utility.php');
 
if(!empty($_POST)) {
	$email = getPost('email');
	$password = getPost('password');

	$password = getMD5Security($password);

	//check tai khoan co ton tai trong database
	$sql = "select * from user where email = '$email' and password = '$password'";
	$result = executeResult($sql);
	// var_dump($result);

	$callback = [];
	$current = $result[0]['current_cart'];
	var_dump($current);
	var_dump($callback);

	if (isset($current)) {
		$callback = json_decode($current, true);
		setcookie('cart', json_encode($callback), time() + 30*24*3600, '/');
		/*var_dump($current);
		var_dump($callback);*/
	} 

	if($result != null && sizeof($result) == 1) {
		//login thanh cong
		//dùng thời điểm log in + email người dùng -> tạo ra token.
		//token -> cookie & database -> verify lai cookie & database -> la nguoi dung nao
		$token = getMD5Security(time().$result[0]['email']);
		setcookie('token', $token, time() + 7*24*60*60, '/');

		$email = $result[0]['email'];
		$sql = "update user set token = '$token' where email = '$email'";
		execute($sql);

		if ($email == 'admin@admin.com') {
			header('Location: ../admin/edit-category.php');
		} else header('Location: ../home/index.php');
		die();
	}
	if(count($result) < 1) {
		echo "<script>
		alert('Email hoặc mật khẩu không đúng !!!');
		window.location.href='../user/login.php';
		</script>";
	}
}
