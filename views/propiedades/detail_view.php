<?php
$uri = $this->uri->segment(4);
 $validar = explode("-",$uri);
if ($validar[0] == 'ubicacion'){
    $link = "propiedades/index/$uri";
}else { $link = "propiedades/index/$tipo_propiedad"; }

?>
    <section class="fichaTecnica">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <a href="<?php echo $link; ?>"><img src="img/icons/regresar.png" class="img-responsive center-block regresarICO" alt=""></a>
                    </div>
                    <div class="col-md-6">
                        <a href="inicio"><img src="img/logotipo.png" class="img-responsive center-block logotipoNavegador3 zoom" alt="Antesala Logotipo"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    if ($fotos_propiedad != ''){
    ?>

    <!--Slider Tecnica-->
    <section>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php
            $i = 0;
            foreach ($fotos_propiedad->result() as $fp){
                if ($fp->foto != ''){
                    $i++;
            ?>
            <div class="item <?php echo ($i==1)?'active':''; ?>">
                <img src="uploads/propiedad/fotos_propiedad/<?php echo $fp->foto; ?>" class="img-responsive fullWidth" alt="...">
            </div>
            <?php
                }
            }
            ?>
        </div>

            <!-- Controles -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div> <!-- Carousel -->
    </section>
    <?php } ?>


 <?php
