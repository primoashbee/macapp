<?php

require "config.php";

session_start();

$json=array();

header('Access-Control-Allow-Origin: *'); 

	if($_POST['request']=="update_grade"){

		$term = $_POST['term'];

		$quiz = $_POST['quiz'];

		$attendance = $_POST['attendance'];

		$exam = $_POST['exam'];

		$class_id=$_POST['class_id'];

		$project = $_POST['project'];	

		$grade = $_POST['grade'];
		
		if(!is_numeric($exam)){

			$grade=$exam;

		}else{
			$grade = $_POST['grade'];
		}

		
		if($term=="prelim"){

			$sql = "Update grades set p_quiz='$quiz',p_exam='$exam',p_attendace='$attendance',p_project='$project',p_total_grade='$grade' where class_id='$class_id'";
				
			if(mysqli_query($conn,$sql)){

				$json[0]=array('MSG'=>'GRADE UPDATED!');

			}

		}else if($term=="midterm"){

			$sql = "Update grades set m_quiz='$quiz',m_exam='$exam',m_attendance='$attendance',m_project='$project',m_total_grade= '$grade' where class_id='$class_id'";

			if(mysqli_query($conn,$sql)){

				$json[0]=array('MSG'=>'GRADE UPDATED!');

			}

		}else if($term=="prefinals"){

			$sql = "Update grades set pf_quiz='$quiz',pf_exam='$exam',pf_attendance='$attendance',pf_project='$project',pf_total_grade='$grade' where class_id='$class_id'";

	

			if(mysqli_query($conn,$sql)){

				$json[0]=array('MSG'=>'GRADE UPDATED!');

			}

		}else if($term=='finals'){

			$sql = "Update grades set f_quiz='$quiz',f_exam='$exam',f_attendance='$attendance',f_project='$project',f_total_grade ='$grade' where class_id='$class_id'";

			if(mysqli_query($conn,$sql)){

				$json[0]=array('MSG'=>'GRADE UPDATED!');

			}

		}

	}else if($_POST['request']=="fetch_grade"){

		$term = $_POST['term'];

		$class_id=$_POST['class_id'];

		$sql = "Select * from grades where class_id='$class_id'";

		

		$data=mysqli_fetch_array(mysqli_query($conn,$sql));		

		if($term=="prelim"){

			$json[0]=array('MSG'=>'GOOD','quiz'=>$data['p_quiz'],'attendance'=>$data['p_attendace'],'project'=>$data['p_project'],'grade'=>$data['p_total_grade']);

	

		}else if($term=="midterm"){



			$json[0]=array('MSG'=>'GOOD','quiz'=>$data['m_quiz'],'attendance'=>$data['m_attendance'],'project'=>$data['m_project'],'grade'=>$data['m_total_grade']);

	

		}else if($term=="prefinals"){





			$json[0]=array('MSG'=>'GOOD','quiz'=>$data['mf_quiz'],'attendance'=>$data['mf_attendance'],'project'=>$data['mf_project'],'grade'=>$data['mf_total_grade']);



	

		}else if($term=='finals'){



			$json[0]=array('MSG'=>'GOOD','quiz'=>$data['f_quiz'],'attendance'=>$data['f_attendance'],'project'=>$data['f_project'],'grade'=>$data['f_total_grade']);



		}

	}else if($_POST['request']=="summary_grade"){

		$student_id=$_POST['id'];

		$sql ="Select * from grade_summary where student_id='$student_id'";



		$res = mysqli_query($conn,$sql);

		while ($data=mysqli_fetch_array($res)) {

			$json[]=array('code'=>$data['code'],'title'=>$data['title'],

				'prelim'=>$data['p_total_grade'],'midterm'=>$data['m_total_grade'],

				'prefinals'=>$data['pf_total_grade'],'finals'=>$data['f_total_grade']);

		}

	}else if($_POST['request']=="drop"){
		$class_id = $_POST['id'];
		$sql = "Update grades set p_total_grade='DROPPED',m_total_grade='DROPPED',pf_total_grade='DROPPED',f_total_grade='DROPPED' where class_id='$class_id'";
			$json[0]=array('MSG'=>'ERROR');	
			if(mysqli_query($conn,$sql)){

				$json[0]=array('MSG'=>'STUDENT DROPPED');

			}
	}else if($_POST['request']=="fda"){
		$class_id = $_POST['id'];
		$sql = "Update grades set p_total_grade='FA',m_total_grade='FA',pf_total_grade='FA',f_total_grade='FA' where class_id='$class_id'";
			$json[0]=array('MSG'=>'ERROR');	
			if(mysqli_query($conn,$sql)){

				$json[0]=array('MSG'=>'STUDENT FAILED');

			}
	}else if($_POST['request']=="w"){
		$class_id = $_POST['id'];
		$sql = "Update grades set p_total_grade='W',m_total_grade='W',pf_total_grade='W',f_total_grade='W' where class_id='$class_id'";
			$json[0]=array('MSG'=>'ERROR');	
			if(mysqli_query($conn,$sql)){

				$json[0]=array('MSG'=>'STUDENT WITHDRAWN');

			}
	}else if($_POST['request']=="get_grade_by_term"){
		
		$json=array();
			$class_id = $_POST['id'];
			$term = $_POST['term'];

			if($term == "prelim"){
				$sql = "Select  p_quiz,p_exam,p_attendace,p_project,p_total_grade from grades where id='$class_id'";
			}else if($term == "midterm"){
				$sql = "Select  m_quiz,m_exam,m_attendance,m_project,m_total_grade from grades where id='$class_id'";
			}else if($term == "prefinals"){
				$sql = "Select  pf_quiz,pf_exam,pf_attendance,pf_project,pf_total_grade from grades where id='$class_id'";
			}else if($term == "finals"){
				$sql = "Select  f_quiz,f_exam,f_attendance,f_project,f_total_grade from grades where id='$class_id'";
			}
		
			$res = mysqli_query($conn,$sql);
			while($data=mysqli_fetch_array($res)){
				$json[] =array(
					'quiz'=>$data[0],
					'exam'=>$data[1],
					'attendance'=>$data[2],
					'project'=>$data[3],
					'total_grade'=>$data[4]
					);
			}
	}else if($_POST['send_grade']){
		
	}

echo json_encode($json);

?>