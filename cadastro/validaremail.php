<?php 
require 'conexao.php';

$email = $_POST['txtemail'];
$senha = $_POST['txtnova'];
$confsenha = $_POST['txtnovaconf'];

//Verificando se o email existe no BD
$sqlEmail= "SELECT * FROM usuarios WHERE EMAIL_USUARIO ='$email'";
$result = mysqli_query($con, $sqlEmail);

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('E-mail inválido. Tente novamente.');</script>";
    header("refresh:0.5,validaremail.html");
    exit();

//Verifica a força da senha
}  else if (strlen($senha) < 8 || !preg_match('/[A-Z]/', $senha) || !preg_match('/[a-z]/', $senha) || !preg_match('/[0-9]/', $senha)) {
    echo "<script>alert('A senha deve ter pelo menos 8 caracteres, incluindo letras maiúsculas, minúsculas e números!');</script>";
    header('refresh:0.5;validaremail.html');
    exit();

//Confirma se a senhas estão iguais
} else if ($senha != $confsenha){
    echo "<script>alert('Algo deu errado. Tente novamente.');</script>";
    header('refresh:0.5;validaremail.html');
} else {

//Faz a atualização no BD
    $sql = "UPDATE usuarios SET SENHA_USUARIO = '$confsenha' WHERE EMAIL_USUARIO = '$email'";
    mysqli_query($con,$sql);
    echo "<script>alert('Sua conta foi criada com sucesso!');</script>";
}

// Inicia a sessão
session_start();

// Armazena o ID do usuário recém-criado na sessão
$idUsuario = mysqli_insert_id($con);
$_SESSION['ID_USUARIO'] = $idUsuario;

header('refresh:0.5;../perfil/perfil_config.php');

mysqli_close($con);
?>