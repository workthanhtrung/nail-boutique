<?php
require_once('form-product.php');
include_once('../layout/admin-header.php');

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