<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../imagens/logo2_liver.png" type="image/x-icon">
    <title>Citações Curtidas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="./citacoes.css"/>
</head>
<body>

    <div class="container-fluid">
 <!--NAVBAR-->
      <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
         <div class="container-nav">
         <a class="navbar-brand">
           <img src="../imagens/liver_logo.png" alt="Logo LiVer"  width="100" height="40"></a>
            </div>
             <div class="testenav">
             <div class="testenav">
         <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScrollingDropdown" aria-controls="navbarScrollingDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
             </button>
         <div class="collapse navbar-collapse" id="navbarScroll">
             <ul class="navbar-nav me-auto my-lg-0">
              <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../listar_obras_CL.php">Página inicial</a>
               </li>
           <li><hr class="dropdown-divider"></li>
          <li class="nav-item">
          <a class="nav-link" href="../perfil/perfil_user.php">Meu perfil</a>
        </li>
        <li><hr class="dropdown-divider"></li>
                        </ul>
                    </div>
                                          
  </nav>
    <br><br><br><br>
    <!--NAVBAR TERMINA-->
            
    
<center>

<h1>Citações Curtidas</h1>
</center>


    
<?php


require '../conexao.php';

session_start();

if (!isset($_SESSION['ID_USUARIO'])) {
    echo "Você precisa estar logado para ver suas citações curtidas.";
    exit;
}

$idUsuario = $_SESSION['ID_USUARIO'];

// Consulta SQL para obter o nome e a foto da obra a partir do id_obra
$sql = "SELECT obra.NOME_OBRA, citacoes.DESC_CITACAO, favoritos.citacoes_ID_CITACOES, favoritos.obra_ID_OBRA, obra.VALOR_OBRA
        FROM favoritos
        JOIN obra ON favoritos.obra_ID_OBRA = obra.ID_OBRA
        JOIN citacoes ON favoritos.citacoes_ID_CITACOES = citacoes.ID_CITACOES
        WHERE favoritos.usuario_ID_USUARIO = $idUsuario AND favoritos.TIPO_FAVORITO = 2";

$result = $con->query($sql);


if ($result->num_rows > 0) {
    // Abre a div container fora do loop para que todos os itens estejam dentro do mesmo container flex
    echo "<div class='flex-container'>";

    while ($row = $result->fetch_assoc()) {
        $id_cit = $row['citacoes_ID_CITACOES'];
        $nome_obra = $row['NOME_OBRA'];
        $descricao = $row['DESC_CITACAO'];
        $valor_obra = $row['VALOR_OBRA'];
        $id_obra = $row['obra_ID_OBRA'];

        echo "<div class='flex-item'>";
        echo "<p class='descr'>$descricao</p>";
      
        echo "<form class='favcit-form' action='../citacoes/remover_curtcit.php' method='POST'>";
        echo "<input type='hidden' class='obraInputFavCitR' name='cit' value='$id_cit'>";
        echo "<button class='favcitt' data-id='$id_cit'>";
     echo '<div id="passar_mouse"><i class="fas fa-heart"></i><div id="mostrar">Descurtir</div></div>';
        echo "</button>";
        echo "</form>";
          echo "<a href=../listar_obras_SL.php?id_obra=$id_obra&valor_obra=$valor_obra class='noobrinha'>-$nome_obra<br><br></a>";
        echo "</div>";
    }

    // Fecha a div container
    echo "</div>";

    echo "<script>
        const favsCitRButtons = document.querySelectorAll('.favcit');
        favsCitRButtons.forEach(button => {
            button.addEventListener('click', function() {
                const citId = button.getAttribute('data-id');
                const parentForm = button.nextElementSibling;
                const obraInputFavCitR = parentForm.querySelector('.obraInputFavCitR');
                obraInputFavCitR.value = citId;
                parentForm.submit();
            });
        });
        </script>";
} else {
    echo "Você ainda não curtiu nenhuma citação.";
}

mysqli_close($con);
?>
</body>
</html>
