<?php 
require "config.php";
session_start();

function checkSubjectIfExist($code){
require "config.php";
	$sql = "Select * from subjects where code ='$code'";
	if(mysqli_num_rows(mysqli_query($conn,$sql))){
		return true;
	}else{
		return false;
	}
}
$json=array();
if(!isset($_SESSION['isLoggedIn'])){
$json[0]=array('MSG'=>'NOT AUTHORIZED');
}else{
	$req = $_POST['request'];
	if($req == "fetch_all"){
		$sql = "Select * from subject_information";
		$res = mysqli_query($conn,$sql);
			while($data=mysqli_fetch_array($res)){
				$json[]=array('id'=>$data['id'],'code'=>$data['code'],'title'=>$data['title'],'units'=>$data['units'],'year'=>$data['year'],'sem'=>$data['sem'],'acad_year'=>$data['acad_year'],'teacher'=>$data['firstname']." ".$data['lastname'],'t_id'=>$data['t_id']);
			}

	}else if($req =="update_subject"){
		$t_id = mysql_real_escape_string($_POST['teacher_id']);
		$code = mysql_real_escape_string($_POST['code']);
		$title = mysql_real_escape_string($_POST['title']);
		$units = mysql_real_escape_string($_POST['units']);
		$year = mysql_real_escape_string($_POST['year']);
		$sem = mysql_real_escape_string($_POST['sem']);
		$sql = "Update subjects set title='$title',units='$units',year='$year',sem='$sem',t_id='$t_id' where code ='$code'";
		$json[0]=array('MSG'=>'ERROR');
			if(mysqli_query($conn,$sql)){
				$json[0]=array('MSG'=>'SUBJECT UPDATED');
			}
	}else if($req =="add_subject"){
		$t_id = mysql_real_escape_string($_POST['teacher_id']);
		$code = mysql_real_escape_string($_POST['code']);
		$title = mysql_real_escape_string($_POST['title']);
		$units = mysql_real_escape_string($_POST['units']);
		$year = mysql_real_escape_string($_POST['year']);
		$sem = mysql_real_escape_string($_POST['sem']);

		$json[0]=array('MSG'=>'SUBJECT CODE EXISTING');
		if(!checkSubjectIfExist($code)){
			$sql = "Insert into subjects(code,title,units,year,sem,t_id)values('$code','$title','$units','$year','$sem','$t_id')";
				if(mysqli_query($conn,$sql)){
				$json[0]=array('MSG'=>'SUBJECT ADDED');
			}
		}
	}
	
}
echo json_encode($json);
?>