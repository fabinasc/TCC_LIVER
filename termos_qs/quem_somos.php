<!DOCTYPE html>
<html>
<head>
      <!-- Configurações da página -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="icon" href="./IMG/logo2_liver.png" type="image/x-icon">
	<title>Quem Somos | LiVer</title>
	 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="termos_qs.css">
</head>
<body>

	<div class="container-fluid">
    <!--NAVBAR-->
    <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark w-100">
        <div class="container">
            <a class="navbar-brand">
                <img src="../imagens/liver_logo.png" alt="Logo LiVer" src="../index.php" width="100" height="40"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Início</a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <?php
                    // Inicie a sessão se ainda não estiver iniciada
                    session_start();

                    // Verifique se o ID_USUARIO está na sessão
                    if(isset($_SESSION['ID_USUARIO']) && !empty($_SESSION['ID_USUARIO'])) {
                        // O ID_USUARIO está configurado na sessão
                        echo '<li class="nav-item">
                                <a class="nav-link" href="../perfil/perfil_user.php">Meu perfil</a>
                            </li>';
                    } else {
                        // O ID_USUARIO não está configurado na sessão
                        echo '<li class="nav-item">
                                <a class="nav-link" href="../login/index.html">Login</a>
                            </li>';
                    }
                    ?>
                    <li><hr class="dropdown-divider"></li>
                    <li class="nav-item">
                         <a class="nav-link" href="../citacoes/citacoes.php">Citações</a>
                   </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorias</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item" href="../categorias/categ_livros.php">Livros</a></li>
                            <li><a class="dropdown-item" href="../categorias/categ_filmes.php">Filmes</a></li>
                            <li><a class="dropdown-item" href="../categorias/categ_series.php">Séries</a></li>
                            <li><a class="dropdown-item" href="../categorias/categ_novelas.php">Novelas</a></li>
                        </ul>
                    </li>
                </ul>

            
                <form class="d-flex" action="../pesquisar.php" method="GET">
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
<br><br><br>

<!-- Conteúdo da página -->
    <div class="frame-child">
        <div class="pagelogin">


            <img class="image-1-icon" alt="" src="./IMG/image-1@2x.png">
  <div class="dev-sectionn">
  
 <!-- Informações sobre a plataforma -->

            <h2>Quem Somos?</h2>
 <div class="barra"></div>
            <section>
                <br>
                <p>Somos uma rede social destinada para apreciadores de livros, filmes, séries e novelas; com o objetivo de enaltecer nossas produções nacionais.</p>
                <br>
                <h3>Sobre Nós</h3>
                <div class="barra"></div>
                <br>
                <p>O Liver nasceu em 2023, sendo um projeto de TCC dos alunos da ETEC Lauro Gomes, do curso de Informática para Internet. Nós tínhamos um interesse em comum pela literatura e cinematografia e notamos o quanto as produções do nosso país eram esquecidas ou tinham um estereótipo ruim. Assim, decidimos mudar isso, iniciando o desenvolvimento do Liver!</p>
                <br>
                <h3>O que você pode fazer no Liver? </h3>
                <div class="barra"></div>
                <br>
                <p>Você pode descobrir novas obras; compartilhar suas opiniões; salvar livros, filmes, séries e novelas para ver mais tarde e marcá-las como favoritas, tudo da melhor maneira!</p>
                <br>
                <h3>Equipe de Desenvolvedores</h3>
            </div>
                <div class="dev-section">
                <div class="barra"></div>
                <br>
                    <p>Brunna Saraiva Oliveira</p>
                    <p>Fabíolla Oliveira Nascimento</p>
                    <p>Giovana Ribeiro Araujo</p>
                    <p>Heloisa Alves de Mesquita</p>
                    <p>Letícia Moreira dos Santos</p>
                    <p>Murillo de Nascimento Ordonho</p>
                    <p>Nikolas Babolim de Carvalho</p>
                </div>
                <br>
                <h3>Contato</h3>
                 <div class="barra"></div>
                 <br>

                <a href="mailto:liverbrasil1@gmail.com "style="text-decoration: none; color: white;"> <i class="fas fa-envelope"></i>liverbrasil1@gmail.com </a>
            </section>
            <br><br>

        </div>
    </div>
</body>
</html>

</div>
</div>

</body>
</html>

