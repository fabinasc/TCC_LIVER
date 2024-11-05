<!DOCTYPE html>
<html>
<head>
     <link rel="icon" href="./imagens/logo2_liver.png" type="image/x-icon">
    <title>Descrição</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/detalhes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
         <style>
        .options {
            position: relative;
            display: inline-block;
        }

        .options button {
            background: white;
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
    <!--NAVBAR-->
    <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark w-100">
        <div class="container">
            <a class="navbar-brand">
                <img src="./imagens/liver_logo.png" alt="Logo LiVer" src="./index.php" width="100" height="40"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.php">Início</a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <?php
                    // Inicie a sessão se ainda não estiver iniciada
                    session_start();

                    // Verifique se o ID_USUARIO está na sessão
                    if(isset($_SESSION['ID_USUARIO']) && !empty($_SESSION['ID_USUARIO'])) {
                        // O ID_USUARIO está configurado na sessão
                        echo '<li class="nav-item">
                                <a class="nav-link" href="./perfil/perfil_user.php">Meu perfil</a>
                            </li>';
                    } else {
                        // O ID_USUARIO não está configurado na sessão
                        echo '<li class="nav-item">
                                <a class="nav-link" href="./login/index.html">Login</a>
                            </li>';
                    }
                    ?>
                    <li><hr class="dropdown-divider"></li>
                    <li class="nav-item">
                         <a class="nav-link" href="./citacoes/citacoes.php">Citações</a>
                   </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorias</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item" href="./categorias/categ_livros.php">Livros</a></li>
                            <li><a class="dropdown-item" href="./categorias/categ_filmes.php">Filmes</a></li>
                            <li><a class="dropdown-item" href="./categorias/categ_series.php">Séries</a></li>
                            <li><a class="dropdown-item" href="./categorias/categ_novelas.php">Novelas</a></li>
                        </ul>
                    </li>
                </ul>

            
                <form class="d-flex" action="./pesquisar.php" method="GET">
                    <div class="search-box"> 
                        <input class="search-txt" type="text" placeholder="Pesquisar" aria-label="Pesquisar" name="pesquisar">
                        <a class="search-btn" href="#">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </nav>
    <br><br><br><br>
    <!--NAVBAR TERMINA-->

<div class= 'container-fluid'>
<?php
include "conexao.php";

mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, 'SET character_set_connection=utf8');
mysqli_query($con, 'SET character_set_client=utf8');
mysqli_query($con, 'SET character_set_results=utf8');

 
  $id_obra = $_GET['id_obra'];
  $valor_obra = $_GET['valor_obra'];
  

  // Consulta ao banco de dados para obter as informações da obra
  $sqlivros = "SELECT * FROM obra INNER JOIN livros ON obra.ID_OBRA = livros.obra_id_OBRA WHERE obra.ID_OBRA = $id_obra";
  $sqlfilmes = "SELECT * FROM obra INNER JOIN filmes ON obra.ID_OBRA = filmes.obra_id_OBRA WHERE obra.ID_OBRA = $id_obra";
  $sqlseries = "SELECT * FROM obra INNER JOIN series ON obra.ID_OBRA = series.obra_id_OBRA WHERE obra.ID_OBRA = $id_obra";
  $sqlnovelas = "SELECT * FROM obra INNER JOIN novelas ON obra.ID_OBRA = novelas.obra_id_OBRA WHERE obra.ID_OBRA = $id_obra";
  
  $resultfilmes = $con->query($sqlfilmes);
  $resultseries = $con->query($sqlseries);
  $resultnovelas = $con->query($sqlnovelas);
  $resultlivros = $con->query($sqlivros); 
  
  if ($valor_obra == 4) {
     if ($resultlivros->num_rows > 0) {

    // Recuperar as informações da obra
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
    <div class = "container">
    <div class = 'img-fluid'>
    <?php echo "<p><b><h4>$nome_obra</h4></b></p>"?>
    <?php echo "<img src='./imagens/img_obras/$foto_obra' class='card-img' style='width: 200px; height: 300px;'>";?>
    </div>
    
    <div class = 'col-md-8'><?php
    echo "<p><b>Ano de Publicação:</b> $ano_obra</p>"; 
    echo "<b><p>Sinopse:</b> $sinopse</p>";
    echo "<b><p>Autor:</b> $autor_obra<br>";
    echo "<b><p>Número de Páginas:</b> $num_paginas</p>";
    echo "<b><p>Editora: </b> $editora</p>";?>
    

  <div class= "button-container">
  <button class="favs" data-id="<?php echo $id_obra;?>">Favoritar</button>
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


  <button class="verdps" data-id="<?php echo $id_obra;?>"> Ver Depois</button>
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
</div>
</div>


<?php
}}
    

