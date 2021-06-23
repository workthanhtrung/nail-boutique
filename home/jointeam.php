<?php
	$title = "Nail | Tuyển Dụng";
	include_once('../layout/header.php');
?> 

<body>
	<link rel="stylesheet" type="text/css" href="../css/jointeam.css">
	<div style="width: 1360px;height: 1211px;display: flex;">
		<div class="join1" style="	width: 680px;height: 1184px;left: 79.5px; ">
			<p class="font_a" style="vertical-align: initial;">Tham gia nhóm NB của chúng tôi</p>

			<div style="margin: 79px; line-height: 27px;">
				<p class="font_b">Tại NB, mọi người đều đóng góp một phần vào sự phát triển của chúng tôi!</p>

				<P class="font_b">Chúng tôi luôn tìm kiếm những người tuyệt vời để tham gia vào nhóm của chúng tôi và chia sẻ các giá trị cốt lõi của chúng tôi! Nếu bạn là một chuyên gia làm đẹp được cấp phép, vui lòng gọi cho chúng tôi và chúng tôi sẽ sẵn lòng nói chuyện với bạn!</P>

				<p class="font_b">Hãy cho chúng tôi biết cách chúng tôi có thể giúp bạn phát triển cùng với chúng tôi!</p>
			</div>
			<div style="width: 680px;height: 558px; margin-left: 40px;">
				<form method="POST">
					<div class="input_join">
						<input required="true" type="text" name="fullname" placeholder="Họ Và Tên">
					</div>
					<div class="input_join">
						<input required="true" type="email" name="email" placeholder="Email">
					</div>
					<div class="input_join">
						<input required="true" type="text"  name="phone_number" placeholder="Số Điện Thoại" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
					</div>
					<div class="input_join">
						<select name="positon" id="test" onchange="document.getElementById('text_content').value=this.options[this.selectedIndex].text">
							<option disabled selected>Vị Trí Ứng Tuyển</option>
							<option value="Chuyên Gia Thẩm Mỹ">Chuyên Gia Thẩm Mỹ</option>
							<option value="Kỹ Thuật Viên Làm Món">Kỹ Thuật Viên Làm Móng</option>
							<option value="Chuyên Gia Trị Liệu Xoa Bóp">Chuyên Gia Trị Liệu Xoa Bóp</option>
							<option value="Lễ Tân">Lễ Tân</option>
							<input type="hidden" name="test_text" id="text_content" value="">
						</select>
					</div>
					<!-- <div class="input_join">
						<input id="txtDate" type="date" name="date" placeholder="Ngày Hẹn">
					</div> -->
					<div class="input_join">
						<input  required="true" type="text" name="link_cv" placeholder="Link CV">
					</div>
					<button style="margin-top: 42px;margin-left: 231px;font-size: 24px;padding-left: 30px;padding-right: 30px;" class="btn btn-dark">Gửi</button>


				</form>
			</div>
		</div>
		<div class="join2" style="	width: 680px;height: 1184px;right: 79.5px;">

		</div>
	</div>
	<script type="text/javascript">
	</script>
<?php
$fullname = $email = $phone_number = $position = $link_cv = '';
if(!empty($_POST)) {
	if(getPost('test_text') == "") {
		echo "<script>
		alert('Vui lòng chọn một vị trí ứng tuyển !!!');
		window.location.href='../home/jointeam.php';
		</script>";
    } else {
        $position = getPost('test_text');
        // $alert2 = 'Bạn đã chọn: ' . $position;
        // echo $alert2;
        echo "<script>
		alert('Cảm ơn bạn ! Chúng tôi sẽ phản hồi lại sớm nhất có thể.');
		</script>";
    	
	$fullname = getPost('fullname');
	$email = getPost('email');
	$phone_number = getPost('phone_number');
	$link_cv = getPost('link_cv');
	$created_at = $updated_at = date('Y-m-d H:i:s');
	
	$sql = "insert into recruitment (fullname, email, phone_number, position, link_cv, created_at, updated_at) values ('$fullname', '$email', '$phone_number', '$position', '$link_cv', '$created_at', '$updated_at')";
	execute($sql);
	}
}
?>

<?php
	include_once('../layout/footer.php');
?>