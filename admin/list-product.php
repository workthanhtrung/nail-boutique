<?php
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
var_dump($total);

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
			order by product.title DESC limit $start, $limit ");
?>


<link rel="stylesheet" type="text/css" href="../css/list-product.css">
<body>
	<div class="about" >
			<div class="text-ab">
				<h1 style="width: 920px;height: 215px;">
					<span style="color: #fff;">
						<font style="vertical-align: inherit;">
							<font class="font" style="vertical-align: inherit;">sản phẩm chất lượng tốt nhất luôn được chúng tôi chọn lọc và đảm bảo
							</font>
						</font>
					</span>
				</h1>
			</div>
		</div>
<form style="margin-top: 78px;display: flex;" class="search-box" method="get">
	<!-- <input type="text" name="search" placeholder="Tìm Kiếm"> -->
	<input type="text" name="search" placeholder="Tìm Kiếm">
	<button class="search-btn" type="submit" name="button" style="outline: none;">
	<i class="fas fa-search"></i>
	</button>
</form>
<section  class="product-section" style="margin-top: 54px;">
	<div class="container-fluid">
		<div class="col-md-12"><h3 class="title-pro">Danh sách sản phẩm</h3></div>
		<div class="row">
			<div class="col-md-3">
				<div class="box1">
					<h3 style="text-align: center;"> Danh mục sản phẩm </h3>
					<ul>
					<?php
						$count = 0;
						$cate = executeResult("select * from category");
						// var_dump($cate.id);
						foreach ($cate as $item) {
							$cate_id = $item['id'];

							echo '<li>
							<a href="../admin/list-product.php?category='.$item['id'].'" style="text-decoration: none;color:#000;"><span>'.(++$count).'</span>'.$item['title'].'</a>
							</li>';
						}
					?>
				</ul>
				</div>
			</div>
			<div class="col-md-9">
				
					<div class="row">
		<?php
		foreach ($data as $item) {
			echo '<div class="col-md-3">
						<div class="product-box">
							<div class="product-img">
								<a href="../cart/detail.php?id='.$item['id'].'"><img src="'.$item['thumbnail'].'" style="width: 100%"></a>
							</div>

							<div class="product-content" href="../cart/detail.php?id='.$item['id'].'">
								<a style="text-decoration: none;" href="../cart/detail.php?id='.$item['id'].'"><h4 style="height: 34.91px;margin-top:5px" >'.$item['title'].'</h4></a>

								<div class="price">
									<p >'.number_format($item['price'], 0, '', '.').' VND</p>
								</div>		
							<button style="margin-top: 8px;color: #fff" class="btn-dark" onclick="addToCart('.$item['id'].')"></i> Thêm vào giỏ</button>
							</div>
				        </div>							
				 </div>';
		}
		?>							
				</div>		
			</div>
		</section>
			<div class="container" style="margin-bottom: 5%; margin-left: 43%;">
				<div class="pagination">
					<?php
						if ($page > 1 ) {
							echo '<a href="'.$href.'page='.($page -1).'" class="previous s"><i class="fa fa-angle-left"></i></a>';
						}

						$pageList = [1, $page-1 ,$page, $page+1, $totalPages];

						$isFirst = $isBefore = false;
						for ($i=1; $i <= $totalPages; $i++) { 
							if (!in_array($i, $pageList)) {
								if (!$isFirst && $i < $page) {
									$isFirst = true;
									echo '<a href="'.$href.'page='.($page - 2).'" class="btn ">...</a>';
								}
								if (!$isBefore && $i > ($page+1)) {
									$isBefore = true;
									echo '<a href="'.$href.'page='.($page + 2).'" class="btn ">...</a>';
								}
								continue;
							}
							if ($i == $page) {
								echo '<a href="'.$href.'page='.$i.'" class="btn active">'.$i.'</a>';
							} else {
								echo '<a href="'.$href.'page='.$i.'" class="btn active">'.$i.'</a>';
							}
						}
						if ($page < $totalPages) {
							echo '<a href="'.$href.'page='.($page +1).'" class="next "><i class="fa fa-angle-right"></i></a>';
						}
					?>
				</div>
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
	$(document).ready(function(){
  var $listItems = $('.pagination a');

  $listItems.click(function(){
    $listItems.removeClass('active');
    $(this).addClass('active');  

  });
});
</script>

	
