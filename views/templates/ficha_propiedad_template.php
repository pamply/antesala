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
    <title>Antesala | Ficha Técnica</title>
    <!--CSS-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/antesala-contacto.css">
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

    <!--Slider de precios-->
    <link rel="stylesheet" href="css/jquery-ui-1.10.2.custom.min.css" type="text/css">
    <link rel="stylesheet" href="css/estiloSliderPrecios.css" type="text/css" id="color-variant-default">
    <style type="text/css">
        .ficha:focus {
            background-color: #fff!important;

        }
    </style>
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.css">
</head>
<body>
    
    <?php echo $contenido;?>


    <div class="footer">
        <div class="container">
            <div class="row">
                <footer>
                    <div class="col-md-3 pull-left espaciadoRedes">
                            <div class="enlacesRedesFooter">
                                <ul>
                                    <li><a href="https://www.facebook.com/Antesala-Inmobiliaria-1655079281375203/" target="blank"><i class="fa fa-facebook fa-lg redesSocialesFoo" aria-hidden="true"></i></a></li>
                                    <li><a href="https://www.instagram.com/antesalainmobiliaria/" target="blank"><i class="fa fa-instagram fa-lg redesSocialesFoo" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                    </div>

                    <div class="col-md-2 text-center">
                        <div class="RecuadrosFooterTecnica">
                                <a class="citaTxt" href="mailto:contacto@antesala.com?subject=Contáctanos">
                                    <i class="fa fa-envelope fa-3x" aria-hidden="true"></i>
                                </a>
                            </div>
                            <p class="textoFinalTecnicaCuadros">Envía a electrónico</p>
                        </div>

                    <div class="col-md-2 text-center">
                        <div class="RecuadrosFooterTecnica">
                                <a class="citaTxt" href="#" onclick="window.print();">
                                    <i class="fa fa-print fa-3x" aria-hidden="true"></i>
                                </a>
                            </div>
                            <p class="textoFinalTecnicaCuadros">Imprimir</p>
                        </div>

<!--                         <div class="col-md-5 text-center">
                            <div class="Agendacita">
                                <a class="citaTxt zoom" href="#contactoModal" data-toggle="modal">
                                    <h4>Agenda tu cita</h4>
                                </a>
                            </div>
                            <p class="textoFinalTecnicaCuadros">Nuestros agentes de venta lo atenderán</p>
                        </div> -->
                </footer>
            </div>
        </div>
    </div>

    <!--Modal Enviar-->
    <div class="portfolio-modal modal fade" id="contactoModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content" style="background-color:#1F1F1F !important;">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr" style="background-color: #fff;">
                    <div class="rl" style="background-color: #fff;">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <div id="contact-f-response" class="" style="display:none">
                                <div class="closef1" style="float: right;margin: 15px;">
                                    <a href="javascript:void(0);" onclick="close_alert()" id="closemsg-formx">
                                        <img src="img/cerrar_form.png" alt="Cerrar"/>
                                    </a>
                                </div>
                                <div id="contact-f-responsem" class="alert alert-success text-left">
                                    <!-- mensajes de error -->
                                </div>
                            </div>
                            <form name="sentMessage" id="cform" class="formContacto">
                                
                                <div class="row control-group">
                                    <h1 class="titulares2 titulares" style="text-align: center !important;">Agenda tu Cita</h1>
                                </div>
                                <div class="row control-group">
                                    <div class="form-group col-xs-5 floating-label-form-group">
                                        <input type="text" class="form-control" placeholder="Nombre" id="inputNombre" style="text-align: left;">
                                    </div>

                                    <div class="select-style col-xs-5 col-xs-offset-1">
                                        <input type="text" class="form-control" placeholder="Estado/Ciudad" id="ciudad" style="text-align: left;font-size: 1.3em;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-5 floating-label-form-group">
                                        <input type="text" class="form-control" placeholder="Correo Electrónico" id="inputEmail" style="text-align: left;">
                                    </div>

                                    <div class="form-group col-xs-5 col-xs-offset-1 floating-label-form-group">
                                        <input type="text" class="form-control" placeholder="Teléfono" id="inputTelefono" style="text-align: left;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-5 floating-label-form-group">
                                        <input type="text" class="form-control datepicker" placeholder="Fecha" id="inputFecha" style="text-align: left;">
                                    </div>

                                    <div class="form-group col-xs-5 col-xs-offset-1 floating-label-form-group">
                                        <input type="text" class="form-control timepicker" placeholder="Hora" id="inputHora" style="text-align: left;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-11 floating-label-form-group">
                                        <textarea rows="5" placeholder="Mensaje" id="inputMensaje" style="color: #fff;"></textarea>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-md-6 col-md-offset-3"> 
                                        <br>
                                        <input type="hidden" id="idPropiedad" value="<?php echo $propiedad->id; ?>"/>
                                            <input onclick="sendPropiedadContacto(this)" type="button" class="btn btn-success btn-enviar btn-lg ficha" value="Enviar" style="color: #2a2a2a;"></input>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <p class="text-center textoAgentes">Nuestros agentes de ventas lo atenderán</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="portfolio-modal modal fade" id="ModalSend" tabindex="-1" role="dialog" aria-hidden="true">
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

    <!--*******+++++++++++++js********************-->
    <!--Slider de Precios-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.currency.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.10.2.custom.min.js"></script>
    <script type="text/javascript" src="js/sliderPrecios.js"></script>
    <!--Fin Slider Precios-->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/moment.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>      
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
        <script src="js/vistas/propiedad.js"></script>
</body>
</html>
 
 
 