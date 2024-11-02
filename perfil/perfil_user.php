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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="perfil.css">

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
            window.location.href = "../excluir_itens.php?type=" + type + "&item_id=" + itemId;
        }
    }


</script>

  </head>

<body>


<?php

// Conecta-se ao banco de dados
require '../conexao.php';

session_start();

include "../funcoes/functions_heloisa.php";
// Verifica se o usuário está logado
if (!isset($_SESSION['ID_USUARIO'])) {
    header('Location: ../login.php');
    exit();
}
else{
    mostrarNavbarPerfil();  
// Obtém o ID do usuário logado
$idUsuario = $_SESSION ['ID_USUARIO'];
// Consulta o perfil do usuário
$sql = "SELECT * FROM perfil WHERE usuario_ID_USUARIO = $idUsuario";
$resultado = mysqli_query($con, $sql);

if (mysqli_num_rows($resultado) > 0) {
    $perfil = mysqli_fetch_assoc($resultado);
    $nome = $perfil['NOME_PERFIL'];
    $username = $perfil['USERNAME_PERFIL'];
    $fotoPerfil = $perfil['FOTO_PERFIL'];
    $fotoCapa = $perfil['FOTOCAPA_PERFIL'];
    $bio = $perfil['BIO']; 
} 

else {
    echo "Perfil não encontrado.";
  
}
  
 // Exiba os dados do perfil
 echo "<div class='container' x-data='{ rightSide: false, leftSide: false }'>";
 echo "<div class='left-side' :class='{'active' : leftSide}'>";


   echo  "<div class='side-wrapper'>";
   echo  "<div class='side-menu'>";

     echo "<a href='Página inicial'>";
     echo "<a href='editar_perfil.php'><div><i class='fa fa-user' aria-hidden='true'></i><span>Alterar perfil</span></div></a>";
     echo "<a href='./meu_verdps.php'><div><i class='fas fa-bookmark' aria-hidden='true'></i><span>Ver Depois</span></div></a>";
     echo "<a href='./meus_favoritos.php'><div><i class='fas fa-bookmark' aria-hidden='true'></i><span>Favoritos</span></div></a>";
     echo "<a href='../cadastro_obra/cadastro_obra.php'><div><i class='fa fa-check-square' aria-hidden='true'></i><span>Cadastrar obra</span></div></a>";
     echo "<a href='../citacoes/citacoes_curtidas.php'><div><i class='fa fa-heart' aria-hidden='true'></i><span>Citações Curtidas</span></div></a>";
     echo "<a href='../timeline.php'><div><button class='btn-perfil'>Explorar</button></div></a>";
     echo "<a href='logout.php'><div id= 'sair'><i class='fa fa-sign-out' aria-hidden='true'></i><span> Sair</span></div></a>";
    echo "</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
 
     
    echo "<div class='main-container'>";
    echo "<div class='profile'>";

 if ($fotoCapa) {
    echo "<img src='../imagens/img_user/fotos_capa/$fotoCapa' alt='Foto de Capa' class='profile-cover'><br>";
 } else {
    echo "<div id='foto-capa'></div>";
 } 
 
 echo "<div class='profile-avatar'>";
 if ($fotoPerfil) {
  echo "<img src='../imagens/img_user/fotos_user/$fotoPerfil' alt='Foto de Perfil' class='profile-img'><br>";
} else {
 echo "<img src='../imagens/img_user/fotos_user/semfoto.png' alt='Foto de Perfil' id='foto-perfil'><br>";
}
 echo "<div class='profile-name'>$nome</div>";
 echo "<div class='username'>@$username</div>";
 echo "<div class='bio'>$bio</div>";
 echo"</div>";

// Verifique se o usuário está logado
if (isset($_SESSION['ID_USUARIO'])) {
    $idUsuario = $_SESSION['ID_USUARIO'];
 
    // Consulta SQL para contar quantos seguidores o usuário logado possui
    $sqlTotalSeguidores = "SELECT COUNT(*) AS totalSeguidores FROM seguir WHERE perfil_ID_PERFIL = $idUsuario";

    // Consulta SQL para contar quantas pessoas o usuário logado está seguindo
    $sqlTotalSeguindo = "SELECT COUNT(*) AS totalSeguindo FROM seguir WHERE ID_SEGUINDO_SEGUIR = $idUsuario";
 
    // Executar as consultas SQL para contar seguidores e pessoas que o usuário está seguindo
    $resultadoTotalSeguidores = mysqli_query($con, $sqlTotalSeguidores);
    $resultadoTotalSeguindo = mysqli_query($con, $sqlTotalSeguindo);
 
    echo "<div class='profile-seguidores'>";
    if ($resultadoTotalSeguidores && $resultadoTotalSeguindo) {
        $rowTotalSeguidores = mysqli_fetch_assoc($resultadoTotalSeguidores);
        $rowTotalSeguindo = mysqli_fetch_assoc($resultadoTotalSeguindo);
    
        $totalSeguidores = $rowTotalSeguidores['totalSeguidores'];
        $totalSeguindo = $rowTotalSeguindo['totalSeguindo'];
    
        // Use um contêiner para os botões e aplique um estilo de flexbox
        echo "<div class='btn-container'>";
        echo "<p><a id ='text' class='btn btn-secondary' href='#seguindoModal' data-toggle='modal' data-target='#seguindoModal'>$totalSeguindo<br>Seguidores</a></p>";
        echo "<p><a id ='text' class='btn btn-secondary' href='#seguidoresModal' data-toggle='modal' data-target='#seguidoresModal'>$totalSeguidores<br>Seguindo</a></p>";
        echo "</div>";
    } else {
        echo "Erro ao consultar o número de seguidores e seguindo.";
    }
    echo "</div>";
} else {
    echo "Faça login para ver as informações de seguidores e seguindo.";
}

echo "</div>"; 
// Mostrar resenhas feitas pelo usuário 

$sql = "SELECT
    'resenha' AS tipo,
    resenhas.ID_RESENHA AS idresenha,
    resenhas.TXT_RESENHA AS texto,
    resenhas.DATA_RESENHA AS data,
    obra.NOME_OBRA AS nome_obra,
    obra.FOTO_OBRA AS foto_obra,
    obra.ID_OBRA AS id_obra,
    obra.VALOR_OBRA AS valor_obra,
    usuarios.ID_USUARIO AS id_usuario,
    perfil.FOTO_PERFIL AS foto_perfil,
    perfil.USERNAME_PERFIL AS username
FROM resenhas
JOIN obra ON resenhas.obra_ID_OBRA = obra.ID_OBRA
JOIN usuarios ON resenhas.usuarios_ID_USUARIO = usuarios.ID_USUARIO
JOIN perfil ON usuarios.ID_USUARIO = perfil.usuario_ID_USUARIO
WHERE usuarios.ID_USUARIO = $idUsuario
UNION
SELECT
    'citacao' AS tipo,
    citacoes.ID_CITACOES AS idcitacoes,
    citacoes.DESC_CITACAO AS texto,
    NULL AS data,
    obra.NOME_OBRA AS nome_obra,
    obra.FOTO_OBRA AS foto_obra,
    obra.ID_OBRA AS id_obra,
    obra.VALOR_OBRA AS valor_obra,
    usuarios.ID_USUARIO AS id_usuario,
    perfil.FOTO_PERFIL AS foto_perfil,
    perfil.USERNAME_PERFIL AS username
FROM citacoes
JOIN obra ON citacoes.obra_ID_OBRA = obra.ID_OBRA
JOIN usuarios ON citacoes.usuario_ID_USUARIO = usuarios.ID_USUARIO
JOIN perfil ON usuarios.ID_USUARIO = perfil.usuario_ID_USUARIO
WHERE usuarios.ID_USUARIO = $idUsuario AND citacoes.ID_CITACOES > 0
ORDER BY data DESC";



$resultado = mysqli_query($con, $sql);

echo "<div class='position'>";

// Loop para mostrar resenhas feitas pelo usuário
// Loop para mostrar resenhas feitas pelo usuário
if (mysqli_num_rows($resultado) > 0) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "<div class='album box'>";
        echo "<div class='borda'>"; 
        echo "<div class='status-main'>";
        //var_dump($row);
        // ... Seu código HTML anterior ...

        echo "<div class='album-detail'>";
        echo "<div class='album-title'>" . $row['nome_obra'] . "</div>";
        // Verifica se 'data' está definido antes de usá-lo
        if (isset($row['data']) && $row['data']) {
            echo "<div class='album-date'>" . $row['data'] . "</div>";
        }
        echo "</div>";

        echo "<img class='status-img' src='../imagens/img_obras/" . $row['foto_obra'] . "' alt='Foto da Obra'><br><br>";
        echo "<div class='album-content'><p class='resenha-text'>" . $row['texto'] . "</p>";
       
        
        if (strlen($row['texto']) >= 400) {
            echo '<button class="ver-mais-btn" onclick="toggleVerMais(this)">Ver mais</button>';
        }
        
        echo '</div>';
       
        echo "</div>";
        echo "</div>"; 
        // Botão para excluir a resenha ou citação
      
        /*if ($row['tipo'] === 'resenha') {
            echo "<button onclick=\"excluirGeral('resenhas', '{$row['idresenha']}')\">
                    <i class='fas fa-trash-alt'></i> <!-- Ícone de lixo do Font Awesome -->
                </button>";
        } 

        if ($row['tipo'] === 'citacao') {

            // Verifica se 'idcitacao' está definido antes de usá-lo
            if ($row['idcitacoes'] > 0) {
                echo "<button onclick=\"excluirGeral('citacoes', '{$row['idcitacoes']}')\">
                        <i class='fas fa-trash-alt'></i> <!-- Ícone de lixo do Font Awesome -->
                    </button>";
            } else {
                echo "<p>Citação sem ID definido.</p>";
            }
        }*/
       
        
    }

} else {
    echo "<h5 id='resenha-not'><br><br><br><br>Aparentemente você ainda não tem resenhas ou citações.</h5>";
}
}
echo "</div>";

