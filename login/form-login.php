<?php
 
if(!empty($_POST)) {
	$email = getPost('email');
	$password = getPost('password');

	$password = getMD5Security($password);

	//check tai khoan co ton tai trong database
	$sql = "select * from user where email = '$email' and password = '$password'";
	$result = executeResult($sql);
	// var_dump($result);
	if($result != null && sizeof($result) == 1) {
		//login thanh cong
		//sinh ra token -> duy nhat cho tung tai khoan nguoi dung + duy nhat tai tung thoi diem login -> bao mat.
		//token -> cookie & database -> verify lai cookie & database -> la nguoi dung nao
		$token = getMD5Security(time().$result[0]['email']);
		setcookie('token', $token, time() + 7*24*60*60, '/');

		$email = $result[0]['email'];
		$sql = "update user set token = '$token' where email = '$email'";
		execute($sql);

		header('Location: ../admin/list-product.php');
		die();
	}
}