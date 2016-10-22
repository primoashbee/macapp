<?php 
require "config.php";
require_once "Classes/PHPExcel.php";
$objTpl = PHPExcel_IOFactory::load("template.xlsx");

 
$objTpl->getActiveSheet()->setCellValue('B6','Micro Asia College of Science and Technology Inc.');
$filename=mt_rand(1,100000).'.xls'; //just some random filename
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=Ashbee.xls');
//header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
$objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
 
?>