<?php
require "config.php";

function ConvertToGradePoint($grade){
	if(is_numeric($grade)){
	$x = intval($grade);
	}else{
	$x= $grade;
	}

	if($x >= 99 && $x <=100){
		$x = 1.0;
		return $x;
	}elseif($x >= 97 && $x <=98){
		$x = 1.1;
		return $x;
	}elseif($x >= 95 && $x <=96){
		$x = 1.2;
		return $x;
	}elseif($x >= 93 && $x <=94){
		$x = 1.3;
		return $x;
	}elseif($x >= 91 && $x <=92){
		$x = 1.4;
		return $x;
	}elseif($x == 90){
		$x = 1.5;
		return $x;
	}elseif($x == 89){
		$x = 1.6;
		return $x;
	}elseif($x == 88){
		$x = 1.7;
		return $x;
	}elseif($x == 87){
		$x = 1.8;
		return $x;
	}elseif($x == 86){
		$x = 1.9;
		return $x;
	}elseif($x == 85){
		$x = 2.0;
		return $x;
	}elseif($x == 84){
		$x = 2.1;
		return $x;
	}elseif($x == 83){
		$x = 2.2;
		return $x;
	}elseif($x == 82){
		$x = 2.3;
		return $x;
	}elseif($x == 81){
		$x = 2.4;
		return $x;
	}elseif($x == 80){
		$x = 2.5;
		return $x;
	}elseif($x == 79){
		$x = 2.6;
		return $x;
	}elseif($x == 78){
		$x = 2.7;
		return $x;
	}elseif($x == 77){
		$x = 2.8;
		return $x;
	}elseif($x == 76){
		$x = 2.9;
		return $x;
	}elseif($x == 75){
		$x = 3.0;
		return $x;
	}elseif($x == "F" ){
		 $x = 5.0;
		 return $x;
	}elseif($x=="FA"){
		$x = 6.0;
		return $x;
	}elseif($x==null || $x  ==""){
		return 'N/A';
	}elseif(!is_numeric($x)){
		
		$x = 6.0;
		return $x;
	}
	//return $x;
}

require_once "Classes/PHPExcel.php";
$objTpl = PHPExcel_IOFactory::load("template.xlsx");


$student_id=$_GET['id'];
$sql ="SELECT g.*,sb.`units`,CONCAT(sb.`firstname`,' ',sb.`lastname`) AS tname,si.`username`,si.`firstname`,si.`lastname`,c.`name`,c.`description` 
FROM grade_summary g 
INNER JOIN students_information si ON g.student_id = si.id
INNER JOIN subject_information sb ON sb.`code` = g.`code`
INNER JOIN course c ON si.course = c.id
WHERE student_id='$student_id'";

$res = mysqli_query($conn,$sql);
$total_units = 0;
$total_subjects = 0;
$total_gwa = 0;
if (mysqli_num_rows($res)>0){	 
	$for_fetch = mysqli_fetch_array(mysqli_query($conn,$sql));
	$name = $for_fetch['lastname'].', '.$for_fetch['firstname'];
	$course = $for_fetch['name'];
	$username = $for_fetch['username'];


	$objTpl->getActiveSheet()->setCellValue('B6',$username);
	$objTpl->getActiveSheet()->setCellValue('B7',$name);
	$objTpl->getActiveSheet()->setCellValue('L6', $course);
	//ROW 9 starts 
	$x=9;
	while($data = mysqli_fetch_array($res)){
	$total_subjects+=1;
	$total_units += intval($data['units']);
	$equivalent = ConvertToGradePoint($data['f_total_grade']);

	$total_gwa += $equivalent;

	$objTpl->getActiveSheet()->setCellValue('A'.$x,$data['code']);
	$objTpl->getActiveSheet()->setCellValue('B'.$x,$data['title']);
	$objTpl->getActiveSheet()->setCellValue('D'.$x,$data['p_total_grade']);
	$objTpl->getActiveSheet()->setCellValue('E'.$x,$data['m_total_grade']);
	$objTpl->getActiveSheet()->setCellValue('F'.$x,$data['pf_total_grade']);
	$objTpl->getActiveSheet()->setCellValue('G'.$x,$data['f_total_grade']);
	$objTpl->getActiveSheet()->setCellValue('H'.$x,$equivalent);
	$objTpl->getActiveSheet()->setCellValue('I'.$x,$data['units']);
	$objTpl->getActiveSheet()->setCellValue('J'.$x,$data['tname']);
	$x++;
	}

	$objTpl->getActiveSheet()->setCellValue('H21',$total_units);
	$objTpl->getActiveSheet()->setCellValue('C21',$total_subjects);
	$objTpl->getActiveSheet()->setCellValue('J21',$total_gwa/$total_subjects);

	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Grades of '.$username.'".xls');
	//header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
	$objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
	
}else{
	echo 'No Data';
}
	
?>