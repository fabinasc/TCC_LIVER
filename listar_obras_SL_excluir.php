<!DOCTYPE html>
<html>
<head>
    <title>Descrição</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/detalhes.css">
     <style>
        .options {
            position: relative;
            display: inline-block;
        }

        .options button {
            background: red;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }
    </style>
    <script type="text/javascript">
    
    function excluirGeral(type, itemId) {
        var itemLabel;

        switch (type) {
            case 'resenhas':
                itemLabel = 'esta resenha';
                break;
            case 'citacoes':
                itemLabel = 'esta citação';
                break;
            case 'comentarios':
                itemLabel = 'este comentário';
                break;

            default:
                itemLabel = 'este item';
        }

        var result = window.confirm("Deseja realmente excluir " + itemLabel + "?");
        
        if (result) {
            // Redirecione para o script PHP de exclusão com o ID do item
            window.location.href = "./excluir_itens.php?type=" + type + "&item_id=" + itemId;
        }
    }


</script>
</head>

<body>

    <!--NAVBAR com opções para as páginas de Login e Início-->
    <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark w-100">
        <a href="index.php" class="navbar-brand">
        <img src="./imagens/liver_logo.png" alt="Logo LiVer" src="index.php" width="100" height="40"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse me-auto y-2 my-lg-0" id="navbarScroll">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
            <a class="nav-link" href="./index.php">Início</a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li class="nav-item">
            <a class="nav-link active" href="./login/index.html">Login</a>
            </li>
        </ul>
    </div>
    </nav>
    <br><br><br><br>
    <!--FIM DA NAVBAR--> 

<div class= 'container-fluid'>
<?php

//inclui a conexão com o banco de dados e o arquivo com a função para curtir as resenhas
include "conexao.php";
include "funcoes/curtir.php";