elseif ($valor_obra == 1) {
    if ($resultseries->num_rows > 0) {

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
        <div class="container">
            <div class='img-fluid'>
                <?php echo "<p><b><h3>$nome_obra</h3></b></p>" ?>
                <?php echo "<img src='./imagens/img_obras/$foto_obra' class='card-img' style='width: 250px; height: 365px;'>"; ?>
            </div>

            <div class='col-md-8'>
                <?php
                echo "<p><b>Ano de Lançamento:</b> $ano_obra</p>";
                echo "<b><p>Sinopse:</b> $sinopse</p>";
                echo "<b><p>Diretor:</b> $autor_obra<br>";
                echo "<b><p>Temporadas:</b> $temporadas</p>";
                echo "<b><p>Classificação Indicativa:</b> $c_ind_serie</p>";
                echo "<b><p>Elenco:</b> $elenco_serie</p>";
                echo "<b><p>Emissora:</b> $dist_serie</p>";
                ?>

                <div class="button-container">
                    <button class="favs" data-id="<?php echo $id_obra; ?>">Favoritar</button>
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

                    <button class="verdps" data-id="<?php echo $id_obra; ?>"> Ver Depois</button>
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
            </div>
        </div>
<?php
    }
}

elseif ($valor_obra == 2) {
    if ($resultfilmes->num_rows > 0) {

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
        <div class="container">
            <div class='img-fluid'>
            <?php echo "<p><b><h3>$nome_obra</h3></b></p>" ?>
            <?php echo "<img src='./imagens/img_obras/$foto_obra' class='card-img' style='width: 200px; height: 300px;'>"; ?>
            </div>
            <div class='col-md-8'>
                <?php
                echo "<p><b>Ano de Lançamento:</b> $ano_obra</p>";
                echo "<b><p>Sinopse:</b> $sinopse</p>";
                echo "<b><p>Duração:</b> $duracao</p>";
                echo "<b><p>Classificação Indicativa:</b> $c_ind</p>";
                echo "<b><p>Produtora:</b> $produtora</p>";
                echo "<b><p>Distribuidora:</b> $distribuidora</p>";
                echo "<b><p>Elenco:</b> $elenco_filme</p>";
                ?>
                <div class="button-container">
                    <button class="favs" data-id=<?php echo $id_obra; ?>>Favoritar</button>
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
                    <button class="verdps" data-id=<?php echo $id_obra; ?>> Ver Depois</button>
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
            </div>
        </div>
<?php
    }
}

elseif ($valor_obra == 3) {
    if ($resultnovelas->num_rows > 0) {

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
        <div class="container">
            <div class='img-fluid'>
            <?php echo "<p><b><h3>$nome_obra</h3></b></p>" ?>
            <?php echo "<img src='./imagens/img_obras/$foto_obra' class='card-img' style='width: 200px; height: 300px;'>"; ?>
            </div>
            <div class='col-md-8'>
                <?php
                echo "<p><b>Ano de Lançamento:</b> $ano_obra</p>";
                echo "<b><p>Sinopse:</b> $sinopse</p>";
                echo "<b><p>Diretor:</b> $autor_obra<br>";
                echo "<b><p>Episódios:</b> $episodios_nov</p>";
                echo "<b><p>Classificação Indicativa:</b> $c_ind_nov</p>";
                echo "<b><p>Emissora:</b> $emissora_nov</p>";
                echo "<b><p>Elenco:</b> $elenco_nov</p>";
                ?>
                <div class="button-container">
                    <button class="favs" data-id=<?php echo $id_obra; ?>>Favoritar</button>
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
                    <button class="verdps" data-id=<?php echo $id_obra; ?>> Ver Depois</button>
                    <form id="verdepois" action="./listas/lista_verdps.php" method= "POST">
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
            </div>
        </div>
<?php
    }
}

    ?>
    </div>
    <div class="custom-hr-container">
    <hr class="custom-hr">
    </div>
    <div id="container-res">
    <div id="content-res">
    <div class="container">
    <ul class="custom-nav" id="pills-tab" role="tablist">
    <li class="custom-nav-item">
    <a class="custom-nav-link" href="listar_obras_SL.php?id_obra=<?php echo $id_obra; ?>&valor_obra=<?php echo $valor_obra; ?>">
    <b>Resenhas sobre a obra</b>
    </a>
    </li>
    <li class="custom-nav-item">
    <a class="custom-nav-link active" href="listar_obras_SL.php?id_obra=<?php echo $id_obra; ?>&valor_obra=<?php echo $valor_obra; ?>">
    <b>Citações sobre a obra</b>
    </a>
    </li>
    </ul>
    </div>


