<?php 
require "PHPMailer-master/PHPMailerAutoload.php";
require 'PhpExcel.php';
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug //zoutput

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = '138.68.76.171';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
//$mail->Username = 'macsatapp2016@gmail.com';                 // SMTP username
$mail->Username = 'rojan@robreyes.xyz';                 // SMTP username
$mail->Password = 'macsat2016';                           // SMTP password

$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('macatadmin@macsat.com', 'ADMIN');
$mail->addAddress('ashbee.morgado@icloud.com', 'Ashbee Morgado');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
};

$file = "DownloadReport";
$table
?>