<?php
// require_once("code-contact.php");
?>


<!DOCTYPE html>
<html>
<head>
	<title>Contact Us</title>
	<meta charset="utf-8">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<h3><span style="font-size: 30px;font-family: poller_oneregular;">let's keep in touch</span></h3>
		<div class="card-body">
			<form action="contact.html">
				<input required="true" type="email" name="email" id="email" value="" placeholder="EMAIL">
				<input required="true" type="text" name="fullname" id="fullname" value="" placeholder="NAME">
				<input required="true" type="phone" name="phone" id="phone" value="" placeholder="PHONE NUMBER">
				<input required="true" type="text" name="address" id="address" value="" placeholder="ADDRESS">
				<textarea rows="5" name="message" id="message" placeholder="MESSAGE"></textarea>
				<button class="read" style="margin-left: 44%;" type="submit">send</button>
			</form>
		</div>
	</div>
</body>
</html>