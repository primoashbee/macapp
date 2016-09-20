<?php require "config.php";
session_start();
$json=array();

if(!isset($_SESSION['isLoggedIn'])){
$json[0]=array('MSG'=>'NOT AUTHORIZED');
}else{
	if($_POST['request']=="fetch_all"){
		$sql = "Select * from teacher_information";
		$res = mysqli_query($conn,$sql);
		while($data=mysqli_fetch_array($res)){
			$json[]=array('MSG'=>'GOOD','name'=>$data['firstname']." ".$data['lastname'],'id'=>$data['id']);
		}
	}
}
echo json_encode($json);
?>