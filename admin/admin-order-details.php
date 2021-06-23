<!DOCTYPE html>
<html>
<head>
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Trang quản trị
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style type="text/css">
    .navbar a button {
      font-size: 18px;
      height: 55px;
      width: 230px;
      color: firebrick;
      background-color: cornsilk;
      margin-bottom: 10px;
      padding: 0px 15px 0px;
      text-align: left;
      border: 1px solid firebrick;
    }

    i {
      padding-right: 12px;
      color: #000;
    }

    li {
      list-style-type: none;
      color: #000;
      font-weight: bold;
    }

    body {
      background-color: ghostwhite;
    }

    h2 {
      color: steelblue;
    }

  </style>

</head>
<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="../home/index.php" >
          <div class="logo-image-big">
            <img src="https://static.wixstatic.com/media/4e382d_0d579ec3ec6241af9e1380ed79c56b7b~mv2.png/v1/fill/w_406,h_46,al_c,q_85,usm_0.66_1.00_0.01/Asset%202_3x.webp" style="width:325px; margin-top: 13px; margin-bottom: 9px;">
          </div>
        </a>
      </div>
<div class="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="../admin/edit-category.php">
              <i class="nc-icon nc-bullet-list-67"></i>
              <p>Danh mục sản phẩm</p>
            </a>
          </li>
          <li>
            <a href="../admin/edit-product.php">
              <i class="nc-icon nc-paper"></i>
              <p>Sản phẩm</p>
            </a>
          </li>
          <li>
            <a href="../admin/ungtuyen.php">
              <i class="nc-icon nc-badge"></i>
              <p>Tuyển dụng</p>
            </a>
          </li>
          <li>
            <a href="../admin/admin-gallery.php">
              <i class="nc-icon nc-album-2"></i>
              <p>Bộ sưu tập ảnh</p>
            </a>
          </li>
          <li>
            <a href="../admin/admin-feedback.php">
              <i class="nc-icon nc-send"></i>
              <p>Phản hồi</p>
            </a>
          </li>
          <li class="active">
            <a href="../admin/admin-orders.php">
              <i class="nc-icon nc-delivery-fast"></i>
              <p>Quản lý đơn hàng</p>
            </a>
          </li>
          <li>
            <a href="../user/logout.php">
              <i class="nc-icon nc-minimal-left"></i>
              <p>Đăng xuất</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" style="height: 1400px;">
      <div class="content">
      	<!-- content start here -->
<?php
require_once('../db/dbhelper.php');
require_once('../utils/utility.php');
$id = getGet('id');
$orderList = executeResult('select orders.address as address, user.fullname as fullname, orders.order_date as order_date, orders.phone_number as phone_number, orders.id
    from orders
    left join user on orders.user_id  = user.id where orders.id = '.$id, true);

$orderdetail = executeResult('select product.id as product_id, category.title as cate_title, product.title as product_title, product.price as product_price, order_details.quantity as detail_quantity, order_details.total_price as detail_totalprice
    from order_details
    left join product on order_details.product_id = product.id
    left join category on category.id = product.category_id where order_id =' .$id);
?>

<!-- <div class="container" style="margin-top: 10px;width: 1600px;"> -->
    <div class="panel panel-primary">
      <div class="panel-heading">
            <h2 class="text-center">Quản lý đơn hàng</h2>
          </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-4">
			<div class="card-header bg-info" style="color: white; text-align: center; height: 100px; padding: 5px;">
				<h4>Thông tin người nhận</h4>
			</div>
			<div class="card-body" style="background-color: white">
				<p>Họ và tên : <?=$orderList['fullname']?></p>
				<p>Số điện thoại : <?=$orderList['phone_number']?></p>
				<p>Địa chỉ : <?=$orderList['address']?></p>
				<p>Ngày đặt hàng : <?=$orderList['order_date']?></p>
			</div>
        </div>
        <div class="col-md-8">
          <div class="card-header bg-primary" style="color: white; text-align: center; height: 100px; padding: 5px;">
            <h4>Thông tin sản phẩm</h4>
          </div>
            <table class="table table-bordered" style="background-color: white;">
              <thead style="text-align: center;">
                <tr>
                  <th>STT</th>
                  <th>Mã sản phẩm</th>
                  <th>Danh mục sản phẩm</th> 
                  <th>Tên sản phẩm</th>
                  <th>Giá</th>
                  <th>Số lượng</th>
                  <th>Tổng tiền</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $count=0;
                  $tong = 0;
                  for ($i=0; $i < count($orderdetail) ; $i++) { 
                    echo '<tr>
                      <td>'.(++$count).'</td>
                      <td>'.$orderdetail[$i]['product_id'].'</td>
                      <td>'.$orderdetail[$i]['cate_title'].'</td>
                      <td>'.$orderdetail[$i]['product_title'].'</td>
                      <td>'.number_format($orderdetail[$i]['product_price'], 0, ',', '.').' VNĐ</td>
                      <td>'.$orderdetail[$i]['detail_quantity'].'</td>
                      <td>'.number_format($orderdetail[$i]['detail_totalprice'], 0, ',', '.').' VNĐ</td>
                    </tr>
                    ';
                    $tong += $orderdetail[$i]['detail_totalprice'];
                  }   
                ?>
              </tbody>
            </table>
            <h4 style="color:#29a5d6;">Tổng số tiền: <?=number_format($tong, 0, ',', '.')?> VNĐ</h4>
        </div>
      </div>
    </div>
  </div>
</div>  
</body>
</html>
		<!-- content end here -->
	</div>
</div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
</body>
</html>
