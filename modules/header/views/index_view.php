<!--Navegador-->
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <a href="<?php echo ($seccion == 'contacto')?'inicio':'#menu'; ?>" <?php echo ($seccion=='contacto')?'':'data-toggle="modal"' ?> class="c-hamburger c-hamburger--htx burguers">
                <span class="burger-x zoom">
                   <p class="menuNombre"><?php echo ($seccion == 'contacto')?'Home':'Menú'; ?></p>
                </span>
            </a>

            <img src="img/logotipo.png" class="img-responsive center-block logotipo" alt="Antesala Logotipo">

            <a href="#buscar" data-toggle="modal">
                <img src="img/icons/search.png" class="img-responsive center-block search pull-right zoom" alt="">
            </a>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <!--Fin Navegador-->

    <!--Modal Search-->
    <div class="portfolio-modal modal fade" id="buscar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content" style="background:url(img/backgroundSearch2.jpg) no-repeat center center fixed !important;
        -webkit-background-size: cover !important;-moz-background-size: cover !important;-o-background-size: cover !important;background-size: cover!important;">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr" style="background-color: #000;">
                    <div class="rl" style="background-color: #000;">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 pull-right">
                        <a href="inicio"><br>
                            <img src="img/logotipo.png" class="img-responsive center-block logoMenu pull-right zoom" alt="Antesala Logotipo">
                        </a>
                    </div>
                    <div class="col-lg-6 col-lg-offset-3">
                        <div class="modal-body" id="search">
                            <form id="busquedaGeneral" action="propiedades/index" method="POST">
                                <input id="buscG" type="search" value="" placeholder="Buscar" name="busqueda_general" />
                                <h2 class="teclaEnter">Busca lo que quieras y aprieta enter</h2>
                                <input type="hidden" name="busquedaGral" value="1">
                            </form>
                        </div>
                    </div>
                    <div class="col-md-5 pull-right">
                            <nav class="enlacesRedes">
                                <ul>
                                    <li><a href="https://www.facebook.com/Antesala-Inmobiliaria-1655079281375203/" target="blank"><i class="fa fa-facebook fa-2x redesSociales" aria-hidden="true"></i></a></li>
                                    <li><a href="https://www.instagram.com/antesalainmobiliaria/" target="blank"><i class="fa fa-instagram fa-2x redesSociales" aria-hidden="true"></i></a></li>
                                </ul>
                            </nav>
                        </div>
                </div>
            </div>
        </div>
    </div>
  


    <!--Modal menu-->
    <div class="portfolio-modal modal fade" id="menu" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content" style="background:url(img/backgroundNinia2.jpg) no-repeat center center fixed !important;
        -webkit-background-size: cover !important;-moz-background-size: cover !important;-o-background-size: cover !important;background-size: cover!important;">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr" style="background-color: #000;">
                    <div class="rl" style="background-color: #000;">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 pull-right">
                        <a href="inicio"><br>
                            <img src="img/logotipo.png" class="img-responsive center-block logoMenu pull-right zoom" alt="Antesala Logotipo">
                        </a>
                    </div>
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <div>
                                <div class="panel">                                    
                                      <?php 
                                      if ($q != ''){
                                        foreach ($q->result() as $m) {
                                      ?>
                                        <a href="propiedades/index/<?php echo $m->id; ?>" class="list-group-item "><?php echo strtoupper($m->titulo); ?> </a>
                                      <?php 
                                            }
                                        } 
                                      ?>                                             
                                </div>
                            </div>

                            <nav class="enlaces text-center">
                                <ul>
                                    <li><a href="familia">Familia Salas</a></li>
<!--                                     <li><a><span class="lineas">/</span></a></li>
                                    <li><a href="javascript:void(0);">Vendedores</a></li>
                                    <li><a><span class="lineas">/</span></a></li>
                                    <li><a href="#newsletter" data-dismiss="modal" data-toggle="modal">Suscríbete</a></li> -->
                                    <li><a><span class="lineas">/</span></a></li>
                                    <li><a href="contacto">Contacto</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
if (isset($menu) && $menu != ''){

?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.c-hamburger').trigger('click');
        })
    </script>
<?php } ?>    