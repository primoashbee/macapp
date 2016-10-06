<?php
require "config.php";
session_start();
$json=array();
header('Access-Control-Allow-Origin: *'); 
	if($_POST['request']=="fetch_all"){
		$sql="Select * from course where isDeleted = false";
		$res = mysqli_query($conn,$sql);
		while($data=mysqli_fetch_array($res)){
			$json[]=array('id'=>$data['id'],'course'=>$data['name'],'desc'=>$data['description']);		
		}
		
	}else if($_POST['request']=="fetch_with_archive"){
		$sql="Select * from course";
		$res = mysqli_query($conn,$sql);
		while($data=mysqli_fetch_array($res)){
			$json[]=array('id'=>$data['id'],'course'=>$data['name'],'desc'=>$data['description'],'isDeleted'=>$data['isDeleted']);		
		}
		
	}else if($_POST['request']=="create"){
		$course = mysqli_real_escape_string($conn,$_POST['course']);
		$desc= mysqli_real_escape_string($conn,$_POST['desc']);
		$sql="Select * from course where name='$course'";
		$res = mysqli_query($conn,$sql);
			if(mysqli_num_rows($res)){
				$json[0]=array('MSG'=>'EXISTING COURSE');
			}else{
				$sql = "Insert into course(name,description,isDeleted)values('".$course."','".$desc."',FALSE)";
				if(mysqli_query($conn,$sql)){
					$json[0]=array('MSG'=>'COURSE ADDED!');
				
				}else{
					$json[0]=array('MSG'=>'ERROR 404');
				}			
			}
	
	}else if($_POST['request']=="update"){
		$course = mysqli_real_escape_string($conn,$_POST['course']);
		$id = mysqli_real_escape_string($conn,$_POST['id']);
		$desc= mysqli_real_escape_string($conn,$_POST['desc']);
		/*$sql="Select * from course where name='$course'";
		$res = mysqli_query($conn,$sql);
			if(mysqli_num_rows($res)){
				$json[0]=array('MSG'=>'EXISTING COURSE');
			}else{*/
				$sql = "update course set description='$desc' where id='$id' ";
				if(mysqli_query($conn,$sql)){
					$json[0]=array('MSG'=>'COURSE UPDATED!');
				
				}else{
					$json[0]=array('MSG'=>'ERROR 404');
				}			
			//}
	}else if($_POST['request']=="delete"){
		$id = mysqli_real_escape_string($conn,$_POST['id']);
		$sql = "Update course set isDeleted = TRUE where id ='$id'";
		
		if(mysqli_query($conn,$sql)){
			$json[0]=array('MSG'=>'COURSE DELETED!');
		}else{
			$json[0]=array('MSG'=>'COURSE 404!');
		}
	}else if($_POST['request']=="recover"){
		$id = mysqli_real_escape_string($conn,$_POST['id']);
		$sql = "Update course set isDeleted = false where id ='$id'";
		
		if(mysqli_query($conn,$sql)){
			$json[0]=array('MSG'=>'COURSE RECOVERED');
		}else{
			$json[0]=array('MSG'=>'COURSE 404!');
		}
	}
echo json_encode($json);
?>