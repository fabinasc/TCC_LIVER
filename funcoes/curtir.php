<?php
// Conecte-se ao banco de dados
require '../conexao.php';

// Inicie a sessão
session_start();

if (isset($_POST['curtir'])) {
    $resenhaId = $_POST['resenha_id'];
    $usuarioId = $_SESSION['ID_USUARIO']; // Obtém o ID do usuário da sessão
    $id_obra = $_POST['id_obra'];
    $valor_obra = $_POST['valor_obra'];

    // Verifique se o usuário já curtiu ou descurtiu a resenha
    $sqlVerificarCurtida = "SELECT ID_CURTIR FROM curtir WHERE resenha_usuario_ID_USUARIO = $usuarioId AND resenha_ID_RESENHA = $resenhaId";
    $result = $con->query($sqlVerificarCurtida);

    if ($result->num_rows > 0) {
        // O usuário já curtiu ou descurtiu, então você pode adicionar a lógica de remover a curtida aqui.
        $sqlRemoverCurtida = "DELETE FROM curtir WHERE resenha_usuario_ID_USUARIO = $usuarioId AND resenha_ID_RESENHA = $resenhaId";
        if ($con->query($sqlRemoverCurtida) === TRUE) {
            echo "Curtida removida com sucesso.";
        } else {
            echo "Erro ao remover curtida: " . $con->error;
        }
    } else {
        // Adicionar a nova curtida (ou descurtida)
        $sqlInserirCurtida = "INSERT INTO curtir (TIME_CURTIR, resenha_ID_RESENHA, resenha_usuario_ID_USUARIO) VALUES (CURRENT_TIMESTAMP, $resenhaId, $usuarioId)";
        if ($con->query($sqlInserirCurtida) === TRUE) {
            echo "Curtida adicionada com sucesso.";
        } else {
            echo "Erro ao adicionar curtida: " . $con->error;
        }
    }
}

// Redirecionar de volta para a página de resenhas
header("Location: ../listar_obras_SL.php?id_obra=" . $id_obra . "&valor_obra=" . $valor_obra);
?>
