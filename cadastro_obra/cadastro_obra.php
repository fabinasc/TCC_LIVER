<?php 
require '../conexao.php';
session_start();
include "../funcoes/functions_heloisa.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['ID_USUARIO'])) {
    header('Location: ../login.php');
    exit();
}
else{
    mostrarNavbarCadObra();  
  }
?>
<html> 

<!DOCTYPE html>
<html lang="pt-br">
<html> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./imagens/logo2_liver.png" type="image/x-icon">
    <link rel="stylesheet" href="..\css/cadestilo.css">
    <title>Cadastar Obra</title>
</head>
<body>
<br>

<div class="position-cad">
<div class="titulo-cad">Cadastre uma obra no Liver!</div>
</div>
  <ul class="progressbar">
  <li class="active">Passo 1</li>
   <li>Passo 2</li>
    <li>Concluído</li>
  </ul>
<br><br> 

    <div class="box-cad">   
      <div class="box-cad-filha">  

    <form method="POST" action="doCadastro_obra.php" name="catobra">
    <label for="categoria" class="titulo-cat">Selecione uma categoria</label>
    <br><br>
        <div class="select">   
    <select name="catobra" method="POST">
            <option value="selecione">Selecione:</option>
            <option value="Livro">Livro</option>
            <option value="Filme">Filme</option>
            <option value="Série">Série</option>
            <option value="Novela">Novela</option>
        </select>
        </div>
        <br><br>
        <input type="submit" name="submit" class="conf" value="Confirmar">
    </form>
    </div>

</div>
</body>
</html>
