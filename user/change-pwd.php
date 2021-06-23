<?php 
	$title = "Nail | Đổi Thông Tin";
	require_once('../db/dbhelper.php');
	require_once('../utils/utility.php');
	require_once('../layout/header.php');

	
	require_once('../user/form-change-pwd.php');
?>
<link rel="stylesheet" type="text/css" href="../css/change-pwd.css">
<div class="container" style="margin-top: 15%;">
    <form method="post">
        <div class="wrapper">
            <div class="tex">
                <h4>Đổi thông tin email hoặc mật khẩu</h4>
            </div>
            <div class="input-data">
                <input required="true" type="email" name="email">
            <div class="underline"></div>
                <label>Email</label>
            </div>
            <div class="input-data">
                <input required="true" type="password" name="old_pwd">
            <div class="underline"></div>
                <label>Mật khẩu cũ</label>
            </div>
            <div class="input-data">
                <input required="true" type="password"  name="new_pwd">
            <div class="underline"></div>
                <label>Mật khẩu mới</label>
            </div>
            <div class="input-data">
                <input  required="true" type="password" name="pwd"></input>
            <div class="underline"></div>
                <label>Nhập lại mật khẩu mới</label>
            </div>
            <div class="social_media">
                <ul>
                    <li style="margin-left: 15%;"><button style="border: none; outline:none;color: #fff">Lưu thông tin</button></li>
                    <li style="margin-left: 20%;"><a href="../user/myacc.php">Quay lại</a></li>
                </ul>
            </div>
        </div>
    </form>
    <div style="margin-bottom:16%;">
        <h1></h1>
    </div>
</div>

<?php 
	require_once('../layout/footer.php');
?>