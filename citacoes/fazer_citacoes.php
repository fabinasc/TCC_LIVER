<!DOCTYPE html>
<html>
<head>
    <title>Citação no Liver</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
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
    <br><br><br><br>
    <!--NAVBAR TERMINA-->

<?php
// Conecta-se ao banco de dados
require '../conexao.php';


// Verifica se o usuário está logado
if (!isset($_SESSION['ID_USUARIO'])) {
    header('Location: ../login/index.html');
    exit();
}

// Obtém o ID do usuário logado
$idUsuario = $_SESSION['ID_USUARIO'];
$idObra = $_POST['id_obra'];
$_SESSION['id_obra'] = $idObra;

mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, 'SET character_set_connection=utf8');
mysqli_query($con, 'SET character_set_client=utf8');
mysqli_query($con, 'SET character_set_results=utf8');

$comando = "SELECT * FROM obra where ID_OBRA = $idObra";
$resulta = mysqli_query($con, $comando);
$p = 0;
?>

<div style='text-align: center'>

<?php
while ($registro = mysqli_fetch_array($resulta)) {
?>

<div style='text-align: center'>

    <div style='display: flex; justify-content: center; align-items: center; margin-bottom: 20px;'>

        <div style='margin-right: 20px;'>
            <img src='../imagens/img_obras/<?php echo $registro['FOTO_OBRA']; ?>' width='270' height='360' alt='Foto da Obra'>
        </div>

        <div>
            <p><strong></strong> <?php echo $registro['NOME_OBRA']; ?></p>
            <form name='fox' action='./doCad_citacoes.php' method='POST'>
                <input name='id_obra' value='id_obra' id='id_obra' type='hidden' value='<?php echo $idObra; ?>'><br><br>
                <p><strong>Citação</strong> <br><br>
                <textarea name='txtCitacao' id='txtCitacao'></textarea></p>
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