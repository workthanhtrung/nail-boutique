<?php 
	$title = "Nail | Thông Tin";
	require_once('../db/dbhelper.php');
	require_once('../utils/utility.php');
	require_once('../layout/header.php');
	 $users = validateToken();
	 $sql = "select * from user";
	 $dataList = executeResult($sql);
	$order_id = executeResult('select * from orders where user_id ='.$users['id'],true);
?>
<link rel="stylesheet" type="text/css" href="../css/myacc.css">	
<div class="nut">
	<a href="../user/myacc.php" style="text-decoration: none;">
	 <button type="button" class="button" style="outline: none;">
	  <span class="button__text">Tài khoản</span>
	  <span class="button__icon">
	    <ion-icon name="cloud-download-outline"><i class="fas fa-user"></i></ion-icon>
	  </span>
	</button>
	</a>
	<a href="../user/information-product.php" style="text-decoration: none;">
	  <button type="button" class="button" style="margin-top: 20px;outline: none;">
	    <span class="button__text">Đơn mua</span>
	    <span class="button__icon">
	      <ion-icon name="cloud-download-outline"><i class="fas fa-check"></i></i></ion-icon>
	    </span>
	  </button>
	</a>
</div>
<div style="height: 800px;font-family: 'Josefin Sans', sans-serif;">
	<div class="wrapper">
		<div class="left">
		    <!-- <img src="https://github.com/codingmarket07/CSS-User-Profile-Card/blob/master/alex.png?raw=true" 
		    alt="user" width="100"> -->
		    <h4><?=$users['fullname']?></h4>
		     <p>Sinh Viên</p>
		</div>
		<div class="right">
		    <div class="info">
		        <h3>THÔNG TIN</h3>
		        <div class="info_data">
		             <div class="data">
		                <h4>Email</h4>
		                <p><?=$users['email']?></p>
		             </div>
		             <div class="data">
		               <h4>Điện thoại</h4>
		                <p><?=$order_id['phone_number']?></p>
		          </div>
		        </div>
		    </div>
		  
		  	<div class="projects">
		        <div class="projects_data">
		             <div class="data">
		                <h4>Địa Chỉ</h4>
		                <p><?=$order_id['address']?></p>
		             </div>
		             
		        </div>
		    </div>
		  
		    <div class="social_media">
		        <ul>
		          <li><a href="../user/change-pwd.php">Đổi thông tin</a></li>
		      </ul>
		  </div>
		</div>
	</div>
</div>
<?php 
	require_once('../layout/footer.php');
?>