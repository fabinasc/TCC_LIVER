
<?php
session_start();
require '../conexao.php';
mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, 'SET character_set_connection=utf8');
mysqli_query($con, 'SET character_set_client=utf8');
mysqli_query($con, 'SET character_set_results=utf8');

if (!isset($_SESSION['ID_USUARIO'])) {
    echo "Você precisa estar logado para adicionar à sua classificação";
    header('Location: ../login/index.html');
    exit();
}

// Utilize declarações preparadas corretamente

$idUsuario = $_SESSION['ID_USUARIO'];
$idObra = $_SESSION['id_obra']; // Certifique-se de que 'id_obra' está definido corretamente na sessão
$valor_obra = $_SESSION['valor_obra'];
$estrela = $_POST['estrela'];

if (!empty($estrela)) {
    $sql = "INSERT INTO classificar (NOTA_CLASSIFICAR, obra_ID_OBRA, usuario_ID_USUARIO) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $estrela, $idObra, $idUsuario);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            $last_id = mysqli_insert_id($con);
            if ($last_id) {
                $_SESSION['msg'] = "Avaliação: $estrela.0
                <br>
                Deseja reavaliar?";
                header("Location: ../listar_obras_SL.php?id_obra=" . $idObra . "&valor_obra=" . $valor_obra);

            } else {
                $_SESSION['msg'] = "Erro ao obter o ID da avaliação";
                header("Location: ../listar_obras_SL.php?id_obra=" . $idObra . "&valor_obra=" . $valor_obra);
            }
        } else {
            $_SESSION['msg'] = "Erro ao executar a consulta preparada: " . mysqli_stmt_error($stmt);
            header("Location: ../listar_obras_SL.php?id_obra=" . $idObra . "&valor_obra=" . $valor_obra);
        }
    } else {
        $_SESSION['msg'] = "Erro ao preparar a consulta: " . mysqli_error($con);
        header("Location: ../listar_obras_SL.php?id_obra=" . $idObra . "&valor_obra=" . $valor_obra);
    }
} else {
    $_SESSION['msg'] = "Necessário selecionar pelo menos 1 estrela";
    header("Location: ../listar_obras_SL.php?id_obra=" . $idObra . "&valor_obra=" . $valor_obra);
}




