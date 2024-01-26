<!DOCTYPE html>
<html ng-app="shop" ng-cloak>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Orlando City</title>
    <link rel="stylesheet" href="../lib/bootstrap3/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="../lib/OwlCarousel3/dist/assets/owl.carousel.min.css">-->
    <link rel="stylesheet" href="https://cdn.es.gov.br/scripts/jquery/jquery-owl-carousel/2.0.0/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../lib/OwlCarousel3/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../lib/raty/lib/jquery.raty.css">
    <link rel="stylesheet" href="../css/orlando.css">
    <link rel="stylesheet" href="../css/orlando-mobile.css">
    <script src="../lib/angularjs/angular/angular.min.js"></script>
    

</head>
<!-- width device width largura automatica do dispositivo e initial-scale2 tamanho da fonte-->
<body>
    <header> <!--Cabeçalho-->
        
        <div id="menu-mobile-mask" class="visible-xs">

        </div>

        <div id="menu-mobile" class="visible-xs">

            <ul class="list-unstyled">   <!-- class="list-unstyled" serve para tirar as bolinhas de marcação do li -->
                
                <li><a href="videos.html"> Videos </a></li>
                <li><a href="#"> Tickets </a></li>
                <li><a href="#"> News </a></li>
                <li><a href="#"> Schedule </a> </li>
            </ul>
            <div class="bar-close">
                <button type="button" class="btn btn-close"> <i class="fa fa-close"> </i> </button>
            </div>
        </div>

        <div class="container container-logo">
            <img id="logotipo" src="../img/orlando-logo.png" alt="Logotipo">
            <!-- chamando a imagem e se ela não conseguir carregar usamos o alt-->
        </div>

        <div class="header-black"> <!-- Para deixar uma parte do cabeçalho preta e outra roxa-->
            <div class="container">
            
                <input type="search" id="input-search-mobile" class="visible-xs" placeholder="search...">
          
                <button id="btn-bars"  type= "button"> <i class="fa fa-bars"> </i> </button> <!--barrinha-->
                <button id="btn-search" type="button"> <i class="fa fa-search"> </i> </button> <!--busca-->

                <ul class="pull-right"> <!--Aqui para puxar tudo para direita-->
                    <li class="club-01"><a href="#"></a></li>
                    <li class="club-02"><a href="#"></a></li>
                    <li class="club-03"><a href="#"></a></li>
                    <li class="club-04"><a href="#"></a></li>
                    <li class="club-05"><a href="#"></a></li>
                    <li class="club-06"><a href="#"></a></li>
                    <li class="club-07"><a href="#"></a></li>
                    <li class="club-08"><a href="#"></a></li>
                    <li class="club-09"><a href="#"></a></li>
                    <li class="club-10"><a href="#"></a></li>
                    <li class="club-11"><a href="#"></a></li>
                    <li class="club-12"><a href="#"></a></li>
                    <li class="club-13"><a href="#"></a></li>
                    <li class="club-14"><a href="#"></a></li>
                    <li class="club-15"><a href="#"></a></li>
                    <li class="club-16"><a href="#"></a></li>
                    <li class="club-17"><a href="#"></a></li>
                    <li class="club-18"><a href="#"></a></li>
                    <li class="club-19"><a href="#"></a></li>
                    <li class="club-20"><a href="#"></a></li>
                    <li class="club-21"><a href="#"></a></li>
                    <li class="club-22"><a href="#"></a></li>

                </ul>

            </div>
        </div>
        <div class="container">
            <div class="row">
                <nav id="menu" class="pull-right">
                    <ul>
                        <li><a href="index.php"> Home </a></li>
                        <li><a href="videos.php"> Videos </a></li>
                        <li><a href="#"> Tickets </a></li>
                        <li><a href="#"> News </a></li>
                        <li><a href="#"> Schedule </a> </li>
                        <li class="search">
                            <div class="input-group">
                                <input type="search" placeholder="search..." id="input-search">
                                <span class="input-group-btn">
                                    <button type="button"><i class="fa fa-search"></i></button>
                                </span>
                            </div><!-- /input-group -->
                        </li>
                    </ul>
                </nav>
            </div>
        </div>


    </header>