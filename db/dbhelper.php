<?php
require_once('config.php');

/**
* Su dung cho cac lenh: insert, update, delete
*/
function initDB($sql) {
	//Mo ket noi toi database
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD);
	mysqli_set_charset($conn, 'utf8');

	//query
	mysqli_query($conn, $sql);

	//Dong ket noi
	mysqli_close($conn);
}

/**
* Su dung cho cac lenh: insert, update, delete
*/
function execute($sql) {
	//Mo ket noi toi database
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	mysqli_set_charset($conn, 'utf8');

	//query
	mysqli_query($conn, $sql);

	//Dong ket noi
	mysqli_close($conn);
}

/**
* Su dung cho cac lenh: select
*/
function executeResult($sql, $onlyOne = false) {
	//Mo ket noi toi database
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	mysqli_set_charset($conn, 'utf8');

	//query
	$resultset = mysqli_query($conn, $sql);

	if($onlyOne) {
		//tra ve 1 object
		$data = mysqli_fetch_array($resultset, 1);
	} else {
		$data = [];
		while(($row = mysqli_fetch_array($resultset, 1)) != null) {
			//tra ve 1 mang
			$data[] = $row;
		}
	}
	//Dong ket noi
	mysqli_close($conn);

	return $data;
}

