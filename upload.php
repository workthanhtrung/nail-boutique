<?php
require_once ('utils/utility.php');
// $id = getGET('id');
// if ($id > 0) {
// 	//Edit
// 	$thisProduct = executeResult("select * from product where id = ".$id, true);
// } else {
// 	//Them moi
// 	$thisProduct = null;
// }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Product</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Add Product</h2>
			</div>
			<div class="panel-body">
				<form method="post" id="upload-file" action="?upload=file" enctype="multipart/form-data">
					<div class="form-group">
					  <label for="title">Title:</label>
					  <input required="true" type="text" class="form-control" id="title" name="title" value="<?=($thisProduct != null)?$thisProduct['title']:''?>">
					  <input type="text" name="id" value="<?=($thisProduct != null)?$thisProduct['id']:''?>" hidden>
					</div>
					<div class="form-group">
					  <label for="thumbnail">Thumbnail:</label>
					  <input type="file" class="form-control" id="fileupload" name="fileupload">
					  <img src="<?=($thisProduct != null)?$thisProduct['fileupload']:''?>" style="max-height: 200px;">
					</div>
					<a href="product-list.php"><button type="button" class="btn btn-default">Back product list</button></a>
					<button class="btn btn-success">Save</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>