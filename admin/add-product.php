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
          <li>
            <a href="../admin/edit-category.php">
              <i class="nc-icon nc-bullet-list-67"></i>
              <p>Danh mục sản phẩm</p>
            </a>
          </li>
          <li class="active">
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
require_once('form-product.php');

$categoryList = executeResult('select * from category');
$id = getGet('id');
if ($id > 0) {
	$thisProduct = executeResult('select * from product where id = '.$id, true);
}else {
	$thisProduct = null;
}

?>


	<div class="container" style="width: 90%;">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Trang chỉnh sửa sản phẩm </h2>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<label for="title">Tên sản phẩm:</label>
						<input required="true" type="text" class="form-control" id="title" name="title" value="<?=($thisProduct != null)?$thisProduct['title']:''?>">
						<input type="text" name="id" value="<?=($thisProduct != null)?$thisProduct['id']:''?>" style="display: none;">
					</div>
					<div class="form-group">
						<label for="thumbnail">Hình ảnh:</label>
						<input required="true" type="text" class="form-control" id="thumbnail" name="thumbnail" value="<?=($thisProduct != null)?$thisProduct['thumbnail']:''?>">
					</div>
					<div class="form-group">
						<label for="price">Giá:</label>
						<input required="true" min="0.01" step="0.01" type="number" class="form-control" id="price" name="price" value="<?=($thisProduct != null)?$thisProduct['price']:''?>">
					</div>
					<div class="form-group">
						<label for="price">Số lượng: </label>
						<input required="true" min="0" step="1" type="number" class="form-control" id="quantity" name="quantity" value="<?=($thisProduct != null)?$thisProduct['quantity']:''?>">
					</div>
					<div class="form-group">
						<label for="category_id">Danh mục sản phẩm:</label>
						<select required="true" class="form-control" id="category_id" name="category_id">
							<option value="">-- Chọn danh mục --</option>
							<?php
								foreach ($categoryList as $item) {
									if($thisProduct != null && $item['id'] == $thisProduct['category_id']) {
										echo '<option selected value="'.$item['id'].'">'.$item['title'].'</option>';
									} else {
										echo '<option value="'.$item['id'].'">'.$item['title'].'</option>';
									}
								}
							?>
					  </select>
					</div>
					<div class="form-group">
						<label for="content">Content:</label>
						<textarea class="form-control" id="content" name="content" rows="5"><?=($thisProduct != null)?$thisProduct['content']:''?></textarea>
					</div>
					<!-- <a href="edit-product.php"> -->
						<button class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i>Lưu</button>
					<!-- </a> -->
					<a href="edit-product.php"><button type="button" class="btn btn-info" style="float: right;"><i class="fa fa-times" aria-hidden="true"></i>Quay lại </button></a>
				</form>
			</div>
		</div>
	</div>

<script type="text/javascript">
	$(document).ready(function() {
	   $('#content').summernote({
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['misc', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
          ]
      });
	});
</script>

<?php
include_once('../layout/admin-footer.php');
?>
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
