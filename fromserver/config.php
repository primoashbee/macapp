<?php 
date_default_timezone_set('Asia/Manila');
//$conn = mysqli_connect('localhost','id106944_rob_macsat','isLocked1234','id106944_rob_macsat');
$conn = mysqli_connect('localhost','root','','macsat');



$masterAdmin = 'macsatadmin2016';

$masterPassword = '9876543210';

$masterRole ='admin';

//$conn_trans = new mysqli('localhost','id106944_rob_macsat','isLocked1234','id106944_rob_macsat');
//$conn_trans = new mysqli('localhost','root','','macsat');

$global_user;

$sql ="Select * from users";	

if(!mysqli_num_rows(mysqli_query($conn,$sql))){

	$sql="Insert into users(username,passkey,role,isDeleted)values('$masterAdmin','$masterPassword','$masterRole',false)";



	mysqli_query($conn,$sql);

}

?>