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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- CSS -->
        <link rel="stylesheet" href="css/style.css">


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
                         <a class="nav-link" href="./citacoes/citacoes.php">Citações</a>
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



function gereRodape(){
  echo '
  <head>
     
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/> 
  </head>
  <style>
      body {
          position: relative;
          min-height: 100vh;
          margin: 0;
          padding: 0;
      }

      .site-footer {
          width: 100%;
          background-color: #26272b;
          padding: 50px 50px;
          font-size: 15px;
          line-height: 20px;
          color: #fff;

      }

      .site-footer hr {
          border-top-color: #bbb;
          opacity: 0.3;
          margin-top: 20px;
          margin-bottom: 20px;
      }

      .site-footer h6 {
          font-size: 18px;
          text-transform: uppercase;
          margin-top: 10px;
          margin-bottom: 20px;
          letter-spacing: 2px;
          color: #29aafe;
      }

      .site-footer p.text-justify {
          text-align: justify;
          margin-bottom: 20px;
      }

      .footer-links {
          padding-left: 0;
          list-style: none;
      }

      .footer-links li {
          display: block;
      }

      .footer-links a {
          color: #737373;
      }

      .footer-links a:active,
      .footer-links a:focus,
      .footer-links a:hover {
          color: #3366cc;
          text-decoration: none;
      }

      .social-icons li {
          display: inline-block;
          
      }
      .social-icons {
        text-align: right; /* Isso alinha os ícones mais para a esquerda */
       
        
    }

      .social-icons a {
        background-color: #696969; /* Cor de fundo cinza */
          color: #fff;
        //   text-align: center;
          font-size: 16px;
          display: inline-block;
          line-height: 44px;
          width: 44px;
          height: 44px;
          border-radius: 50%;
          -webkit-transition: all 0.2s linear;
          -o-transition: all 0.2s linear;
          transition: all 0.2s linear;
      }



      @media (max-width: 767px) {
          .site-footer {
              padding-bottom: 0;
          }
          .site-footer .copyright-text,
          .site-footer .social-icons {
              text-align: center;
          }

      }
      .text-justify {
          text-align: justify;
      }
  </style>

  <footer class="site-footer">
      <div class="container">
          <div class="row">
              <div class="col-md-6 ">
                  <h6>Quem Somos?</h6>
                  <p class="text-justify">Somos uma rede social destinada para apreciadores de livros, filmes, séries e novelas; com o objetivo de enaltecer nossas produções nacionais.</p>
              </div>
              <div class="col-md-6 col-md-3"></div>
              <div class="col-md-3 ">
                  <h6>Links</h6>
                  <ul class="footer-links">
                      <li><a href="./termos_qs/quem_somos.php">Sobre Nós</a></li>
                      <li><a href="./termos_qs/termos_de_Uso.php">Termos de Uso</a></li>
                      <li><a href="https://mail.google.com/mail/?view=cm&fs=1&to=liverbrasil@gmail.com">Fale Conosco</a></li>
                  </ul>
              </div>
          </div>
          <hr>
      </div>
      <div class="container">
          <div class="row">
              <div class="col-md-3">
                  <p class="copyright-text">Copyright &copy; 2023</p>
              </div>
              <div class=" col-sm-7 ">
                  <ul class="social-icons">
                      <li><a class="instagram" href="https://www.instagram.com/liverbr_/"><i class="fa fa-instagram"></i></a></li>
                      <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                  </ul>
              </div>
          </div>
      </div>
  </footer>';
    
}
function Rodape() {
  
  echo '
  <head>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/> 
  </head>
  <style>

  body {
      position: relative;
      min-height: 100vh;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
  }

  .site-footer {
      margin-top: 15%;
      position: relative;
      width: 103%;
      background-color: #26272b;
      padding: 50px 100px;
      font-size: 15px;
      line-height: 25px;
      color: #fff;
      
  }

  .site-footer hr {
      border-top-color: #bbb;
      opacity: 0.3;
      margin-top: 20px;
      margin-bottom: 20px;
  }

  .site-footer h6 {
      font-size: 18px;
      text-transform: uppercase;
      margin-top: 10px;
      margin-bottom: 10px; /* Reduzindo o espaçamento aqui */
      letter-spacing: 2px;
      color: #29aafe;
  }

  .site-footer p.text-justify {
      text-align: justify;
      text-decoration: none; /* Remove a decoração de link */

  }
  
  .footer-links {
    list-style: none; /* Remove os marcadores de lista */
    padding: 0; /* Remova qualquer padding padrão */
}

.footer-links li {
    margin-left: 0; /* Remove qualquer recuo (indentação) padrão */
}

.footer-links a {
    color: #4f4f4f; /* Cor padrão para os links */
    text-decoration: none; /* Remove a decoração de link (sublinhado) */
}

.footer-links a:hover {
    color: #4747eb; /* Define a cor azul quando o mouse está em cima */
}


  .footer-links a:active,
  .footer-links a:focus,
  .footer-links a:hover {
      color: #3366cc;
      text-decoration: none;

  }
  .social-icons {
    text-align: right; /* Isso alinha os ícones mais para a esquerda */
   
}

  .social-icons li {
      display: inline-block;
      text-decoration: none; /* Remove a decoração de link */
      margin-right: 10px;
     
  }
  .social-icons a {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 40px; /* Ajuste o tamanho do círculo conforme necessário */
    height: 40px; /* Ajuste o tamanho do círculo conforme necessário */
    border-radius: 50%; /* Faz com que o elemento seja um círculo */
    background-color: #3f3f3f; /* Cor de fundo cinza */
    text-decoration: none; /* Remove a decoração de link */
}
.social-icons a i {
    font-size: 16px; /* Ajuste o tamanho do ícone conforme necessário */
    color: #FFF; /* Cor do ícone */
    text-decoration: none; /* Remove a decoração de link */
}


  .social-icons a:active,
  .social-icons a:focus,
  .social-icons a:hover {
      color: #fff;
      background-color: #337ab7;
  }

  @media (max-width: 767px) {
      .site-footer {
          padding-bottom: 0;
      }
      .site-footer .copyright-text,
      .site-footer .social-icons {
          text-align: center;
      }
      .social-icons {
          text-align: center;
      }
  }

  .text-justify {
      text-align: justify;
  }

</style>

      <footer class="site-footer">
          <div class="col-md-6">
              <h6>Quem Somos?</h6>
              <p class="text-justify">Somos uma rede social destinada para apreciadores de livros, filmes, séries e novelas; com o objetivo de enaltecer nossas produções nacionais.</p>
          </div>
          <div class="col-md-8">
              <h6>Quick Links</h6>
              <ul class="footer-links">
              <li><a href="../termos_qs/quem_somos.php">Sobre Nós</a></li>
              <li><a href="../termos_qs/termos_de_Uso.php">Termos de Uso</a></li>
              <li><a href="https://mail.google.com/mail/?view=cm&fs=1&to=liverbrasil@gmail.com">Fale Conosco</a></li>
              </ul>
          </div>
          <hr>
          <div class="row">
          <div class="col-md-8">
              <p class="copyright-text">Copyright &copy; 2023</p>
          </div>
          <div class="col-md-3">
              <ul class="social-icons">
                  <li><a class="instagram" href="https://www.instagram.com/liverbr_/"><i class="fa fa-instagram"></i></a></li>
                  <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
              </ul>
          </div>
      </div>
      </footer>';
}



