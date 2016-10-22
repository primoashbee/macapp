<?php
	require "config.php";
	require_once 'Classes/PhpExcel.php';

	$objPHPExcel = new PhpExcel();	
	$styleArray = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => '000000'),
        'size'  => 10,
        'name'  => 'Courier New'
    ));
	$objPHPExcel->getActiveSheet()->setCellValue('A1','Micro Asia College of Science and Technology Inc.');
	$objPHPExcel->getActiveSheet()->setCellValue('A2','Paulien, Zone I, Iba, Zambales');
	$objPHPExcel->getActiveSheet()->setCellValue('A3','Subject Grade Report');
	$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray)->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);;
	
	$objPHPExcel->getActiveSheet()->setTitle('Cheese1');
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="helloworld.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	/*
	$student_id=$_GET['id'];
	$sql ="SELECT g.*,si.`username`,si.`firstname`,si.`lastname`,c.`name`,c.`description` FROM grade_summary g INNER JOIN students_information si ON g.student_id = si.id INNER JOIN course c ON si.course = c.id WHERE student_id='$student_id'";

	$res = mysqli_query($conn,$sql);
	if (mysqli_num_rows($res)>0){
		$for_fetch = mysqli_fetch_array(mysqli_query($conn,$sql));
		$name = $for_fetch['firstname'].' '.$for_fetch['lastname'];
		$course = $for_fetch['name'];
		$username = $for_fetch['username'];

		$table='<p style="padding-left:20px"><center>Micro Asia College of Science and Technology Inc.</center></p>';
		$table.='<p><center>Paulien, Zone I, Iba, Zambales</center></p>';
		$table.='<h1><center>Subject Grade Report</center></h1>';

		$table.='<h1><center>Grades of: <b>'.$name.'</b></center></h1>';
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
			}
				$table.='</table>';
				header("Content-Type: application/xls");

				header('Content-Disposition:attachment;filename=Grades of '.$name.'.xls');
				echo $table;
}else{
	echo 'No Data';
}
	*/
?>