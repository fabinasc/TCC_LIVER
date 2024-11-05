<?php
require '../conexao.php';
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['ID_USUARIO'])) {
    echo "Você precisa estar logado para remover as curtidas";
    header('Location: ../login/index.php');
    exit();
}

$id_cit = $_POST['cit'];

if ($con->connect_error) {
    echo "error";
    exit;
}

$sql = "DELETE FROM favoritos WHERE citacoes_ID_CITACOES = $id_cit";

if (mysqli_query($con, $sql)) {
    echo "<script>alert('Curtida removida.');</script>";
    header('refresh:0.3;../citacoes/citacoes_curtidas.php');
} else {
    echo "<script>alert('Erro ao remover a curtida.');</script>";
    header('refresh:0.3;../citacoes/citacoes_curtidas.php');
}

$con->close();
?>
