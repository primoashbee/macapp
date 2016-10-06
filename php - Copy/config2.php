<?php 
header('Access-Control-Allow-Origin: *'); 
$conn = mysqli_connect('localhost','gcccsorg_johndoe','isLocked1234','gcccsorg_johndoe');
$masterAdmin = 'macsatadmin2016';
$masterPassword = '9876543210';
$masterRole ='admin';
$conn_trans = new mysqli('localhost','gcccsorg_johndoe','isLocked1234','gcccsorg_johndoe
');
$sql ="Select * from users";	
if(mysqli_num_rows(mysqli_query($conn,$sql))){
	$sql="Insert into users(username,passkey,role,isDeleted)values('$masterAdmin','$masterPassword','$masterRole',false)";

	mysqli_query($conn,$sql);
}
?>