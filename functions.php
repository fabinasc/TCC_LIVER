<?php
function mostrarNavbar() {
    echo '
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="./imagens/logo2_liver.png" type="image/x-icon">
        <title>Liver</title>
        <!-- Pesquisar CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <!-- Swiper CSS -->
        <link rel="stylesheet" href="css/swiper-bundle.min.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
        <!-- CSS -->
        <link rel="stylesheet" href="css/style.css">
        <style>
            /* Estilo da NAVBAR */
            .navbar-nav {
                display: flex;
                justify-content: start;
                align-items: center;
                height: 100%;
                margin-top: 0px; 
                margin-right: 100px;
            }

            .search-box {
                position: absolute;
                top: 50%;
                left: 90%;
                transform: translate(-50%, -50%);
                background: white;
                height: 30px;
                border-radius: 20px;
                padding: 5px; 
            }

            .search-box:hover > .search-txt {
                width: 110px;
                padding: 0 6px;
                top: 50px;
            }

            .search-btn {
                position: absolute;
                color: black;
                background: yellow;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                display: block;
            }

            .search-txt {
                border: none;
                background: none;
                outline: none;
                float: right;
                padding: 0;
                font-size: 14px;
                transition: 1.2s;
                width: 20px;
                margin-left: 20px;
                margin-top: -1px;
                display: block;
            }

            .navbar {
                position: fixed;
                width: 100%;
                left: 0;
                background-color: black; 
            }
        </style>
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
                <img src="./imagens/liver_logo.png" alt="Logo LiVer" src="index.php" width="100" height="40"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Início</a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li class="nav-item">
                        <a class="nav-link" href="login/index.html">Login</a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li class="nav-item">
                        <a class="nav-link" href="./pages/citacoes.php">Citações</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorias</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item" href="categorias/categ_livros.php">Livros</a></li>
                            <li><a class="dropdown-item" href="categorias/categ_filmes.php">Filmes</a></li>
                            <li><a class="dropdown-item" href="categorias/categ_series.php">Séries</a></li>
                            <li><a class="dropdown-item" href="categorias/categ_novelas.php">Novelas</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" action="pesquisar.php" method="GET">
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
    <!--CAROUSEL COM BANNERS-->
    <div class="container">
        <div id="carouselExampleLight" class="carousel carousel-light slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleLight" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleLight" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="2000">
                    <img src="./imagens/Consciência.jpg" class="d-block w-100" alt="Banner sobre dia da Consciência Negra">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="./imagens/Bandeira.jpg" class="d-block w-100" alt="Banner Bandeira Brasileira">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleLight" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleLight" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>';
}
?>

<?php

function Rodape() {
    echo ' 
<style> 
.container{
    padding: 50px 0 20px;
}
.site-footer
{
  position: absolute;
  top: 2990px;
  width: 100%;
  background-color:#26272b;
  height: 450px; /* Ajuste o valor conforme necessário */
  padding: 50px 80px; /* Ajuste o valor conforme necessário para controlar o espaçamento interno */
  font-size:15px;
  line-height:24px;
  color:#737373;
}
.site-footer hr
{
  border-top-color:#bbb;
  opacity: 0.3;
  margin-top: -1px;
}
.site-footer hr.small
{
  margin:80px 0;
}
.site-footer h6
{
  color:#fff;
  font-size:18px;
  text-transform:uppercase;
  margin-top:5px;
  letter-spacing:2px
}
.site-footer a
{
  color:#737373;
}
.site-footer a:hover
{
  color:#3366cc;
  text-decoration:none;
}
.footer-links
{
  padding-left:0;
  list-style:none
}
.footer-links li
{
  display:block
}
.footer-links a
{
  color:#737373
}
.footer-links a:active,.footer-links a:focus,.footer-links a:hover
{
  color:#3366cc;
  text-decoration:none;
}
.footer-links.inline li
{
  display:inline-block
}
.site-footer .social-icons
{
  text-align:right
}
.site-footer .social-icons a
{
    width: 40px;
    height: 40px;
    line-height: 40px;
    margin-left: 6px;
    margin-right: 3px; /* Adicione a unidade de medida, por exemplo, 1000px */
    border-radius: 100%;
    background-color: #33353d;
}
.site-footer .copyright-text
{
    margin-bottom: 50px;
}
@media (max-width:991px)
{
  .site-footer [class^=col-]
  {
    margin-bottom:50px
  }
}
@media (max-width:767px)
{
  .site-footer
  {
    padding-bottom:0
  }
  .site-footer .copyright-text,.site-footer .social-icons
  {
    text-align:center
  }
}
.social-icons
{
  padding-left:0;
  margin-bottom:0;
  list-style:none
}
.social-icons li
{
  display:inline-block;
  margin-bottom:4px
}
.social-icons li.title
{
  margin-right:15px;
  text-transform:uppercase;
  color:#96a2b2;
  font-weight:700;
  font-size:13px
}
.social-icons a{
  background-color:#eceeef;
  color:#818a91;
  font-size:16px;
  display:inline-block;
  line-height:44px;
  width:44px;
  height:44px;
  text-align:center;
  margin-right:10px;
  border-radius:100%;
  -webkit-transition:all .2s linear;
  -o-transition:all .2s linear;
  transition:all .2s linear
}
.social-icons a:active,.social-icons a:focus,.social-icons a:hover
{
  color:#fff;
  background-color:#29aafe
}
.social-icons.size-sm a
{
  line-height:34px;
  height:34px;
  width:34px;
  font-size:14px
}
.social-icons a.facebook:hover
{
  background-color:#3b5998
}
.social-icons a.twitter:hover
{
  background-color:#00aced
}
.social-icons a.linkedin:hover
{
  background-color:#007bb6
}
.social-icons a.dribbble:hover
{
  background-color:#ea4c89
}
@media (max-width:767px)
{
  .social-icons li.title
  {
    display:block;
    margin-right:0;
    font-weight:600
  }
}
</style>
    <body>
    <!-- Site footer -->
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>Quem Somos?</h6>
            <p class="text-justify"> Somos uma rede social destinada para apreciadores de livros, filmes, séries e novelas; com o objetivo de enaltecer nossas produções nacionais.

</p>
          </div>

          <div class="col-xs-6 col-md-3">
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Quick Links</h6>
            <ul class="footer-links">
              <li><a href="##">Sobre Nós</a></li>
              <li><a href="##">SAC</a></li>
              <li><a href="###">Contribua</a></li>
              <li><a href="h##">Termos de Uso</a></li>
            </ul>
          </div>
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <p class="copyright-text">Copyright &copy; 2023 
            </p>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
              <li><a class="instagram" href="https://www.instagram.com/liverbr_/"><i class="fa fa-instagram"></i></a></li>
              <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
             
            </ul>
          </div>
        </div>
      </div>
</footer>
    </body>
    </html>
    ';
}
?>

