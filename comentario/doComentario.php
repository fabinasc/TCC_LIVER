<?php
// Conecta-se ao banco de dados
require '../conexao.php';
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['ID_USUARIO'])) {
    header('Location: ../login/index.html');
    exit();
}

// Recupera os valores do formulário
$idUsuario = $_SESSION['ID_USUARIO'];
$id_resenha = $_POST['id_resenha'];
$_SESSION['id_resenha'] = $id_resenha;
$comentario = $_POST['txtComent'];

//Insere o comentário no banco de dados
  $sql_inserir_comentario = "INSERT INTO comentarios (TXT_COMENTARIO, resenha_ID_RESENHA, usuarios_ID_USUARIO)
                               VALUES ('$comentario', '$id_resenha', '$idUsuario')";
    
    if ($con->query($sql_inserir_comentario) === TRUE) {
      echo "<script>window.alert('Comentário salvo!');</script>";
    header('refresh:1;../timeline.php');
    exit();
    } else {

    // Erro ao inserir o comentário
    echo "<script>window.alert('Comentário NÃO salvo');</script>";
 header('refresh:1;../timeline.php');}

mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, 'SET character_set_connection=utf8');
mysqli_query($con, 'SET character_set_client=utf8');
mysqli_query($con, 'SET character_set_results=utf8');

// Fecha a conexão com o banco de dados
mysqli_close($con);
?>