function catRodape() {
  
    echo '
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/> 
    </head>
    <style>
  
    body {
        position: relative;
        min-height: 100vh;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }
  
    .site-footer {
        margin-top: 15%;
        position: relative;
        width: 101%;
        background-color: #26272b;
        padding: 50px 100px;
        font-size: 15px;
        line-height: 25px;
        color: #fff;
        
    }
  
    .site-footer hr {
        border-top-color: #bbb;
        opacity: 0.3;
        margin-top: 20px;
        margin-bottom: 20px;
    }
  
    .site-footer h6 {
        font-size: 18px;
        text-transform: uppercase;
        margin-top: 10px;
        margin-bottom: 10px; /* Reduzindo o espaçamento aqui */
        letter-spacing: 2px;
        color: #29aafe;
    }
  
    .site-footer p.text-justify {
        text-align: justify;
        text-decoration: none; /* Remove a decoração de link */
  
    }
    .footer-links {
        list-style: none; /* Remove os marcadores de lista */
        padding: 0; /* Remova qualquer padding padrão */
    }
    
    .footer-links li {
        margin-left: 0; /* Remove qualquer recuo (indentação) padrão */
    }
    
    .footer-links a {
        color: #4f4f4f; /* Cor padrão para os links */
        text-decoration: none; /* Remove a decoração de link (sublinhado) */
    }
    
    .footer-links a:hover {
        color: #4747eb; /* Define a cor azul quando o mouse está em cima */
    }
    .footer-links a:active,
    .footer-links a:focus,
    .footer-links a:hover {
        color: #3366cc;
        text-decoration: none;
  
    }
    .social-icons {
      text-align: right; /* Isso alinha os ícones mais para a direita */
      margin-top: -40px;
  }
  
    .social-icons li {
        display: inline-block;
        text-decoration: none; /* Remove a decoração de link */
        margin-right: 10px;
       
    }
    .social-icons a {
      display: inline-flex;
      justify-content: center;
      align-items: center;
      width: 40px; /* Ajuste o tamanho do círculo conforme necessário */
      height: 40px; /* Ajuste o tamanho do círculo conforme necessário */
      border-radius: 50%; /* Faz com que o elemento seja um círculo */
      background-color: #3f3f3f; /* Cor de fundo cinza */
      text-decoration: none; /* Remove a decoração de link */
  }
  .social-icons a i {
      font-size: 16px; /* Ajuste o tamanho do ícone conforme necessário */
      color: #FFF; /* Cor do ícone */
      text-decoration: none; /* Remove a decoração de link */
  }
  
  
    .social-icons a:active,
    .social-icons a:focus,
    .social-icons a:hover {
        color: #fff;
        background-color: #337ab7;
    }
  
    @media (max-width: 767px) {
        .site-footer {
            padding-bottom: 0;
        }
        .site-footer .copyright-text,
        .site-footer .social-icons {
            text-align: center;
        }

    }
  
    .text-justify {
        text-align: justify;
    }
  
  </style>
  
        <footer class="site-footer">
            <div class="col-md-6">
                <h6>Quem Somos?</h6>
                <p class="text-justify">Somos uma rede social destinada para apreciadores de livros, filmes, séries e novelas; com o objetivo de enaltecer nossas produções nacionais.</p>
            </div>
            <div class="col-md-8">
                <h6>Quick Links</h6>
                <ul class="footer-links">
                      <li><a href="../termos_qs/quem_somos.php">Sobre Nós</a></li>
                      <li><a href="../termos_qs/termos_de_Uso.php">Termos de Uso</a></li>
                      <li><a href="https://mail.google.com/mail/?view=cm&fs=1&to=liverbrasil@gmail.com">Fale Conosco</a></li>
                </ul>
            </div>
            <hr>
            <div class="col-md-8">
                <p class="copyright-text">Copyright &copy; 2023</p>
            </div>
            <div class="col-md-11">
                <ul class="social-icons">
                    <li><a class="instagram" href="https://www.instagram.com/liverbr_/"><i class="fa fa-instagram"></i></a></li>
                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                </ul>
            </div>

        </footer>';
  }
?>