if ($propiedades != ''){
    $p = $propiedades->row();
 ?>
    <section class="DatosFicha">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-xs-12">
                    <h2 class="titularFicha" style="padding-top: 2px;"><?php echo $p->titulo; ?></h2>
                    <h4 class="subtitularFicha"><?php echo $p->direccion; ?></h4>
                    <div class="descripcionFinalFicha">
                        <p class="descripcionFichaTecnica">
                            <?php echo $p->descripcion_larga; ?>
                            <!--Now Has its own bathroom in a beachy indoor/outdoor settings. The very large open air <br>
                            shower has a view of the Pacific Ocean & Coronado Islands. Surfing - Private Beache  <br>
                            Jet Ski Access. <br> <br>
                            Totally seoarate from main home. -->
                        </p>
                    </div>
                </div>
            </div>

            <!--Casa-->
            <?php
                if($p->banos != 'Ninguno' && $p->cuartos!='Ninguno'){
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="contenedorElementos espaciadoFicha"></div>
                </div>

                <div class="col-md-3 col-xs-12">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="spanEstilo"><?php echo ($tipo_propiedad == 3)?'Departamento':'La casa'; ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-3 col-xs-12">
                            <span style="color: #fff;">Baños:</span> <span class="spanEstilo" style="color: #fff;"><?php echo $p->banos; ?></span>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <span style="color: #fff;">Dormitorios:</span> <span class="spanEstilo" style="color: #fff;"><?php echo $p->cuartos; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

            <!--Servicios-->
            <div class="row">
                <div class="col-md-12">
                    <div class="contenedorElementos espaciadoFicha"></div>
                </div>
            </div>
            <?php if (!is_numeric($servicios)){ ?>
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="spanEstilo">Servicios</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <?php
                        foreach ($servicios->result() as $sv) {
                        ?>
                        <div class="col-md-4">
                            <span style="color: #fff;"><?php echo $sv->titulo; ?></span>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
                        <div class="row">
                <div class="col-md-12">
                    <div class="contenedorElementos espaciadoFicha"></div>
                </div>
            </div>
            <?php } ?>

            <!--Seguridad-->

            <?php if (!is_numeric($seguridad)){ ?>
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="spanEstilo">Seguridad</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <?php
                        foreach ($seguridad->result() as $sg) {
                        ?>
                        <div class="col-md-4">
                            <span style="color: #fff;"><?php echo $sg->titulo; ?></span>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
                        <div class="row">
                <div class="col-md-12">
                    <div class="contenedorElementos espaciadoFicha"></div>
                </div>
            </div>
            <?php } ?>


            <!--<div class="row">
                <div class="col-md-12">
                    <div class="contenedorElementos espaciadoFicha"></div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <span class="spanEstilo">Seguridad</span>
                </div>
                <div class="col-md-3 col-xs-12">
                    <ul class="ListaFichaTecnica">
                        <li><span>24/7</span></li>
                        <li><span>24/7</span></li>
                    </ul>
                </div>
                <div class="col-md-3 col-xs-12">
                    <ul class="ListaFichaTecnica">
                        <li><span>Barda Perimetral</span></li>
                        <li><span>Barda Perimetral</span></li>
                    </ul>
                </div>
                <div class="col-md-3 col-xs-12">
                    <ul class="ListaFichaTecnica">
                        <li><span>Cámaras de vigilancia</span></li>
                        <li><span>Cámaras de vigilancia</span></li>
                    </ul>
                </div>
            </div>-->




            <!--Amenidades-->

            <?php if (!is_numeric($amenidades)){ ?>
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="spanEstilo">Amenidades</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <?php
                        foreach ($amenidades->result() as $a) {
                        ?>
                        <div class="col-md-4">
                            <span style="color: #fff;"><?php echo $a->titulo; ?></span>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
                                    <div class="row">
                <div class="col-md-12">
                    <div class="contenedorElementos espaciadoFicha"></div>
                </div>
            </div>
            <?php } ?>


            <!--<div class="row">
                <div class="col-md-12">
                    <div class="contenedorElementos espaciadoFicha"></div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <span class="spanEstilo">Amenidades</span>
                </div>
                <div class="col-md-3 col-xs-12">
                    <ul class="ListaFichaTecnica">
                        <li><span>Parques</span></li>
                        <li><span>Parques</span></li>
                    </ul>
                </div>
                <div class="col-md-3 col-xs-12">
                    <ul class="ListaFichaTecnica">
                        <li><span>Campo de golf</span></li>
                        <li><span>Campo de golf</span></li>
                    </ul>
                </div>
            </div>-->




            <!--Precio-->
            <div class="row">
<!--                 <div class="col-md-12">
                    <div class="contenedorElementos espaciadoFicha"></div>
                </div> -->
                <div class="col-md-3 col-xs-12">
                    <span class="spanEstilo">Precio</span>
                </div>
                <div class="col-md-3 col-xs-12 col-xs-12">
                    <div class="recuadroPrecio">
                        <?php if($p->mostrar_dolar!=0){ ?>
                            <span class="precioColor" style="color: #fff;"><?php echo number_format($p->precio_dolar,2) ?> USD</span>
                        <?php }else{ ?>
                            <span class="precioColor" style="color: #fff;"><?php echo number_format($p->precio,2) ?> MX</span>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-5 text-center">
                    <div class="Agendacita" style="margin-top: 0; min-height: 61px;">
                        <a class="citaTxt zoom" href="#contactoModal" data-toggle="modal">
                            <h4>Agenda tu cita</h4>
                        </a>
                    </div>
                    <p class="textoFinalTecnicaCuadros">Nuestros agentes de venta lo atenderán</p>
                </div>

                <div class="col-md-12">
                    <div class="contenedorElementos espaciadoFicha eliminarResponsive"></div>
                </div>
            </div>

        </div>
    </section>

    <section class="GoogleMaps">
        <!-- Map Section -->
        <div id="map"></div>
    </section>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBb6n9mrCEZkOvPvzQG7Uc0Ow6aXBEYOt4"></script>
    <script>
    //----Api Navegantes----
    //AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA


        // Google Maps Scripts
        var map = null;
        // When the window has finished loading create our google map below
        google.maps.event.addDomListener(window, 'load', init);
        google.maps.event.addDomListener(window, 'resize', function() {
            map.setCenter(new google.maps.LatLng(<?php echo $p->latitud; ?>, <?php echo $p->longitud; ?>));
        });

        function init() {
            // Basic options for a simple Google Map
            // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            var mapOptions = {
                // How zoomed in you want the map to start at (always required)
                zoom: <?php echo $p->zoom; ?>,

                // The latitude and longitude to center the map (always required)
                center: new google.maps.LatLng(<?php echo $p->latitud; ?>, <?php echo $p->longitud; ?>), //

                // Disables the default Google Maps UI components
                disableDefaultUI: false,
                scrollwheel: false,
                draggable: false,

                // How you would like to style the map.
                // This is where you would paste any style found on Snazzy Maps.
                styles: [{
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#000000"
                    }, {
                        "lightness": 17
                    }]
                }, {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#000000"
                    }, {
                        "lightness": 20
                    }]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#000000"
                    }, {
                        "lightness": 17
                    }]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "color": "#000000"
                    }, {
                        "lightness": 29
                    }, {
                        "weight": 0.2
                    }]
                }, {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#000000"
                    }, {
                        "lightness": 18
                    }]
                }, {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#000000"
                    }, {
                        "lightness": 16
                    }]
                }, {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#000000"
                    }, {
                        "lightness": 21
                    }]
                }, {
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                        "visibility": "on"
                    }, {
                        "color": "#000000"
                    }, {
                        "lightness": 16
                    }]
                }, {
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "saturation": 36
                    }, {
                        "color": "#000000"
                    }, {
                        "lightness": 40
                    }]
                }, {
                    "elementType": "labels.icon",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }, {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#000000"
                    }, {
                        "lightness": 19
                    }]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#000000"
                    }, {
                        "lightness": 20
                    }]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "color": "#000000"
                    }, {
                        "lightness": 17
                    }, {
                        "weight": 1.2
                    }]
                }]
            };

            // Get the HTML DOM element that will contain your map
            // We are using a div with id="map" seen below in the <body>
            var mapElement = document.getElementById('map');

            // Create the Google Map using out element and options defined above
            map = new google.maps.Map(mapElement, mapOptions);

            // Custom Map Marker Icon - Customize the map-marker.png file to customize your icon
            var image = 'img/map-marker.png';
            var myLatLng = new google.maps.LatLng(<?php echo $p->latitud; ?>, <?php echo $p->longitud; ?>); //20.9844801, -89.6287586
            var beachMarker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: image
            });
        }
    </script>

 <?php } ?>