<?php 
require_once('../PHPMailer/src/PHPMailer.php');
require_once('../PHPMailer/src/SMTP.php');
require_once('../PHPMailer/src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

 function emailUsuario()
 {
      $email = $_GET['email'];

      $mail = new PHPMailer(true);

      try {
          
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'liverbrasil1@gmail.com';
          $mail->Password = 'sucmwgnfyeldjvxr';   
          $mail->Port = 587;
      
          $mail->setFrom('liverbrasil1@gmail.com');
          $mail->addAddress("$email");
          $mail->isHTML(true);
          $mail->Subject = 'Cadastro da obra realizado com sucesso!';
          $mail->Body = 'Nós da equipe Liver verificamos aqui, e sim, a sua obra é brasileira! Acesse o site agora para resenhar, curtir, citar e adicionar a obra aos favoritos! <a href="www.liverbr.com" target="_blank"><button>Acesse</button></a> ';

          if(!$mail->send()) {
              echo "<script>alert('Erro ao enviar o e-mail. Tente novamente.');</script>";
          } else {
              echo "<script>alert('E-mail enviado a $email com sucesso!');</script>";   
          } 
          
      }  catch (Exception $e) {
          echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
      }
  }

?>

<?php 
function cadastroLivro(){
  
include "conexao.php";

mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, 'SET character_set_connection=utf8');
mysqli_query($con, 'SET character_set_client=utf8');
mysqli_query($con, 'SET character_set_results=utf8');


  session_start();

  // Verifica se o usuário está logado
  if (!isset($_SESSION['ID_USUARIO'])) {
  header('Location: ../index.html');
  exit();
  }

  $idUsuario = $_SESSION['ID_USUARIO'];
  $nome = $_GET['nomelivro'];
  $autor = $_GET['autor'];
  $ano = $_GET['anolivro'];
  $sinopse = $_GET['sinopselivro'];
  $foto = $_GET['fotolivro'];
  $editora = $_GET['editora'];
  $classif = $_GET['classiflivro'];
  $paginas = $_GET['paginas'];

  $sql= "INSERT INTO obra (VALOR_OBRA, DESC_OBRA, NOME_OBRA, FOTO_OBRA, AU_DI_OBRA, ANO_OBRA, perfil_ID_PERFIL, perfil_usuario_ID_USUARIO) 
         VALUES (4, '$sinopse','$nome','$foto','$autor','$ano',$idUsuario, $idUsuario)";

  if (!mysqli_query($con,$sql)) {
      
      echo "<script>alert('Ocorreu um erro. Tente novamente mais tarde.');</script>";
  } else {
      $id_obra = mysqli_insert_id($con);

      //INNER JOIN
      $sqlSelectLivros = "SELECT * FROM obra INNER JOIN livros ON obra.ID_OBRA = livros.obra_ID_OBRA WHERE obra.ID_OBRA = $id_obra";

      //INSERT tabela livros
      $sqlInsertLivros = "INSERT INTO livros (obra_ID_OBRA, obra_perfil_ID_PERFIL, obra_perfil_usuario_ID_USUARIO, VALOR_OBRA, EDITORA_LIVRO, PAGINAS_LIVRO, C_IND_LIVRO)
                          VALUES ($id_obra, $idUsuario, $idUsuario, 4, '$editora', '$paginas', '$classif')";
      $resultInsertLivros = $con->query($sqlInsertLivros);
  } 
  
  if (!mysqli_query($con, $sqlSelectLivros)) {
      echo "<script>alert('Erro ao cadastrar obra. Tente novamente.');</script>";
  } else if (!mysqli_query($con,$sqlInsertLivros)){
      echo "<script>alert('Erro ao cadastrar livro. Tente novamente.');</script>";
  } else {
    echo "";
  }

  }
