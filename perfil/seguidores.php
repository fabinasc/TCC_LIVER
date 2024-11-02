<?php

// Conecta-se ao banco de dados
require '../conexao.php';

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['ID_USUARIO'])) {
    header('Location: login.php');
    exit();
}

// Obtém o ID do usuário logado
$idUsuario = $_SESSION['ID_USUARIO'];

// Consulta o perfil do usuário logado
$sql = "SELECT * FROM perfil WHERE usuario_ID_USUARIO = $idUsuario";
$resultado = mysqli_query($con, $sql);

if (mysqli_num_rows($resultado) > 0) {
    $perfil = mysqli_fetch_assoc($resultado);
    $nome = $perfil['NOME_PERFIL'];
    $username = $perfil['USERNAME_PERFIL'];
    $fotoPerfil = $perfil['FOTO_PERFIL'];
    $fotoCapa = $perfil['FOTOCAPA_PERFIL'];
    $bio = $perfil['BIO'];
} else {
    echo "Perfil não encontrado.";
}

$sqlSeguidores = "SELECT ID_SEGUINDO_SEGUIR FROM seguir WHERE perfil_ID_PERFIL = $idUsuario";
$resultadoSeguidores = mysqli_query($con, $sqlSeguidores);

echo "<div class='profile-seguidores'>";

if (mysqli_num_rows($resultadoSeguidores) > 0) {
    echo "<h3>Seus Seguidores:</h3>";
    while ($rowSeguidor = mysqli_fetch_assoc($resultadoSeguidores)) {
        $idSeguidor = $rowSeguidor['ID_SEGUINDO_SEGUIR'];
        $sqlPerfilSeguidor = "SELECT * FROM perfil WHERE usuario_ID_USUARIO = $idSeguidor";
        $resultadoPerfilSeguidor = mysqli_query($con, $sqlPerfilSeguidor);

        if (mysqli_num_rows($resultadoPerfilSeguidor) > 0) {
            $perfilSeguidor = mysqli_fetch_assoc($resultadoPerfilSeguidor);
            $nomeSeguidor = $perfilSeguidor['NOME_PERFIL'];
            $usernameSeguidor = $perfilSeguidor['USERNAME_PERFIL'];
            $idU_Seguidor = $perfilSeguidor['usuario_ID_USUARIO'];

            // Verifica se o perfil sendo exibido é diferente do seu próprio perfil
            if ($idU_Seguidor != $idUsuario) {
                echo "<p>$nomeSeguidor - <a href='../perfil.php?id_usuario=$idU_Seguidor'>@$usernameSeguidor</a></p>";
            }
        }
    }
} else {
    echo "<h3 id='seguidores'>Você não tem seguidores.</h3>";
}

echo "</div>";

?>
