<?php

require_once('../PHPMailer/src/PHPMailer.php');
require_once('../PHPMailer/src/SMTP.php');
require_once('../PHPMailer/src/Exception.php');
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    function obraErrada(){

    $email = $_GET['email'];

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
        $mail->Subject = 'Eita...ocorreu um erro.';
        $mail->Body = 'Nós, da equipe Liver verificamos aqui, e infelizmente não conseguiremos cadastrar sua obra no site, seja por ela ser estrangeira ou inapropriada. Tente outra obra. <a href="www.liverbr.com" target="_blank"><button>Acesse</button></a>';

        if(!$mail->send()) {
            echo "<script>alert('Erro ao enviar o e-mail. Tente novamente.');</script>";
        } else {
            echo "<script>alert('E-mail enviado com sucesso! Verifique sua caixa de entrada.');</script>";

      
        } 
        
    }  catch (Exception $e) {
        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }
    }

    obraErrada();

    ?>

