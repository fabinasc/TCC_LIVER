<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../imagens/logo2_liver.png" type="image/x-icon">
        <title>Liver</title>
        <!-- Pesquisar CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <!-- Swiper CSS -->
        <link rel="stylesheet" href="../css/swiper-bundle.min.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
        <!-- CSS -->
        <link rel="stylesheet" href="../css/style.css">
                                        
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
            <img src="../imagens/liver_logo.png" alt="Logo LiVer" src="index.php" width="100" height="40"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse me-auto y-2 my-lg-0" id="navbarScroll">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../index.php">Início</a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li class="nav-item">
            <a class="nav-link" href="../perfil/perfil_user.php">Meu Perfil</a>
            </li>
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
        </div>
        <form class="d-flex" action="../pesquisar.php" method="GET">
        <div class="search-box"> 
        <input class="search-txt" type="text" placeholder= "     Pesquisar" aria-label="Pesquisar" name="pesquisar">
            <a class="search-btn" href="#">
            <i class="fas fa-search"></i>
            </a>
        </div>
        </form>
    </div>
    </nav>
<body style="background-color: #000; color: white;">


<?php
// Conecta-se ao banco de dados
require '../conexao.php';

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['ID_USUARIO'])) {
    header('Location: ../login/index.html');
    exit();
}

// Obtém o ID do usuário logado 
$idUsuario = $_SESSION['ID_USUARIO'];
$id_resenha = $_POST['id_resenha'];
$_SESSION['id_resenha'] = $id_resenha;

mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, 'SET character_set_connection=utf8');
mysqli_query($con, 'SET character_set_client=utf8');
mysqli_query($con, 'SET character_set_results=utf8');

$comando = "SELECT r.*, o.FOTO_OBRA FROM resenhas r
           LEFT JOIN obra o ON r.obra_ID_OBRA = o.ID_OBRA
           WHERE r.ID_RESENHA = $id_resenha";
$resulta = mysqli_query($con, $comando);
$p = 0;
?>
 <style>
        .texto-justificado {
            text-align: justify;
        }
    </style>
<div style='text-align: center'>

<?php
while ($registro = mysqli_fetch_array($resulta)) {
?>

    <div style='display: flex; justify-content: center; align-items: center; margin-bottom: 20px;'>

        <div style='margin-right: 20px;'>
            <img src='../imagens/img_obras/<?php echo $registro['FOTO_OBRA']; ?>' width='210' height='305' alt='Foto da Obra'>
        </div>

        <div>
            <p style="max-width: 450px;" class="texto-justificado"><strong>Resenha:</strong> <?php echo $registro['TXT_RESENHA']; ?></p>
            <form name='fox' action='./doComentario.php' method='POST'>
                <input name='id_resenha' id='id_resenha' type='hidden' value='<?php echo $id_resenha; ?>'>
                <p><strong>Comentário:</strong> <br><br>
                <textarea name='txtComent' id='txtComent'></textarea></p>
                <p><input type='submit' name='bot2' value='Enviar' class='btn btn-primary'></p>
            </form>
        </div>

    </div>

<?php
}

$close = mysqli_close($con);
?>

</div>

</body>
</html>

