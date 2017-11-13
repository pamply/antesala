<?php
if (!isset($checkedv)){
    $checkedv = '';
}
if (!isset($checkedr)){
    $checkedr = '';
}
if (!isset($populadoMin)){
    $populadoMin = '';

}
if (!isset($populadoMax)){
    $populadoMax = '';
}

?>

    <section class="bgDepartamentos">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <a href="inicio/menu"><img src="img/icons/regresar.png" class="img-responsive center-block regresarICO" alt=""></a>
                    </div>
                    <div class="col-md-6">
                        <a href="inicio"><img src="img/logotipo.png" class="img-responsive center-block logotipoNavegador3 zoom" alt="Antesala Logotipo"></a>
                    </div>
                </div>
            </div>
            <?php
                if ($ocultar_filtros != true){
            ?>
            <div class="row">
                <div class="col-md-12 ">
                    <h2 class="titularesFiltros f-heavy" style="color: #414141;font-weight: bold;">
                    <?php echo ($nombre_tipo_propiedad != '')?strtoupper($nombre_tipo_propiedad->row()->titulo):''; ?><!-- CASAS -->
                    </h2>
                </div>
            </div>
                <form class="busqueda-filtro" action="propiedades/index" method="POST">
                <input type="hidden" id="inputProp" name="idPropiedad" value="<?php echo (isset($id_tipo_propiedad))?$id_tipo_propiedad:''; ?>"></input>
                    <div class="contenedorElementos">
                        <div class="row">
                            <div class="col-md-3 col-sm-5">
                                <h3 class="f-heavy" style="color: #2a2a2a;margin-top: 0;"><i style="margin-right: 20px;"><img src="img/icon-tramite.png" width="50"></i>Trámite</h3>
                            </div>
                            <div class="col-md-9 col-sm-7">
                                <div class="select-style2 col-xs-12">
                                    <select id="rent-sale" class="selectpicker">
                                        <option value="">Seleccionar</option>
                                        <option value="1" <?php echo (isset($id_venta) && $id_venta == 1)?"selected":""; ?>>Compra</option>
                                        <option value="2" <?php echo (isset($id_renta) && $id_renta == 1)?"selected":""; ?>>Renta</option>
                                    </select>
                                </div>
                            </div>


<!--                             <div class="col-md-9">
                                <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <div class="contenedorChecks">
                                        <div class="checkbox">
                                            <input type="checkbox" id="inputRent" class="vr" name="check" <?php echo $checkedv; ?> >
                                            <label for="inputRent"><span></span> Venta</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="contenedorChecks">
                                        <div class="checkbox">
                                            <input type="checkbox" id="inputSale" class="vr" name="check" <?php echo $checkedr; ?> >
                                            <label for="inputSale"><span></span> Renta</label>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div> -->

                        </div>
                    </div>

                            <!--Elementos-->
                            <div class="contenedorElementos">
                                <div class="row">
                                    <div class="col-md-3 col-sm-5">
                                        <i style="display: inline-table; width: 65px;"><img src="img/icon-casa.png" width="50"></i>
                                        <h3 class="f-heavy" style="color: rgb(42, 42, 42); display: inline-block; vertical-align: middle; width: 180px;">Tipo de <?php echo ($nombre_tipo_propiedad != '')?strtolower($nombre_tipo_propiedad->row()->titulo):'búsqueda'; ?></h3>
                                    </div>

                                    <div class="col-md-9 col-sm-7">
                                        <div class="select-style2 col-xs-12">
                                            <select id="tipo" class="selectpicker">
                                                <option value="">Seleccionar</option>
                                                <?php
                                                    if (!is_numeric($filtros)){
                                                        foreach ($filtros->result() as $f) {
                                                ?>
                                                <option value="<?php echo $f->id; ?>" <?php echo ($id_tipo == $f->id)?"selected":""; ?>><?php echo $f->titulo; ?></option>
                                                <?php
                                                        }
                                                ?>
                                                <?php
                                                    }
                                                ?>
<!--                                                 <option value="1" <?php echo ($id_tipo == 1)?"selected":""; ?>>Residencial</option>
                                                <option value="2" <?php echo ($id_tipo == 2)?"selected":""; ?>>Media</option>
                                                <option value="3" <?php echo ($id_tipo == 3)?"selected":""; ?>>Casas en la playa</option> -->
                                            </select>
                                        </div>
                                    </div>


<!--                                     <div class="col-md-9">
                                        <div class="row">

                                    <?php
                                        if ($filtros != ''){
                                            foreach ($filtros->result() as $f) {
                                    ?>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="contenedorChecks">
                                                <div class="checkbox">
                                                    <input type="checkbox" id="checkBottom<?php echo $f->id; ?>" class="check-tipo" name="check" value="<?php echo $f->id; ?>" <?php if (in_array($f->id, $all_id_filtro)){ echo "checked"; } ?>>
                                                    <label for="checkBottom<?php echo $f->id; ?>"><span></span> <?php echo $f->titulo; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                             }
                                        }
                                    ?>
                                        </div>
                                    </div> -->


                                </div>
                            </div>

                            <input type="hidden" value="0" id="inputUbicacion"></input>

                            <!--Elementos-->
                            <div class="contenedorElementos">
                                <div class="row">
                                    <div class="col-md-3 col-sm-5">
                                        <i style="display: inline-table; width: 65px;"><img src="img/icon-estado.png" width="50"></i>
                                        <h3 class="f-heavy" style="color: rgb(42, 42, 42); display: inline-block; vertical-align: middle; width: 180px;">Estado de la República</h3>
                                    </div>
                                    <div class="col-md-9 col-sm-7">
                                        <div class="select-style2 col-xs-12">
                                            <select id="inputCiudad" class="selectpicker">

                                                <option value="">Seleccionar</option>
                                                <?php
                                                    if (!is_numeric($ciudades)){
                                                        foreach ($ciudades->result() as $c) {
                                                            if ($c->estado != 0){
                                                                if ($c->estado == $id_ciudad){
                                                                 ?>
                                                            <option value="<?php echo $c->estado; ?>" selected="selected">
                                                               <?php echo $mciudad->getCampo('titulo',$c->estado); ?>
                                                            </option>
                                                                 <?php
                                                                }else{
                                                                    ?>
                                                            <option value="<?php echo $c->estado; ?>">
                                                                <?php echo $mciudad->getCampo('titulo',$c->estado); ?>
                                                            </option>

                                                                    <?php

                                                                }
                                                            }

                                                        }
                                                    }

                                                    if (isset($ciudades_general) && (!is_numeric($ciudades_general))){

                                                        foreach ($ciudades_general->result() as $cg) {
                                                    ?>
                                                            <option value="<?php echo $cg->id; ?>">
                                                                <?php echo $cg->titulo; ?>
                                                            </option>
                                                    <?php
                                                        }
                                                    }
                                                ?>
                                                <?php ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                    <div class="contenedorElementosPrecio">
                        <div class="row">
                                <div class="col-md-3 ">
                                    <h3 class="f-heavy" style="color: #2a2a2a;"><i style="margin-right: 20px;"><img src="img/icon-precio.png" width="50"></i>Precios</h3>
                                </div>
                <input type="hidden" class="priceMin" data-pricemin = "<?php echo $minPrice; ?>">
                <input type="hidden" class="priceMax" data-pricemax = "<?php echo $maxPrice; ?>">

                <input type="hidden" name="populadoMin" class="populadoMin" data-populadomin = "<?php echo $populadoMin; ?>">
                <input type="hidden" name="populadoMax" class="populadoMax" data-populadomax = "<?php echo $populadoMax; ?>">

                                <div class="col-md-6">
                                    <div class="contenedorSliderPrecio">
                                        <div class="property-filter">
                                            <div class="content">
                                                <form method="get" action="?">

                                                    <div class="price-value">
                                                        <span class="from"></span><!-- /.from -->
                                                        -
                                                        <span class="to"></span><!-- /.to -->
                                                    </div><!-- /.price-value -->

                                                    <div class="price-slider">
                                                    </div><!-- /.price-slider -->

                                                    <div class="price-from control-group">
                                                        <label class="control-label" for="inputPriceFrom">
                                                            Price from
                                                        </label>
                                                        <div class="controls">
                                                            <input type="text" id="inputPriceFrom" name="inputPriceFrom">
                                                        </div><!-- /.controls -->
                                                    </div><!-- /.control-group -->

                                                    <div class="price-to control-group">
                                                        <label class="control-label" for="inputPriceTo">
                                                            Price to
                                                        </label>
                                                        <div class="controls">
                                                            <input type="text" id="inputPriceTo" name="inputPriceTo">
                                                        </div><!-- /.controls -->
                                                    </div><!-- /.control-group -->

                                                </form>
                                            </div><!-- /.content -->
                                        </div><!-- /.property-filter -->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <img src="img/icons/perro.png" class="img-responsive center-block imgPerro" alt="">
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="buscando" value="1">
                                    <input type="hidden" id="clic_buscar" name="clic_buscar" value=""></input>
                                    <button type="submit" class="btn btn-default btn-lg text-center center-block btnBuscar btn-buscar">Buscar</button>
                                </div>
                        </div>
                    </div>
                </form>
                <?php } ?>
            </div>
    </section>

    <section class="resultados">
        <div class="container">
            <?php if ($propiedades != ''){ ?>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="titularesResultados" style="margin-top: 25px;"> <span><?php //echo $total_resultados; ?></span> Resultados</h4>
                </div>
            </div>
            <div class="row">
                <?php
                $i=-1;
                    foreach ($propiedades->result() as $p) {
                        $i++;
                        if ($i == 3): $i=0;
                ?>
            </div>

            <div class="row">
                <?php endif; ?>
                <div class="col-sm-6 col-md-4">
                    <div class="descripcion">
                        <a href="propiedades/ver/<?php echo $p->id ?>-<?php echo url_title($p->titulo) ?>/<?php echo $uri; ?>">
                        <?php
                            if ($p->foto != '') {
                        ?>
                            <img src="uploads/propiedad/<?php echo $p->foto; ?>" class="img-responsive center-block" alt="...">
                        <?php
                            }else{

                        ?>
                            <img src="img/propiedades/propiedades.jpg" class="img-responsive center-block" alt="...">
                        <?php } ?>
                        </a>
                        <?php if($p->mostrar_dolar!=0){ ?>
                        <h4 class="precioPropiedades"><?php echo number_format($p->precio_dolar,2) ?> USD</h4>
                        <?php }else{ ?>
                        <h4 class="precioPropiedades"><?php echo number_format($p->precio,2) ?> MXN</h4>
                        <?php } ?>
                            <div class="caption">
                                <h3 class="tituloPropiedad"><?php echo character_limiter($p->titulo,22); ?></h3>
                                <p class="descripcionPropiedad"><?php echo character_limiter($p->direccion,27); ?></p>
                            </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <?php
                    if (isset($paginationC)){
                        echo $paginationC;
                    }else {
                    ?>

                    <?php } ?>
                </div>
            </div>
            <?php }else{ ?>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="titularesResultados"> No se encontraron resultados</h4>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>

    <?php
        if (isset($scroll) && $scroll == true){
    ?>

    <script type="text/javascript">

        $(document).ready(function(){
            $('html, body').animate({
                scrollTop: $(".resultados").offset().top
            }, 2000);
        })
    </script>

    <?php } ?>

