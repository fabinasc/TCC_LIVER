<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../imagens/logo2_liver.png" type="image/x-icon">
    <title>Citações</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="./citacoes.css"/>
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
require "../funcoes/functions.php";

mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, 'SET character_set_connection=utf8');
mysqli_query($con, 'SET character_set_client=utf8');
mysqli_query($con, 'SET character_set_results=utf8');

// Passo 2: Realizar a consulta SQL
$stmt = mysqli_prepare($con, "SELECT citacoes.*, obra.NOME_OBRA
FROM citacoes INNER JOIN obra ON citacoes.obra_ID_OBRA = obra.ID_OBRA LIMIT 25");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Verificando se a consulta foi bem-sucedida
if (!$result) {
    die("Erro na consulta: " . mysqli_error($con));
}


?>
<center>

<h1>Citações</h1>
</center>

<?php
echo "<div class='flex-container'>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='flex-item'>";
    echo "<p class='descr'>" . $row['DESC_CITACAO'] . "</p>";
    echo "<p class='noobra'>-" . $row['NOME_OBRA'] . "</p>";
    echo "<form class='favcit-form' action='../citacoes/salvar_citacao.php' method='POST'>";
    echo "<input type='hidden' name='cit' value='{$row['ID_CITACOES']}'>";
    echo "<input type='hidden'  name='obra' value='{$row['obra_ID_OBRA']}'>";
    echo "<button class='favcit' type='submit'>";
 echo '<div id="passar_mouse"><i class="fas fa-heart"></i><div id="mostrar">Curtir</div></div>';       
echo '</button>'; 
echo "</form>";
    echo "</div>";
}
echo "</div>";
?>

<script>
const addButtonsCit = document.querySelectorAll('.favcit');
const addFormsCit = document.querySelectorAll('.favcit-form');

addButtonsCit.forEach((button, index) => {
    button.addEventListener('click', function() {
        // Envie o formulário correspondente ao botão clicado
        addFormsCit[index].submit();
    });
});
</script>


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

 <?php /*
    // Passo 3: Mostrar os dados na tela
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['DESC_CITACAO'] . "</td>";
        echo "<td>" . $row['NOME_OBRA'] . "</td>";
        echo "</tr>"; ?>

    <button class="favcit" data-id= "oi">Curtir</button>
    <form id="facit" action="./citacoes/salvar_citacao.php" method="POST">
    <input type="hidden" id="obraInputFavCit" name="obra" value="">
    </form>

 <?php
    }
    mysqli_close($con); */

    ?>

    <!-- RODAPÉ  --> 
    <?php 
    Rodape();
    ?>
<!-- RODAPÉ  --> 
    


</body>






</html>
