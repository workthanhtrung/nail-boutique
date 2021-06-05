
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<body background="banner3.jpg" style="background-image: url(baner.jpg)no-repeat;
	background-size: cover;
	opacity: 0.99;
	background-attachment: fixed;
	background-position: center;
	background-repeat: no-repeat;">
	<link rel="stylesheet" type="text/css" href="login.css">
	<div class="dangnhap">
		<div class="hero">
			<div class="form-box">
				<div class="button-box">
					<div id="btn"></div>
					<button  type="button" class="toggle-btn" onclick="login()">Login In</button>
					<button  type="button" class="toggle-btn" onclick="register()">Register</button>								
				</div>
				<div class="social-icon">
					<img src="fb.png">
					<img src="tw.png">
					<img src="gp.png">
				</div>			
				<form id="login" method="post" class="input-group" >
					
					<input type="text" name="email" id="email" class="input-field" placeholder=" Email" required="true">

					<input type="password" name="password" class="input-field" placeholder=" Password" required="true">

					<input type="checkbox" class="check-box" id="rememberMe" value="lsRememberMe"><span for>Remeber Password</span>
					<button type="submit" class="submit-btn">Log In</button>
				</form>
				<form id="register" method="post" class="input-group" onsubmit="return checkPw(this)">
					<input type="text" name="name" class="input-field" placeholder=" Name" required="true" >

					<input type="email" name="email" class="input-field" placeholder=" Email" required="true">
					
					<input type="password" name="pw1" id="pw1" class="input-field" placeholder=" Password" required="true">
					
					<input type="password" name="pw2" id="pw2" class="input-field" placeholder=" confirmation_pwd" required="true">
					
					<input type="checkbox" class="check-box" required="true"><span>I agree to the terms & condittins</span>
					<button type="submit" class="submit-btn">Register</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
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
	const rmCheck = document.getElementById("rememberMe"),
	    emailInput = document.getElementById("email");

	if (localStorage.checkbox && localStorage.checkbox !== "") {
	  rmCheck.setAttribute("checked", "checked");
	  emailInput.value = localStorage.username;
	} else {
	  rmCheck.removeAttribute("checked");
	  emailInput.value = "";
	}

	function lsRememberMe() {
		if (rmCheck.checked && emailInput.value !== "") {
			localStorage.username = emailInput.value;
			localStorage.checkbox = rmCheck.value;
		} else {
			localStorage.username = "";
			localStorage.checkbox = "";
		}
}

</script>
