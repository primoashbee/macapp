<?php 
require "config.php";
session_start();
header('Access-Control-Allow-Origin: *'); 
function checkSubjectIfExist($code){
	require "config.php";
	$sql = "Select * from subjects where code ='$code'";
	if(mysqli_num_rows(mysqli_query($conn,$sql))){
		return true;
	}else{
		return false;
	}
}
function getCriteriaById($id){
	require "config.php";
	$class_id=$id;
	$sql = "select * from grading_criteria where class_id='$class_id'";
	$crits[]=array();
	$res = mysqli_query($conn,$sql);
	if(mysqli_num_rows($res)){
		while($data =mysqli_fetch_array($res)){
				$crits[]=array(
					 'e_total'=>$data['e_total'],'e_percentage'=>$data['e_percentage'],
					 'a_total'=>$data['a_total'],'a_percentage'=>$data['a_percentage'],
					 'p_total'=>$data['p_total'],'p_percentage'=>$data['p_percentage'],
					 'q_total'=>$data['q_total'],'q_percentage'=>$data['q_percentage']
					 );
		}	
	}else{
		$sql="Insert into grading_criteria(class_id)values('$class_id')";
		if(mysqli_query($conn,$sql)){
				$sql = "select * from grading_criteria where class_id='$class_id'";
				$crits[]=array();
				$res = mysqli_query($conn,$sql);
				while($data =mysqli_fetch_array($res)){
					$crits[]=array(
					'e_total'=>$data['e_total'],'e_percentage'=>$data['e_percentage'],
					'a_total'=>$data['a_total'],'a_percentage'=>$data['a_percentage'],
					'p_total'=>$data['p_total'],'p_percentage'=>$data['p_percentage'],
					'q_total'=>$data['q_total'],'q_percentage'=>$data['q_percentage']
					);
				}
		}
	}
	return $crits;
}

