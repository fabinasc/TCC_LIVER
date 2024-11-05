<?php
include 'conexao.php';
session_start();

// Verifique se o usuário está autenticado
if (!isset($_SESSION['ID_USUARIO'])) {
    header("Location: login.php"); // Redirecione para a página de login se não estiver autenticado
    exit();
}

// Verifique se os parâmetros type e item_id estão presentes na consulta
if (isset($_GET['type']) && isset($_GET['item_id'])) {
    $type = $_GET['type'];
    $item_id = $_GET['item_id'];

    if ($type == 'resenhas') {
    $queryres = "DELETE FROM $type WHERE ID_RESENHA = $item_id";
    $resultres = $con->query($queryres);

     }

    elseif ($type == 'citacoes') {
    $querycit = "DELETE FROM $type WHERE ID_CITACOES = $item_id";
    $resultcit = $con->query($querycit);
    }

    elseif ($type == 'comentarios') {
    $querycom = "DELETE FROM $type WHERE ID_COMENTARIO = $item_id";
    $resultcom = $con->query($querycom);
    }
     
    echo "<script>window.alert('Deletado com sucesso.');</script>";
    // Redirecione de volta para a página principal após a exclusão
     header('refresh:0.5;./timeline.php');
    exit();
} else {
    echo "Tipo de item ou ID do item não especificado.";
}
?>