?>

<?php 
function cadastroFilme(){
  include "conexao.php";

  mysqli_query($con, "SET NAMES 'utf8'");
  mysqli_query($con, 'SET character_set_connection=utf8');
  mysqli_query($con, 'SET character_set_client=utf8');
  mysqli_query($con, 'SET character_set_results=utf8');


  session_start();
  // Verifica se o usuário está logado
  if (!isset($_SESSION['ID_USUARIO'])) {
  header('Location: ../index.html');
  exit();
  }

  $idUsuario = $_SESSION['ID_USUARIO'];
  $nome = $_GET['nomefilme'];
  $diretor = $_GET['diretorfilme'];
  $ano = $_GET['anofilme'];
  $elenco = $_GET['elencofilme'];
  $sinopse = $_GET['sinopsefilme'];
  $duracao = $_GET['duracao'];
  $distrib = $_GET['distfilme'];
  $produtora = $_GET['prodfilme'];
  $classif = $_GET['classiffilme'];
  $foto = $_GET['fotofilme'];

  $sql= "INSERT INTO obra (VALOR_OBRA, DESC_OBRA, NOME_OBRA, FOTO_OBRA, AU_DI_OBRA, ANO_OBRA, perfil_ID_PERFIL, perfil_usuario_ID_USUARIO) 
         VALUES (2, '$sinopse','$nome','$foto','$diretor','$ano',$idUsuario, $idUsuario)";

  if (!mysqli_query($con,$sql)) {
      echo "<script>alert('Ocorreu um erro. Tente novamente mais tarde.');</script>";
      echo "Erro na inserção: " . mysqli_error($con);
  } else {
      $id_obra = mysqli_insert_id($con);
      
      //INNER JOIN
      $sqlSelectFilmes = "SELECT * FROM obra INNER JOIN filmes ON obra.ID_OBRA = filmes.obra_ID_OBRA WHERE obra.ID_OBRA = $id_obra";

      //INSERT tabela filmes
      $sqlInsertFilmes = "INSERT INTO filmes (VALOR_OBRA, PRODUTORA_FILME, DISTRIBUIDORA_FILME, C_IND_FILME, DURACAO, ELENCO, obra_ID_OBRA, obra_perfil_ID_PERFIL, obra_perfil_usuario_ID_USUARIO) 
                          VALUES (2, '$produtora', '$distrib', '$classif', '$duracao', '$elenco', $id_obra, $idUsuario, $idUsuario)";
      
      if (!mysqli_query($con, $sqlSelectFilmes)){
          echo "<script>alert('Erro ao cadastrar obra. Tente novamente.');</script>";  
      } else if (!mysqli_query($con,$sqlInsertFilmes)) {
          echo "<script>alert('Erro ao cadastrar filme. Tente novamente.');</script>";
      } else {
          echo "";
      }  
          } 
  }
?>

