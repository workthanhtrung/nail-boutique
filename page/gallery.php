<?php
$title ="Nail | Thư Viện Ảnh";
include_once('../layout/header.php');
require_once '../utils/utility.php';
?>
 <link rel="stylesheet" type="text/css" href="../css/style.css">

 <body style="background-color: #f8f8f8;">
            <?php   if(validateToken() != null) {?>
                    <div class="panel-heading" style="margin-top: 77px">
                <h2 class="text-center">Tải ảnh lên thư viện ảnh</h2>
            </div>
            <form id="upload-file-form" action="?upload=file" method="POST" enctype="multipart/form-data" style="margin-left: 20%; margin-top: 28px; margin-bottom: -80px;"> 
                <div style="width: 100%; display: flex;">
                     <label style="margin-right: 7%;font-weight: bold;padding: 10px;">Chọn hình ảnh: </label>
                    <input class="tai" multiple type="file" name="file_upload[]" />
                    <input class="len" type="submit" value="Tải ảnh lên" />
                </div>
            </form>
<?php } ?>
        <?php
        if (isset($_GET['upload']) && $_GET['upload'] == 'file') {
            $uploadedFiles = $_FILES['file_upload'];
            $errors = uploadFiles($uploadedFiles);
            if (!empty($errors)) {
                print_r($errors);
                exit;
            } else {
                echo "Tải lên thành công.";
            }
            /**
             * Chú ý khi upload file
             * Trong file php.ini có các thông số max như sau: 
             * post_max_size = 8M // Dung lượng lớn nhất cho một lần upload
             * upload_max_filesize = 2M //Dung lượng file cho phép lớn nhất
             * max_file_uploads = 20 //Số lượng file upload tối đa
             * Các bạn muốn upload nhiều hơn thì thay các thông số này và restart lại wamp hoặc xamp
             */
        } 

           ?>     
        
              
    <div class="container" style="margin-top:10%; background-color: #f8f8f8;">
        <h1 style="margin-bottom:20px;"><span class="title">gallery</span></h1>
        <div class="gallery">
<?php

        $allFiles = getAllFiles();
        if (!empty($allFiles)) {
            ?>
            <ul>
                <?php foreach ($allFiles as $file) { ?>
                    <li>
                        <img src="<?= $file ?>"/>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
        </div>
    </div> 
</body>
<?php 
include_once('../layout/footer.php');
?>