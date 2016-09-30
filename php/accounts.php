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
				$json[]=array('MSG'=>1,'id'=>$data['id'],'username'=>$data['username'],'password'=>$data['passkey'],'role'=>$data['role'],'isDeleted'=>$data['isDeleted']);	
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
							$sql ="Insert into users(username,passkey,role,isDeleted)values('".$user."','".$pass."','student',false)";
							
							
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
							$sql ="Insert into users(username,passkey,role,isDeleted)values('".$user."','".$pass."','teacher',false)";
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
		

	}else if($request=="soft_delete"){
		$json[0]=array('MSG'=>'ACCOUNT ERROR');
		$user=mysql_real_escape_string($_POST['user']);
		$sql = "Update users set isDeleted = true where username='$user'";

		if(mysqli_query($conn,$sql)){
			$json[0]=array('MSG'=>'ACCOUNT DELETED');
		}
	}else if($request=="recover"){
		$json[0]=array('MSG'=>'ACCOUNT ERROR');
		$user=mysql_real_escape_string($_POST['user']);
		$sql = "Update users set isDeleted = false where username='$user'";
		if(mysqli_query($conn,$sql)){
			$json[0]=array('MSG'=>'ACCOUNT RECOVERED');
		}
	}else if($request=="change_pass"){

		$username = mysql_escape_string($_POST['username']);
		$oldpass  = mysql_escape_string($_POST['oldpass']);
		$newpass1 = mysql_escape_string($_POST['newpass']);
		$newpass2 = mysql_escape_string($_POST['newpass2']);
			if($newpass1!=$newpass2){
				$json[0]=array('MSG'=>'PASSWORD MUST MATCH');
				
			}else{
			$sql ="Select * from users where username = '$username'";

			$data = mysqli_fetch_row(mysqli_query($conn,$sql));
			
			$o_pass = $data[2];
			
			
				if($o_pass==$oldpass){
					$sql="Update users set passkey='$newpass1' where username ='$username'";
						
					if(mysqli_query($conn,$sql)){


						$json[0]=array('MSG'=>'PASSWORD CHANGE SUCCESSFUL');
					}else{
						$json[0]=array('MSG'=>'ERROR');
					}
				}else{
					$json[0]=array('MSG'=>'OLD PASSWORD DID NOT MATCH');
				}
			}
	}
}
echo json_encode($json);
?>