//define os caracteres como uft8
mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, 'SET character_set_connection=utf8');
mysqli_query($con, 'SET character_set_client=utf8');
mysqli_query($con, 'SET character_set_results=utf8');

  //inicia a sessão
  session_start();

  //valores das variáveis $id_obra e $valor_obra vindos do aquivo index.php são atribuídos à $id_obra e $valor_obra 
  $id_obra = $_GET['id_obra'];
  $valor_obra = $_GET['valor_obra'];

  //consulta ao banco de dados para obter as informações da obra
  $sqlivros = "SELECT * FROM obra INNER JOIN livros ON obra.ID_OBRA = livros.obra_id_OBRA WHERE obra.ID_OBRA = $id_obra";
  $sqlfilmes = "SELECT * FROM obra INNER JOIN filmes ON obra.ID_OBRA = filmes.obra_id_OBRA WHERE obra.ID_OBRA = $id_obra";
  $sqlseries = "SELECT * FROM obra INNER JOIN series ON obra.ID_OBRA = series.obra_id_OBRA WHERE obra.ID_OBRA = $id_obra";
  $sqlnovelas = "SELECT * FROM obra INNER JOIN novelas ON obra.ID_OBRA = novelas.obra_id_OBRA WHERE obra.ID_OBRA = $id_obra";
  $resultfilmes = $con->query($sqlfilmes);
  $resultseries = $con->query($sqlseries);
  $resultnovelas = $con->query($sqlnovelas);
  $resultlivros = $con->query($sqlivros); 
  
  //se $valor_obra tiver o valor 4, as informações da consulta $resultlivros são utilizadas
  if ($valor_obra == 4) {
     if ($resultlivros->num_rows > 0) {

    //recuperando as informações da obra
     $row = $resultlivros->fetch_assoc();
     $num_paginas = $row['PAGINAS_LIVRO'];
     $editora = $row['EDITORA_LIVRO'];
     $c_ind = $row['C_IND_LIVRO'];
     $nome_obra = $row['NOME_OBRA'];
     $ano_obra = $row['ANO_OBRA'];
     $sinopse = $row['DESC_OBRA'];
     $foto_obra = $row['FOTO_OBRA'];
     $autor_obra = $row['AU_DI_OBRA'];
?>

    <!--aparecendo as informações da obra-->
    <div class= 'col-md-4'><?php echo "<p><b>$nome_obra</b></p>"?></div>
    <div class = 'img-fluid'><?php echo "<img src='./imagens/img_obras/$foto_obra' alt='$nome_obra' class='card-img'>";?> </div>
    <div class = 'col-md-8'><?php
    echo "<p>Ano de Publicação: $ano_obra</p>"; 
    echo "<p>Sinopse: $sinopse</p>";
    echo "<p>Autor: $autor_obra<br>";
    echo "<p>Número de Páginas: $num_paginas</p>";
    echo "<p>Editora: $editora</p>";?>

    <!--botão para o usuário adicionar a obra aos favoritos utilizando o arquivo lista_favoritos.php-->
    <button class="favs" data-id=<?php echo $id_obra;?>>Adicionar aos favoritos</button>
    <form id="favoritos" action="./listas/lista_favoritos.php" method="POST">
    <input type="hidden" id="obraInputFav" name="obra" value="">
    </form>
    <script>
    const addButtonsFav = document.querySelectorAll('.favs');
    const obraInputFav = document.getElementById('obraInputFav');
    const addFormFav = document.getElementById('favoritos');
    addButtonsFav.forEach(button => {
        button.addEventListener('click', function() {
            const obraId = button.getAttribute('data-id');
            obraInputFav.value = obraId;
            favoritos.submit();
        });
    });
 </script>

   <!--botão para o usuário adicionar a obra à lista de Ver Depois utilizando o arquivo lista_verdps.php-->
   <button class="verdps" data-id=<?php echo $id_obra;?>>Adicionar à lista de Ver Depois</button>
   <form id="verdepois" action="./listas/lista_verdps.php" method="POST">
   <input type="hidden" id="obraInputVd" name="obra" value="">
   </form>
   <script>
    const addButtonsVd = document.querySelectorAll('.verdps');
    const obraInputVd = document.getElementById('obraInputVd');
    const addFormVd = document.getElementById('verdepois');
    addButtonsVd.forEach(button => {
        button.addEventListener('click', function() {
            const obraId = button.getAttribute('data-id');
            obraInputVd.value = obraId;
            verdepois.submit();
        });
    });
 </script>
 </div>

<?php
    }}
 
  //se $valor_obra tiver o valor 1, as informações da consulta $resultseries são utilizadas
  elseif ($valor_obra == 1) {
     if ($resultseries->num_rows > 0) {

    //recuperando as informações da obra
     $row = $resultseries->fetch_assoc();
     $produtora_serie = $row['PRODUTORA_SERIE'];
     $dist_serie = $row['DISTRIBUIDORA_SERIE'];
     $c_ind_serie = $row['C_IND_SERIE'];
     $temporadas =  $row['TEMPORADAS_SERIE'];
     $elenco_serie =  $row['ELENCO_SERIE'];
     $nome_obra = $row['NOME_OBRA'];
     $ano_obra = $row['ANO_OBRA'];
     $sinopse = $row['DESC_OBRA'];
     $foto_obra = $row['FOTO_OBRA'];
     $autor_obra = $row['AU_DI_OBRA'];
     ?>

    <!--aparecendo as informações da obra-->
    <div class= 'col-md-4'><?php echo "<p><b>$nome_obra</b></p>"?></div>
    <div class = 'img-fluid'><?php echo "<img src='./imagens/img_obras/$foto_obra' alt='$nome_obra' class='card-img'>";?> </div>
    <div class = 'col-md-8'><?php
    echo "<p>Ano de Lançamento: $ano_obra</p>";
    echo "<p>Sinopse: $sinopse</p>";
    echo "<p>Diretor: $autor_obra<br>";
    echo "<p>Temporadas: $temporadas</p>";
    echo "<p>Classificação Indicativa: $c_ind_serie</p>";
    echo "<p>Elenco: $elenco_serie</p>";
    echo "<p>Emissora: $dist_serie</p>";
    ?>

    <!--botão para o usuário adicionar a obra aos favoritos utilizando o arquivo lista_favoritos.php-->
    <button class="favs" data-id=<?php echo $id_obra;?>>Adicionar aos favoritos</button>
    <form id="favoritos" action="./listas/lista_favoritos.php" method="POST">
    <input type="hidden" id="obraInputFav" name="obra" value="">
    </form>
    <script>
    const addButtonsFav = document.querySelectorAll('.favs');
    const obraInputFav = document.getElementById('obraInputFav');
    const addFormFav = document.getElementById('favoritos');
    addButtonsFav.forEach(button => {
        button.addEventListener('click', function() {
            const obraId = button.getAttribute('data-id');
            obraInputFav.value = obraId;
            favoritos.submit();
        });
    });
 </script>
 
   <!--botão para o usuário adicionar a obra à lista de Ver Depois utilizando o arquivo lista_verdps.php-->
   <button class="verdps" data-id=<?php echo $id_obra;?>>Adicionar à lista de Ver Depois</button>
   <form id="verdepois" action="./listas/lista_verdps.php" method="POST">
   <input type="hidden" id="obraInputVd" name="obra" value="">
   </form>
   <script>
    const addButtonsVd = document.querySelectorAll('.verdps');
    const obraInputVd = document.getElementById('obraInputVd');
    const addFormVd = document.getElementById('verdepois');
    addButtonsVd.forEach(button => {
        button.addEventListener('click', function() {
            const obraId = button.getAttribute('data-id');
            obraInputVd.value = obraId;
            verdepois.submit();
        });
    });
</script>
    </div>
<?php
    }}
 
   //se $valor_obra tiver o valor 2, as informações da consulta $resultfilmes são utilizadas
   elseif ($valor_obra == 2) {
     if ($resultfilmes->num_rows > 0) {

    //recuperando as informações da obra
     $row = $resultfilmes->fetch_assoc();
     $c_ind = $row['C_IND_FILME'];
     $produtora = $row['PRODUTORA_FILME'];
     $distribuidora = $row['DISTRIBUIDORA_FILME'];
     $duracao = $row['DURACAO'];
     $elenco_filme = $row['ELENCO'];
     $nome_obra = $row['NOME_OBRA'];
     $ano_obra = $row['ANO_OBRA'];
     $sinopse = $row['DESC_OBRA'];
     $foto_obra = $row['FOTO_OBRA'];
     $autor_obra = $row['AU_DI_OBRA'];
     ?>

    <!--mostrando as informações da obra-->
    <div class= 'col-md-4'><?php echo "<p><b>$nome_obra</b></p>"?></div>
    <div class = 'img-fluid'><?php echo "<img src='./imagens/img_obras/$foto_obra' alt='$nome_obra' class='card-img'>";?> </div>
    <div class = 'col-md-8'><?php
    echo "<p>Ano de Lançamento: $ano_obra</p>";
    echo "<p>Sinopse: $sinopse</p>";
    echo "<p>Duração: $duracao</p>";
    echo "<p>Classificação Indicativa: $c_ind</p>";
    echo "<p>Produtora: $produtora</p>";
    echo "<p>Distribuidora: $distribuidora</p>";
    echo "<p>Elenco: $elenco_filme</p>";
    ?>
        
    <!--botão para o usuário adicionar a obra aos favoritos utilizando o arquivo lista_favoritos.php-->    
    <button class="favs" data-id=<?php echo $id_obra;?>>Adicionar aos favoritos</button>
    <form id="favoritos" action="./listas/lista_favoritos.php" method="POST">
    <input type="hidden" id="obraInputFav" name="obra" value="">
    </form>
    <script>
    const addButtonsFav = document.querySelectorAll('.favs');
    const obraInputFav = document.getElementById('obraInputFav');
    const addFormFav = document.getElementById('favoritos');
    addButtonsFav.forEach(button => {
        button.addEventListener('click', function() {
            const obraId = button.getAttribute('data-id');
            obraInputFav.value = obraId;
            favoritos.submit();
        });
    });
    </script>
 
   <!--botão para o usuário adicionar a obra à lista de Ver Depois utilizando o arquivo lista_verdps.php-->
   <button class="verdps" data-id=<?php echo $id_obra;?>>Adicionar à lista de Ver Depois</button>
   <form id="verdepois" action="./listas/lista_verdps.php" method="POST">
   <input type="hidden" id="obraInputVd" name="obra" value="">
   </form>
   <script>
    const addButtonsVd = document.querySelectorAll('.verdps');
    const obraInputVd = document.getElementById('obraInputVd');
    const addFormVd = document.getElementById('verdepois');
    addButtonsVd.forEach(button => {
        button.addEventListener('click', function() {
            const obraId = button.getAttribute('data-id');
            obraInputVd.value = obraId;
            verdepois.submit();
        });
    });
    </script>
    </div>
   <?php
    }}

  //se $valor_obra tiver o valor 3, as informações da consulta $resultnovelas são utilizadas
  elseif ($valor_obra == 3) {
     if ($resultnovelas->num_rows > 0) {

    //recuperando as informações da obra
     $row = $resultnovelas->fetch_assoc();
     $emissora_nov = $row['EMISSORA_NOVELA'];
     $episodios_nov = $row['EPISODIOS_NOVELA'];
     $c_ind_nov = $row['C_IND_NOVELA'];
     $elenco_nov = $row['ELENCO_NOVELA'];
     $nome_obra = $row['NOME_OBRA'];
     $ano_obra = $row['ANO_OBRA'];
     $sinopse = $row['DESC_OBRA'];
     $foto_obra = $row['FOTO_OBRA'];
     $autor_obra = $row['AU_DI_OBRA'];
     ?>

    <!--mostrando as informações da obra-->    
    <div class= 'col-md-4'><?php echo "<p><b>$nome_obra</b></p>"?></div>
    <div class = 'img-fluid'><?php echo "<img src='./imagens/img_obras/$foto_obra' alt='$nome_obra' class='card-img'>";?> </div>
    <div class = 'col-md-8'><?php
    echo "<p>Ano de Lançamento: $ano_obra</p>";
    echo "<p>Sinopse: $sinopse</p>";
    echo "<p>Diretor: $autor_obra<br>";
    echo "<p>Episódios: $episodios_nov</p>";
    echo "<p>Classificação Indicativa: $c_ind_nov</p>";
    echo "<p>Emissora: $emissora_nov</p>";
    echo "<p>Elenco: $elenco_nov</p>";
    ?>
      
    <!--botão para o usuário adicionar a obra aos favoritos utilizando o arquivo lista_favoritos.php-->    
    <button class="favs" data-id=<?php echo $id_obra;?>>Adicionar aos favoritos</button>
    <form id="favoritos" action="./listas/lista_favoritos.php" method="POST">
    <input type="hidden" id="obraInputFav" name="obra" value="">
    </form>
    <script>
    const addButtonsFav = document.querySelectorAll('.favs');
    const obraInputFav = document.getElementById('obraInputFav');
    const addFormFav = document.getElementById('favoritos');
    addButtonsFav.forEach(button => {
        button.addEventListener('click', function() {
            const obraId = button.getAttribute('data-id');
            obraInputFav.value = obraId;
            favoritos.submit();
        });
    });
    </script>
 
   <!--botão para o usuário adicionar a obra à lista de Ver Depois utilizando o arquivo lista_verdps.php-->
   <button class="verdps" data-id=<?php echo $id_obra;?>>Adicionar à lista de Ver Depois</button>
   <form id="verdepois" action="./listas/lista_verdps.php" method="POST">
   <input type="hidden" id="obraInputVd" name="obra" value="">
   </form>
   <script>
    const addButtonsVd = document.querySelectorAll('.verdps');
    const obraInputVd = document.getElementById('obraInputVd');
    const addFormVd = document.getElementById('verdepois');
    addButtonsVd.forEach(button => {
        button.addEventListener('click', function() {
            const obraId = button.getAttribute('data-id');
            obraInputVd.value = obraId;
            verdepois.submit();
        });
    });
   </script>
   </div>
   <?php  
    }}
    ?>
    </div>
    <hr id="linha-resenha">  
    <div id="container-res">
    <div id="content-res">