<?php 
    function cadastroSerie(){
    include "conexao.php";

    mysqli_query($con, "SET NAMES 'utf8'");
    mysqli_query($con, 'SET character_set_connection=utf8');
    mysqli_query($con, 'SET character_set_client=utf8');
    mysqli_query($con, 'SET character_set_results=utf8');

      
      session_start();
      // Verifica se o usuário está logado
      if (!isset($_SESSION['ID_USUARIO'])) {
      header('Location: ../index.html');
      exit();
      }
    
      $idUsuario = $_SESSION['ID_USUARIO'];
      $nome = $_GET['nomeserie'];
      $diretor = $_GET['diretorserie'];
      $ano = $_GET['anoserie'];
      $elenco = $_GET['elencoserie'];
      $sinopse = $_GET['sinopseserie'];
      $temporadas = $_GET['tempserie'];
      $distrib = $_GET['distserie'];
      $produtora = $_GET['prodserie'];
      $classif = $_GET['classifserie'];
      $foto = $_GET['fotoserie'];
    
      $sql= "INSERT INTO obra (VALOR_OBRA, DESC_OBRA, NOME_OBRA, FOTO_OBRA, AU_DI_OBRA, ANO_OBRA, perfil_ID_PERFIL, perfil_usuario_ID_USUARIO) 
             VALUES (1, '$sinopse','$nome','$foto','$diretor','$ano',$idUsuario, $idUsuario)";
    
      if (!mysqli_query($con,$sql)) {
          echo "<script>alert('Ocorreu um erro. Tente novamente mais tarde.');</script>";
          echo "Erro na inserção: " . mysqli_error($con);
      } else {
          $id_obra = mysqli_insert_id($con);
    
          //INNER JOIN
          $sqlSelectSeries = "SELECT * FROM obra INNER JOIN series ON obra.ID_OBRA = series.obra_ID_OBRA WHERE obra.ID_OBRA = $id_obra";

          //INSERT tabela series
          $sqlInsertSeries = "INSERT INTO series (obra_ID_OBRA, obra_perfil_ID_PERFIL, obra_perfil_usuario_ID_USUARIO, VALOR_OBRA, PRODUTORA_SERIE, DISTRIBUIDORA_SERIE, TEMPORADAS_SERIE, C_IND_SERIE, ELENCO_SERIE) 
                              VALUES ($id_obra, $idUsuario, $idUsuario, 1, '$produtora', '$distrib', '$temporadas', '$classif', '$elenco')";

          if (!mysqli_query($con, $sqlSelectSeries)) {
              echo "<script>alert('Erro ao cadastrar obra. Tente novamente.');</script>";
          } else if (!mysqli_query($con, $sqlInsertSeries)){
              echo "<script>alert('Erro ao cadastrar série. Tente novamente.');</script>";
          } else {
          echo ""; 
              } 
      }
    }
?> 

<?php 
        function cadastroNovela(){
          include "conexao.php";
          
          mysqli_query($con, "SET NAMES 'utf8'");
          mysqli_query($con, 'SET character_set_connection=utf8');
          mysqli_query($con, 'SET character_set_client=utf8');
          mysqli_query($con, 'SET character_set_results=utf8');

          
          session_start();
          // Verifica se o usuário está logado
          if (!isset($_SESSION['ID_USUARIO'])) {
          header('Location: ../index.html');
          exit();
          }
        
          $idUsuario = $_SESSION['ID_USUARIO'];
          $nome = $_GET['nomenovela'];
          $diretor = $_GET['diretornovela'];
          $ano = $_GET['anonovela'];
          $elenco = $_GET['elenconovela'];
          $sinopse = $_GET['sinopsenovela'];
          $emissora = $_GET['emissora'];
          $episodios = $_GET['epsnovela'];
          $classif = $_GET['classifnovela'];
          $foto = $_GET['fotonovela'];
        
          $sql= "INSERT INTO obra (VALOR_OBRA, DESC_OBRA, NOME_OBRA, FOTO_OBRA, AU_DI_OBRA, ANO_OBRA, perfil_ID_PERFIL, perfil_usuario_ID_USUARIO) 
                 VALUES (3, '$sinopse','$nome','$foto','$diretor','$ano',$idUsuario, $idUsuario)";

          if (!mysqli_query($con,$sql)) {
              echo "<script>alert('Ocorreu um erro. Tente novamente mais tarde.');</script>";

          } else {
          $id_obra = mysqli_insert_id($con);

          //INNER JOIN
          $sqlSelectNovelas = "SELECT * FROM obra INNER JOIN novelas ON obra.ID_OBRA = novelas.obra_ID_OBRA WHERE obra.ID_OBRA = $id_obra";

          //INSERT tabela filmes
          $sqlInsertNovelas = "INSERT INTO novelas (obra_ID_OBRA, obra_perfil_ID_PERFIL, obra_perfil_usuario_ID_USUARIO, VALOR_OBRA, EMISSORA_NOVELA, EPISODIOS_NOVELA, ELENCO_NOVELA, C_IND_NOVELA) 
                               VALUES ($id_obra, $idUsuario, $idUsuario, 3, '$emissora', '$episodios', '$elenco', '$classif')";

          if (!mysqli_query($con, $sqlSelectNovelas)){
              echo "<script>alert('Erro ao cadastrar obra. Tente novamente.');</script>";
          } else if (!mysqli_query($con, $sqlInsertNovelas)){
              echo "<script>alert('Erro ao cadastrar novela. Tente novamente.');</script>";
          } else {
              echo "";

          }
  }    

      
  }
?>