<?php 
$to = 'ashbee.morgado@icloud.com';
$from = 'mailman@johndoe.com';
$headers=="";
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();

$msg = 'Download grade <a href="http://rojan.robreyes.xyz/php/mail?id=1">Here</a>';
// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);
// send email
mail($to,"Download Grade",$msg,$headers);
?>