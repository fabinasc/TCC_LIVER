<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <title>Linha do tempo</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/timeline.css">
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
<body class= 'body'>

</body>
</html>
<?php
// Conecta-se ao banco de dados
require 'conexao.php';

session_start();
include "funcoes/functions_heloisa.php";
// Verifica se o usuário está logado
if (!isset($_SESSION['ID_USUARIO'])) {
    header('Location: ../login.php');
    exit();
}
else {
    $idUsuario = ($_SESSION['ID_USUARIO']);
    mostrarNavbarTimeline();  
}

// Consulta principal para obter resenhas e citações
$sql = "
SELECT
    resenhas.ID_RESENHA,
    resenhas.TXT_RESENHA,
    resenhas.DATA_RESENHA,
    obra.NOME_OBRA,
    obra.FOTO_OBRA,
    obra.ID_OBRA,
    obra.VALOR_OBRA, 
    usuarios.ID_USUARIO,
    perfil.usuario_ID_USUARIO,
    perfil.FOTO_PERFIL,
    perfil.USERNAME_PERFIL
FROM resenhas
JOIN obra ON resenhas.obra_ID_OBRA = obra.ID_OBRA
JOIN usuarios ON resenhas.usuarios_ID_USUARIO = usuarios.ID_USUARIO
JOIN perfil ON usuarios.ID_USUARIO = perfil.usuario_ID_USUARIO
UNION
SELECT
    citacoes.ID_CITACOES,
    citacoes.DESC_CITACAO,
    NULL,
    obra.NOME_OBRA,
    obra.FOTO_OBRA,
    obra.ID_OBRA,
    obra.VALOR_OBRA, 
    usuarios.ID_USUARIO,
    perfil.usuario_ID_USUARIO,
    perfil.FOTO_PERFIL,
    perfil.USERNAME_PERFIL
FROM citacoes
JOIN perfil ON citacoes.usuario_ID_USUARIO = perfil.usuario_ID_USUARIO
JOIN obra ON citacoes.obra_ID_OBRA = obra.ID_OBRA
JOIN usuarios ON citacoes.usuario_ID_USUARIO = usuarios.ID_USUARIO
ORDER BY DATA_RESENHA DESC;
";

$result = $con->query($sql);
echo "<div class='container' x-data='{ rightSide: false, leftSide: false }'>";
echo "<div class='left-side' :class='{'active' : leftSide}'>";


  echo  "<div class='side-wrapper'>";
  echo  "<div class='side-menu'>";

  echo "<a href='Página inicial'>";
  echo "<a href='./perfil/perfil_user.php'><div><i class='fa fa-user' aria-hidden='true'></i><span>Meu perfil</span></div></a>";
  echo "<a href='./citacoes.php'><div><i class='fa-solid fa-quote-left'></i><span>Citações</span></div></a>";
  echo "<a href='./listar_obras_CL.php'><div><button class='btn-perfil'>Página Inicial</button></div></a>";
  echo "<a href='logout.php'><div id= 'sair'><i class='fa fa-sign-out' aria-hidden='true'></i><span> Sair</span></div></a>";
 
  
 echo "</div>";
 echo "</div>";
 echo "</div>";

 echo "<div class='main-container'>";

