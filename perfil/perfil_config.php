<?php

// Conecta-se ao banco de dados
require '../conexao.php';


session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['ID_USUARIO'])) {
    header('Location: ../login/doLogin.php');
    exit();
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Perfil Liver</title>
</head>
<body class="fundo">

    <div class="box-formulario">
<section class="perfil">

<h1 class="title">Vamos terminar de configurar o seu perfil?</h1>

<form method="POST" action="salvar_perfil.php" enctype="multipart/form-data">

    <label class="title" for="nome">Primeiro, insira seu nome:</label><br>
    <input  class="form" type="text" id="nome" name="txtnome" placeholder="Campo obrigatório*  " required><br>
   

    <label class="title" for="username">Qual username você deseja usar?</label><br>
    <input  class= "form" type="text" id="username" name="username" placeholder=" Campo obrigatório*  " required><br>

    <label class="title" for="bio">Faça uma breve biografia sobre você e seus gostos!</label><br>
    <textarea  class= "form" id="bio" name="txtbio" cols="30" rows="3"></textarea><br>
    
    <label class="title" id="label" for="foto">Escolha sua foto de perfil</label><br>
    <input  class= "form" type="file" class="submit_file" id="foto" name="foto"><br>
    
    <label class="title" id="label" for="foto_capa">Escolha sua foto de capa</label><br>
    <input class= "form" type="file" id="foto_capa" name="foto_capa"><br><br>

    <input type="submit" class="submit_btn" value="Salvar"><br><br>

</section>
  

</form>  
</div>
</body>
</html>











