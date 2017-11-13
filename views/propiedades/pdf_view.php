<table style="font-family:Arial, Helvetica, sans-serif" width="80%" border="0" align="center">
    <tr>
        <td width="15%">
            <img src="images/logopdf.jpg" style="width: 250px;height: 50px" />
            <div style="padding:0px 0px 0px 15px;">
                <p>Informaci&oacute;n de contacto</p>
                <p>Oficinas: Calle 56-B, No. 451<br>
                    Colonia Buenavista, C.P. 97119
                    M&eacute;rida, Yucat&aacute;n, M&eacute;xico.<br/>
                    <strong>(999) 926.89.66</strong><br/>
                    <br/>
                </p>
            </div>
        </td>
        <td width="100" style="padding-top: 50px;padding-left: 30px">
            <strong style="font-size: 14px;"><?php  echo utf8_decode($propiedad->titulo); ?></strong>
        </td>
        <td width="20%" align="center" valign="top">
            <div style="text-align:right; width:200px; margin-left:100px;">
                <p class="fuentes fs4 fc3">FICHA <?php echo utf8_decode("TÉCNICA")?></p>
                <p class="fuentes fs2 fc3">FECHA <?php echo date("d / m / Y");?></p>
            </div>
        </td>
    </tr>
    <tr>
        <td valign="top" class="fuentes  fc3">
            <img src="uploads/propiedad/<?php echo $propiedad->thumbnail; ?>" width="250" height="260"/>
        </td>
        <td colspan="2" align="left" valign="top" style="padding:5px;">

            <div style="padding:0px 0px 0px 15px;">

                <div>
                    <table width="80%" height="117" border="0" align="left" cellpadding="0" cellspacing="0" >
                        <tbody>
                        <tr class="even_row" style="width:60%">
                            <td>

                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr class="even_row" style="width:35%">
                            <td>

                            </td>
                            <td >
                                <?php

                                echo $enOferta;
                                ?>
                                <?php if(isset($propiedad->codigo) && $propiedad->codigo != ""):?>
                                C&oacute;digo:	<strong><?php echo $propiedad->codigo;?></strong><br><br>
                                <?php endif;?>
                                Tipo:	<strong><?php echo $tipo_propiedad->row()->titulo;?></strong><br><br>
                                Estatus:	<strong><?php echo $status->row()->titulo;?></strong><br><br>
                                Terreno:	<strong><?php echo $propiedad->terreno;?> m<sup>2</sup></strong><br><br>
                                <?php echo utf8_decode("Construcción");?>:	<strong><?php echo $propiedad->construccion;?> m<sup>2</sup></strong><br><br>
                                Precio:	<strong>$<?php echo number_format($propiedad->precio);?></strong><br><br>
                                <?php
                                    if($propiedad->plantas!="Ninguno"){
                                ?>
                                 Plantas: <strong><?php echo $propiedad->plantas;?></strong><br><br>
                                <?php
                                    }
                                ?>
                                <?php
                                if($propiedad->cuartos!="Ninguno"){
                                ?>
                                Cuartos: <strong><?php echo $propiedad->cuartos;?></strong><br><br>
                                <?php
                                }
                                ?>
                                <?php
                                if($propiedad->banos!="Ninguno"){
                                ?>
                                <?php echo utf8_decode("Baños");?>: <strong><?php echo $propiedad->banos;?></strong><br><br>
                                <?php
                                }
                                ?>
                                <?php
                                if($propiedad->garage!="No"){
                                    if($propiedad->garage!="Ninguno"){
                                    ?>
                                    Garage:	<strong><?php echo utf8_decode($propiedad->garage);?></strong><br><br>
                                    <?php
                                    }
                                }
                                ?>
                                <?php
                                if($propiedad->piscina!="No"){
                                    if($propiedad->piscina!="Ninguno" || $propiedad->piscina!="No"){
                                    ?>
                                    Piscina:	<strong><?php echo utf8_decode($propiedad->piscina);?></strong><br><br>
                                    <?php
                                    }
                                }
                                ?>
                                Estado	<strong><?php echo utf8_decode($estado->row()->titulo);?></strong><br><br>
                                Ciudad:	<strong><?php echo utf8_decode($ciudad->row()->titulo);?></strong><br><br>
                                Colonia:	<strong><?php echo utf8_decode($colonia->row()->titulo);?></strong><br><br>
                                <?php if ($zona != ''){ ?>
                                Zona:	<strong><?php echo utf8_decode($zona->row()->titulo);?></strong><br><br>
                                <?php } ?>




                            </td>
                        </tr>
                    </table>


                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td width="20%">
            <p><?php echo $propiedad->descripcion_corta;?></p>
            <p><?php echo $propiedad->descripcion_larga;?></p>
        </td>
    </tr>
</table>
<br/><br/>