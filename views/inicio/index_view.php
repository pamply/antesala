<div class="container">
<div id="main">
<div class="slider-wrapper">
    <div class="slider">
        <div class="slider-inner">
            <div class="row">
                <div class="images span9">
                    <div class='iosSlider' >
                        <div class='slider-content'>
                            <?php
                            $totalSliders=0;

                            if($sliders != ''){
                                 if($sliders->num_rows > 0 && $sliders != ''){
                                    if(count($sliders)>0){
                                            foreach($sliders->result() as $element){
                                                if($element->foto!=""){
                                                    $totalSliders++;
                                    ?>
                                            <div class="slide">
                                                <?php if(isset($element->foto) && $element->foto != ""){?>
                                                    <img src="uploads/propiedad/<?php echo $element->foto; ?>" alt="">
                                                <?php } else{ ?>
                                                    <img src="img/df_slider_barcam.jpg" alt="">
                                                <?php } ?>
                                                <div class="slider-info">
                                                    <div class="price">
                                                        <h2 class="f-fam1 fs-24 fc-0">$<?php echo number_format($element->precio); ?></h2>
                                                        <a class="f-fam2 fs-14 fc-21" href="propiedades/ver/<?php echo $element->id; ?>-<?php echo url_title($element->titulo); ?>">Ver más</a>
                                                    </div><!-- /.price -->
                                                    <h2 class="responsive-hidden"><a  class="f-fam1 fs-24 fc-22" href="propiedades/ver/<?php echo $element->id; ?>-<?php echo url_title($element->titulo); ?>"><?php echo $element->titulo; ?></a></h2>
                                                    <?php if ($element->terreno != ''){ ?><div class="terreno f-fam1 fs-12 responsive-hidden">Terreno: <?php echo $element->terreno; ?> m<sup>2</sup></div><!-- /.bathrooms --><?php } ?>
                                                    <?php if ($element->construccion != ''){ ?><div class="construccion f-fam1 fs-12 responsive-hidden">Construcción: <?php echo $element->construccion; ?> m<sup>2</sup></div><!-- /.bathrooms --><?php } ?>
                                                    <?php
                                                    if($element->cuartos!="Ninguno"){
                                                    ?>
                                                    <div class="bathrooms f-fam1 fs-12 responsive-hidden">Cuartos: &nbsp;&nbsp; <span class="f-fam1"><?php echo $element->cuartos; ?></span></div><!-- /.bathrooms -->
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if($element->banos!="Ninguno"){
                                                        ?>
                                                    <div class="bedrooms f-fam1 fs-12 responsive-hidden">Baños: &nbsp;&nbsp; <span class="f-fam1"><?php echo $element->banos; ?></div><span><!-- /.bedrooms -->
                                                    <?php
                                                    }
                                                    ?>
                                                </div><!-- /.slider-info -->
                                            </div><!-- /.slide -->
                                    <?php
                                                }
                                            }
                                        }
                                 }
                            }else{
                             ?>

                                <div class="slide">
                                    <img src="uploads/propiedad/default.jpg" alt="">

                                </div><!-- /.slide -->

                            <?php
                            }
                            ?>

                        </div><!-- /.slider-content -->
                    </div><!-- .iosSlider -->

                    <ul class="navigation">
                        <?php

                            for($i=0;$i<$totalSliders;$i++){
                                if($i==0){
                                    echo '<li class="active"><a>'.($i+1).'</a></li>';
                                }else{
                                    echo '<li><a>'.($i+1).'</a></li>';
                                }
                            }
                        ?>
                    </ul><!-- /.navigation-->
                </div><!-- /.images -->
                <?php echo modules::run('busqueda/busqueda/index'); ?>
            </div><!-- /.row -->
        </div><!-- /.slider-inner -->
    </div><!-- /.slider -->
</div><!-- /.slider-wrapper -->
<?php echo modules::run('pdestacadas/pdestacadas/index'); ?>
<?php echo modules::run('p_ultimas/p_ultimas/index'); ?>
</div>
</div>

<div class="bottom-wrapper">
    <div class="bottom container">
        <div class="bottom-inner row">
            <div class="item span4">
                <div class="barcam decoration"></div>
                <h2><a>Nosotros</a></h2>
                <p>Somos una empresa que contribuye a mejorar la calidad de vida de las personas a través de los servicios...</p>
                <a href="nosotros" class="btn btn-primary">Ver más</a>
            </div><!-- /.item -->

            <div class="item span4">
                <div class="key decoration"></div>
                <h2><a>Visión</a></h2>
                <p>Ser una organización líder en la construcción inmobiliaria a nivel local y regional reconocida por su mejora...
                    </p>
                <a href="nosotros" class="btn btn-primary">Ver más</a>
            </div><!-- /.item -->

            <div class="item span4">
                <div class="gps decoration"></div>
                <h2><a>Misión</a></h2>
                <p>Satisfacer las necesidades de nuestros clientes con espacios provechosos, superando sus expectativas...
                    </p>
                <a href="nosotros" class="btn btn-primary">Ver más</a>
            </div><!-- /.item -->
        </div><!-- /.bottom-inner -->
    </div><!-- /.bottom -->
</div><!-- /.bottom-wrapper -->