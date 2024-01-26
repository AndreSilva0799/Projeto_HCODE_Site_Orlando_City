if (typeof jQuery === 'undefined') {
    console.error('jQuery não está carregado. Verifique a ordem dos scripts.');
} else {
    $(document).ready(function () {
        $("#logotipo").on("mouseover", function () {
            $("#banner h1").addClass("efeito");
        }).on("mouseout", function () {
            $("#banner h1").removeClass("efeito");
        });

        $("#input-search").on("focus", function () {
            $("li.search").addClass("ativo");
        }).on("blur", function () {
            $("li.search").removeClass("ativo");
        });

        
        $(".thumbnails").owlCarousel({
            loop: true,
            margin: 10,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 4
                },
                1000: {
                    items: 4
                }
            }
        });

        var owl = $(".thumbnails").data('owlCarousel');
        $('#btn-news-prev').on("click", function () {
            owl.prev();
        });

        $('#btn-news-next').on("click", function () {
            owl.next();
        });

        $("#page-up").on("click", function (event) {
            $("body").animate({
                scrollTop: 0
            }, 1000);
            event.preventDefault();
        });

        $("#btn-bars").on("click", function () {
            $("header").toggleClass("open-menu");
        });

        $("#menu-mobile-mask, .btn-close").on("click", function () {
            $("header").removeClass("open-menu");
        });

        $("#btn-search").on("click", function () {
            $("header").toggleClass("open-search");
            $("#input-search-mobile").focus();
        });
    });

    var initEstrelas =function(){
        $('.estrelas').each(function (){

        $(this).raty({
            starHalf: '../lib/raty/lib/images/star-half.png',
            starOff: '../lib/raty/lib/images/star-off.png',
            starOn: '../lib/raty/lib/images/star-on.png',
            score: parseFloat($(this).data("score"))
        });
    });
};

    angular.module("shop", []).controller("destaque-controller", function ($scope, $http) {

        $scope.produtos = [];
        $scope.buscados = [];

var initCarousel = function(){
    $("#destaque-produtos").owlCarousel({
        autoplay: 3000,
        items: 1,
        singleItem: true
    });

    $("#mais-buscados").owlCarousel({
        autoplay: 3000,
        items: 1,
        singleItem: true
    });

    var owlDestaque = $("#destaque-produtos").data('owlCarousel');
    $('#btn-destaque-prev').on("click", function () {
        owlDestaque.prev();
    });
    $('#btn-destaque-next').on("click", function () {
        owlDestaque.next();
    });

  

}

 var initEstrelas =function(){
        $('.estrelas').each(function (){

        $(this).raty({
            starHalf: '../lib/raty/lib/images/star-half.png',
            starOff: '../lib/raty/lib/images/star-off.png',
            starOn: '../lib/raty/lib/images/star-on.png',
            score: parseFloat($(this).data("score"))
        });
    });
};

        $http({
            method: 'GET',
            url: '../produtos'
        }).then(function successCallback(response) {

            $scope.produtos = response.data;

            setTimeout(initCarousel,100);
            console.log(response.data);
        }, function errorCallback(response) {
            console.error('Erro na requisição HTTP', response);
        });

        $http({
            method: 'GET',
            url: '../produtos-mais-buscados'
        }).then(function successCallback(response) {

            $scope.buscados = response.data;
            

            setTimeout(initEstrelas,100);
            setTimeout(initCarousel,100);
            console.log(response.data);
        }, function errorCallback(response) {
            console.error('Erro na requisição HTTP', response);
        });
    });


    
    

}