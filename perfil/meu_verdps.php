<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="icon" href="./public/logo2_liver.png" type="image/x-icon">
    <title>Meu perfil</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="listas.css">
  </head>

<body class= "geral">



<?php
require '../conexao.php';
session_start(); 
include "../funcoes/functions_heloisa.php";

if (!isset($_SESSION['ID_USUARIO'])) {
    echo "Você precisa estar logado para ver sua lista de Ver Depois.";
    exit;
}
else{
    mostrarNavbarLista();  
  }
// Consulta SQL para obter o nome e a foto da obra a partir do id_obra
$sql = "SELECT obra.NOME_OBRA, obra.FOTO_OBRA, depois.obra_ID_OBRA
        FROM depois
        JOIN obra ON depois.obra_ID_OBRA = obra.ID_OBRA";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Exibindo os resultados
    echo "<div class='container'>";
    echo "<div class='row justify-content-center'>"; // Centraliza a primeira linha
    echo "<div class= title>Minha Lista Ver Depois</div>";
    echo "<br><br><br><br>";
    while ($row = $result->fetch_assoc()) {
        $id_obra = $row['obra_ID_OBRA'];
        $nome_obra = $row['NOME_OBRA'];
        $foto_obra = $row['FOTO_OBRA'];

        // Exibir o nome e a foto da obra
        echo "<div class='col-md-4 text-center'>"; // Adiciona a classe text-center para centralizar o conteúdo
        echo "<div x-data='{ rightSide: false, leftSide: false }'>";
        echo "<div class='album-title'>$nome_obra<br><br></div>";
        echo "<img class='status-img' width='300' height='430px' src='../imagens/img_obras/$foto_obra' alt='Foto da obra'><br><br>";
     
        echo "<button class='verdps' data-id='$id_obra'>Remover da lista</button>
            <form class='verdepois-form' action='../listas/remover_verdps.php' method='POST'>
                <input type='hidden' class='obraInputVd' name='obra' value=''>
            </form>";

            echo "</div>";

            echo "</div>";

    }
    echo "</div>"; // Fecha a primeira linha
    echo "</div>";

    echo "<script>
        const verdpsButtons = document.querySelectorAll('.verdps');
        verdpsButtons.forEach(button => {
            button.addEventListener('click', function() {
                const obraId = button.getAttribute('data-id');
                const parentForm = button.nextElementSibling;
                const obraInputVd = parentForm.querySelector('.obraInputVd');
                obraInputVd.value = obraId;
                parentForm.submit();
            });
        });
    </script>";
} else {
    echo "Você ainda não adicionou nenhuma obra para ver depois.";
}


mysqli_close($con);
?>
</body>
</html>