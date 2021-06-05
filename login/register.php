<?php
require_once('../db/dbhelper.php');
require_once('../utils/utility.php');

if(validateToken() != null) {
	header('Location: ../admin/list-product.php');
	die();
}

require_once('form-register.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registation Form</title>
	<meta charset="utf-8">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Register</h2>
				<?php
					if(!empty($_POST)) {
						echo '<h2 style="color: red">User is existed</h2>';
					}
				?>
			</div>
			<div class="panel-body">
				<form method="post" id="checkPassword">
					<div class="form-group">
					  <label for="usr">Full Name:</label>
					  <input required="true" type="text" class="form-control" id="usr" name="fullname" value="<?=$fullname?>">
					</div>
					<div class="form-group">
					  <label for="email">Email:</label>
					  <input required="true" type="email" class="form-control" id="email" name="email" value="<?=$email?>">
					</div>
					<div class="form-group">
					  <label for="pwd">Password:</label>
					  <input required="true" type="password" class="form-control" id="pwd" name="password">
					</div>
					<div class="form-group">
					  <label for="confirmation_pwd">Confirmation Password:</label>
					  <input required="true" type="password" class="form-control" id="confirmation_pwd" name="confirmation_pwd">
					</div>
					<p><a href="login.php">I have a account (login)</a></p>
					<button class="btn btn-success">Register</button>
				</form>
			</div>
		</div>
	</div>
<script type="text/javascript">
	$(function() {
		$('#checkPassword').submit(function() {
			if($('[name=password]').val() != $('[name=confirmation_pwd]').val()) {
				alert('Mật khẩu không trùng khớp. Hãy kiểm tra lại !!!')
				return false
			}

			return true
		})
	})
</script>
</body>
</html>