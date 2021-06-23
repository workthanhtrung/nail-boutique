<?php 
require_once('../db/dbhelper.php');
require_once('../utils/utility.php');

$user  = validateToken();
$id = $user['id'];

$email = $old_pwd = $new_pwd = $pwd = '';
if (!empty($_POST)) {
	$email = getPost('email');
	$new_pwd = getPost('new_pwd');
	$old_pwd = getPost('old_pwd');
	$pwd = getPost('pwd');
	$updated_at = date('Y-m-d H:i:s');

	$sql = "select count(*) total from user where email = '$email'";
	$check = executeResult($sql,true);
	$total = $check['total'];

	if ($total > 0 && $email != $user['email']) {
		function function_alert($message){
		    echo "<script>alert('$message');</script>";
		};
		function_alert("Email đã tồn tại !!!");
	} else if( getMD5Security($old_pwd) != $user['password']) {
		function function_alert($message){
		    echo "<script>alert('$message');</script>";
		};
		function_alert("Email hoặc mật khẩu không đúng !!!");
	} else if(getMD5Security($old_pwd) == $user['password']) {
		if($old_pwd == $new_pwd) {
			function function_alert($message){
			    echo "<script>alert('$message');</script>";
			};
			function_alert("Mật khẩu mới không được trùng với mật khẩu cũ !!!");
		} else if($new_pwd != $pwd) {
			function function_alert($message){
			    echo "<script>alert('$message');</script>";
			};
			function_alert("Nhập lại mật khẩu cần giống với mật khẩu mới !!!");
		} else if ($old_pwd != $new_pwd && $new_pwd == $pwd) {
			$new_pwd = getMD5Security($new_pwd);
			$sql = "update user set email = '$email', password = '$new_pwd', updated_at = '$updated_at' where id = $id";
			execute($sql);
			function function_alert($message){
			    echo "<script>alert('$message');</script>";
			};
			function_alert("Đổi thông tin thành công.");
		}
	}
}