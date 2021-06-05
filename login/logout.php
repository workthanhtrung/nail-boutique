<?php

require_once('../db/dbhelper.php');
require_once('../utils/utility.php');

	$token = '';
	if(isset($_COOKIE['token'])) {
		$token = $_COOKIE['token'];
		
		$sql = "update user set token = null where token = '$token'";
		execute($sql);

		// $_SESSION['user'] = $result;

		// return $result;
	}
setcookie('token', '', time() -3000, '/');
header('Location: ../admin/list-product.php');