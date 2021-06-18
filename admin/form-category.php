<?php
	require_once('../db/dbhelper.php');
	require_once('../utils/utility.php');

if (!empty($_POST)) {
	$action = getPost('action');

	switch ($action) {
		case 'delete':
			deleteCategory();
			break;
		default:
			$id = getPost('id');
			if ($id > 0) {
				updateCategory();
			} else {
				addCategory();
			}

			break;
	}
}

function deleteCategory() {
	$id  = getPost('id');
	$sql =  'delete from category where id = '.$id;
	execute($sql);
}

function addCategory()	{
	$title = '';

	$title = getPost('title');
	$created_at = $updated_at = date('Y-m-d H:i:s');

	$sql = "insert into category (title, created_at, updated_at) values ('$title', '$created_at', '$updated_at')";
	execute($sql);
	header('Location: edit-category.php');
}

function updateCategory()	{
	$title = '';

	$title = getPost('title');
	$id = getPost('id');

	$updated_at = date('Y-m-d H:i:s');

	$sql = "update category set title = '$title', updated_at = '$updated_at' where id = $id";
	execute($sql);
	header('Location: edit-category.php');
}