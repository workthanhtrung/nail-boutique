<?php	if(validateToken() != null) {?>
			<li class="nav-item active dropdown">
		        <a class="nav-link dropdown-toggle" href=""><?=$users['fullname']?></a>
		     <div class="dropdown-menu" style="border: none; font-weight: bold;line-height: 30px;">
		        <a style="font-weight: bold;" class="dropdown-item" href="">Thông Tin Tài Khoản</a>
		        <a style="font-weight: bold;" class="dropdown-item" href="../user/logout.php">Đăng Xuất</a>
		     </div>
		    </li>
<?php	}else{ ?>
		<li class="nav-item active">
	      <a class="nav-link" href="../user/login.php"><i class="bi bi-door-open-fill"></i>Đăng Nhập</a>
	    </li>
<?php	} ?>
  

list category
              <?php
                    foreach ($categoryList as $item) {
                      echo '<li>
                        <a href="../admin/list-product.php?id='.$item['id'].'">'.$item['title'].'</a>';
                      echo "</li>";
                    }
                    ?>