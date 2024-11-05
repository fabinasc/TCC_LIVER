<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../imagens/logo2_liver.png" type="image/x-icon">
        <title>Livros</title>
        <!-- Pesquisar CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <!-- Swiper CSS -->
        <link rel="stylesheet" href="css/swiper-bundle.min.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
        <!-- CSS -->
        <link rel="stylesheet" href="../categorias/categorias.css">
                                        
    </head>
    <body>
    <!-- JS Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>

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
    <br><br><br><br>
    <!--NAVBAR TERMINA-->

<!--NAVBAR TERMINA-->

                <?php
                // Faz a conexão com o banco de dados
                include "conexao.php";
                mysqli_query($con,"SET NAMES 'utf8'");  
                mysqli_query($con,'SET character_set_connection=utf8');  
                mysqli_query($con,'SET character_set_client=utf8');  
                mysqli_query($con,'SET character_set_results=utf8'); 
                // Selecionando os livros da tabela
                $query = "SELECT * FROM obra WHERE VALOR_OBRA = 4";
                $result = mysqli_query($con, $query);


                $count = 1;  // Inicialize a variável $count antes de começar o loop
                // Checa se a busca retornou resultados
                if (mysqli_num_rows($result) > 0) {
                    echo '<div class="row row-cols-3 g-3">';  // Inicie a div com as classes desejadas
                
                    // Inicie o loop
                    while ($row = mysqli_fetch_assoc($result)) {
                        $valor_obra = $row['VALOR_OBRA'];
                        $id_obra = $row['ID_OBRA'];
                        echo '<div class="col">';  // Coluna para cada card
                        echo '<div class="card">';  // Card
                        echo '<a href="../listar_obras_SL.php?id_obra=' . $id_obra . '&valor_obra=' . $valor_obra . '"><img src="../imagens/img_livros/' . $row['FOTO_OBRA'] . '" alt="' . $row["NOME_OBRA"] . '" class="card-img-top"></a>';
                        echo '<div class="card-body" style="display: block; text-align: center;">';  // Exibir o corpo do card e centralizar o texto
                      
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                
                        // Verifique se é hora de abrir uma nova linha
                        if ($count % 3 == 0) {
                            echo '</div><div class="row row-cols-3 g-3">';  // Feche a linha anterior e inicie uma nova
                        }
                
                        // Incrementa o contador
                        $count++;
                    }
                
                    // Feche a última div de linha após o loop
                    echo '</div>';
                }
                include "../funcoes/functions.php";
                catRodape();
 ?>

</body>
</html>