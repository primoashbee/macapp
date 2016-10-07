<?php 
session_start();
$json=array();
header('Access-Control-Allow-Origin: *'); 
$request = $_POST['request'];

		$json[0]=array('MSG'=>1);

echo json_encode($json);
?>