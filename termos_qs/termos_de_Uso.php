<!DOCTYPE html>
<html>
<head>
     <!-- Configurações da página -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./IMG/logo2_liver.png" type="image/x-icon">
	<title>Termos de Uso | LiVer</title>
	 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="termos_qs.css">
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
<br><br><br>

<!-- Conteúdo da página -->

 <div class="frame-childd">
        <div class="pagetermo">


            <img class="image-1-icon" alt="" src="./IMG/image-1@2x.png">
 
  <!-- Informações sobre a plataforma -->
<h3>Termos de Uso</h3>
<div class="barra"></div>

<br>
<section>
<P>Esta política de Termos de Uso é válida a partir de Apr 2023
<br><br>
LiVer, pessoa jurídica de direito privado descreve, através deste documento, as regras de uso do site liver.com e qualquer outro site, loja ou aplicativo operado pelo proprietário. 
<br>
Ao navegar neste website, consideramos que você está de acordo com os Termos de Uso abaixo. 
<br>
Caso você não esteja de acordo com as condições deste contrato, pedimos que não faça mais uso deste website, muito menos cadastre-se ou envie os seus dados pessoais. 
<br>

Podemos alterar este documento a qualquer momento. Caso haja alteração significativa nos termos deste contrato, podemos informá-lo por meio das informações de contato que tivermos em nosso banco de dados ou por meio de notificações. 
<br>
A utilização deste website após as alterações significa que você aceitou os Termos de Uso revisados. Caso, após a leitura da versão revisada, você não esteja de acordo com seus termos, favor encerrar o seu acesso. 
<br>
<H5>● Seção 1 - Usuário</H5>
    <div class="barra"></div>


<br>
A utilização deste website atribui de forma automática a condição de Usuário e implica a plena aceitação de todas as diretrizes e condições incluídas nestes Termos. 
<BR><br>
<h5>● Seção 2 - Adesão em conjunto com a Política de Privacidade</h5>
<div class="barra"></div>

<br>
A utilização deste website acarreta a adesão aos presentes Termos de Uso e a versão mais atualizada da Política de Privacidade de LiVer. 
<BR><br>
<h5>● Seção 3 - Condições de acesso</h5>
<div class="barra"></div>

<br>
Em geral, o acesso ao website da LiVer possui caráter gratuito e não exige prévia inscrição ou registro.
Contudo, para usufruir de algumas funcionalidades, o usuário poderá precisar efetuar um cadastro, criando uma conta de usuário com login e senha próprios para acesso. 
<br>
É de total responsabilidade do usuário fornecer apenas informações corretas, autênticas, válidas, completas e atualizadas, bem como não divulgar o seu login e senha para terceiros.
<br>
Partes deste website oferecem ao usuário a opção de publicar comentários em determinadas áreas. LiVer não consente com a publicação de conteúdos que tenham natureza discriminatória, ofensiva ou ilícita, ou ainda infrinjam direitos de autor ou quaisquer outros direitos de terceiros. 
<br>
A publicação de quaisquer conteúdos pelo usuário deste website, incluindo mensagens e comentários, implica em licença não-exclusiva, irrevogável e irretratável, para sua utilização, reprodução e publicação pela LiVer no seu website, plataformas e aplicações de internet, ou ainda em outras plataformas, sem qualquer restrição ou limitação.
<BR><BR>
<H5>● Seção 4 - Cookies</H5>
<div class="barra"></div>

<br>
Informações sobre o seu uso neste website podem ser coletadas a partir de cookies. Cookies são informações armazenadas diretamente no computador que você está utilizando. Os cookies permitem a coleta de informações tais como o tipo de navegador, o tempo despendido no website, as páginas visitadas, as preferências de idioma, e outros dados de tráfego anônimos. Nós e nossos prestadores de serviços utilizamos informações para proteção de segurança, para facilitar a navegação, exibir informações de modo mais eficiente, e personalizar sua experiência ao utilizar este website, assim como para rastreamento online. Também coletamos informações estatísticas sobre o uso do website para aprimoramento contínuo do nosso design e funcionalidade, para entender como o website é utilizado e para auxiliá-lo a solucionar questões relevantes. 
<br>
Caso não deseje que suas informações sejam coletadas por meio de cookies, há um procedimento simples na maior parte dos navegadores que permite que os cookies sejam automaticamente rejeitados, ou oferece a opção de aceitar ou rejeitar a transferência de um cookie (ou cookies) específico(s) de um site determinado para o seu computador. Entretanto, isso pode gerar inconvenientes no uso do website. 
<BR>
As definições que escolher podem afetar a sua experiência de navegação e o funcionamento que exige a utilização de cookies. Neste sentido, rejeitamos qualquer responsabilidade pelas consequências resultantes do funcionamento limitado deste website provocado pela desativação de cookies no seu dispositivo (incapacidade de definir ou ler um cookie). 
<BR><BR>
<H5>● Seção 5 - Propriedade Intelectual</H5>
<div class="barra"></div>

<br>
Todos os elementos de LiVer são de propriedade intelectual da mesma ou de seus licenciados. Estes Termos ou a utilização do website não concede a você qualquer licença ou direito de uso dos direitos de propriedade intelectual da LiVer ou de terceiros. 
<BR><br>
<h5>● Seção 6 - Links para sites de terceiros</H5>
    <div class="barra"></div>

<br>
Este website poderá, de tempos a tempos, conter links de hipertexto que redirecionará você para sites das redes dos nossos parceiros, anunciantes, fornecedores etc. Se você clicar em um desses links para qualquer um desses sites, lembre-se que cada site possui as suas próprias práticas de privacidade e que não somos responsáveis por essas políticas. Consulte as referidas políticas antes de enviar quaisquer  Dados  Pessoais para esses sites. 
<BR>
Não nos responsabilizamos pelas políticas e práticas de coleta, uso e divulgação (incluindo práticas de proteção de dados) de outras organizações, tais como Facebook, Apple, Google, Microsoft, ou de qualquer outro desenvolvedor de software ou provedor de aplicativo, loja de mídia social, sistema operacional, prestador de serviços de internet sem fio ou fabricante de dispositivos, incluindo todos os Dados Pessoais que divulgar para outras organizações por meio dos aplicativos, relacionadas a tais aplicativos, ou publicadas em nossas páginas em mídias sociais. Nós recomendamos que você se informe sobre a política de privacidade e termos de uso de cada site 
visitado ou de cada prestador de serviço utilizado. 
<BR><BR>
<h5>● Seção 7 - Prazos e alterações</H5>
    <div class="barra"></div>


<BR>
O funcionamento deste website se dá por prazo indeterminado. 
O website no todo ou em cada uma das suas seções, pode ser encerrado, suspenso ou interrompido unilateralmente por LiVer, a qualquer momento e sem necessidade de prévio aviso. 
<BR><br>
<h5>● Seção 8 - Dados pessoais</H5>
    <div class="barra"></div>

<BR>
Durante a utilização deste website, certos dados pessoais serão coletados e tratados por LiVer e ou pelos Parceiros. As regras relacionadas ao tratamento de dados pessoais de LiVer estão estipuladas na Política de Privacidade. 
<BR><br>
<h5>● Seção 9 - Contato</H5>
    <div class="barra"></div>

   <div class="dev-section">
<br>
Caso você tenha qualquer dúvida sobre os Termos de Uso, por favor, entre em contato pelo e-mail   
<br><a href="mailto:liverbrasil1@gmail.com "style="text-decoration: none; color: white;"> <i class="fas fa-envelope"></i>liverbrasil1@gmail.com </a>
<br><br>
        </div>
   </div>
    </div>
</body>
</html>