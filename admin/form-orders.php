<?php
require_once('../db/dbhelper.php');
require_once('../utils/utility.php');

$title = '';

if (!empty($_POST)) {
	$action = getPost('action');

	switch ($action) {
		case 'delete':
			deleteOrder();
			break;
		default:

			break;
	}
}

function deleteOrder() {
	$id  = getPost('id');
	$sql =  'delete orders.*,order_details.* from orders,order_details where id = '.$id;
	execute($sql);
}

