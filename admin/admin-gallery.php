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
    }

    li {
      list-style-type: none;
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
        <a href="../home/trangchu.php" >
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
            <a href="">
              <i class="nc-icon nc-ruler-pencil"></i>
              <p>Bài viết</p>
            </a>
          </li>
          <li class="active">
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
require_once '../utils/utility.php';
// require_once '../layout/admin-header.php';
?>
<style>
    #gallery{
        display: table;
    }

    #gallery li{
        list-style: none;
        float: left;
        width: 23%;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        margin: 10px 1%;
    }

    #gallery li img{
        width: 230px;
        height: 230px;
    }

    #gallery li input{
        width: 100%;
    }

</style>
    <body>
        <div class="container" style="margin-top: 10px;">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Quản lý thư viện ảnh </h2>
            </div>
            <form id="upload-file-form" action="?upload=file" method="POST" enctype="multipart/form-data" style="margin-left: 20%; margin-top: 40px; margin-bottom: 30px;"> 
                <label style="margin-right: 7%;font-weight: bold;padding: 10px;">Chọn hình ảnh: </label>
                <input multiple type="file" name="file_upload[]" />
                <input type="submit" value="Tải ảnh lên" />
            </form>
        <?php
        if (isset($_GET['upload']) && $_GET['upload'] == 'file') {
            $uploadedFiles = $_FILES['file_upload'];
            $errors = uploadFiles($uploadedFiles);
            if (!empty($errors)) {
                print_r($errors);
                exit;
            } else {
                echo "Tải lên thành công. <a  href='admin-gallery.php'>Xem lại thư viện ảnh</a>";
            }
            /**
             * Chú ý khi upload file
             * Trong file php.ini có các thông số max như sau: 
             * post_max_size = 8M // Dung lượng lớn nhất cho một lần upload
             * upload_max_filesize = 2M //Dung lượng file cho phép lớn nhất
             * max_file_uploads = 20 //Số lượng file upload tối đa
             * Các bạn muốn upload nhiều hơn thì thay các thông số này và restart lại wamp hoặc xamp
             */
        } else {
            ?>
    
                <h2 class="text-center">Danh sách ảnh</h2>
            <?php
            $baseURL = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $allFiles = getAllFiles();
            if (!empty($allFiles)) {
                ?>
                <ul id="gallery">
                    <?php foreach ($allFiles as $file) { ?>
                        <li>
                            <img src="<?= $file ?>"/>
                            <input style="display: none;" readonly="" type="text" value="<?= $baseURL .'/'. $file ?>" />
                            <a style="display: block; text-align: center;" href="admin-gallery-delete.php?url=<?=  urlencode($file)?>">Xóa</a>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        <?php } ?>
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
