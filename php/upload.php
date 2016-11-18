<?php 
session_start();
require "config.php";
require_once "Classes/PHPExcel.php";
$values="";
$user_values="";
if(isset($_POST['submit'])){
if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else{
  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  echo "Type: " . $_FILES["file"]["type"] . "<br />";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  echo "Stored in: " . $_FILES["file"]["tmp_name"]."<br>";
	$inputFileType = 'CSV';
	$inputFileName = $_FILES["file"]["tmp_name"];
	$objReader = PHPExcel_IOFactory::createReader($inputFileType);
	$objPHPExcel = $objReader->load($inputFileName);
	$worksheet = $objPHPExcel->getActiveSheet();
	$sql = "Insert into students_information(username,lastname,firstname,course,sex,birthday,email)values";
	$sql2 = "Insert into users(username,passkey,role,isDeleted)values";
	$row_vals="";
	$acc_vals="";
	foreach ($worksheet->getRowIterator() as $row) {
	
			foreach($row->getCellIterator() as $key=>$cell){
				
				if($cell->getRow() >1){
					if($key==0){
					$row_vals.="('".abs($cell->getCalculatedValue())."',";
					$acc_vals.="('".abs($cell->getCalculatedValue())."','default123','student',0),";
					}elseif($key==1){
					$row_vals.="'".$cell->getCalculatedValue()."',";
					}elseif($key==2){
					$row_vals.="'".$cell->getCalculatedValue()."',";
					}elseif($key==3){
					$row_vals.="'".$cell->getCalculatedValue()."',";
					}elseif($key==4){
					$row_vals.="'".$cell->getCalculatedValue()."',";
					}elseif($key==5){
					$row_vals.="'".$cell->getCalculatedValue()."',";
					}elseif($key==6){
					
					$row_vals.="'".$cell->getCalculatedValue()."')	,";
					}
				}

			}



	}
	$accsql = $sql2.substr($acc_vals,0, strlen($acc_vals)-1);
	mysqli_query($conn,$accsql);
	$infosql = $sql.substr($row_vals,0, strlen($row_vals)-1);
 	mysqli_query($conn,$infosql);
 

  }

   
}
?>
<html>
<body>
	<form action="<?php $this ?>" method="POST" enctype="multipart/form-data">
		<input type="file" name="file" required="">
		<input type="submit" name ="submit" value ="submit">
	</form>

</body>

</html>