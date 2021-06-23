<?php
require_once('../db/dbhelper.php');

if(!empty($_POST)) {
	$sql = "create database if not exists ".DATABASE;
	initDB($sql);

	$sql = "create table if not exists user (
		id int primary key auto_increment,
		fullname varchar(50),
		email varchar(50),
		password varchar(32),
		token varchar(100),
		created_at datetime,
		updated_at datetime
	)";
	execute($sql);

	$sql = "create table if not exists category (
		id int primary key auto_increment,
		title varchar(50),
		created_at datetime,
		updated_at datetime
	)";
	execute($sql);

	$sql = "create table if not exists product (
		id int primary key auto_increment,
		category_id int references category (id),
		title varchar(50),
		price float,
		quantity int not null,
		thumbnail varchar(200),
		content varchar(2000),
		created_at datetime,
		updated_at datetime
	)";
	execute($sql);

	$sql = "create table if not exists gallery (
		id int primary key auto_increment,
		thumbnail varchar(200),
		title varchar(50),
		created_at datetime,
		updated_at datetime
	)";
	execute($sql);

	$sql = "create table if not exists orders (
		id int primary key auto_increment,
		user_id int references user (id),
		order_date datetime,
		address varchar(200),
		phone_number varchar(20),
		note varchar(500),
		created_at datetime,
		updated_at datetime
	)";
	execute($sql);

	$sql = "create table if not exists order_details  (
		id int primary key auto_increment,
		order_id int references orders (id),
		product_id int references product (id),
		quantity int,
		total_price float,
		created_at datetime,
		updated_at datetime
	)";
	execute($sql);

	$sql = "create table if not exists feedback (
		id int primary key auto_increment,
		user_id int references user (id),
		title varchar(100),
		picture varchar(200),
		note varchar(500),
		created_at datetime,
		updated_at datetime
	)";
	execute($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Init Database</title>
	<meta charset="utf-8">
</head>
<body>
	<h1 style="text-align: center;">Init DataBase</h1>
	<h3 style="text-align: center;">
		<form method="post">
			<button name="action" value="init_database">Start Init DataBase</button>
		</form>
	</h3>
</body>
</html>