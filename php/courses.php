<?php
require "config.php";
session_start();
$json=array();

if(!isset($_SESSION['isLoggedIn'])){
$json[0]=array('MSG'=>'NOT AUTHORIZED');
}else{
	if($_POST['request']=="fetch_all"){
		$sql="Select * from course where isDeleted = false";
		$res = mysqli_query($conn,$sql);
		while($data=mysqli_fetch_array($res)){
			$json[]=array('id'=>$data['id'],'course'=>$data['name'],'desc'=>$data['description']);		
		}
		
	}elseif($_POST['request']=="create"){
		$course = htmlspecialchars($_POST['course']);
		$desc= htmlspecialchars($_POST['desc']);
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
		$course = htmlspecialchars($_POST['course']);
		$id = htmlspecialchars($_POST['id']);
		$desc= htmlspecialchars($_POST['desc']);
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
		$id = htmlspecialchars($_POST['id']);
		$sql = "Update course set isDeleted = TRUE where id ='$id'";
		
		if(mysqli_query($conn,$sql)){
			$json[0]=array('MSG'=>'COURSE DELETED!');
		}else{
			$json[0]=array('MSG'=>'COURSE 404!');
		}
	}
}

echo json_encode($json);
?>