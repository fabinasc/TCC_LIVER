<!DOCTYPE html>
<html>
<head>
     <link rel="icon" href="./imagens/logo2_liver.png" type="image/x-icon">
    <title>Liver</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/detalhes.css">

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
                <img src="./imagens/liver_logo.png" alt="Logo LiVer" src="../index.php" width="100" height="40"></a>
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

//inclui a conexão com o banco de dados e o arquivo com a função para curtir as resenhas
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
    <div class= "imagem-container">
    <div class = 'img-fluid'>
    <?php echo "<p><b><h4>$nome_obra</h4></b></p>"?>
    <?php echo "<img src='./imagens/img_obras/$foto_obra' class='card-img' style='width: 200px; height: 300px;'>";?>
   
    <?php
		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg']."<br><br>";
			unset($_SESSION['msg']);
		}
		?>
        <div class="estrelas">

   <?php

//$idUsuario = $_SESSION['ID_USUARIO'];
//$idObra = $_SESSION['id_obra'];

//$sql = "SELECT * FROM classificar WHERE usuario_ID_USUARIO = $idUsuario AND obra_ID_OBRA = $idObra";
//$result = mysqli_query($con, $sql);

//if ($result) {
    //if (mysqli_num_rows($result) > 0) {
       // echo "Você já avaliou esta obra.";
    //} else {
        ?> 

    <!-- Seu código para exibir as estrelas -->
    <br><br><form method="POST" action="./classificacao/classificar.php" enctype="multipart/form-data"> 
			<div class="estrelas">
				<input type="radio" id="vazio" name="estrela" value="" checked>
				
				<label for="estrela_um"><i class="fa"></i></label>
				<input type="radio" id="estrela_um" name="estrela" value="1">
				
				<label for="estrela_dois"><i class="fa"></i></label>
				<input type="radio" id="estrela_dois" name="estrela" value="2">
				
				<label for="estrela_tres"><i class="fa"></i></label>
				<input type="radio" id="estrela_tres" name="estrela" value="3">
				
				<label for="estrela_quatro"><i class="fa"></i></label>
				<input type="radio" id="estrela_quatro" name="estrela" value="4">
				
				<label for="estrela_cinco"><i class="fa"></i></label>
				<input type="radio" id="estrela_cinco" name="estrela" value="5"><br><br>
				
                <input type='hidden' name='id_obra' value='<?php echo $_SESSION['id_obra'] = $_GET['id_obra']; ?>'>
                <input type='hidden' name='valor_obra' value='<?php echo $_SESSION['valor_obra'] = $_GET['valor_obra']; ?>'>

                    <!-- No botão de envio, chame a função JavaScript para enviar a classificação -->
                    <input type="submit" class="custom-button" value="Enviar">
				
			 </div>
    </form>
    <?php
    //}
//} else {
    // Se ocorrer um erro na consulta, exiba uma mensagem de erro
   // echo "Erro na consulta: " . mysqli_error($con);
//}
?>  </div>
    </div>
    <div class = 'col-md-8'><?php
    echo "<p><b>Ano de Publicação:</b> $ano_obra</p>"; 
    echo "<b><p>Sinopse:</b> $sinopse</p>";
    echo "<b><p>Autor:</b> $autor_obra<br>";
    echo "<b><p>Número de Páginas:</b> $num_paginas</p>";
    echo "<b><p>Editora: </b> $editora</p>";?>
    

  <div class= "button-container">
  <button class="favs" data-id="<?php echo $id_obra;?>">Favoritar </button>
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


  <button class="verdps" data-id="<?php echo $id_obra;?>">Ver Depois</button>
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
        <div class= "imagem-container">
            <div class='img-fluid'>
                <?php echo "<p><b><h3>$nome_obra</h3></b></p>" ?>
                <?php echo "<img src='./imagens/img_obras/$foto_obra' class='card-img' style='width: 250px; height: 365px;'>"; ?>
                <?php
		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg']."<br><br>";
			unset($_SESSION['msg']);
		}
		?>
        <div class="estrelas">

   <?php

//$idUsuario = $_SESSION['ID_USUARIO'];
//$idObra = $_SESSION['id_obra'];

//$sql = "SELECT * FROM classificar WHERE usuario_ID_USUARIO = $idUsuario AND obra_ID_OBRA = $idObra";
//$result = mysqli_query($con, $sql);

