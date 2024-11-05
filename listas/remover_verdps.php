<?php
require '../conexao.php';
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['ID_USUARIO'])) {
    echo "Você precisa estar logado para remover do Ver Depois";
    header('Location: ../login/index.php');
    exit();
}

$idObra = $_POST['obra'];

if ($con->connect_error) {
    echo "error";
    exit;
}

$sql = "DELETE FROM depois WHERE obra_ID_OBRA = $idObra";

if (mysqli_query($con, $sql)) {
    echo "<script>alert('Obra removida da lista Ver Depois!');</script>";
    header('refresh:0.5;../perfil/meu_verdps.php');
} else {
    echo "<script>alert('Erro ao remover a obra da lista.');</script>";
    header('refresh:0.5;../perfil/meu_verdps.php');
}

$con->close();
?>