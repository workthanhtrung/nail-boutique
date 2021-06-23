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

function getCOOKIE($key){
		$value='';
		if (isset($_COOKIE[$key])) {
			$value = $_COOKIE[$key];
		}
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
	
	// if(isset($_FILES['picture'])){
	//     echo $_FILES['picture']['tmp_name'];
	// }
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

function getAllFiles() {
    $allFiles = array();
    $allDirs = glob('../admin/uploads/*');
    foreach ($allDirs as $dir) {
        $allFiles = array_merge($allFiles, glob($dir . "/*"));
    }
    return $allFiles;
}

function uploadFiles($uploadedFiles) {
    $files = array();
    $errors = array();
    //Xử lý gom dữ liệu vào từng file đã upload
    foreach ($uploadedFiles as $key => $values) {
        foreach ($values as $index => $value) {
            $files[$index][$key] = $value;
        }
    }
    $uploadPath = "./uploads/" . date('d-m-Y', time());
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }
    foreach ($files as $file) {
        $file = validateUploadFile($file, $uploadPath);
        if ($file != false) {
            move_uploaded_file($file["tmp_name"], $uploadPath . '/' . $file["name"]);
        } else {
            $errors[] = "The file " . basename($file["name"]) . " isn't valid.";
        }
    }
    return $errors;
}

//Check file hợp lệ
function validateUploadFile($file, $uploadPath) {
    //Kiểm tra xem có vượt quá dung lượng cho phép không?
    if ($file['size'] > 2 * 1024 * 1024) { //max upload is 2 Mb = 2 * 1024 kb * 1024 bite
        return false;
    }
    //Kiểm tra xem kiểu file có hợp lệ không?
    $validTypes = array("jpg", "jpeg", "png", "bmp","xls","xlsx","doc","docx");
    $fileType = substr($file['name'], strrpos($file['name'], ".") + 1);
    if (!in_array($fileType, $validTypes)) {
        return false;
    }
    //Check xem file trùng tên thì ko cho up
    $fileName = substr($file['name'], 0, strrpos($file['name'], "."));
    if (file_exists($uploadPath . '/' . $fileName . '.' . $fileType)) {
		echo('Ảnh đã tồn tại');
		return false;
    }
    return $file;
}


    //Check xem file đã tồn tại chưa? Nếu tồn tại thì đổi tên
    // $num = 1;
    // $fileName = substr($file['name'], 0, strrpos($file['name'], "."));
    // while (file_exists($uploadPath . '/' . $fileName . '.' . $fileType)) {
    //     $fileName = $fileName . "(" . $num . ")";
    //     $num++;
    // }