// Loop através dos resultados
echo "<div class='position'>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='album box'>"; 
        echo "<div class='borda'>"; 
        echo "<div class='status-main'>";

        echo '<div class="post-header">';
        echo '<img class="status-img" src="imagens/img_user/fotos_user/' . $row["FOTO_PERFIL"] . '">';
        echo '<a href="perfil.php?id_usuario=' . $row["ID_USUARIO"] . '">' . $row["USERNAME_PERFIL"] . '</a>';
        echo '</div>';

        echo '<form method="GET" action="listar_obras_SL.php">';
        echo '<input type="hidden" name="id_obra" value="' . $row["ID_OBRA"] . '">';
        echo '<input type="hidden" name="valor_obra" value="' . $row["VALOR_OBRA"] . '">';
        echo "<div class='album-detail'>";
        echo "<div class='album-title'>" . $row["NOME_OBRA"] . '</div>';
        echo '<p>' . $row["DATA_RESENHA"] . '</p>';
        echo "</div>";
        echo '<button type="submit" style="background: none; border: none; cursor: pointer;">';
        echo '<img class="status-img" src="imagens/img_obras/' . $row["FOTO_OBRA"] . '" alt="' . $row["NOME_OBRA"] . '" data-id="' . $row["ID_OBRA"] . '">';
        echo '</button>';
        echo '</form>';
        

        
        if ($row["TXT_RESENHA"]) {
            $id_resenha = $row['ID_RESENHA'];
             $id_usuario = $row['ID_USUARIO'];
            echo "<div class='album-content'>";
            echo '<p>' . $row["TXT_RESENHA"] . '</p>';
            echo '</div>';
            echo '</div>';
             /*if ($id_usuario == $_SESSION['ID_USUARIO']) {
                   echo "<div class='options'>
                  <button onclick=\"excluirGeral('resenhas', '$id_resenha')\">
                  <i class='fas fa-trash-alt'></i> <!-- Ícone de lixo do Font Awesome -->
                  </button>
                  </div>"; }*/

            // Verifique se a postagem atual é uma resenha antes de buscar comentários
            if ($row["ID_RESENHA"]) {
                $id_resenha = $row['ID_RESENHA'];

                if (isset($_SESSION['ID_USUARIO'])) {
                    $query_curtida = "SELECT ID_CURTIR FROM curtir WHERE resenha_usuario_ID_USUARIO = $idUsuario AND resenha_ID_RESENHA = $id_resenha";
                    $result_curtida = mysqli_query($con, $query_curtida);

                    echo "<form method='post' action='funcoes/curtir_tml.php'>";
                    echo "<input type='hidden' name='resenha_id' value='$id_resenha'>";
                    echo '<input type="hidden" name="id_obra" value="' . $row["ID_OBRA"] . '">';
                    echo '<input type="hidden" name="valor_obra" value="' . $row["VALOR_OBRA"] . '">';
         }
                    if ($result_curtida->num_rows > 0) {
                        // O usuário já curtiu, então exiba o botão para descurtir
                        echo "<button type='submit' name='curtir' value='unlike'>Descurtir</button>";
                    } else {
                        // O usuário ainda não curtiu, exiba o botão para curtir
                        echo "<button type='submit' name='curtir' value='like'>Curtir</button>";                 
        }
        

                    
                    echo "</form>";
                } else {
                    echo "Faça login para curtir/descurtir resenhas.";
                }
          
                 if (isset($_SESSION['ID_USUARIO'])) {
            echo "<form action='comentario/comentario.php' method='POST'>";
            echo "<input type='hidden' name='id_resenha' value='$id_resenha'>";
            echo "<button id='comentario' type='submit'>Comentar</button>";
            echo "</form>";

                // Consulta SQL para obter os comentários relacionados a esta resenha
                $comentariosSql = "SELECT * FROM comentarios WHERE resenha_ID_RESENHA = " . $row['ID_RESENHA'];
                $comentariosResult = $con->query($comentariosSql);

                if ($comentariosResult->num_rows > 0) {
                    echo '<h4>Comentários:</h4>';
                    while ($comentario = $comentariosResult->fetch_assoc()) {
                        $comentarioIdUsuario = $comentario["usuarios_ID_USUARIO"];


                        // Consulta para obter o nome de usuário do autor do comentário
                        $query_nome_usuario = "SELECT USERNAME_PERFIL FROM perfil WHERE usuario_ID_USUARIO = $comentarioIdUsuario";
                        $result_nome_usuario = $con->query($query_nome_usuario);
                        $id_comentario = $comentario['ID_COMENTARIO'];

                        if ($result_nome_usuario->num_rows > 0) {
                            $row_nome_usuario = $result_nome_usuario->fetch_assoc();
                            $nome_usuario_comentario = $row_nome_usuario["USERNAME_PERFIL"];
                        } else {
                            $nome_usuario_comentario = "Nome de Usuário Desconhecido";
                        }

                        echo '<div class="comment">';
                        echo '<p><a href="perfil.php?id_usuario=' . $comentarioIdUsuario . '">' . $nome_usuario_comentario . '</a>: ' . $comentario["TXT_COMENTARIO"] . '</p>';
                        echo '</div>';

                         if (isset($_SESSION['ID_USUARIO'])) {
                         if ($comentarioIdUsuario == $_SESSION['ID_USUARIO']) {
                            
                     echo "<div class='options'>
                    <button onclick=\"excluirGeral('comentarios', '$id_comentario')\">
                    <i class='fas fa-trash-alt'></i> <!-- Ícone de lixo do Font Awesome -->
                    </button>
                    </div>";
                }}

                    }
                }
            }
        } elseif ($row["DESC_CITACAO"]) {
            $id_citacao = $row['ID_CITACOES'];
            echo '<p>Citação: ' . $row["DESC_CITACAO"] . '</p>';
             /*if ($id_usuario == $_SESSION['ID_USUARIO']) {
                            
                     echo "<div class='options'>
                    <button onclick=\"excluirGeral('citacoes', '$id_citacao')\">
                    <i class='fas fa-trash-alt'></i> <!-- Ícone de lixo do Font Awesome -->
                    </button>
                    </div>";
                }*/
        }

        echo '</div>'; // Feche a div do timeline-post
    }
} else {
    echo "Nenhuma postagem encontrada.";
}
echo "</div>";
echo "</div>";
?>

