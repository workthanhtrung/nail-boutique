<?php
$title = "Nail | Liên Hệ";
include_once('../layout/header.php');
require_once('contact-form.php');

if (validateToken() == null) {
	echo "<script>
		alert('Bạn cần đăng nhập trước khi gửi phản hồi !');
		window.location.href='../user/login.php';
		</script>";
	// header('Location: ../user/login.php');
	// die();
}

//dùng token tìm thông tin user_id trong bảng user 
$token = '';
	if(isset($_COOKIE['token'])) {
		$token = $_COOKIE['token'];
		
		$find_id = "select * from user where token = '$token'";
		$user = executeResult($find_id, true);
}
//
?>
<link rel="stylesheet" type="text/css" href="../css/contact.css">
	<div class="contact-warp">
		<div class="contact-in">
			<h1>Contact Info</h1>
			<h2 style="color: #fff;"><i class="far fa-calendar-alt"></i> Business Hours</h2>
			<p>Monday - Friday: 10:00AM - 7:30PM</p>
			<p>Saturday: 9:00AM - 7:00PM</p>
			<p>Sunday: 11:00AM - 6:00PM</p>
			<h2 style="color: #fff;"><i class="fas fa-map-marker-alt"></i> Address</h2>
			<p>3rd floor, 54 Le Thanh Nghi, Hai Ba Trung, Hanoi, Vietnam</p>
			<h2><i class="fas fa-phone-alt"></i> Phone</h2>
			<p style="color: #000;">+841 6666 8888</p>
			<h2><i class="fas fa-envelope"></i>Email</h2>
			<p style="color: #000;">ABC@aptechlearning.edu.vn</p>
			<h2>Ask about our referral program! </h2>
			<ul>
				<li><a href="https://www.facebook.com/nbnailboutique"><i class="fab fa-facebook-square"></i></a></li>
				<li><a href="https://twitter.com/"><i class="fab fa-twitter"></i></a></li>
				<li><a href="https://www.instagram.com/nb_nailboutique/"><i class="fab fa-instagram-square"></i></a></li>
				<li><a href="https://www.youtube.com/channel/UCd8aIzwdaoQ_Abp3frmeZSA"><i class="fab fa-youtube"></i></a></li>
			</ul>
		</div>
		<div class="contact-in">
			<h1 style="color: #000;">Gửi phản hồi cho chúng tôi nhé !</h1>
			<form method="post" enctype="multipart/form-data">
				<div class="form-group" style="display:none;">
				  <label for="userid">userid:</label>
				  <input type="number" class="form-control" id="userID" name="userID" value="<?=$user['id']?>">
				</div>
				<input required="true" type="text" name="title" class="contact-in-input" placeholder="Tiêu Đề">
				<textarea placeholder="Nội Dung" required="true" style="margin-top: 0px;" row="5" class="contact-in-textarea" name="note"></textarea>
				<input type="file" class="contact-in-input" id="picture" name="picture">
				<!-- <img src=" mở thẻ php ($thisProduct != null)?$thisProduct['picture']:'' đóng thẻ " style="max-height: 200px;"> -->
				<button class="contact-in-btn btn btn-outline-danger">Gửi</button>
			</form>
		</div>
		<div class="map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.729700886134!2d105.84692901476278!3d21.00346948601203!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad58455db2ab%3A0x9b3550bc22fd8bb!2zNTQgTMOqIFRoYW5oIE5naOG7iywgQsOhY2ggS2hvYSwgSGFpIELDoCBUcsawbmcsIEjDoCBO4buZaSwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1622187562590!5m2!1sen!2s" style="border:0; width: 100%;height: 300px;" allowfullscreen="" loading="lazy"></iframe>
		</div>
	</div>
<?php
	include_once('../layout/footer.php');
?>