//if ($result) {
    //if (mysqli_num_rows($result) > 0) {
       // echo "Você já avaliou esta obra.";
    //} else {
        ?> 

    <!-- Seu código para exibir as estrelas -->
    <br><br><form method="POST" action="./classificacao/classificar.php" enctype="multipart/form-data"> 
			<div class="estrelas">
				<input type="radio" id="vazio" name="estrela" value="" checked>
				
				<label for="estrela_um"><i class="fa"></i></label>
				<input type="radio" id="estrela_um" name="estrela" value="1">
				
				<label for="estrela_dois"><i class="fa"></i></label>
				<input type="radio" id="estrela_dois" name="estrela" value="2">
				
				<label for="estrela_tres"><i class="fa"></i></label>
				<input type="radio" id="estrela_tres" name="estrela" value="3">
				
				<label for="estrela_quatro"><i class="fa"></i></label>
				<input type="radio" id="estrela_quatro" name="estrela" value="4">
				
				<label for="estrela_cinco"><i class="fa"></i></label>
				<input type="radio" id="estrela_cinco" name="estrela" value="5"><br><br>
				
                <input type='hidden' name='id_obra' value='<?php echo $_SESSION['id_obra'] = $_GET['id_obra']; ?>'>
                <input type='hidden' name='valor_obra' value='<?php echo $_SESSION['valor_obra'] = $_GET['valor_obra']; ?>'>

                    <!-- No botão de envio, chame a função JavaScript para enviar a classificação -->
                    <input type="submit" class="custom-button" value="Enviar">
				
			 </div>
    </form>
    <?php
    //}
//} else {
    // Se ocorrer um erro na consulta, exiba uma mensagem de erro
   // echo "Erro na consulta: " . mysqli_error($con);
//}
?>  </div>
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

                    <button class="verdps" data-id="<?php echo $id_obra; ?>">Ver Depois</button>
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
            <?php
		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg']."<br><br>";
			unset($_SESSION['msg']);
		}
		?>
        <div class="estrelas">

   <?php

//$idUsuario = $_SESSION['ID_USUARIO'];
//$idObra = $_SESSION['id_obra'];

//$sql = "SELECT * FROM classificar WHERE usuario_ID_USUARIO = $idUsuario AND obra_ID_OBRA = $idObra";
//$result = mysqli_query($con, $sql);

//if ($result) {
    //if (mysqli_num_rows($result) > 0) {
       // echo "Você já avaliou esta obra.";
    //} else {
        ?> 

    <!-- Seu código para exibir as estrelas -->
    <br><br><form method="POST" action="./classificacao/classificar.php" enctype="multipart/form-data"> 
			<div class="estrelas">
				<input type="radio" id="vazio" name="estrela" value="" checked>
				
				<label for="estrela_um"><i class="fa"></i></label>
				<input type="radio" id="estrela_um" name="estrela" value="1">
				
				<label for="estrela_dois"><i class="fa"></i></label>
				<input type="radio" id="estrela_dois" name="estrela" value="2">
				
				<label for="estrela_tres"><i class="fa"></i></label>
				<input type="radio" id="estrela_tres" name="estrela" value="3">
				
				<label for="estrela_quatro"><i class="fa"></i></label>
				<input type="radio" id="estrela_quatro" name="estrela" value="4">
				
				<label for="estrela_cinco"><i class="fa"></i></label>
				<input type="radio" id="estrela_cinco" name="estrela" value="5"><br><br>
				
                <input type='hidden' name='id_obra' value='<?php echo $_SESSION['id_obra'] = $_GET['id_obra']; ?>'>
                <input type='hidden' name='valor_obra' value='<?php echo $_SESSION['valor_obra'] = $_GET['valor_obra']; ?>'>

                    <!-- No botão de envio, chame a função JavaScript para enviar a classificação -->
                    <input type="submit" class="custom-button" value="Enviar">
				
			 </div>
    </form>
    <?php
    //}
//} else {
    // Se ocorrer um erro na consulta, exiba uma mensagem de erro
   // echo "Erro na consulta: " . mysqli_error($con);
//}
?>  </div>
    </div>
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
        <div class= "imagem-container">
            <div class='img-fluid'>
            <?php echo "<p><b><h3>$nome_obra</h3></b></p>" ?>
            <?php echo "<img src='./imagens/img_obras/$foto_obra' class='card-img' style='width: 200px; height: 300px;'>"; ?>
            
            <?php
            if(isset($_SESSION['msg'])){
			echo $_SESSION['msg']."<br><br>";
			unset($_SESSION['msg']);
		}
		?>
        <div class="estrelas">

   <?php

//$idUsuario = $_SESSION['ID_USUARIO'];
//$idObra = $_SESSION['id_obra'];

//$sql = "SELECT * FROM classificar WHERE usuario_ID_USUARIO = $idUsuario AND obra_ID_OBRA = $idObra";
//$result = mysqli_query($con, $sql);

