<?php 

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

//$to = 'macsatapp2016@gmail.com';
$to = 'ashbee.morgado@icloud.com';
$from = 'ezboi@johndoe.com';
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();

$msg = 'Download grade <a href="http://rojan.robreyes.xyz/php/mail.php?id='.$_GET['id'].'">Here</a>';
// use wordwrap() if lines are longer than 70 characters
//$msg = wordwrap($msg,70);
// send email
if(mail($to,"Download Grade",$msg,$headers)){
	$json[0]=array('MSG'=>'CHECK EMAIL');
}else{
	$json[0]=array('MSG'=>'ERROR SENDING EMAIL');
}
echo json_encode($json);


?>