?>
<script>
function toggleVerMais(button) {
    var container = button.closest('.album-content');
    container.classList.toggle("partial");
    button.textContent = container.classList.contains("partial") ? "Ver menos" : "Ver mais";
}
</script>
<!-- Conteúdo do modal para a função 'SEGUIDORES()' -->
<div class="modal fade" id="seguidoresModal" tabindex="-1" role="dialog" aria-labelledby="seguidoresModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="seguidoresModalLabel">Seguindo</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                // Consulta SQL para obter os seguidores do usuário logado
                $sqlSeguidores = "SELECT ID_SEGUINDO_SEGUIR FROM seguir WHERE perfil_ID_PERFIL = $idUsuario";
                $resultadoSeguidores = mysqli_query($con, $sqlSeguidores);

                echo "<div class='list-group'>";
                if (mysqli_num_rows($resultadoSeguidores) > 0) {
                    while ($rowSeguidor = mysqli_fetch_assoc($resultadoSeguidores)) {
                        $idSeguidor = $rowSeguidor['ID_SEGUINDO_SEGUIR'];

                        // Consulta SQL para obter informações do perfil do seguidor
                        $sqlPerfilSeguidor = "SELECT * FROM perfil WHERE usuario_ID_USUARIO = $idSeguidor";
                        $resultadoPerfilSeguidor = mysqli_query($con, $sqlPerfilSeguidor);

                        if (mysqli_num_rows($resultadoPerfilSeguidor) > 0) {
                            $perfilSeguidor = mysqli_fetch_assoc($resultadoPerfilSeguidor);
                            $nomeSeguidor = $perfilSeguidor['NOME_PERFIL'];
                            $usernameSeguidor = $perfilSeguidor['USERNAME_PERFIL'];
                            $idU_Seguidor = $perfilSeguidor['usuario_ID_USUARIO'];

                            // Verifica se o perfil sendo exibido é diferente do seu próprio perfil
                            if ($idU_Seguidor != $idUsuario) {
                                echo "<a href='../perfil.php?id_usuario=$idU_Seguidor' class='list-group-item list-group-item-action'>$nomeSeguidor - @$usernameSeguidor</a>";
                            }
                        }
                    }
                } else {
                    echo "<h3 class='list-group-item list-group-item-dark'>Você não tem seguidores.</h3>";
                }
                echo "</div>";
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Conteúdo do modal para a função 'SEGUINDO()' -->
<div class="modal fade" id="seguindoModal" tabindex="-1" role="dialog" aria-labelledby="seguindoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="seguindoModalLabel">Seguidores</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                // Consulta SQL para obter as pessoas que você segue
                $sqlSeguindo = "SELECT * FROM seguir WHERE ID_SEGUINDO_SEGUIR = $idUsuario";
                $resultadoSeguindo = mysqli_query($con, $sqlSeguindo);

                echo "<div class='list-group'>";
                if (mysqli_num_rows($resultadoSeguindo) > 0) {
                    while ($rowSeguindo = mysqli_fetch_assoc($resultadoSeguindo)) {
                        $idSeguido = $rowSeguindo['ID_SEGUINDO_SEGUIR'];
                        echo $idSeguido;
                        // Consulta SQL para obter informações do perfil da pessoa que você segue
                        $sqlPerfilSeguido = "SELECT * FROM perfil WHERE usuario_ID_USUARIO = $idSeguido";
                        $resultadoPerfilSeguido = mysqli_query($con, $sqlPerfilSeguido);

                        if (mysqli_num_rows($resultadoPerfilSeguido) > 0) {
                            $perfilSeguido = mysqli_fetch_assoc($resultadoPerfilSeguido);
                            $nomeSeguido = $perfilSeguido['NOME_PERFIL'];
                            $usernameSeguido = $perfilSeguido['USERNAME_PERFIL'];
                            $idU_Seguido = $perfilSeguido['usuario_ID_USUARIO'];

                            // Verifica se o perfil sendo exibido é diferente do seu próprio perfil
                            if ($idU_Seguido != $idUsuario) {
                                echo "<a href='../perfil.php?id_usuario=$idU_Seguido' class='list-group-item list-group-item-action'>$nomeSeguido - @$usernameSeguido</a>";
                            }
                        }
                    }
                } else {
                    echo "<h4 class='list-group-item'>Você não está seguindo ninguém.</h4>";
                }
                echo "</div>";
                ?>
            </div>
        </div>
    </div>
</div>


</body>
</html>