$json=array();

	$req = $_POST['request'];
	if($req == "fetch_all"){
		$sql = "Select * from subject_information";
		$res = mysqli_query($conn,$sql);
			while($data=mysqli_fetch_array($res)){
				$json[]=array('id'=>$data['id'],'code'=>$data['code'],'title'=>$data['title'],'units'=>$data['units'],'year'=>$data['year'],'sem'=>$data['sem'],'acad_year'=>$data['acad_year'],'teacher'=>$data['firstname']." ".$data['lastname'],'t_id'=>$data['t_id'],'isDeleted'=>$data['isdeleted']);
			}

	}else if($req=="my_subjects"){
		
		$student_id = $_POST['id'];
		$sql = "Select s.* from class_list cl inner join subject_information s on cl.code = s.code where cl.student_id='$student_id'";
	
		$res = mysqli_query($conn,$sql);
		while($data=mysqli_fetch_array($res)){
			$json[]=array('MSG'=>'GOOD','id'=>$data['id'],'code'=>$data['code'],'title'=>$data['title'],'units'=>$data['units'],'year'=>$data['year'],'sem'=>$data['sem'],'teacher'=>$data['firstname']. " ".$data['lastname']);
		}

	}else if($req =="update_subject"){
		$t_id = mysqli_real_escape_string($conn,$_POST['teacher_id']);
		$code = mysqli_real_escape_string($conn,$_POST['code']);
		$title = mysqli_real_escape_string($conn,$_POST['title']);
		$units = mysqli_real_escape_string($conn,$_POST['units']);
		$year = mysqli_real_escape_string($conn,$_POST['year']);
		$sem = mysqli_real_escape_string($conn,$_POST['sem']);
		$sql = "Update subjects set title='$title',units='$units',year='$year',sem='$sem',t_id='$t_id' where code ='$code'";
		$json[0]=array('MSG'=>'ERROR');
			if(mysqli_query($conn,$sql)){
				$json[0]=array('MSG'=>'SUBJECT UPDATED');
			}
	}else if($req =="add_subject"){
		$t_id = mysqli_real_escape_string($conn,$_POST['teacher_id']);
		$code = mysqli_real_escape_string($conn,$_POST['code']);
		$title = mysqli_real_escape_string($conn,$_POST['title']);
		$units = mysqli_real_escape_string($conn,$_POST['units']);
		$year = mysqli_real_escape_string($conn,$_POST['year']);
		$sem = mysqli_real_escape_string($conn,$_POST['sem']);

		$json[0]=array('MSG'=>'SUBJECT CODE EXISTING');
		if(!checkSubjectIfExist($code)){
			$sql = "Insert into subjects(code,title,units,year,sem,t_id,isDeleted)values('$code','$title','$units','$year','$sem','$t_id',false)";
				if(mysqli_query($conn,$sql)){
				$json[0]=array('MSG'=>'SUBJECT ADDED');
			}
		}
	}else if($req =="delete_subject"){
		$id=mysqli_real_escape_string($conn,$_POST['id']);
		$json[0]=array('MSG'=>'ERROR');
		$sql="update subjects set isDeleted = true where id ='$id'";
		if(mysqli_query($conn,$sql)){
			$json[0]=array('MSG'=>'SUBJECT DELETED');
		}
	}else if($req=="recover_subject"){
		$id=mysqli_real_escape_string($conn,$_POST['id']);
		$json[0]=array('MSG'=>'ERROR');
		$sql="update subjects set isDeleted = false where id ='$id'";
		if(mysqli_query($conn,$sql)){
			$json[0]=array('MSG'=>'SUBJECT RECOVERED');
		}		
	}else if($req=="criteria"){
		$class_id=$_POST['class_id'];
		$e_total = $_POST['e_total'];
		$e_perc = $_POST['e_perc'];
		$q_total = $_POST['q_total'];
		$q_perc = $_POST['q_perc'];
		$a_total = $_POST['a_total'];
		$a_perc = $_POST['a_perc'];
		$p_total = $_POST['p_total'];
		$p_perc = $_POST['p_perc'];
		$json[0]=array('MSG'=>'ERROR');
		$sql = "select * from grading_criteria where class_id='$class_id'";
		if(mysqli_num_rows(mysqli_query($conn,$sql))){
				$sql = "update grading_criteria set e_total ='$e_total',e_percentage ='$e_perc', a_total='$a_total', a_percentage='$a_perc',p_total='$p_total',p_percentage='$p_perc',q_total='$q_total',q_percentage='$q_perc' where class_id='$class_id'";
				if(mysqli_query($conn,$sql)){
					$json[0]=array('MSG'=>'CRITERIA UPDATED');
				}
		}else{
			$sql ="Insert into grading_criteria(class_id)values('$class_id')";
			if(mysqli_query($conn,$sql)){
			$sql = "update grading_criteria set e_total ='$e_total',e_percentage ='$e_perc', a_total='$a_total', a_percentage='$a_perc',p_total='$p_total',p_percentage='$p_perc',q_total='$q_total',q_percentage='$q_perc' where class_id='$class_id'";
				if(mysqli_query($conn,$sql)){
					$json[0]=array('MSG'=>'CRITERIA UPDATED');
				}
			}
		}

	}else if($req =="get_criteria_by_class_id"){
		
	$class_id=$_POST['class_id'];
	unset($json);
	
	$sql = "select * from grading_criteria where class_id='$class_id'";
	$crits[]=array();
	$res = mysqli_query($conn,$sql);
	if(mysqli_num_rows($res)){
		while($data =mysqli_fetch_array($res)){
				$json[]=array(
					 'e_total'=>$data['e_total'],'e_percentage'=>$data['e_percentage'],
					 'a_total'=>$data['a_total'],'a_percentage'=>$data['a_percentage'],
					 'p_total'=>$data['p_total'],'p_percentage'=>$data['p_percentage'],
					 'q_total'=>$data['q_total'],'q_percentage'=>$data['q_percentage']
					 );
		}	
	}else{
		$sql="Insert into grading_criteria(class_id)values('$class_id')";
		if(mysqli_query($conn,$sql)){
				$sql = "select * from grading_criteria where class_id='$class_id'";
				$json[]=array();
				$res = mysqli_query($conn,$sql);
				while($data =mysqli_fetch_array($res)){
					$json[]=array(
					'e_total'=>$data['e_total'],'e_percentage'=>$data['e_percentage'],
					'a_total'=>$data['a_total'],'a_percentage'=>$data['a_percentage'],
					'p_total'=>$data['p_total'],'p_percentage'=>$data['p_percentage'],
					'q_total'=>$data['q_total'],'q_percentage'=>$data['q_percentage']
					);
				}
		}
	}
	}	
		
	


echo json_encode($json);
?>