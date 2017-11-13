    <!--Banner Principal-->
    <div class="container sliderPrincipal">
            <div id="slider" class="sl-slider-wrapper">
                <div class="sl-slider">
<?php
if (!is_numeric($slider)){

    $i=1;
    foreach($slider->result() as $r){
        $res=$i%2;
        $orientacion="vertical";
        if($res!=0){
             $orientacion="horizontal";
        }
?>
                    <div class="sl-slide bg-1" data-orientation="<?php echo $orientacion; ?>" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                        <div class="sl-slide-inner" style='background: rgba(0, 0, 0, 0) url("uploads/slider_principal/<?php echo $r->foto; ?>") no-repeat center 25px fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;'>
                            <div class="row">
                                <div class="contenedorBannerImagenes">
                                    <div class="col-md-6 pull-left">
                                        <div class="contenedorInfoSlider">
                                            <div class="pull-left">
                                                <nav class=" BannerRedes">
                                                    <ul>
                                                        <li><a href="https://www.facebook.com/Antesala-Inmobiliaria-1655079281375203/" target="blank"><i class="fa fa-facebook fa-3x redesSocialesBanner" aria-hidden="true"></i></a></li>
                                                        <li><a href="https://www.instagram.com/antesalainmobiliaria/" target="blank"><i class="fa fa-instagram fa-3x redesSocialesBanner" aria-hidden="true"></i></a></li>
                                                        <h4 class="hola">Hola</h4>
                                                    </ul>
                                                </nav>
                                            </div>
                                            <h2 class="TextoPrincipal hidden-xs"><?php echo $r->titulo; ?> <br> <span class="TextoSeundario"><?php echo $r->titulo_2; ?></span></h2>
                                        </div>
                                    </div>

                                    <?php if($r->foto_2!=''){ ?>
                                    <div class="col-md-6 pull-right">
                                        <img src="uploads/slider_principal/<?php echo $r->foto_2; ?>" class="img-responsive center-block FamiliaImg" alt="">
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>


<?php
        $i++;
    }
}else{
?>
<!-- img estatica -->
                    <div class="sl-slide bg-1" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                        <div class="sl-slide-inner">
                            <div class="row">
                                <div class="contenedorBannerImagenes">
                                    <div class="col-md-6 pull-left">
                                        <div class="contenedorInfoSlider">
                                            <div class="pull-left">
                                                <nav class=" BannerRedes">
                                                    <ul>
                                                        <li><a href="http://facebook.com" target="blank"><i class="fa fa-facebook fa-3x redesSocialesBanner" aria-hidden="true"></i></a></li>
                                                        <li><a href="http://instagram.com" target="blank"><i class="fa fa-instagram fa-3x redesSocialesBanner" aria-hidden="true"></i></a></li>
                                                        <h4 class="hola">Hola</h4>
                                                    </ul>
                                                </nav>
                                            </div>
                                            <h2 class="TextoPrincipal">#Me siento <br> <span class="TextoSeundario">como en casa</span></h2>
                                        </div>
                                    </div>


                                    <div class="col-md-6 pull-right">
                                        <img src="img/banners/familia2.png" class="img-responsive center-block FamiliaImg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php } ?>

                </div><!-- /sl-slider -->

                <nav id="nav-arrows" class="nav-arrows">
                    <span class="nav-arrow-prev"></span>
                    <span class="nav-arrow-next"></span>
                </nav>
            </div><!-- /slider-wrapper -->
        </div>
    <!--Fin Banner Principal-->