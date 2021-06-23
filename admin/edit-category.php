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
      font-weight: bold;
    }

    li {
      list-style-type: none;
      color: #000;
      font-weight: bold;
    }

    body {
      background-color: white;
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
          <li class="active">
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
          <li>
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

require_once('form-category.php');
?>

	<div class="container" style="margin-top: 10px;">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Quản lý danh mục sản phẩm </h2>
			</div>
			<div class="panel-body">
				<a href="add-category.php"><button class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i>Thêm danh mục sản phẩm mới</button></a>	


				<table class="table table-bordered" style="margin-top: 10px;background-color: white">

					<thead>
						<tr>
							<th>STT</th>
							<th>Tên </th>
							<th>Ngày tạo </th>
							<th>Ngày cập nhật </th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
<?php 
	$num_page = 10;
	$page = 1;
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	}
	$index = ($page - 1) * $num_page;
	//gia du page 1 -> index = (1-1)*6 = 0
	//page 2 -> index = (2-1)*6= 6

	//tim tong so san pham trong database
	$sql = 'select count(*) total from category';
	$categoryList = executeResult($sql);
	$total = $categoryList[0]['total'];

	//lay so sp chia cho so sp tren 1 trang -> ra duoc so trang, lam tron len.
	$totalPage = ceil($total/$num_page);

	//lay tu product o vi tri index, lay num_page phan tu
	$sql = "select id, title, created_at, updated_at from category limit ".$index.','.$num_page;
	$categoryList = executeResult($sql);

	$count = $index;

	// $count = 0;
	foreach ($categoryList as $item) {
		echo '<tr>
				<td style="width:70px;">'.++$count.'</td>
				<td>'.$item['title'].'</td>
				<td style="width:200px;">'.$item['created_at'].'</td>
				<td style="width:200px;">'.$item['updated_at'].'</td>
				<td style="width:110px;"><a href="add-category.php?id='.$item['id'].'"><button class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Sửa</button></a></td>
				<td style="width:110px;"><button class="btn btn-danger" onclick="deleteCategory('.$item['id'].')"><i class="fa fa-trash-o" aria-hidden="true"></i>Xóa</button></td>
			</tr>';
}
?>
					</tbody>
				</table>
				<ul class="pagination">
					<?php
						if ($page >1 ) {
							echo '<li class="page-item"><a class="page-link" href="?page='.($page -1).'">Previous</a></li>';
						}

						$pageList = [1, $page-1 ,$page, $page+1, $totalPage];

						$isFirst = $isBefore = false;
						for ($i=1; $i <= $totalPage; $i++) { 
							if (!in_array($i, $pageList)) {
								if (!$isFirst && $i < $page) {
									$isFirst = true;
									echo '<li class="page-item"><a class="page-link" href="?page='.($page - 2).'">...</a></li>';
								}
								if (!$isBefore && $i > ($page+1)) {
									$isBefore = true;
									echo '<li class="page-item"><a class="page-link" href="?page='.($page + 2).'">...</a></li>';
								}
								continue;
							}
							if ($i == $page) {
								echo '<li class="page-item active"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
							} else {
								echo '<li class="page-item"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
							}
						}
						if ($page < $totalPage) {
							echo '<li class="page-item"><a class="page-link" href="?page='.($page +1).'">Next</a></li>';
						}
					?>
				</ul>
			</div>
		</div>
	</div>
<script type="text/javascript">
	function deleteCategory(id) {
		option = confirm('Bạn chắc chắn muốn xóa danh mục sản phẩm này ??')
		if (!option) return

		$.post('form-category.php', {
			'action': 'delete',
			'id': id
		}, function(data) {
			location.reload();
		})
	}
</script>
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
