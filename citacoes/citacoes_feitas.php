<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
// Conecta-se ao banco de dados
require '../conexao.php';
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['ID_USUARIO'])) {
    header('Location: ../login/index.html');
    exit();
}

mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, 'SET character_set_connection=utf8');
mysqli_query($con, 'SET character_set_client=utf8');
mysqli_query($con, 'SET character_set_results=utf8');

// Obtém o ID do perfil do usuário logado
$idUsuario = $_SESSION['ID_USUARIO'];

// Selecionando as citações do perfil logado
$query = "SELECT * FROM citacoes WHERE usuario_ID_USUARIO = $idUsuario";
$result = mysqli_query($con, $query);

// Verificando se a consulta foi bem-sucedida
if (!$result) {
    die("Erro na consulta: " . mysqli_error($con));
}
?>

<h1>Minhas Citações</h1>
<table>
    <?php
    // Mostrar os dados na tela
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['DESC_CITACAO'] . "</td>";
        echo "</tr>";
    }
    // Fecha a conexão com o banco de dados
    mysqli_close($con);
    ?>

</table>
</body>
</html>