<?php
require '../conexao.php';
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['ID_USUARIO'])) {
    echo "Você precisa estar logado para remover dos favoritos";
    header('Location: ../login/index.php');
    exit();
}

$idObra = $_POST['obra'];

if ($con->connect_error) {
    echo "error";
    exit;
}

$sql = "DELETE FROM favoritos WHERE obra_ID_OBRA = $idObra";

if (mysqli_query($con, $sql)) {
    echo "<script>alert('Obra removida dos favoritos!');</script>";
    header('refresh:0.5;../perfil/meus_favoritos.php');
} else {
    echo "<script>alert('Erro ao remover a obra dos favoritos.');</script>";
    header('refresh:0.5;../perfil/meus_favoritos.php');
}

$con->close();
?>

