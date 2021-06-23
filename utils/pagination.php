<?php 
echo	'<ul class="pagination">';
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
echo	'</ul>';