<?php 
require "config.php";
session_start();
$json=array();
if(!isset($_SESSION['isLoggedIn'])){
$json[0]=array('MSG'=>'NOT AUTHORIZED');
}else{
	$req = $_POST['request'];
	if($req == "fetch_all"){
		$sql = "Select * from subject_information";
		$res = mysqli_query($conn,$sql);
			while($data=mysqli_fetch_array($res)){
				$json[]=array('id'=>$data['id'],'code'=>$data['code'],'title'=>$data['title'],'units'=>$data['units'],'year'=>$data['year'],'sem'=>$data['sem'],'acad_year'=>$data['acad_year'],'teacher'=>$data['firstname']." ".$data['lastname']);
			}

	}
	
}
echo json_encode($json);
?>