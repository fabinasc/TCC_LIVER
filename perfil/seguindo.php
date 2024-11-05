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
$idUsuario = $_SESSION ['ID_USUARIO'];
// Consulta o perfil do usuário
$sql = "SELECT * FROM perfil WHERE usuario_ID_USUARIO = $idUsuario";
$resultado = mysqli_query($con, $sql);

if (mysqli_num_rows($resultado) > 0) {
    $perfil = mysqli_fetch_assoc($resultado);
    $nome = $perfil['NOME_PERFIL'];
    $username = $perfil['USERNAME_PERFIL'];
    $fotoPerfil = $perfil['FOTO_PERFIL'];
    $fotoCapa = $perfil['FOTOCAPA_PERFIL'];
    $bio = $perfil['BIO']; 
} 

else {
    echo "Perfil não encontrado.";
}
$sqlSeguindo = "SELECT * FROM seguir WHERE perfil_ID_PERFIL = $idUsuario";
$resultadoSeguindo = mysqli_query($con, $sqlSeguindo);

echo "<div class='profile-seguidores'>";

if (mysqli_num_rows($resultadoSeguindo) > 0) {

    echo "<h3>Pessoas que você segue:</h3>";
    while ($rowSeguindo = mysqli_fetch_assoc($resultadoSeguindo)) {
        $idSeguido = $rowSeguindo['ID_SEGUINDO_SEGUIR'];
        $sqlPerfilSeguido = "SELECT * FROM perfil WHERE usuario_ID_USUARIO = $idSeguido";
        $resultadoPerfilSeguido = mysqli_query($con, $sqlPerfilSeguido);
        $perfilSeguido = mysqli_fetch_assoc($resultadoPerfilSeguido);
        $nomeSeguido = $perfilSeguido['NOME_PERFIL'];
        $usernameSeguido = $perfilSeguido['USERNAME_PERFIL'];
        $idU_Seguido = $perfilSeguido['usuario_ID_USUARIO'];
        
        // Verifica se o perfil sendo exibido é diferente do seu próprio perfil
        if ($idU_Seguido != $idUsuario) {
            echo "<p>$nomeSeguido - <a href='../perfil.php?id_usuario=$idU_Seguido'>@$usernameSeguido</a> <a href='../seguir/unfollow.php?idU_Seguido=$idU_Seguido'>Deixar de Seguir</a></p>";
        }
    }
} else {
    echo "<h3 id='seguindo'>Você não está seguindo ninguém.</h3>";
    
}
echo"</div>";
    ?>