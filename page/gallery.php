<?php
$title ="Nail | Gallery";
include_once('../layout/header.php');
?>
 <link rel="stylesheet" type="text/css" href="style.css">

 <body style="background-color: #f8f8f8;">
	<div class="container" style="margin-top:10%; background-color: #f8f8f8;">
		<h1 style="margin-bottom:20px;"><span class="title">gallery</span></h1>
		<div class="gallery">
<?php
require_once '../utils/utility.php';
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