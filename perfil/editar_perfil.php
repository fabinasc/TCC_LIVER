<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="icon" href="./public/logo2_liver.png" type="image/x-icon">
    <title>Configurações Gerais</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="editar_perfil.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  </head>

<body>

  <div class="container-fluid">
    <!--NAVBAR-->
    <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark w-100">
    <div class="container">
        <a class="navbar-brand">
            <img src="./public/liver_logo.png" alt="Logo LiVer" src="index.php" width="100" height="40"></a>
    </div>
    </nav>
    <br><br><br><br>
<!--NAVBAR TERMINA-->

<h2>Configurações Gerais</h2>
<div class="barra"></div>
<div class="barrax"></div>


<nav class="nav flex-column">
  <a class="nav-link" href="perfil_user.php">Voltar</a>
  
  
</nav>


<div class="formulario">

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

// Consulta o perfil do usuário
$sql = "SELECT * FROM perfil WHERE usuario_ID_USUARIO = $idUsuario";
$resultado = mysqli_query($con, $sql);

if (mysqli_num_rows($resultado) > 0) {
    $perfil = mysqli_fetch_assoc($resultado);
    $nome = $perfil['NOME_PERFIL'];
    $username = $perfil['USERNAME_PERFIL'];
    $bio = $perfil['BIO'];
    $fotoPerfil = $perfil['FOTO_PERFIL'];
    $fotoCapa = $perfil['FOTOCAPA_PERFIL'];

    // Exiba o formulário de alteração do perfil


    echo "<h4>Editar Perfil</h4>";
    echo "<form enctype='multipart/form-data' method='POST' action='atualizar_perfil.php'>";
    echo "Nome: <input type='text' class='name-estilizado' name='nome' value='$nome'><br>";
    echo "Username: <input type='text' class='username-estilizado' name='username' value='$username'><br>";
    echo "Bio: <textarea class='bio-estilizado' name='txtbio'>$bio</textarea><br>";
    echo "Foto de Perfil: <input type='file'class='foto-estilizado'name='fotoPerfil'> <br><br>";
    echo "Foto de Capa: <input type='file' class= 'capa-estilizado' name='fotoCapa'><br><br>";
    echo "<input type='submit'class='salvar-estilizado'value='Salvar'>";
    echo "</form>";

}



// Fechar a conexão com o banco de dados
mysqli_close($con);
?>

</div>
<div class="img-fundo" data-tilt>
                    <img src="public\user1.png" alt="IMG">
                </div>
</body>

