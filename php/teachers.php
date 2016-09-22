<?php require "config.php";
session_start();
$json=array();
function checkIfEmailIsSame($id,$email){
	require "config.php";
	$sql = "Select * from teacher_information where id ='$id'";
	$data = mysqli_fetch_array(mysqli_query($conn,$sql));
	if($data['email']==$email){
		return true;
	}else{
		return false;
	}
}
function checkIfEmailExists($id,$email){
	require "config.php";
	$sql = "Select * from teacher_information where email ='$email' and id !='$id'";
	if(mysqli_num_rows(mysqli_query($conn,$sql))){
		return true;
	}else{
		return false;
	}
}


if(!isset($_SESSION['isLoggedIn'])){
$json[0]=array('MSG'=>'NOT AUTHORIZED');
}else{
	if($_POST['request']=="teachers_accs"){
		$sql = "Select * from teacher_information";
		$res = mysqli_query($conn,$sql);
		while($data=mysqli_fetch_array($res)){
			$json[]=array('MSG'=>'GOOD','name'=>$data['firstname']." ".$data['lastname'],'id'=>$data['id']);
		}
	}else if($_POST['request']=="fetch_all"){
		$sql = "Select * from teacher_information";
		$res = mysqli_query($conn,$sql);
		while($data=mysqli_fetch_array($res)){
			$json[]=array('MSG'=>'GOOD','id'=>$data['id'],'fname'=>$data['firstname'],'lname'=>$data['lastname'],
				'bday'=>$data['birthday'],'sex'=>$data['sex'],'age'=>$data['age'],'email'=>$data['email']);
		}
	}else if($_POST['request']=="update"){
		$json = array();
		
		$id=mysql_real_escape_string($_POST['id']);
		
		$fname=mysql_real_escape_string($_POST['fname']);
		$lname=mysql_real_escape_string($_POST['lname']);
		$birthday=mysql_real_escape_string($_POST['bday']);
		$age=mysql_real_escape_string($_POST['age']);
		$sex=mysql_real_escape_string($_POST['sex']);
		$email=mysql_real_escape_string($_POST['email']);
			if($id =="" || $fname=="" || $lname=="" || $birthday==""|| $age==""||$sex==""||$email==""){
				$json[0]=array('MSG'=>'PLEASE FIll ALL');
			}else{	
						if(!checkIfEmailIsSame($id,$email)) {
							$json[0]=array('MSG'=>'EMAIL ALREADY TAKEN');
						}else{
							if(checkIfEmailExists($id,$email)){	
							$json[0]=array('MSG'=>'EMAIL ALREADY TAKEN');
						}else{
							$json[0]=array('MSG'=>'ACCOUNT 404');	
								$sql="Update  teacher_information set firstname='$fname',lastname='$lname',age='$age',sex='$sex',email='$email',birthday='$birthday' where id ='$id'";
								
								if(mysqli_query($conn,$sql)){
										$json[0]=array('MSG'=>'INFORMATION UPDATED');			
								}else{
										$json[0]=array('MSG'=>mysqli_error($conn));
								}
							}
									
						}
			}
			//end update		
			
	}
}
echo json_encode($json);
?>