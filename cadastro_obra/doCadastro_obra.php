<?php 
require '../conexao.php';
session_start();
include "../funcoes/functions_Heloisa.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['ID_USUARIO'])) {
    header('Location: ../login.php');
    exit();
}
else{
  mostrarNavbarCadObra();
}

?>
<!DOCTYPE html>
<html lang="pt-br">         
<head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
             <link rel="icon" href="./imagens/logo2_liver.png" type="image/x-icon">

            <link rel="stylesheet" href="..\css/cadestilo.css">
            <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
            <title>Cadastro de Obra</title>
</head>
<body>
<br><br> 
    

<?php 
$opcao= $_POST['catobra'];

 // Faz a conexão com o banco de dados
 include "../conexao.php";
 mysqli_query($con,"SET NAMES 'utf8'");  
 mysqli_query($con,'SET character_set_connection=utf8');  
 mysqli_query($con,'SET character_set_client=utf8');  
 mysqli_query($con,'SET character_set_results=utf8'); 

 // Verifica se o formulário foi enviado pelo método POST
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($opcao)) {
        // Verifica se a opção foi selecionada

        $opcaoSelecionada = $_POST["catobra"];
        echo "<div class='position-cad'>";
        echo "<div class='titulo-cad'>";
        echo "Cadastrar um/uma: " . $opcaoSelecionada;
        echo "</div>";
        echo "</div>";
        
    } else {
        echo "Nenhuma opção selecionada.";
    }
}
?>

<ul class="progressbar">
          <li class="active">Passo 1</li>
           <li class="active">Passo 2</li>
            <li>Concluído</li>
          </ul>


<?php

//Cadastrando um livro
if ($opcaoSelecionada == "Livro") {
    echo "<div class='formulario-cad'>";
    echo "<div class='primeira-col'>";
    echo "<form enctype='multipart/form-data' method='POST' action='cadastrolivro.php' action='obra_permitida.php'>";
    echo "Insira uma foto da capa do livro: <br><input type='file' class='input' id='img-input' name='fotolivro' style='display:none' accept='image/*' required onchange='previewImage(this)'><br><br>";
    echo "<div id='img-container'>";
    echo "<label for='img-input'>";
    echo "<img id='preview' src='../imagens/Img_fundo/livro-cinza_Prancheta 1.svg'>";
    echo "<p><i class='fa-solid fa-camera  fa-2xl' id='icon'></i></p>";
    echo "</label>";
    echo "</div>";
    echo "</div>";
    echo "<div class='sinopse-col'>";
    echo "Sinopse:<br><textarea name='sinopselivro' id='autoresizing'></textarea><br><br>";
    echo "</div>";
    echo "<div class='segunda-col'>";
    echo "Nome do Livro:<br><input type='text' class='input' name='nomelivro'><br><br>";
    echo "Autor:<br><input type='text' class='input' name='autor'><br><br>";
    echo "Editora:<br><input type='text' class='input' name='editora'><br><br>";
    echo "Ano em que foi publicado:<br><input type='text' id='col-1' class='input'  name='anolivro'><br><br>";  
    echo "Quantas páginas?<br><input type='text' id='col-1' class='input' name='paginas'><br><br>";
    echo "Classificação Indicativa:<br><input type='text' id='col-1' class= 'input'  name='classiflivro'><br><br>";   
    echo "Confirme seu e-mail:<br><input type='text' id='col-1' class='input' name='email'><br><br>";
    echo "<input type='submit' class='conf' id='conf-position' value='Salvar'>";
    echo "</div>";
    echo "</form>";
    echo "</div>";
 
}

