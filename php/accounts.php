<?php 
require "config.php";
session_start();
$json=array();

if(!isset($_SESSION['isLoggedIn'])){
$json[0]=array('MSG'=>'NOT AUTHORIZED');
}else{
	$request  = $_POST['request'];
	if($request=="fetch_all"){
		$sql ="Select * from users where role !='admin'";
		$res = mysqli_query($conn,$sql);
			while($data=mysqli_fetch_array($res)){
				$json[]=array('MSG'=>1,'id'=>$data['id'],'username'=>$data['username'],'password'=>$data['passkey'],'role'=>$data['role']);	
			}
	}else if($request=="create"){
		$user=mysql_real_escape_string($_POST['user']);
		$pass=mysql_real_escape_string($_POST['pass']);
		$fname=mysql_real_escape_string($_POST['fname']);
		$lname=mysql_real_escape_string($_POST['lname']);
		$birthday=mysql_real_escape_string($_POST['birthday']);
		$age=mysql_real_escape_string($_POST['age']);
		$course=mysql_real_escape_string($_POST['course']);
		$sex=mysql_real_escape_string($_POST['sex']);
		$email=mysql_real_escape_string($_POST['email']);
		$json = array();
			if($user=="" || $pass=="" || $fname=="" || $lname=="" || $birthday==""|| $age==""||$course==""||$sex==""||$email==""){
				$json[0]=array('MSG'=>'PLEASE FIll ALL');
			}else{
				$sql = "Select * from users where username ='".$user."'";
					if(mysqli_num_rows(mysqli_query($conn,$sql))){
						$json[0]=array('MSG'=>'USERNAME TAKEN');
					}else{
						$sql = "Select * from students_information where email ='".$email."'";
						if(mysqli_num_rows(mysqli_query($conn,$sql))){
							$json[0]=array('MSG'=>'EMAIL ALREADY TAKEN');
						}else{
							$json[0]=array('MSG'=>'ACCOUNT 404');	
							$sql ="Insert into users(username,passkey,role)values('".$user."','".$pass."','student')";
							if(mysqli_query($conn,$sql)){
								$sql="Insert into students_information(username,firstname,lastname,age,course,sex,email,birthday)values
								('".$user."','".$fname."','".$lname."','".$age."','".$course."','".$sex."','".$email."','".$birthday."')";
								if(mysqli_query($conn,$sql)){
										$json[0]=array('MSG'=>'ACCOUNT CREATED');			
									}
							}		
						}
					}

			}

			
	}else if($request=="create_teacher"){
		$json = array();
		$user=mysql_real_escape_string($_POST['user']);
		$pass=mysql_real_escape_string($_POST['pass']);
		$fname=mysql_real_escape_string($_POST['fname']);
		$lname=mysql_real_escape_string($_POST['lname']);
		$birthday=mysql_real_escape_string($_POST['birthday']);
		$age=mysql_real_escape_string($_POST['age']);
		$sex=mysql_real_escape_string($_POST['sex']);
		$email=mysql_real_escape_string($_POST['email']);
			if($user=="" || $pass=="" || $fname=="" || $lname=="" || $birthday==""|| $age==""||$sex==""||$email==""){
				$json[0]=array('MSG'=>'PLEASE FIll ALL');
			}else{
				$sql = "Select * from users where username ='".$user."'";
					if(mysqli_num_rows(mysqli_query($conn,$sql))){
						$json[0]=array('MSG'=>'USERNAME TsAKEN');
					}else{
						$sql = "Select * from teacher_information where email ='".$email."'";
						if(mysqli_num_rows(mysqli_query($conn,$sql))){
							$json[0]=array('MSG'=>'EMAIL ALREADY TAKEN');
						}else{
							$json[0]=array('MSG'=>'ACCOUNT 404');	
							$sql ="Insert into users(username,passkey,role)values('".$user."','".$pass."','teacher')";
							if(mysqli_query($conn,$sql)){
								$sql="Insert into teacher_information(username,firstname,lastname,age,sex,email,birthday)values
								('".$user."','".$fname."','".$lname."','".$age."','".$sex."','".$email."','".$birthday."')";
								if(mysqli_query($conn,$sql)){
										$json[0]=array('MSG'=>'ACCOUNT CREATED');			
									}
							}		
						}
					}
			}
		

	}
}
echo json_encode($json);
?>