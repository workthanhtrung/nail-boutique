<?php
require_once('../db/dbhelper.php');
require_once('../utils/utility.php');

if(!empty($_POST)) {
	$action = getPost('action');

	switch ($action) {
		case 'delete':
			deletevn();
			break;
		default:
	}
}
function deletevn() {
	$id = getPost('id');
	$sql = 'delete from recruitment where id = '.$id;
	execute($sql);
}