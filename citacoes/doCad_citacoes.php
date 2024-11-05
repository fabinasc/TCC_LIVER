<?php
// Conecta-se ao banco de dados

require '../conexao.php';
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['ID_USUARIO'])) {
    header('Location: ../login/index.html');
    exit();
}

mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, 'SET character_set_connection=utf8');
mysqli_query($con, 'SET character_set_client=utf8');
mysqli_query($con, 'SET character_set_results=utf8');

// Obtém o ID do usuário logado
$idUsuario = $_SESSION['ID_USUARIO'];
$idObra = $_SESSION['id_obra'];
$citacao = mysqli_real_escape_string($con, $_POST['txtCitacao']); // Evita SQL Injection

// Prepara a consulta SQL usando prepared statement para evitar SQL Injection
$sql = "INSERT INTO citacoes (DESC_CITACAO, obra_ID_OBRA, usuario_ID_USUARIO) VALUES (?, ?, ?)";

if ($stmt = mysqli_prepare($con, $sql)) {
    // Vincula as variáveis à instrução preparada como parâmetros
    mysqli_stmt_bind_param($stmt, "sii", $citacao, $idObra, $idUsuario);

    // Executa a consulta
    if (mysqli_stmt_execute($stmt)) {
        // Citacao inserida com sucesso
        echo "<script>window.alert('Citação Salva!');</script>";
        header('refresh:1.5;../perfil/perfil_user.php');
        exit();
    } else {
        // Erro ao inserir a citação
        echo "Erro ao criar a citação. Por favor, tente novamente.";
    }

    // Fecha a instrução preparada
    mysqli_stmt_close($stmt);
} else {
    // Erro na preparação da consulta
    echo "Erro na preparação da consulta. Por favor, tente novamente.";
}

// Fecha a conexão com o banco de dados
mysqli_close($con);
?>
