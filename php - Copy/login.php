<?php 
require "config.php";
session_start();
$user = mysqli_real_escape_string($conn,$_POST['user']);
$pass = mysqli_real_escape_string($conn,$_POST['pass']);
$sql="Select * from users where username='".$user."' and passkey='".$pass."' and isDeleted=false";
$res = mysqli_query($conn,$sql);
$json=array();
if(mysqli_num_rows($res)){
	$data = mysqli_fetch_array($res);
	$role = $data['role'];
	$global_user = $user;
	if($role=="student"){
		$sql="Select * from qrystudentinformation where username='".$user."' and passkey='".$pass."'";
	}elseif($role=="teacher"){
		$sql="Select * from qryteacherinformation where username='".$user."' and passkey='".$pass."'";
	}
	$res = mysqli_query($conn,$sql);
	while($data=mysqli_fetch_array($res)){

		if($data['role']=='student'){
			$json[]=array('MSG'=>1,'ID'=>$data['id'],'USERNAME'=>$data['username'],'role'=>$data['role'],'firstname'=>$data['firstname'],'lastname'=>$data['lastname'],'age'=>$data['age'],'course'=>$data['course'],'sex'=>$data['sex'],'email'=>$data['email']);
		}elseif($data['role']=='teacher'){
			$json[]=array('MSG'=>1,'ID'=>$data['id'],'USERNAME'=>$data['username'],'role'=>$data['role'],'firstname'=>$data['firstname'],'lastname'=>$data['lastname'],'age'=>$data['age'],'sex'=>$data['sex'],'email'=>$data['email']);
		}else{
			$json[]=array('MSG'=>1,'USERNAME'=>$data['username'],'role'=>$data['role']);
		}
	}
}else{
		$json[]=array('MSG'=>0,'USERNAME'=>0,'role'=>0);
}
echo json_encode($json);
?>
