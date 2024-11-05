<?php

require_once('../PHPMailer/src/PHPMailer.php');
require_once('../PHPMailer/src/SMTP.php');
require_once('../PHPMailer/src/Exception.php');
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "conexao.php"; 
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['ID_USUARIO'])) {
    header('Location: ../index.html');
    exit();
}

mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, 'SET character_set_connection=utf8');
mysqli_query($con, 'SET character_set_client=utf8');
mysqli_query($con, 'SET character_set_results=utf8');

$idUsuario = $_SESSION['ID_USUARIO'];
$valorobra = 2;
$nome = $_POST['nomefilme'];
$diretor = $_POST['diretorfilme'];
$ano = $_POST['anofilme'];
$elenco = $_POST['elencofilme'];
$sinopse = $_POST['sinopsefilme'];
$duracao = $_POST['duracao'];
$distrib = $_POST['distfilme'];
$produtora = $_POST['prodfilme'];
$classif = $_POST['classiffilme'];
$foto = $_FILES['fotofilme']['name'];
$foto2 = $_FILES['fotofilme']['tmp_name'];

$fotoNomeInput = 'fotofilme'; // Nome do input do formulário usado para enviar o arquivo
$diretorioFotoF = "../imagens/img_obras/";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

//Verificando se filme já está no bd
function verificarObra($con, $nome) {
    $sql = "SELECT * FROM obra WHERE NOME_OBRA = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $nome);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    return mysqli_num_rows($resultado) > 0;
}

if(@move_uploaded_file($foto2, $diretorioFotoF.$foto))
{
    //Verificando se tem algum campo em branco 
    if (empty($nome) || empty($diretor) || empty($ano) || empty($sinopse) || empty($foto) || empty($elenco) || empty($duracao) || empty($distrib) || empty($produtora)) {
        echo "<script>alert('Por favor, preencha todos os campos!');</script>";
    } else if (verificarObra($con, $nome)) {
        echo "<script>alert('Obra já cadastrada em nosso sistema.');</script>";
    } else {
        echo "";
       
     // Capturar o endereço de e-mail do formulário
     $emailDoCliente = $_POST['email'];

     // Verificar se o e-mail está registrado no banco de dados ou em sua lógica de aplicativo
     $emailDoCliente = mysqli_real_escape_string($con, $emailDoCliente); // Proteção contra injeção SQL
     $sqlID = "SELECT * FROM usuarios WHERE EMAIL_USUARIO='$emailDoCliente'";
     $resultado = mysqli_query($con, $sqlID);
 
     if ($resultado = $emailDoCliente) {
 
         $mail = new PHPMailer(true);
 
         try {
             $mail->CharSet = 'UTF-8';
             $mail->isSMTP();
             $mail->Host = 'smtp.gmail.com';
             $mail->SMTPAuth = true;
             $mail->Username = 'liverbrasil1@gmail.com';
             $mail->Password = 'sucmwgnfyeldjvxr';   
             $mail->Port = 587;
          
             $mail->setFrom("$emailDoCliente", "$idUsuario");
             $mail->addAddress('liverbrasil1@gmail.com', "Liver");
             $mail->isHTML(true);
             $mail->Subject = 'Verificando a Obra';
             $mail->Body = "<form action='obra_permitida.php' name='verificar' method='POST'>
                            Nome do livro: $nome <br> 
                            Diretor: $diretor <br> 
                            Ano de lançamento: $ano <br> 
                            Sinopse: $sinopse <br>
                            Elenco: $elenco <br> 
                            Produtora: $produtora <br> 
                            Distribuidora: $distrib <br>
                            Duração: $duracao <br> 
                            Classificação: $classif <br> 
                            Foto: $foto <br>
                            Email: $emailDoCliente<br>
                            <a href='http://localhost/TCC_LIVER/cadastro_obra/obra_permitida.php?email=$emailDoCliente&valorobra=$valorobra&nomefilme=$nome&diretorfilme=$diretor&anofilme=$ano&sinopsefilme=$sinopse&fotofilme=$foto&elencofilme=$elenco&duracao=$duracao&classiffilme=$classif&distfilme=$distrib&prodfilme=$produtora' target='_blank'><button>Permitir</button></a>
                            <a href='http://localhost/TCC_LIVER/cadastro_obra/obra_naopermitida.php?email=$emailDoCliente' target='_blank'><button>Não Permitir</button></a>    
                            </form>";
         
             if(!$mail->send()) {
                 echo "<script>alert('Erro ao enviar o e-mail. Tente novamente.');</script>";
                 header("refresh:0.5,cadastro_obra.php");
             } else {
                 echo "<script>alert('Perfeito! Agora iremos verificar se sua obra pode entrar em nosso site. Verifique sua caixa de entrada em alguns minutos.');</script>";
                 header("refresh:0.5,../listar_obras_CL.php");
           
             } 
                     } 
                     catch (Exception $e) {
                         echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
                     }     
         }      
     
 
    }
}

}

?>
