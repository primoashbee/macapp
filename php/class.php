<?php 
require "config.php";
session_start();
$json=array();

function getStudentList($id){
	require "config.php";
	$sql = "Select * from class_list where id ='$id'";

	$res = mysqli_query($conn,$sql);
	while($data=mysqli_fetch_array($res)){
		$json[]=array('fname'=>$data['firstname'],'lname'=>$data['lastname']);
	}
	return $json;
}
function getClassIdAfterInsert($student_id){
	require "config.php";
	$id=$student_id;
	$sql = "Select id from class where student_id ='$id' order by id DESC";
	$res = mysqli_query($conn,$sql);
	$data=mysqli_fetch_array($res);
	
	return $data['id'];
	
}
function StudentIsInClass($student_id,$subject_id){
	require "config.php";
	$sb_id = $subject_id;
	$st_id = $student_id;
	$sql = "Select id from class where subject_id ='$sb_id' and student_id='$st_id'";

	$res = mysqli_query($conn,$sql);
	if(mysqli_num_rows($res)){
		return true;
	}else{
		return false;
	}
}
if(!isset($_SESSION['isLoggedIn'])){
$json[0]=array('MSG'=>'NOT AUTHORIZED');
}else{
$req = $_POST['request'];
	if($req == "fetch_all"){
		$sql = "Select * from class_summary";
		$res = mysqli_query($conn,$sql);
			while($data=mysqli_fetch_array($res)){
			
			$json[]=array('id'=>$data['id'],'code'=>$data['code'],'title'=>$data['title'],'units'=>$data['units'],'year'=>$data['year'],'sem'=>$data['sem'],'acad_year'=>$data['acad_year'],'teacher'=>$data['firstname']." ".$data['lastname'],'t_id'=>$data['t_id'],'isDeleted'=>$data['isdeleted'],'count'=>$data['student_count']);
			}	
	}else if($req=="myclass_summary"){
		$id = mysql_escape_string($_POST['id']);
		$sql = "Select * from class_summary where t_id ='$id'";
	
		$res = mysqli_query($conn,$sql);
			while($data=mysqli_fetch_array($res)){
			
			$json[]=array('id'=>$data['id'],'code'=>$data['code'],'title'=>$data['title'],'units'=>$data['units'],'year'=>$data['year'],'sem'=>$data['sem'],'acad_year'=>$data['acad_year'],'teacher'=>$data['firstname']." ".$data['lastname'],'t_id'=>$data['t_id'],'isDeleted'=>$data['isdeleted'],'count'=>$data['student_count']);
			}			

	}else if($req=="get_list_by_id"){
		//$json[]=getStudentList($_POST['id']);
		$id = $_POST['id'];
		$sql = "Select * from class_list where subject_id ='$id'";
		
		$res = mysqli_query($conn,$sql);
		$json=array();
		
			while($data=mysqli_fetch_array($res)){
				$json[]=array('id'=>$data['class_id'],'student_id'=>$data['student_id'],'fname'=>$data['firstname'],'lname'=>$data['lastname']);
			
		}
	}else if($req=="remove_from_class"){
		try{
			$conn_trans->begin_transaction();
			foreach($_POST['list'] as $x){
				$conn_trans->query("delete from class where id ='$x'");
				$conn_trans->query("delete from grades where class_id ='$x'");
			}
			$conn_trans->commit();
			$json[0]=array('MSG'=>'STUDENT REMOVED');
		} catch (Exception $e ){

			$json[0]=array('MSG'=>'ERROR');
			$conn_trans->rollback();
		}
	}else if($req=="add_to_class"){
		try{
			$conn_trans->begin_transaction();
			$subject_id=$_POST['subject_id'];
			foreach($_POST['list'] as $x){

				if(!StudentIsInClass($x,$subject_id)){
							if(mysqli_query($conn,"Insert into class(subject_id,student_id)values('$subject_id','$x')")){
								$class_id = getClassIdAfterInsert($x);
								$sql = "Insert into grades(class_id)values('$class_id')";
									if(mysqli_query($conn,$sql)){
										
										$json[0]=array('MSG'=>'ADDED TO CLASS');
									}
						}
		
				}

			}
			$conn_trans->commit();
			$json[0]=array('MSG'=>'STUDENT ADDED TO CLASS');
		} catch (Exception $e ){

			$json[0]=array('MSG'=>'ERROR');
			$conn_trans->rollback();
		}
	}
}
echo json_encode($json);
?>