<?php
header('Access-Control-Allow-Origin: *'); 
require "config.php";
if(isset($_GET['request'])){
	$req = $_GET['request'];
}else{
	$req = 'get';
}

if(($req=="send_link")){

	$to = "macsatapp2016@gmail.com";
	$subject = "HTML email";

	$message = 'Download Grade from <a href="http://rojan.robreyes.xyz/php/mail.php?id='.$_GET['id'].'&request=get">Here</a>';

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: <macsat@admin.com>' . "\r\n";
	
	if(mail($to,$subject,$message,$headers)){
		$msg[0] =array('MSG'=>'CHECK EMAIL');
	}else{
		$msg[0] =array('MSG'=>'CHECK EMAIL');
	}
	echo json_encode($msg);

}elseif($req=='get'){
	$student_id=$_GET['id'];
	$sql ="SELECT g.*,si.`firstname`,si.`lastname`,c.`name`,c.`description` FROM grade_summary g INNER JOIN students_information si ON g.student_id = si.id INNER JOIN course c ON si.course = c.id WHERE student_id='$student_id'";
	$for_fetch = mysqli_fetch_array(mysqli_query($conn,$sql));
	$name = $for_fetch['firstname'].' '.$for_fetch['lastname'];
	$course = $for_fetch['name'];
	$res = mysqli_query($conn,$sql);



	$table='<h1>Grades of: <b>'.$name.'</b></h1>';
	$table.='<h3>Course <b>'.$course.'</b></h3>';
		if(mysqli_num_rows($res)>0){
			$table .='
			<table class="table table-striped" bordered="1">
				<tr>
					<td>Code</td>
					<td>Title</td>
					<td>Prelims</td>
					<td>Midterms</td>
					<td>Pre Finals</td>
					<td>Finals</td>
				</tr>';

			while ($data=mysqli_fetch_array($res)) {
				$table .='
				<tr>
					<td>'.$data['code'].'</td>
					<td>'.$data['title'].'</td>
					<td>'.$data['p_total_grade'].'</td>
					<td>'.$data['m_total_grade'].'</td>
					<td>'.$data['pf_total_grade'].'</td>
					<td>'.$data['f_total_grade'].'</td>
				</tr>';
			}
			$table.='</table>';
			header("Content-Type: application/xls");

			header("Content-Disposition:attachment;filename=grade.xls");
			echo $table;
		
}


}
?>