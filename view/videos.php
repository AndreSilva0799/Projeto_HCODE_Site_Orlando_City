<?php include_once("header.php"); ?>

<link rel="stylesheet" href="../lib/plyr/dist/plyr.css">
    <section>
        <div id="call-to-action">

            <div class="container">

                <div class="row text-center">
                    <h2>Videos</h2>
                    <hr>
                </div>

                <div class="row">
                    <video src="../mp4/highlights.mp4" autoplay controls poster="../img/highlights.jpg">
                        <track kind="captions" label="Português (Brasil)" src="../vtt/legendas.vtt" srclang="pt-br" default>
                    </video> <!-- autoplay para startar o video automaticamente e o controls para aparecer os botões de controle do video
                    poster para mostrar uma imagem especifica de capa do video   <Track para colocar a LEGENDA do VIDEO-->
                    <!--<input type="range" id="volume" min="0" max="1" step="0.01" value="1">
                    <button type="buttom" id="btn-play-pause" class="btn btn-success"> Play </button> -->
                    <!-- <audio src="mp3/audio.mp3" controls></audio> Dessa forma eu poderia reproduzir um audio -->
                </div>
            </div>
        </div>

        <div id="news" class="container" style="top:0">

            <div class="row text-center">
                <h2>Latest News</h2>
                <hr>
            </div>

            <div class="row thumbnails owl-carousel owl-theme">
                <div class="item" data-video="highlights">
                    <div class="item-inner">
                        <img src="../img/highlights.jpg" alt="Noticia"> <!--chamando o arquivo da imagem-->
                        <h3>Highlights</h3>
                    </div>
                </div>
                <div class="item" data-video="Orlando_City_Foundation_2015">
                    <div class="item-inner">
                        <img src="../img/Orlando_City_Foundation_2015.jpg" alt="Noticia"> <!--chamando o arquivo da imagem-->
                        <h3>Orlando City Foundation 2015</h3>
                    </div>
                </div>
                <div class="item" data-video="highlights">
                    <div class="item-inner">
                        <img src="../img/highlights.jpg" alt="Noticia"> <!--chamando o arquivo da imagem-->
                        <h3>Highlights</h3>
                    </div>
                </div>
                <div class="item" data-video="Orlando_City_Foundation_2015">
                    <div class="item-inner">
                        <img src="../img/Orlando_City_Foundation_2015.jpg" alt="Noticia"> <!--chamando o arquivo da imagem-->
                        <h3>Orlando City Foundation 2015</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include_once("footer.php") ?>

  
    <script src="../lib/plyr/dist/plyr.js"></script>
    <script>
       $(function(){

        $(".thumbnails .item").on("click",function(){
            console.log($(this).data('video'));
            $("video").attr({
                "src":"../mp4/"+$(this).data('video')+".mp4",
                "poster":"../img/"+$(this).data('video')+".jpg"
            });
        });
        $("volume").on("mousemove",function(){
            $("video")[0].volume = parseFloat($(this).val)
        });
        $("#btn-play-pause").on("click",function(){
            
             var video = $("video")[0]
            if($(this).hasClass("btn-success")) {
                $(this).text("PAUSE");
                video.play();
            }else {
                $(this).text("PLAY");
                video.pause();
            }

            $(this).toggleClass("btn-success btn-danger"); /* aqui vai checar qual classe está,
             depois do click se tiver a success ele colaca a danger e vice - versa */
        })
       });
    </script>