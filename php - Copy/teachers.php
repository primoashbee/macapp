	<?php require "config.php";
	header('Access-Control-Allow-Origin: *'); 
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

if(!isset($global_user)){
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
		
		$id=mysqli_real_escape_string($conn,$_POST['id']);
		
		$fname=mysqli_real_escape_string($conn,$_POST['fname']);
		$lname=mysqli_real_escape_string($conn,$_POST['lname']);
		$birthday=mysqli_real_escape_string($conn,$_POST['bday']);
		$age=mysqli_real_escape_string($conn,$_POST['age']);
		$sex=mysqli_real_escape_string($conn,$_POST['sex']);
		$email=mysqli_real_escape_string($conn,$_POST['email']);
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