<?php

//se o usuário não estiver logado, ele tem a opção de fazer o login para realizar uma citação da obra
    if (!isset($_SESSION['ID_USUARIO'])) {
                    echo "<a id='resenha' href='login/index.html'><p id='login-res'>Faça login para fazer a citação desta obra.</p><br>
                    <button id='botao-res3' type='submit' style='background: none; border: none;'>
                    <i class='fas fa-right-from-bracket fa-xl' style='color: #ffffff;'></i>
                    </button>";
                    die;


                //se o usuário estiver logado, o botão "Fazer Citação" é disponibilizado para ele
                } else {
                    $idUsuario = $_SESSION['ID_USUARIO'];
                    echo "<form action='citacoes/fazer_citacoes.php' method='POST'>";
                    echo "<input type='hidden' name='id_obra' value='$id_obra'>";
                    ?>
                    <div id="container-citacao">
                      <div id="frase-citacao">
                        <p id="logado-citacao">Faça uma citação agora!</p>
                        <button id='botao-cit' type='submit'>Citação</button>
                      </div>
                    </div>
                    <?php
                    echo "</form>";
                }

                // Consulta ao banco de dados para obter as resenhas da obra
$sql_citacoes = "SELECT citacoes.*, perfil.NOME_PERFIL
                FROM citacoes
                INNER JOIN perfil ON citacoes.usuario_ID_USUARIO = perfil.usuario_ID_USUARIO
                WHERE citacoes.obra_ID_OBRA = $id_obra
                LIMIT 0, 25";
$result_citacoes = $con->query($sql_citacoes);

if ($result_citacoes->num_rows > 0) {
    while ($row_citacao = $result_citacoes->fetch_assoc()) {
        $nome_usuario = $row_citacao['NOME_PERFIL'];
        $txt_citacao = $row_citacao['DESC_CITACAO'];
        $id_usuario = $row_citacao['usuario_ID_USUARIO'];
        echo '<div class="citacao-container">';
        echo '<div class="resenha-header">';
        echo '<span class="nome-usuario">' . $nome_usuario . '</span>';
        echo '<a href="perfil.php?id_usuario=' . $id_usuario . '">Ver perfil</a>';
        echo '</div>';
        echo '<div class="txt-citacao">' . $txt_citacao . '</div>';

        // botão para curtir e salvar a citação através do arquivo salvar_citacao.php
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
        //if ($idUsuario != $_SESSION['ID_USUARIO']) {
            echo "<td>
                <form class='favcit-form' action='./citacoes/salvar_citacao.php' method='POST'>
                    <input type='hidden' name='cit' value='{$row_citacao['ID_CITACOES']}'>
                    <input type='hidden' name='obra' value='{$row['obra_ID_OBRA']}'>
                    <button class='favcit' type='submit'>Curtir</button>
                </form>
            </td>";
         /* elseif ($idUsuario == $_SESSION['ID_USUARIO']) {
            echo "<div class='options'>
                    <button onclick=\"excluirGeral('citacoes', '{$row_citacao['ID_CITACOES']}')\">
                        <i class='fas fa-trash-alt'></i> <!-- Ícone de lixo do Font Awesome -->
                    </button>
                </div>";
        } */
        
        echo "</div>";
    }
    } else {
    ?>
    <div id="frase-citacao2">
        <p id="logado-citacao2">Ainda não há citações para esta obra</p>
    </div>
    <?php
    if (isset($_SESSION['ID_USUARIO'])) {
        if ($idUsuario != $_SESSION['ID_USUARIO']) {
            echo "<td>
                    <form class='favcit-form' action='./citacoes/salvar_citacao.php' method='POST'>
                        <input type='hidden' name='cit' value='{$row_citacao['ID_CITACOES']}'>
                        <input type='hidden' name='obra' value='{$row['obra_ID_OBRA']}'>
                        <button class='favcit' type='submit'>Curtir</button>
                    </form>
                </td>";
            echo "</div>";
            echo "</div>";
        } /* elseif ($idUsuario == $_SESSION['ID_USUARIO']) {
            echo "<div class='options'>
                    <button onclick=\"excluirGeral('citacoes', '$id_citacoes')\">
                        <i class='fas fa-trash-alt'></i> <!-- Ícone de lixo do Font Awesome -->
                    </button>
                </div>";
        } */
    }
} 

echo "</div>";
echo "</div>";

?>
</div>
</div>
</body>
</html>
