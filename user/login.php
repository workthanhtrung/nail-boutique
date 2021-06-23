<?php
require_once('../db/dbhelper.php');
require_once('../utils/utility.php');

if(validateToken() != null) {
	header('Location: ../home/index.php');
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nail | Login</title>
	<meta charset="utf-8">

</head>
<body>
<body background="../pictures/baner.jpg">
	<link rel="stylesheet" type="text/css" href="../css/login.css">
	<div class="dangnhap">
			<div class="hero">
				<div class="form-box">
					<div class="button-box">
						<div id="btn"></div>
						<button  type="button" class="toggle-btn" onclick="login()">Login In</button>
						<button  type="button" class="toggle-btn" onclick="register()">Register</button>								
					</div>
					<div class="social-icon">
						<img src="../pictures/fb.png">
						<img src="../pictures/tw.png">
						<img src="../pictures/gp.png">
					</div>
					<form id="login" method="POST" class="input-group" action="../user/form-login.php">

						<input type="text" name="email" id="email" class="input-field" placeholder=" Email" required="true" >

						<input type="password" name="password" class="input-field" placeholder=" Password" required="true" >

						<input type="checkbox" class="check-box" value="lsRememberMe"><span for>Remeber Password</span>
						<button type="submit" class="submit-btn">Log In</button>
					</form>
					<form id="register" method="POST" class="input-group" onsubmit="return checkPw(this)"
					action="../user/form-register.php">
						
						<input type="text" name="fullname" class="input-field" placeholder="Full Name" required="true"  >

						<input type="email" name="email" class="input-field" placeholder=" Email" required="true" >
						
						<input type="password" name="password" id="pw1" class="input-field" placeholder=" Password" required="true" >
						
						<input type="password" name="pw2" id="pw2" class="input-field" placeholder=" confirmation_pwd" required="true">
						
						<input type="checkbox" class="check-box" required="true"><span>I agree to the terms & condittins</span>
						<button class="submit-btn">Register</button>
					</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var lem1 = document.getElementById("pw1");
		var lem2 = document.getElementById("pw2");
	
		function checkPw(form) {
			pw1 = form.pw1.value;
			pw2 = form.pw2.value;
			if (pw1 != pw2) {
			lem1.style.background = '#ffe0e0';
			lem2.style.background = '#ffe0e0';
			alert ("\nMật Khẩu KHông KHớp.");
			
			return false;
			}
			else return true;
			}

		var x = document.getElementById("login");
		var y = document.getElementById('register');
		var z = document.getElementById("btn");

		function register() {
			x.style.left = '-400px';
			y.style.left = '50px';
			z.style.left = '110px';
		}
		function login() {
			x.style.left = '50px';
			y.style.left = '450px';
			z.style.left = '0';	
		}
		

	</script>
</body>
</html>