<?php
    //se o usuário não estiver logado, ele tem a opção de fazer o login para resenhar a obra
    if (!isset($_SESSION['ID_USUARIO'])) {
        echo "<a id='resenha' href='login/index.html'><p id='login-res'>Faça login para resenhar esta obra.</p><button id='botao-res' type='submit'>Login</button></a>";
        echo"<div class='space'></div>";

      //se o usuário estiver logado, o botão "Resenhar" é disponibilizado para ele  
    } else {
        $idUsuario = $_SESSION['ID_USUARIO'];
        echo "<form action='resenha/resenha.php' method='POST'>";
        echo "<input type='hidden' name='id_obra' value='$id_obra'>";
        echo "<a id='resenha'><p id='logado-res'>Resenhe essa obra agora!</p><button id='botao-res' type='submit'>Resenhar</button>";
        echo "</form>";
   
    }

      //se o usuário não estiver logado, ele tem a opção de fazer o login para realizar uma citação da obra
      if (!isset($_SESSION['ID_USUARIO'])) {
                    echo "<a id='citacao' href='login/index.html'><p id='login-res'>Faça login para fazer a citação desta obra.</p><button id='botao-cit' type='submit'>Login</button></a>";
                    echo "<div class='space'></div>";

                //se o usuário estiver logado, o botão "Fazer Citação" é disponibilizado para ele
                } else {
                    $idUsuario = $_SESSION['ID_USUARIO'];
                    echo "<form action='citacoes/fazer_citacoes.php' method='POST'>";
                    echo "<input type='hidden' name='id_obra' value='$id_obra'>";
                    echo "<a id='citacao'></p><button id='botao-cit' type='submit'>Fazer Citação</button><br><br>";
                    echo "</form>";
                }

    //consulta ao banco de dados para obter as resenhas da obra
    $sql_resenhas = "SELECT resenhas.*, perfil.NOME_PERFIL
    FROM resenhas
    INNER JOIN perfil ON resenhas.usuarios_ID_USUARIO = perfil.usuario_ID_USUARIO
    WHERE resenhas.obra_ID_OBRA = $id_obra
    ORDER BY resenhas.DATA_RESENHA DESC
    LIMIT 0, 25";
    $result_resenhas = $con->query($sql_resenhas);

    
    //exibindo as resenhas da obra
    if ($result_resenhas->num_rows > 0) {
    while ($row_resenha = $result_resenhas->fetch_assoc()) {
        $id_resenha = $row_resenha['ID_RESENHA'];
        $nome_usuario = $row_resenha['NOME_PERFIL'];
        $txt_resenha = $row_resenha['TXT_RESENHA'];
        $id_usuario = $row_resenha['usuarios_ID_USUARIO'];

        echo "<p>";
        echo "<a href='perfil.php?id_usuario=$id_usuario'>$nome_usuario</a><br>";
        echo $txt_resenha;

     if (isset($_SESSION['ID_USUARIO'])) {
    if ($id_usuario != $_SESSION['ID_USUARIO']) {
        echo '<td>
            <!-- Botão para o usuário curtir a resenha através do ID da resenha -->
            <?php
            $id_resenha = $row_resenha["ID_RESENHA"];
            echo "<form action=\'\' method=\'POST\'>";
            echo "<input type=\'hidden\' name=\'id_resenha\' value=\'$id_resenha\'>";
            echo "<button type=\'submit\' name=\'curtir\'>Curtir</button>";
            echo "</form>";
            ?>
        </td>';
    }
     elseif ($id_usuario == $_SESSION['ID_USUARIO']) {
            echo "<div class='options'>
        <button onclick=\"excluirGeral('resenhas', '$id_resenha')\">
        <i class='fas fa-trash-alt'></i> <!-- Ícone de lixo do Font Awesome -->
        </button>
        </div>";
         }
        }


        $sql_comentarios = "SELECT comentarios.*, perfil.USERNAME_PERFIL, perfil.usuario_ID_USUARIO
                        FROM comentarios
                        INNER JOIN perfil ON comentarios.usuarios_ID_USUARIO  = perfil.usuario_ID_USUARIO
                        WHERE comentarios.resenha_ID_RESENHA = $id_resenha";
            $result_comentarios = $con->query($sql_comentarios);


        // Botão para fazer comentários
        if (isset($_SESSION['ID_USUARIO'])) {
            echo "<form action='comentario/comentario.php' method='POST'>";
            echo "<input type='hidden' name='id_resenha' value='$id_resenha'>";
            echo "<button id='comentario' type='submit'>Comentar</button>";
            echo "</form>";
        }


        if ($result_comentarios->num_rows > 0) {
            while ($row_comentario = $result_comentarios->fetch_assoc()) {
                $id_resenha = $row_comentario['resenha_ID_RESENHA'];
                $txt_comentario = $row_comentario['TXT_COMENTARIO'];
                $id_comentario = $row_comentario['ID_COMENTARIO'];
                $nome_usuario_comentario = $row_comentario['USERNAME_PERFIL'];
                $id_usuario_comentario = $row_comentario['usuario_ID_USUARIO'];

                echo "<div>";
                echo "<p><a href='perfil.php?id_usuario=$id_usuario_comentario'>$nome_usuario_comentario</a>: $txt_comentario</p>";
                echo "</div>";


                //  REMOVER COMENTÁRIO
                if (isset($_SESSION['ID_USUARIO'])) {
                if ($id_usuario_comentario == $_SESSION['ID_USUARIO']) {
                     echo "<div class='options'>
                    <button onclick=\"excluirGeral('comentarios', '$id_comentario')\">
                    <i class='fas fa-trash-alt'></i> <!-- Ícone de lixo do Font Awesome -->
                    </button>
                    </div>";
                }}
            }
        } else {
            echo "<p>Nenhum comentário disponível para essa resenha.</p>";
        }
    }
} else {
    echo "<p id='resenha'><a id='not-res'>Ainda não há resenhas para esta obra.</a></p>";
}