//if ($result) {
    //if (mysqli_num_rows($result) > 0) {
       // echo "Você já avaliou esta obra.";
    //} else {
        ?> 

    <!-- Seu código para exibir as estrelas -->
    <br><br><form method="POST" action="./classificacao/classificar.php" enctype="multipart/form-data"> 
			<div class="estrelas">
				<input type="radio" id="vazio" name="estrela" value="" checked>
				
				<label for="estrela_um"><i class="fa"></i></label>
				<input type="radio" id="estrela_um" name="estrela" value="1">
				
				<label for="estrela_dois"><i class="fa"></i></label>
				<input type="radio" id="estrela_dois" name="estrela" value="2">
				
				<label for="estrela_tres"><i class="fa"></i></label>
				<input type="radio" id="estrela_tres" name="estrela" value="3">
				
				<label for="estrela_quatro"><i class="fa"></i></label>
				<input type="radio" id="estrela_quatro" name="estrela" value="4">
				
				<label for="estrela_cinco"><i class="fa"></i></label>
				<input type="radio" id="estrela_cinco" name="estrela" value="5"><br><br>
				
                <input type='hidden' name='id_obra' value='<?php echo $_SESSION['id_obra'] = $_GET['id_obra']; ?>'>
                <input type='hidden' name='valor_obra' value='<?php echo $_SESSION['valor_obra'] = $_GET['valor_obra']; ?>'>

                    <!-- No botão de envio, chame a função JavaScript para enviar a classificação -->
                    <input type="submit" class="custom-button" value="Enviar">
				
			 </div>
    </form>
    <?php
    //}
//} else {
    // Se ocorrer um erro na consulta, exiba uma mensagem de erro
   // echo "Erro na consulta: " . mysqli_error($con);
//}
?>  </div>
    
            </div>
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
                    <button class="verdps" data-id=<?php echo $id_obra; ?>>Ver Depois</button>
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
    </div>
    <div class="custom-hr-container">
    <hr class="custom-hr">
    </div>
     <div id="container-res">
     <div id="content-res">
     <ul class="custom-nav" id="pills-tab" role="tablist">

  <li class="custom-nav-item">
    <a class="custom-nav-link" href="listar_obras_SL.php?id_obra=<?php echo $id_obra; ?>&valor_obra=<?php echo $valor_obra; ?>">
      <b>Resenhas sobre a obra</b>
    </a>
  </li>
  <li class="custom-nav-item">
    <a class="custom-nav-link active" href="listar_obras_SL_Citacoes.php?id_obra=<?php echo $id_obra; ?>&valor_obra=<?php echo $valor_obra; ?>">
      <b>Citações sobre a obra</b>
    </a>
  </li>
</ul>
<script>
  // Obtém o caminho da URL atual
  const path = window.location.pathname;

  // Encontra todos os links na barra de navegação
  const navLinks = document.querySelectorAll('.custom-nav-link');

  // Verifica se a URL contém o texto "resenha" e adiciona ou remove a classe "active" nos links correspondentes
  if (path.includes("resenha")) {
    navLinks[1].classList.add('active');
    navLinks[0].classList.remove('active');
  } else {
    navLinks[0].classList.add('active');
    navLinks[1].classList.remove('active');
  }
