<?php
require_once('../db/dbhelper.php');
require_once('../utils/utility.php');

$title = $note = $picture = '';
if(!empty($_POST))	{
	$title = getPost('title');
	$note = getPost('note');
	// $picture = moveFileToPhotos('picture');
	$created_at = $updated_at = date('Y-m-d H:i:s');
	$userID = getPost('userID');

	if (isset($_FILES['picture'])) {
		$file = $_FILES['picture'];
		$file_name = $file['name'];

		if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png') {
			move_uploaded_file($file['tmp_name'], 'uploads'.$file_name);
		}	else {
			echo "Định dạng ảnh không đúng ";
			$file_name = '';
		}
		move_uploaded_file($_FILES['picture']['tmp_name'], 'uploads/'.$_FILES['picture']['name']);

	}
	//thêm thông tin vào bảng feedback
	$sql = "insert into feedback (user_id, title, note, created_at, updated_at, picture) values ('$userID', '$title', '$note', '$created_at', '$updated_at', '$file_name')";
	execute($sql);

	echo "<script>
		alert('Cảm ơn bạn đã gửi phản hồi !');
		window.location.href='../home/index.php';
		</script>";
}