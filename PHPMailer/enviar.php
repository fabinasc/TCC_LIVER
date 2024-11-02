<?php
require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
$mail = new PHPMailer(true);
$nome=$_POST["nome"];
$email=$_POST["email"];
$mensagem=$_POST["mensagem"];
try {
	
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'rosatesteaula@gmail.com';
	$mail->Password = 'phzbkdjwdbwefrhf';   //senha de 16 digitos , configurar no gmail
	$mail->Port = 587;
 
	$mail->setFrom('rosatesteaula@gmail.com');
	//$mail->addAddress('mitikorosa6@gmail.com');
          $mail->addAddress("$email");
	$mail->isHTML(true);
	$mail->Subject = 'Teste de email ';
	$mail->Body = "$mensagem";
	if($mail->send()) {
		echo 'Email enviado com sucesso';
	} else {
		echo 'Email nao enviado';
	}
} catch (Exception $e) {
	echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}