<?php 
session_start();
$json=array();
 header('Access-Control-Allow-Origin: *'); 
$request = $_POST['request'];
if(isset($request)){
	if(!isset($_SESSION['isLoggedIn'])){
		$json[0]=array('MSG'=>1);
	}else{
		$json[0]=array('MSG'=>0);
	}
}else{
	$json[0]=array('MSG'=>0);
}
echo json_encode($json);


?>