//Cadastrando um filme 
if ($opcaoSelecionada == "Filme") {
    echo "<div class='formulario-cad'>";
    echo "<div class='primeira-col'>";
    echo "<form enctype='multipart/form-data' method='POST' action='cadastrofilme.php'>";
    echo "Insira uma foto da capa do livro: <br><input type='file' class='input' id='img-input' name='fotofilme' style='display:none' accept='image/*' required onchange='previewImage(this)'><br><br>";
    echo "<div id='img-container'>";
    echo "<label for='img-input'>";
    echo "<img id='preview' src='../imagens/Img_fundo/livro-cinza_Prancheta 1.svg'>";
    echo "<p><i class='fa-solid fa-camera  fa-2xl' id='icon'></i></p>";
    echo "</label>";
    echo "</div>";
    echo "</div>";
    echo "<div class='sinopse-col'>";
    echo "Sinopse:<br><textarea name='sinopsefilme' id='autoresizing'></textarea><br><br>";
    echo "</div>";
    echo "<div class='segunda-col'>";
    echo "Nome do Filme:<br><input type='text' class= 'input' name='nomefilme'><br><br>";
    echo "Diretor:<br><input type='text' class= 'input' name='diretorfilme'><br><br>";
    echo "Distribuidora (Netflix, Prime, etc..?):<br><input type='text' class= 'input' name='distfilme'><br><br>";
    echo "Produtora:<br><input type='text' class= 'input' name='prodfilme'><br><br>";
    echo "Elenco principal: <br><input type='text' class= 'input' name='elencofilme'><br><br>";
    echo "Ano de lançamento:<br><input type='text' id='col-1' class= 'input'  name='anofilme'><br><br>"; 
    echo "Quanto tempo de duração? (Em minutos)<br><input type='text' id='col-1' class= 'input'  name='duracao'><br><br>";
    echo "Classificação Indicativa:<br><input type='text' id='col-1' class= 'input'  name='classiffilme'><br><br>";
    echo "Confirme seu e-mail:<br><input type='text' id='col-1' class= 'input' name='email'><br><br>";
    echo "<input type='submit' class='conf' id='conf-position' value='Salvar'>";
    echo "</div>";
    echo "</form>";
    echo "</div>";
}
//Cadastrando uma série 
if ($opcaoSelecionada == "Série") {
    echo "<div class='formulario-cad'>";
    echo "<div class='primeira-col'>";
    echo "<form enctype='multipart/form-data' method='POST' action='cadastroserie.php'>";
    echo "Insira uma foto da capa do livro: <br><input type='file' class='input' id='img-input' name='fotoserie' style='display:none' accept='image/*' required onchange='previewImage(this)'><br><br>";
    echo "<div id='img-container'>";
    echo "<label for='img-input'>";
    echo "<img id='preview' src='../imagens/Img_fundo/livro-cinza_Prancheta 1.svg'>";
    echo "<p><i class='fa-solid fa-camera  fa-2xl' id='icon'></i></p>";
    echo "</label>";
    echo "</div>";
    echo "</div>";
    echo "<div class='sinopse-col'>";
    echo "Sinopse:<br><textarea name='sinopsefilme' id='autoresizing'></textarea><br><br>";
    echo "</div>";
    echo "<div class='segunda-col'>";
    echo "Nome da Série:<br><input type='text' class='input' name='nomeserie'><br><br>";
    echo "Diretor:<br><input type='text' class='input' name='diretorserie'><br><br>";
    echo "Distribuidora (Netflix, Prime, etc..):<br><input type='text' class='input' name='distserie'><br><br>";
    echo "Produtora:<br><input type='text' class='input' name='prodserie'><br><br>";
    echo "Elenco principal: <br><input type='text' class='input' name='elencoserie'><br><br>";
    echo "Ano de lançamento:<br><input type='text' id='col-1' class='input' name='anoserie'><br><br>"; 
    echo "Quantas temporadas?<br><input type='text' id='col-1' class='input' name='tempserie'><br><br>";
    echo "Classificação Indicativa:<br><input type='text' id='col-1' class='input' name='classifserie'><br><br>";
    echo "Confirme seu e-mail:<br><input type='text' id='col-1' class='input' name='email'><br><br>";
    echo "<input type='submit' class='conf' id='conf-position' value='Salvar'>";
    echo "</div>";
    echo "</form>";
    echo "</div>";
 
}

//Cadastrando uma novela 
if ($opcaoSelecionada == "Novela") {
    echo "<div class='formulario-cad'>";
    echo "<div class='primeira-col'>";
    echo "<form enctype='multipart/form-data' method='POST' action='cadastronovela.php'>";
    echo "Insira uma foto da capa do livro: <br><input type='file' class='input' id='img-input' name='fotonovela' style='display:none' accept='image/*' required onchange='previewImage(this)'><br><br>";
    echo "<div id='img-container'>";
    echo "<label for='img-input'>";
    echo "<img id='preview' src='../imagens/Img_fundo/livro-cinza_Prancheta 1.svg'>";
    echo "<p><i class='fa-solid fa-camera  fa-2xl' id='icon'></i></p>";
    echo "</label>";
    echo "</div>";
    echo "</div>";
    echo "<div class='sinopse-col'>";
    echo "Sinopse:<br><textarea name='sinopsefilme' id='autoresizing'></textarea><br><br>";
    echo "</div>";
    echo "<div class='segunda-col'>";
    echo "Nome da Novela:<br><input type='text' class='input' name='nomenovela'><br><br>";
    echo "Diretor:<br><input type='text' class='input' name='diretornovela'><br><br>";
    echo "Emissora (Globo, SBT, Record...):<br><input type='text' class='input' name='emissora'><br><br>";
    echo "Elenco principal: <br><input type='text' class='input' name='elenconovela'><br><br>";
    echo "Ano de lançamento:<br><input type='text' id='col-1' class='input'  name='anonovela'><br><br>";
    echo "Quantos capítulos?<br><input type='text' id='col-1' class='input'  name='epsnovela'><br><br>";
    echo "Classificação Indicativa:<br><input type='text' id='col-1' class='input'  name='classifnovela'><br><br>";
    echo "Confirme seu e-mail:<br><input type='text' id='col-1' class='input'  name='email'><br><br>";
    echo "<input type='submit' class='conf' id='conf-position' value='Salvar'>";
    echo "</div>";
    echo "</form>";
    echo "</div>";
}

?>
<script>
function previewImage(input) {
    var preview = document.getElementById('preview');
    var file = input.files[0];
    var reader = new FileReader();

    reader.onloadend = 

    reader.onloadend =
function () {
        preview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "../imagens/Img_fundo/livro-cinza_Prancheta 1.svg"; // ou outra imagem padrão
    }
}
</script>
</body>
</html>