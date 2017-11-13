<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="es-ES"><![endif]-->
<!--[if IE 7 ]>   <html class="ie ie7" lang="es-ES"><![endif]-->
<!--[if IE 8 ]>   <html class="ie ie8" lang="es-ES"><![endif]-->
<!--[if IE 9 ]>   <html class="ie ie9" lang="es-ES"><![endif]-->
<!--[if gt IE 9]><!--><html lang="es-ES"><!--<![endif]-->
<head>
<base href="<?php echo base_url(); ?>" />
    <!--Metatags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--Titulo-->
    <title>Antesala | Bienvenido</title>
    <!--CSS-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/antesala.css">
    <link rel="stylesheet" href="css/tipografias.css">

    <!--menu-->
    <link rel="stylesheet" href="css/menu.css">

    <!--Slider-->
    <link rel="stylesheet" type="text/css" href="css/sliderPrincipal.css" />
    <link rel="stylesheet" type="text/css" href="css/sliderPersonalizado.css" />
    <script type="text/javascript" src="js/modernizr.custom.79639.js"></script>
    <noscript>
        <link rel="stylesheet" type="text/css" href="css/sliderNoJS.css" />
    </noscript>
    <!--FinSlider-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>


    <?php echo modules::run('header/header/index'); ?>

    <?php echo modules::run('slider/slider/index'); ?>

    <!--Modal Enviar-->
    <div class="portfolio-modal modal fade modalInicio" id="ModalSend" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content" style="background-color: rgba(235,168,51,0.9) !important;">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="modal-body">
                            <img src="img/logotipo2.png" class="img-responsive center-block logotipo2" alt="">
                            <img src="img/mensajeEnviado.png" class="img-responsive center-block imgEnviado" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Modal News-->
    <div class="portfolio-modal modal fade" id="newsletter" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content" style="background-color:#1F1F1F !important;">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr" style="background-color: #fff;">
                    <div class="rl" style="background-color: #fff;">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3">
                        <div class="modal-body">
                            <form name="sentMessage" id="contactForm" class="formContacto">

                                <div class="row control-group">
                                    <h1 id="titNews" class="titulares2 titulares" style="text-align: center !important;">¡Suscríbete a nuestro newsletter!</h1>
                                </div>
                                <div class="row control-group">
                                    <div class="form-group col-xs-12 floating-label-form-group">
                                        <input type="text" class="form-control" placeholder="Nombre Completo" id="nombre" style="text-align: left;">
                                        <p id="eNombre" hidden style="color:red;">Escriba su nombre</p>
                                    </div>

                                    <div class="form-group col-xs-12 floating-label-form-group">
                                        <input type="text" class="form-control" placeholder="Correo Electrónico" id="mail" style="text-align: left;">
                                        <p id="eCorreo" hidden style="color:red;">Escriba su correo</p>
                                    </div>


                                    <div class="form-group col-xs-12 col-md-6 col-md-offset-3">
                                    <a href="#"> <br>
                                        <button id="newsletterRes" type="submit" class="btn btn-success btn-enviar btn-lg">Enviar</button>
                                    </a>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <p class="text-center textoAgentes">Recibe información de tu interés</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--*******+++++++++++++js********************-->
    <!--Slider de Precios-->

    <script type="text/javascript" src="js/jquery.currency.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.10.2.custom.min.js"></script>
    <script type="text/javascript" src="js/sliderPrecios.js"></script>
    <!-- <script type="text/javascript" src="js/vistas/contacto.js"></script> -->
    <script type="text/javascript" src="js/vistas/newsletter.js"></script>
    <!--Fin Slider Precios-->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/personalizado.js"></script>

    <!--Funcion para slider -->
    <script type="text/javascript" src="js/jquery.ba-cond.min.js"></script>
        <script type="text/javascript" src="js/jquery.slitslider.js"></script>
        <script type="text/javascript">
            $(function() {

                var Page = (function() {

                    var $navArrows = $( '#nav-arrows' ),
                        $nav = $( '#nav-dots > span' ),
                        slitslider = $( '#slider' ).slitslider( {
                            onBeforeChange : function( slide, pos ) {

                                $nav.removeClass( 'nav-dot-current' );
                                $nav.eq( pos ).addClass( 'nav-dot-current' );

                            }
                        } ),

                        init = function() {

                            initEvents();

                        },
                        initEvents = function() {

                            // add navigation events
                            $navArrows.children( ':last' ).on( 'click', function() {

                                slitslider.next();
                                return false;

                            } );

                            $navArrows.children( ':first' ).on( 'click', function() {

                                slitslider.previous();
                                return false;

                            } );

                            $nav.each( function( i ) {

                                $( this ).on( 'click', function( event ) {

                                    var $dot = $( this );

                                    if( !slitslider.isActive() ) {

                                        $nav.removeClass( 'nav-dot-current' );
                                        $dot.addClass( 'nav-dot-current' );

                                    }

                                    slitslider.jump( i + 1 );
                                    return false;

                                } );

                            } );

                        };

                        return { init : init };

                })();

                Page.init();

                /**
                 * Notes:
                 *
                 * example how to add items:
                 */

                /*

                var $items  = $('<div class="sl-slide sl-slide-color-2" data-orientation="horizontal" data-slice1-rotation="-5" data-slice2-rotation="10" data-slice1-scale="2" data-slice2-scale="1"><div class="sl-slide-inner bg-1"><div class="sl-deco" data-icon="t"></div><h2>some text</h2><blockquote><p>bla bla</p><cite>Margi Clarke</cite></blockquote></div></div>');

                // call the plugin's add method
                ss.add($items);

                */

            });
        </script>
</body>
</html>