</script>
<?php
    //se o usuário não estiver logado, ele tem a opção de fazer o login para resenhar a obra
    if (!isset($_SESSION['ID_USUARIO'])) {
        echo "<a id='resenha' href='login/index.html'><p id='login-res'>Faça login para resenhar esta obra.</p><br>
        <button id='botao-res2' type='submit' style='background: none; border: none;'>
  <i class='fas fa-right-from-bracket fa-xl' style='color: #ffffff;'></i>
</button>";


      //se o usuário estiver logado, o botão "Resenhar" é disponibilizado para ele  
    } else {
        $idUsuario = $_SESSION['ID_USUARIO'];
        echo "<form action='resenha/resenha.php' method='POST'>";
        echo "<input type='hidden' name='id_obra' value='$id_obra'>";
        ?>
        <div id="container-resenha">
        <div id="frase-resenha">
        <p id="logado-res">Resenhe essa obra agora!</p>
        <button id='botao-res' type='submit'>Resenhar</button>
        </div>
        </div>
       <?php
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
            $nome_usuario = $row_resenha['NOME_PERFIL'];
            $txt_resenha = $row_resenha['TXT_RESENHA'];
            $id_usuario = $row_resenha['usuarios_ID_USUARIO'];
            $id_resenha = $row_resenha['ID_RESENHA'];
    
            echo '<div class="resenha-container">';
            echo '<div class="resenha-header">';
            echo '<span class="nome-usuario">' . $nome_usuario . '</span>';
            echo '<a href="perfil.php?id_usuario=' . $id_usuario . '">Ver perfil</a>';
            echo '</div>';
            echo '<div class="txt-resenha">' . $txt_resenha . '</div>';
            echo '<div class="curtir-comentar-container">'; // Container para os botões "Curtir" e "Comentar"

        /* if (isset($_SESSION['ID_USUARIO'])) {
        $id_usuario == $_SESSION['ID_USUARIO'];
        echo "<div class='options'>
        <button onclick=\"excluirGeral('resenhas', '$id_resenha')\">
        <i class='fas fa-trash-alt'></i> <!-- Ícone de lixo do Font Awesome -->
        </button>
        </div>";
        } */
        

    
            if (isset($_SESSION['ID_USUARIO'])) {
                $query_curtida = "SELECT ID_CURTIR FROM curtir WHERE resenha_usuario_ID_USUARIO = $idUsuario AND resenha_ID_RESENHA = $id_resenha";
                $result_curtida = mysqli_query($con, $query_curtida);

                echo "<form method='post' action='funcoes/curtir.php'>";
                echo "<input type='hidden' name='resenha_id' value='$id_resenha'>";
                echo '<input type="hidden" name="id_obra" value="' . $row["ID_OBRA"] . '">';
                echo '<input type="hidden" name="valor_obra" value="' . $row["VALOR_OBRA"] . '">';
            
                if ($result_curtida->num_rows > 0) {
                    // O usuário já curtiu, então exiba o botão para descurtir
                    echo "<form action='' method='POST'>";
                    echo "<input type='hidden' name='id_resenha' value='$id_resenha'>";
                    echo '<button type="submit" name="descurtir"  value="unlike" class="curtir-button">';
                    echo '<b>Descurtir</b> <i class="fas fa-heart"></i>';
                    echo '</button>';
                    echo '</form>';
                } else {
                    // O usuário ainda não curtiu, exiba o botão para curtir
                    echo "<form action='' method='POST'>";
                    echo "<input type='hidden' name='id_resenha' value='$id_resenha'>";
                    echo '<button type="submit" name="curtir" value="like" class="curtir-button">';
                    echo '<b>Curtir</b> <i class="fas fa-heart"></i>';
                    echo '</button>';
                    echo '</form>';
                }
                
            } else {
                echo "Faça login para curtir/descurtir resenhas.";
            }

            $sql_comentarios = "SELECT comentarios.*, perfil.USERNAME_PERFIL, perfil.usuario_ID_USUARIO
                        FROM comentarios
                        INNER JOIN perfil ON comentarios.usuarios_ID_USUARIO  = perfil.usuario_ID_USUARIO
                        WHERE comentarios.resenha_ID_RESENHA = $id_resenha";
            $result_comentarios = $con->query($sql_comentarios);

            //Botão comentário
                if (isset($_SESSION['ID_USUARIO'])) {
                    echo "<form action='comentario/comentario.php' method='POST'>";
                    echo "<input type='hidden' name='id_resenha' value='$id_resenha'>";
                    echo '<button type="submit" name="comentar" class="comentar-button">';
                    echo "<i class='fas fa-comment' style='font-size: 18px; color: #a8a8a8;' title='Comentar'></i>";
                    echo '</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>'; 
                } else {
                    echo "<a id='coment' href='login/index.html'><button type='submit'><b>Comentar</b><i class='fas fa-comment'></i> </button></a>";
                }

            if ($result_comentarios->num_rows > 0) {
                while ($row_comentario = $result_comentarios->fetch_assoc()) {
                    $id_resenha = $row_comentario['resenha_ID_RESENHA'];
                    $id_comentario = $row_comentario['ID_COMENTARIO'];
                    $txt_comentario = $row_comentario['TXT_COMENTARIO'];
                    $nome_usuario_comentario = $row_comentario['USERNAME_PERFIL'];
                    $id_usuario_comentario = $row_comentario['usuario_ID_USUARIO'];
            
            echo '<div class="comment-balloon">';
            echo '<div class="comment-header">';
            echo '<a href="perfil.php?id_usuario=' . $id_usuario . '">' . $nome_usuario_comentario . '</a>';
            echo '</div>';
            echo '<div class="comment-content">';
            echo "<p>$txt_comentario</p>";
            if (isset($_SESSION['ID_USUARIO'])) {
                if ($id_usuario_comentario == $_SESSION['ID_USUARIO']) {
                     echo 
                     "<div class='options'>
                    <button onclick=\"excluirGeral('comentarios', '$id_comentario')\">
                    <i class='fas fa-trash-alt' ></i> <!-- Ícone de lixo do Font Awesome -->
                    </button>
                    </div>";

                }}
                    echo '</div>';
                    echo '</div>';
           }
           }
           else {
            ?>
        <div id="frase-coment">
        </div>
        <?php
        }}}
    
    //caso não existam resenhas nessa obra, a frase abaixo é mostrada   
    else {
        ?>
        <div id="frase-citacao2">
            <p id="logado-citacao2">Seja o primeiro a resenhar!</p>
        </div>
        <?php
    }
    //fechando conexão com o banco de dados
?>


</body>
</html>
