<?php 

$conn = mysqli_connect('localhost','rob_macsat','macsat1234','rob_macsat');



$masterAdmin = 'macsatadmin2016';

$masterPassword = '9876543210';

$masterRole ='admin';

$conn_trans = new mysqli('localhost','rob_macsat','macsat1234','rob_macsat');

$global_user;

$sql ="Select * from users";	

if(!mysqli_num_rows(mysqli_query($conn,$sql))){

	$sql="Insert into users(username,passkey,role,isDeleted)values('$masterAdmin','$masterPassword','$masterRole',false)";



	mysqli_query($conn,$sql);

}

?>