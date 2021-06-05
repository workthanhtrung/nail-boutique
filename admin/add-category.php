<?php
require_once('form-category.php');
require_once('../layout/admin-header.php');

$categoryList = executeResult('select * from category');
$id = getGet('id');
if ($id > 0) {
	$thisCategory = executeResult('select * from category where id = '.$id, true);
}else {
	$thisCategory = null;
}

?>

	<div class="container" style="width: 90%;">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Trang chỉnh sửa danh mục</h2>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<label for="title">Tên danh mục sản phẩm:</label>
						<input required="true" type="text" class="form-control" id="title" name="title" value="<?=($thisCategory != null)?$thisCategory['title']:''?>">
						<input type="text" name="id" value="<?=($thisCategory != null)?$thisCategory['id']:''?>" style="display: none;">
					</div>
					<a href="edit-category.php"><button class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i>Lưu</button></a>
					<a href="edit-category.php"><button type="button" class="btn btn-info" style="float: right;"><i class="fa fa-times" aria-hidden="true"></i>Quay lại </button></a>
				</form>
			</div>
		</div>
	</div>

