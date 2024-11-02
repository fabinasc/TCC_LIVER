<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="./imagens/logo2_liver.png" type="image/x-icon">
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
  </head>
<body class= "body">

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
  echo "<a href='./citacoes/citacoes.php'><div><i class='fa-solid fa-quote-left'></i><span>Citações</span></div></a>";
  echo "<a href='./listar_obras_CL.php'><div><button class='btn-perfil'>Página Inicial</button></div></a>";
  echo "<a href='./perfil/logout.php'><div id= 'sair'><i class='fa fa-sign-out' aria-hidden='true'></i><span> Sair</span></div></a>";
 
  
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
        if ($row["FOTO_PERFIL"]) {
            echo '<img class="profile-img" width="400" height="400" src="imagens/img_user/fotos_user/' . $row["FOTO_PERFIL"] . '">';
        } else {
            // Se não houver foto de perfil, exibe um ícone de usuário
            echo '<img class="sem-profile-img" width="400" height="400" src="imagens/img_user/fotos_user/semfoto.png">';
        }
        echo '<a class= "name-time" href="perfil.php?id_usuario=' . $row["ID_USUARIO"] . '">' . $row["USERNAME_PERFIL"] . '</a>';
        echo '</div>';

        echo '<form method="GET" action="listar_obras_SL.php">';
        echo '<input type="hidden" name="id_obra" value="' . $row["ID_OBRA"] . '">';
        echo '<input type="hidden" name="valor_obra" value="' . $row["VALOR_OBRA"] . '">';
        echo "<div class='album-detail'>";
        echo "<div class='album-title'>" . $row["NOME_OBRA"] . '</div>';
        echo '<div class= "album-date"><p>' . $row["DATA_RESENHA"] . '</p></div>';
        echo "</div>";
        echo '<button type="submit" style="background: none; border: none; cursor: pointer;">';
        echo '<img class="status-img" width="100" height="150" src="imagens/img_obras/' . $row["FOTO_OBRA"] . '" alt="' . $row["NOME_OBRA"] . '" data-id="' . $row["ID_OBRA"] . '">';
        echo '<br><br>';
        echo '</button>';
        echo '</form>';
        
        if ($row["TXT_RESENHA"]) {
            echo "<div class='album-content'>";
            echo '<div class="section">';
            echo '<div class="custom-container">';
            echo '<p class= "resenha-text">' . $row["TXT_RESENHA"] . '</p>';
            if (strlen($row["TXT_RESENHA"]) >= 400) {
                echo '<button class="ver-mais-btn" onclick="toggleVerMais(this)">Ver mais</button>';
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            ?>
            <script>
            function toggleVerMais(button) {
                var container = button.parentNode;
                container.classList.toggle("partial");
                button.textContent = container.classList.contains("partial") ? "Ver menos" : "Ver mais";
            }
            </script>
            <?php
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
                    echo "<div class='positionfav'>";
                    if ($result_curtida->num_rows > 0) {
                        // O usuário já curtiu, então exiba o botão para descurtir
                        
                        echo "<button class= 'favcitum' type='submit' name='curtir' value='unlike'>";
                        echo '<div id="passar_mouse"><i class="fas fa-heart"></i><div id="mostrar">Descurtir</div></div>';
                        echo '</button>';
                        
                    } else {
                        // O usuário ainda não curtiu, exiba o botão para curtir
                        echo "<button class= 'favcit' type='submit' name='curtir' value='like'>";
                        echo '<div id="passar_mouse"><i class="fas fa-heart"></i><div id="mostrar">Curtir</div></div>';       
                        echo '</button>';     
                        
        }
        
                    }
                    echo "</form>";
                } else {
                    echo "Faça login para curtir/descurtir resenhas.";
                }
          
                 if (isset($_SESSION['ID_USUARIO'])) {
            echo "<form action='comentario/comentario.php' method='POST'>";
            echo "<input type='hidden' name='id_resenha' value='$id_resenha'>";
            echo "<button class= 'comcit' type='submit'>";
            echo '<div id="passar_mouse"><i class="fas fa-comment"></i><div id="mostrar">Comente</div></div>';
            echo '</button>';
            echo "</form>";
            echo '</div>';
            echo '<button class="respostas">Respostas</button>';
            echo '<div class="comentarios" style="display: none;">';
                // Consulta SQL para obter os comentários relacionados a esta resenha
                $comentariosSql = "SELECT * FROM comentarios WHERE resenha_ID_RESENHA = " . $row['ID_RESENHA'];
                $comentariosResult = $con->query($comentariosSql);

                if ($comentariosResult->num_rows > 0) {
                   
                    while ($comentario = $comentariosResult->fetch_assoc()) {
                        $comentarioIdUsuario = $comentario["usuarios_ID_USUARIO"];

                        // Consulta para obter o nome de usuário do autor do comentário
                        $query_nome_usuario = "SELECT USERNAME_PERFIL FROM perfil WHERE usuario_ID_USUARIO = $comentarioIdUsuario";
                        $result_nome_usuario = $con->query($query_nome_usuario);

                        if ($result_nome_usuario->num_rows > 0) {
                            $row_nome_usuario = $result_nome_usuario->fetch_assoc();
                            $nome_usuario_comentario = $row_nome_usuario["USERNAME_PERFIL"];
                        } else {
                            $nome_usuario_comentario = "Nome de Usuário Desconhecido";
                        }

                        echo '<div class="comment">';
                        echo '<p><a id= "perfil-comment" href="perfil.php?id_usuario=' . $comentarioIdUsuario . '">' . $nome_usuario_comentario . '</a><br> ' . '<div id= "resposta">' . $comentario["TXT_COMENTARIO"] . '</div></p>';
                        echo '<hr>';
                        echo '</div>';

                    }
                }
                echo '</div>'; // Feche a div do coment
            }
        } elseif ($row["DESC_CITACAO"]) {
            echo '<p>Citação: ' . $row["DESC_CITACAO"] . '</p>';
        }

        echo '</div>'; // Feche a div do timeline-post
    }
} else {
    echo "Nenhuma postagem encontrada.";
}
echo "</div>";
echo "</div>";
?>
<script>
    $(document).ready(function(){
        $(".respostas").click(function(){
            $(this).next(".comentarios").toggle();
        });
    });
</script>
</body>
</html>
