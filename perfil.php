<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="icon" href="./imagens/logo2_liver.png" type="image/x-icon">
    <title>Perfil</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/perfildois.css">
  </head>

<body>

<!-- JS Bootstrap -->

<?php

session_start();
include "funcoes/functions_heloisa.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['ID_USUARIO'])) {
    header('Location: ../login.php');
    exit();
}
else{
  mostrarNavbarPerfilDois();
}

include "conexao.php";
mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, 'SET character_set_connection=utf8');
mysqli_query($con, 'SET character_set_client=utf8');
mysqli_query($con, 'SET character_set_results=utf8');

$id_usuario_SL = $_GET['id_usuario'];

// Consulta ao banco de dados para obter as informações do perfil do usuário
$sql = "SELECT * FROM perfil WHERE usuario_ID_USUARIO = $id_usuario_SL";
$result = mysqli_query($con, $sql);

// Verificar se o perfil do usuário existe no banco de dados
if (mysqli_num_rows($result) > 0) {
    // Recuperar as informações do perfil do usuário
    $row = mysqli_fetch_assoc($result);
    $nome = $row['NOME_PERFIL'];
    $username = $row['USERNAME_PERFIL'];
    $fotoPerfil = $row['FOTO_PERFIL'];
    $fotoCapa = $row['FOTOCAPA_PERFIL'];
    $bio = $row['BIO'];

    // Exiba os dados do perfil
    echo "<div class='container' x-data='{ rightSide: false, leftSide: false }'>";

    echo "<div class='main-container'>";
    echo "<div class='profile'>";

    if ($fotoCapa) {
    echo "<img src='imagens/img_user/fotos_capa/$fotoCapa' alt='Foto de Capa' class='profile-cover'><br>";
    } else {
    echo "<div id='foto-capa'></div>";
    } 
 
    echo "<div class='profile-avatar'>";
    if ($fotoPerfil) {
    echo "<img src='imagens/img_user/fotos_user/$fotoPerfil' alt='Foto de Perfil' class='profile-img'><br>";
    } else {
    echo "<img src='imagens/img_user/fotos_user/semfoto.png' alt='Foto de Perfil' id='foto-perfil'><br>";
    }

    echo "<div class='profile-name'>$nome</div>";
    echo "<div class='username'>@$username</div>";
    echo "<div class='bio'>$bio</div>";

    
    
} else {
    echo "Perfil do usuário não encontrado.";
}
  
?>
 <br><br><br>
<?php

//Botão seguir
// Verifique se o usuário está logado
if (isset($_SESSION['ID_USUARIO'])) {
    $idUsuario = $_SESSION['ID_USUARIO'];

    // Consulta SQL para verificar se o usuário logado está seguindo o usuário_SL
    $sqlVerificarSeguindo = "SELECT COUNT(*) AS totalSeguindo FROM seguir WHERE perfil_ID_PERFIL = $idUsuario AND ID_SEGUINDO_SEGUIR = $id_usuario_SL";

    // Executar a consulta SQL
    $resultadoVerificarSeguindo = mysqli_query($con, $sqlVerificarSeguindo);

    echo "<div class='profile-seguidores'>";
    if ($resultadoVerificarSeguindo) {
        $rowVerificarSeguindo = mysqli_fetch_assoc($resultadoVerificarSeguindo);
        $estaSeguindo = $rowVerificarSeguindo['totalSeguindo'];
        if ($estaSeguindo > 0) {
            echo "<form action='seguir/unfollow.php' method='get'>";
            echo "<input type='hidden' name='idU_Seguido' value='$id_usuario_SL'>";
            echo "<input type='submit' value='Seguindo' id= 'btn-user' class='btn-user-seguindo'>";
            echo "</form>";
        } else {
            echo "<form action='seguir/seguir.php' method='post'>";
            echo "<input type='hidden' name='idU_Seguir' value='$id_usuario_SL'>";
            echo "<input type='submit' value='Seguir usuário' class='btn-user'>";
            echo "</form>";
        }
    } else {
        echo "Erro ao verificar se está seguindo o usuário.";
    }
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
  

$sqlR = "SELECT * FROM resenhas WHERE usuarios_ID_USUARIO = $id_usuario_SL ORDER BY DATA_RESENHA DESC";
$resultadoResenhas = mysqli_query($con, $sqlR);

echo "<div class='position'>";

if (mysqli_num_rows($resultadoResenhas) > 0) {
   
   
    while ($row = mysqli_fetch_assoc($resultadoResenhas)) {
        $idObra = $row["obra_ID_OBRA"];
        
        $sqlO = "SELECT * FROM obra WHERE ID_OBRA = $idObra";
        $resultadoObra = mysqli_query($con, $sqlO);
        $obra = mysqli_fetch_assoc($resultadoObra);
        
        // Exiba as informações da obra
        // Exiba as informações da obra
        echo "<div class='album box'>";
        echo "<div class='borda'>";
        echo "<div class='status-main'>";
             
              echo "<div class='album-detail'>"; 
              echo "<div class='album-title'>" . $obra['NOME_OBRA'] . "</div>";
              echo "<div class='album-date'>" .  $obra['AU_DI_OBRA'] . "</div>";
              echo "</div>";
              echo "<img class= 'status-img' src='imagens/img_obras/" . $obra['FOTO_OBRA'] . "' alt='Foto da Obra'>";
              echo "<br><br>";
              echo "<div class='album-content'><p class='resenha-text'>" . $row['TXT_RESENHA'] . "</p>";
         
              if (strlen($row['TXT_RESENHA']) >= 400) {
                echo '<button class="ver-mais-btn" onclick="toggleVerMais(this)">Ver mais</button>';
            }
              echo "</div>";
              echo "</div>";
              echo '</div>';
            }
        } else {
            echo "<h5 id='resenha-not'><br><br><br><br>Aparentemente você ainda não tem resenhas.<br>";//<a href='../listar_obras.php'>Resenhe uma obra agora!</a><br></h3><br>";
        }
        echo "</div>";

// Fechar conexão com o banco de dados
$con->close();
?>

<script>
function toggleVerMais(button) {
    var container = button.closest('.album-content');
    container.classList.toggle("partial");
    button.textContent = container.classList.contains("partial") ? "Ver menos" : "Ver mais";
}
</script>