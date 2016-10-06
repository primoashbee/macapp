<?php 
require "config.php";
session_start();
$json=array();
header('Access-Control-Allow-Origin: *'); 
	if($_POST['request']=="fetch_all"){
		$sql = "Select * from qrystudentinformation";
		$res = mysqli_query($conn,$sql);
		while($data=mysqli_fetch_array($res)){
			$json[]=array('MSG'=>'GOOD','id'=>$data['id'],'fname'=>$data['firstname'],'lname'=>$data['lastname'],
				'bday'=>$data['birthday'],'sex'=>$data['sex'],'age'=>$data['age'],'email'=>$data['email'],'course'=>$data['course']);
		}
	}else if($_POST['request']=="update"){
		//id:id,fname:fname,lname:lname,bday:bday,age:age,course:course,sex:sex,email:email,request:'update'
		
		$id = mysql_escape_string($_POST['id']);
		$fname = mysql_escape_string($_POST['fname']);
		$lname = mysql_escape_string($_POST['lname']);
		$bday = mysql_escape_string($_POST['bday']);
		$age = mysql_escape_string($_POST['age']);
		$course = mysql_escape_string($_POST['course']);
		$sex = mysql_escape_string($_POST['sex']);
		$email = mysql_escape_string($_POST['email']);
		$sql="Update students_information set firstname='$fname',lastname='$lname',age='$age',birthday='$bday',sex='$sex',email='$email' where id = '$id'";
		if(mysqli_query($conn,$sql)){
			$json[0]=array('MSG'=>'INFORMATION UPDATED');
		}else{
			$json[0]=array('MSG'=>(mysqli_error($conn)));
		}
	}

echo json_encode($json);
?>