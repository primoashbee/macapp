<?php
// the message
//$student_id=$_POST['id'];
require "config.php";
require "PHPExcel.php";
$student_id=1;
$sql ="Select * from grade_summary where student_id='$student_id'";
$res = mysqli_query($conn,$sql);
$table='<b>Hi Ashbee Morgado</b>';

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
	$x = header("Content-Disposition:attachment;filename=download.xls");
	echo $table;
	
	fwrite($x,'validation');

}
//$msg = 'Download grade <a href="http://rojan.robreyes.xyz/php/validate.zip">Here</a>';

// use wordwrap() if lines are longer than 70 characters
//$msg = wordwrap($msg,70);

// send email
//mail("ashbee.morgado@icloud.com","My subject",$msg);
?>