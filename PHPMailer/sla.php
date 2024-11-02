<?php 
require 'vendor/autoload.php'; // Carrega o PHPMailer

// Função para gerar uma senha temporária (você pode personalizar isso)
function gerarSenhaTemporaria() {
    return substr(md5(uniqid()), 0, 8);
}

// Dados do cliente
$nomeDoCliente = "Nome do Cliente"; // Substitua pelo nome do cliente
$emailDoCliente = "cliente@email.com"; // Substitua pelo e-mail do cliente

// Gerar uma senha temporária
$novaSenha = gerarSenhaTemporaria();

// Configuração do PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.seudominio.com'; // Substitua pelo servidor SMTP do seu provedor de e-mail
$mail->SMTPAuth = true;
$mail->Username = 'seuemail@seudominio.com'; // Substitua pelo seu e-mail
$mail->Password = 'suasenha'; // Substitua pela senha do seu e-mail
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom('seuemail@seudominio.com', 'Seu Nome'); // Substitua pelo seu nome
$mail->addAddress($emailDoCliente, $nomeDoCliente);
$mail->isHTML(true);
$mail->Subject = 'Recuperação de Senha';
$mail->Body    = 'Sua nova senha temporária é: ' . $novaSenha;

// Enviar o e-mail
if ($mail->send()) {
    echo 'E-mail enviado com sucesso. Verifique sua caixa de entrada.';
} else {
    echo 'Erro ao enviar o e-mail: ' . $mail->ErrorInfo;
}
?>