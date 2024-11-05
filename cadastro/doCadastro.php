<?php
require_once('../PHPMailer/src/PHPMailer.php');
require_once('../PHPMailer/src/SMTP.php');
require_once('../PHPMailer/src/Exception.php');
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'conexao.php';

$email = $_POST['txtemail'];

// Valida o formato do email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Por favor, insira um email válido!');</script>";
    header('refresh:3;./index.html');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se o e-mail está registrado no banco de dados ou em sua lógica de aplicativo
    $email = mysqli_real_escape_string($con, $email); // Proteção contra injeção SQL
    $sql = "SELECT * FROM usuarios WHERE EMAIL_USUARIO='$email'";
    $resultado = mysqli_query($con, $sql);

    if (!mysqli_num_rows($resultado) == 0) {
        echo "<script>window.alert('E-mail já cadastrado. Conecte-se!');</script>";
        header("refresh:0.5,../login/index.html");
        exit(); } else {

//Enviando mensagem para o e-mail do usuário
$mail = new PHPMailer(true);

try {
	
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'liverbrasil1@gmail.com';
	$mail->Password = 'sucmwgnfyeldjvxr';   
	$mail->Port = 587;
 
	$mail->setFrom('liverbrasil1@gmail.com');
    $mail->addAddress("$email");
	$mail->isHTML(true);
	$mail->Subject = 'Fazendo minha conta no Liver';
	$mail->Body = 'Termine seu cadastro <a href="http://localhost/TCC_LIVER/cadastro/validaremail.html" target="_blank"><button>aqui.</button></a> ';

	if(!$mail->send()) {
		echo "<script>alert('Erro ao enviar o e-mail. Tente novamente.');</script>";
	} else {
        echo "<script>alert('Enviamos um e-mail para você. Por favor, verifique sua caixa de entrada para finalizar seu cadastro.');</script>";
        header("refresh:0.5,../index.php");

        $sql = "INSERT INTO usuarios(EMAIL_USUARIO) VALUES('$email')";
        mysqli_query($con,$sql);
  
    } 
	
}  catch (Exception $e) {
	echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}

}
}

// Fecha a conexão com o banco de dados
mysqli_close($con);
?>
