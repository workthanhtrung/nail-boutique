<?php
// session_start();

$title = 'Nail | Product Page';
include_once('../layout/header.php');
require_once('../db/dbhelper.php');
require_once('../utils/utility.php');
require_once('../cart/api-product.php');

$category=getGET('category');
if ($category !='') {
	$tail1=' and category_id ='.$category;
}else{ 
	$tail1= '';
}

$search = getGet('search');
if ($search != '') {
	$tail2 = " and product.title like '%$search%' ";
} else {
	$tail2 = '';
}

$totalItems = executeResult("select count(*) 'dem' from product join category 
	where
		product.category_id = category.id".$tail1.$tail2, true);

$total = $totalItems['dem'];
// var_dump($total);

$href = 'list-product.php?category='.$category.'&search='.$search.'&';

$page = getGet('page');
if ($page == '') {
	$page = 1;
}

$limit = 8;
$totalPages = ceil($total/$limit);
$start = ($page - 1) * $limit;

$data = executeResult("select product.* from product join category
	where
		product.category_id = category.id ".$tail1.$tail2."
			order by product.title asc limit $start, $limit ");
?>


<link rel="stylesheet" type="text/css" href="list-product.css">
<body>
 	<form style="margin-top: 50px;display: flex;margin-left: 1007px;" method="get">
		<input type="text" name="search" placeholder="Tìm Kiếm">
		<button class="search-btn"><i class="fas fa-search"></i></button>
	</form>
<section  class="product-section" style="margin-top: 54px;">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<ul style="list-style-type:none;">
					<?php
						$cate = executeResult("select * from category");
						// var_dump($cate.id);
						foreach ($cate as $item) {
							$cate_id = $item['id'];

							echo '<li>
									<a href="../admin/list-product.php?category='.$item['id'].'">'.$item['title'].'</a>
								</li>';
						}
					?>
				</ul>
				
			</div>
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-12"><h3 class="title-pro">product-List</h3></div>
		<?php
		foreach ($data as $item) {
			echo '<div class="col-md-3">
						<div class="product-box">
							<div class="product-img">
								<p href="../cart/detail.php?id='.$item['id'].'"><img src="'.$item['thumbnail'].'" style="width: 100%"></p>
							</div>

							<div class="product-content">
								<a href="../cart/detail.php?id='.$item['id'].'"  style="text-decoration: none;"><h4 style="height: 34.91px;" >'.$item['title'].'</h4></a>

								<div class="price">
									<p >'.number_format($item['price'], 0, '', '.').' VND</p>
								</div>		
							<button style="margin-bottom: 10px;color: #fff" class="btn-dark" onclick="addToCart('.$item['id'].')"></i> Thêm vào giỏ</button>
							</div>
				        </div>							
				 </div>';
		}
		?>							
				</div>		
			</div>
		</section>
			<div class="container" style="margin-bottom: 5%; margin-left: 43%;">
				<ul class="pagination">
					<?php
						if ($page > 1 ) {
							echo '<li class="page-item"><a class="page-link" href="'.$href.'page='.($page -1).'">Previous</a></li>';
						}

						$pageList = [1, $page-1 ,$page, $page+1, $totalPages];

						$isFirst = $isBefore = false;
						for ($i=1; $i <= $totalPages; $i++) { 
							if (!in_array($i, $pageList)) {
								if (!$isFirst && $i < $page) {
									$isFirst = true;
									echo '<li class="page-item"><a class="page-link" href="'.$href.'page='.($page - 2).'">...</a></li>';
								}
								if (!$isBefore && $i > ($page+1)) {
									$isBefore = true;
									echo '<li class="page-item"><a class="page-link" href="'.$href.'page='.($page + 2).'">...</a></li>';
								}
								continue;
							}
							if ($i == $page) {
								echo '<li class="page-item active"><a class="page-link" href="'.$href.'page='.$i.'">'.$i.'</a></li>';
							} else {
								echo '<li class="page-item"><a class="page-link" href="'.$href.'page='.$i.'">'.$i.'</a></li>';
							}
						}
						if ($page < $totalPages) {
							echo '<li class="page-item"><a class="page-link" href="'.$href.'page='.($page +1).'">Next</a></li>';
						}
					?>
				</ul>
			</div>

			</div>
		</div>
		
<?php
	include_once('../layout/footer.php');
?>
<script type="text/javascript">
	function addToCart(id) {
        alert('Thêm vào giỏ thành công! Hãy kiểm tra giỏ hàng.')
		$.post('../cart/api-product.php', {
			'action': 'add',
			'id':id,
			'num': 1
		}, function(data) {
			location.reload()
		})
	}
</script>

	
