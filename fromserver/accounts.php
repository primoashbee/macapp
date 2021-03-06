<?php 

require "config.php";

session_start();

$json=array();

header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');
	$request  = $_POST['request'];

	if($_POST['request']=="validate"){

		$json[0]=array('MSG'=>'AUTHORIZED');

	}

	if($request=="fetch_all"){

		$sql ="SELECT u.*,CONCAT(si.`firstname`,' ',si.`lastname`) AS name  FROM users u INNER JOIN students_information si ON u.`username`=si.username WHERE u.role !='admin'";

		$res = mysqli_query($conn,$sql);

			while($data=mysqli_fetch_array($res)){

				$json[]=array('MSG'=>1,'id'=>$data['id'],'username'=>$data['username'],'password'=>$data['passkey'],'name'=>$data['name'],'role'=>$data['role'],'isDeleted'=>$data['isDeleted']);	

			}

		$sql ="SELECT u.*,CONCAT(ti.`firstname`,' ',ti.`lastname`) AS name  FROM users u 	INNER JOIN teacher_information ti ON u.`username`=ti.username WHERE u.role !='admin'";

		$res = mysqli_query($conn,$sql);

			while($data=mysqli_fetch_array($res)){

				$json[]=array('MSG'=>1,'id'=>$data['id'],'username'=>$data['username'],'password'=>$data['passkey'],'role'=>$data['role'],'name'=>$data['name'],'isDeleted'=>$data['isDeleted']);	

			}

			

	}else if($request=="create"){

		$user=mysqli_real_escape_string($conn,$_POST['user']);

		$pass=mysqli_real_escape_string($conn,$_POST['pass']);

		$fname=mysqli_real_escape_string($conn,$_POST['fname']);

		$lname=mysqli_real_escape_string($conn,$_POST['lname']);

		$birthday=mysqli_real_escape_string($conn,$_POST['birthday']);

		$age=mysqli_real_escape_string($conn,$_POST['age']);

		$course=mysqli_real_escape_string($conn,$_POST['course']);

		$sex=mysqli_real_escape_string($conn,$_POST['sex']);

		$email=mysqli_real_escape_string($conn,$_POST['email']);

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

		$user=mysqli_real_escape_string($conn,$_POST['user']);

		$pass=mysqli_real_escape_string($conn,$_POST['pass']);

		$fname=mysqli_real_escape_string($conn,$_POST['fname']);

		$lname=mysqli_real_escape_string($conn,$_POST['lname']);

		$birthday=mysqli_real_escape_string($conn,$_POST['birthday']);

		$age=mysqli_real_escape_string($conn,$_POST['age']);

		$sex=mysqli_real_escape_string($conn,$_POST['sex']);

		$email=mysqli_real_escape_string($conn,$_POST['email']);

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

		$user=mysqli_real_escape_string($conn,$_POST['user']);

		$sql = "Update users set isDeleted = true where username='$user'";



		if(mysqli_query($conn,$sql)){

			$json[0]=array('MSG'=>'ACCOUNT DELETED');

		}

	}else if($request=="recover"){

		$json[0]=array('MSG'=>'ACCOUNT ERROR');

		$user=mysqli_real_escape_string($conn,$_POST['user']);

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

	}else if($request=="change_pass_by_admin"){

			$username = mysql_escape_string($_POST['username']);
			$newpass = mysql_escape_string($_POST['password']);
			
			$sql="Update users set passkey='$newpass' where username ='$username'";
					if(mysqli_query($conn,$sql)){

						$json[0]=array('MSG'=>'PASSWORD CHANGE SUCCESSFUL');

					}else{

						$json[0]=array('MSG'=>'ERROR');

					}

			

	}



echo json_encode($json);

?>