// Consulta ao banco de dados para obter as citações da obra, ID do usuário e nome de perfil do usuário
$sql_citacoes = "SELECT citacoes.*, perfil.USERNAME_PERFIL
                FROM citacoes
                INNER JOIN perfil ON citacoes.usuario_ID_USUARIO = perfil.usuario_ID_USUARIO
                WHERE citacoes.obra_ID_OBRA = $id_obra
                LIMIT 0, 25";
$result_citacoes = $con->query($sql_citacoes);

// Mostrando as informações consultadas
if ($result_citacoes->num_rows > 0) {
    while ($row_citacao = $result_citacoes->fetch_assoc()) {
        $id_citacoes = $row_citacao['ID_CITACOES'];
        $nome_usuario = $row_citacao['USERNAME_PERFIL'];
        $txt_citacao = $row_citacao['DESC_CITACAO'];
        $id_usuario = $row_citacao['usuario_ID_USUARIO'];

        echo "<p id='citacoes' class='res'>";
        echo "<a id='citacao-nome' href='perfil.php?id_usuario=$id_usuario'>$nome_usuario</a><br>";
        echo $txt_citacao;
        echo "</p>";

        // Botão para curtir e salvar a citação através do arquivo salvar_citacao.php
        ?>
        <script>
        const addButtonsCit = document.querySelectorAll('.favcit');
        const obraInputCit = document.getElementById('obraInputFavCit');
        const addFormCit = document.getElementById('facit');
        addButtonsCit.forEach(button => {
            button.addEventListener('click', function() {
                const obraId = button.getAttribute('data-id');
                obraInputFavCit.value = obraId;
                facit.submit();
            });
        });
        </script>
        <?php
        if (isset($_SESSION['ID_USUARIO'])) {
            if ($id_usuario != $_SESSION['ID_USUARIO']) {
        echo "<td>
        <form class='favcit-form' action='./citacoes/salvar_citacao.php' method='POST'>
        <input type='hidden' name='cit' value='{$row_citacao['ID_CITACOES']}'>
        <input type='hidden' name='obra' value='{$row['obra_ID_OBRA']}'>
        <button class='favcit' type='submit'>Curtir</button>
        </form>
        </td>";}
         
        elseif ($id_usuario == $_SESSION['ID_USUARIO']) {
             echo "<div class='options'>
        <button onclick=\"excluirGeral('citacoes', '$id_citacoes')\">
            <i class='fas fa-trash-alt'></i> <!-- Ícone de lixo do Font Awesome -->
        </button>
      </div>";
         }
    }}
} else {
    echo "<p id='citacao'><a id='not-res'>Ainda não há citações para esta obra.</a></p>";
}

// Fechando conexão com o banco de dados
$con->close();

    ?>

</div>
</div>
</body>
</html>
