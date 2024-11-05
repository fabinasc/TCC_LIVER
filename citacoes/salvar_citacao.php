<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../conexao.php';
mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, 'SET character_set_connection=utf8');
mysqli_query($con, 'SET character_set_client=utf8');
mysqli_query($con, 'SET character_set_results=utf8');

session_start();
if (!isset($_SESSION['ID_USUARIO'])) {
    echo "Você precisa estar logado para curtir a citação!";
    header('Location: ../login/index.html');
    exit();
}

$idUsuario = $_SESSION['ID_USUARIO'];
$sqlperfil = "SELECT * FROM perfil WHERE usuario_ID_USUARIO = $idUsuario";
$resultado = mysqli_query($con, $sqlperfil);
$row = mysqli_fetch_assoc($resultado);
$id_cit = $_POST['cit'];
$id_obra = $_POST['obra'];
$_SESSION['ID_PERFIL'] = $row['ID_PERFIL'];
$idPerfilUsuario = $_SESSION['ID_PERFIL'];

    $sqlverif = "SELECT * FROM favoritos WHERE citacoes_ID_CITACOES = $id_cit";
    $resultado2 = mysqli_query($con, $sqlverif);

    if (mysqli_num_rows($resultado2) > 0) {
    echo "<script>alert('Você já curtiu essa citação antes!');</script>";
        header('refresh:0.2;./citacoes.php');

    } else {
    $sql = "INSERT INTO favoritos (TIPO_FAVORITO, obra_ID_OBRA, citacoes_ID_CITACOES, obra_perfil_ID_PERFIL, obra_perfil_usuario_ID_USUARIO, usuario_ID_USUARIO) VALUES (2, $id_obra, $id_cit, $idPerfilUsuario, $idUsuario, $idUsuario)";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Citação curtida!');</script>";
        header('refresh:0.2;./citacoes.php');
    } else {
        echo "<script>alert('Erro ao curtir a citação.');</script>";
        header('refresh:0.2;./citacoes.php');
    }
}

mysqli_close($con);

?>