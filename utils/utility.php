<?php
function removeSpecialCharacter($str) {
	$str = str_replace('\\', '\\\\', $str);
	$str = str_replace('\'', '\\\'', $str);
	return $str;
}

function getPost($key) {
	$value = '';
	if(isset($_POST[$key])) {
		$value = $_POST[$key];
	}

	return removeSpecialCharacter($value);
}

function getGet($key) {
	$value = '';
	if(isset($_GET[$key])) {
		$value = $_GET[$key];
	}

	return removeSpecialCharacter($value);
}


function getMD5Security($pwd) {
	return md5(md5($pwd).MD5_PRIVATE_KEY);
}

function validateToken() {
	if(isset($_SESSION['user'])) {
		// var_dump($_SESSION);
		// echo 'get user from session<br/>';
		return $_SESSION['user'];//memcache
	}

	$token = '';
	if(isset($_COOKIE['token'])) {
		$token = $_COOKIE['token'];
		
		$sql = "select * from user where token = '$token'";
		$result = executeResult($sql, true);

		$_SESSION['user'] = $result;

		return $result;
	}

	return false;
}

function moveFileToPhotos($key) {
	// var_dump($_FILES);
	// die();
	//Đường dẫn chứa file đã được upload lên server 
	$target_dir = "photos/";

	// $file              = $_FILES[$key]['name'];

	// $path              = pathinfo($file);
	// $filename          = $path['filename'];
	// $ext               = $path['extension'];
	$filename = $_FILES[$key]['name'];

	//Form -> a.png -> server -> lưu a.png tới đường dẫn $temp_name
	$temp_name = $_FILES[$key]['tmp_name'];

	$path_filename_ext = $target_dir.$filename;

	//Form -> a.png -> server (tmp_name: aaa) -> file_exists(photos/a.png) -> false -> move -> photos/a.png -> exist
	//Form -> a.png -> server (tmp_name: bbb) -> file_exists(photos/a.png) -> true -> stop

	//Risk:
	//A -> login -> addProduct -> upload a.png -> server (tmp_name: aaa) -> file_exists(photos/a.png) -> false -> move -> photos/a.png -> exist
	//A -> login -> addProduct -> upload a.png (cùng tên -> ảnh khác) -> server (tmp_name: bbb) -> file_exists(photos/a.png) -> true -> stop -> Error nghiệp vụ .
	if (file_exists($path_filename_ext)) {
		// echo "Sorry, file already exists.";
	} else {
		//move a.png ($temp_name) -> photos/a.png ($path_filename_ext)
		move_uploaded_file($temp_name, $path_filename_ext);
		// echo "Congratulations! File Uploaded Successfully.";
	}
	return $path_filename_ext;
}

