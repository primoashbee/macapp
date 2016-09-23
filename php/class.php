<?php 
require "config.php";
session_start();
$json=array();
function getStudentList($id){
	require "config.php";
	$sql = "Select * from class_list where id ='$id'";

	$res = mysqli_query($conn,$sql);
	while($data=mysqli_fetch_array($res)){
		$json[]=array('fname'=>$data['firstname'],'lname'=>$data['lastname']);
	}
	return $json;
}
if(!isset($_SESSION['isLoggedIn'])){
$json[0]=array('MSG'=>'NOT AUTHORIZED');
}else{
$req = $_POST['request'];
	if($req == "fetch_all"){
		$sql = "Select * from class_summary";
		$res = mysqli_query($conn,$sql);
			while($data=mysqli_fetch_array($res)){
			
			$json[]=array('id'=>$data['id'],'code'=>$data['code'],'title'=>$data['title'],'units'=>$data['units'],'year'=>$data['year'],'sem'=>$data['sem'],'acad_year'=>$data['acad_year'],'teacher'=>$data['firstname']." ".$data['lastname'],'t_id'=>$data['t_id'],'isDeleted'=>$data['isdeleted'],'count'=>$data['student_count']);
			}	
	}else if($req=="get_list_by_id"){
		//$json[]=getStudentList($_POST['id']);
		$id = $_POST['id'];
		$sql = "Select * from class_list where id ='$id'";
		
		$res = mysqli_query($conn,$sql);
		$json=array();
		
			while($data=mysqli_fetch_array($res)){
				$json[]=array('id'=>$data['id'],'fname'=>$data['firstname'],'lname'=>$data['lastname']);
			
		}
	}
}
echo json_encode($json);
?>