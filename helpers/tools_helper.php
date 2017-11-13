<?php

    if (! function_exists('createMetaTagsSEO'))
    {
        function createMetaTagsSEO($array){

           $meta ='
            <meta name="description" content="'.$array['meta_description'].'" />
            <meta name="keywords" content="'.$array['meta_keywords'].'" />
            <meta name="robots" content="'.$array['meta_robots'].'" />
            <meta name="rating" content="'.$array['meta_rating'].'" />
            <meta name="distribution" content="'.$array['meta_distribution'].'" />
            <meta name="copyright" content="'.$array['meta_copyright'].'" />
            <meta name="author" content="'.$array['meta_author'].'" />
            ';
            return $meta;
        }
    }

    if (! function_exists('randomText'))
    {
        function randomText($l){$k='';$p= "abcdefghijklmnopqrstuvwxyz";$m = strlen($p)-1;for($i=0;$i<$l;$i++){$k .= $p{rand(0,$m)};}return $k;}
    }

    if (! function_exists('randomNumber'))
    {
        function randomNumber($l){$k='';$p= "1234567890";$m = strlen($p)-1;for($i=0;$i<$l;$i++){$k .= $p{rand(0,$m)};}return $k;}
    }

    if (! function_exists('getMes'))
    {
        function getMes($fecha){
            $nfecha = explode("/", $fecha);
            $dia = $nfecha[0];
            $mes = $nfecha[1];
            $anio = $nfecha[2];
            $string2 = '';
            switch($mes){
                case '01':
                    $string2 = 'ENERO';
                    break;
                case '02':
                    $string2 = 'FEBRERO';
                    break;
                case '03':
                    $string2 = 'MARZO';
                    break;
                case '04':
                    $string2 = 'ABRIL';
                    break;
                case '05':
                    $string2 = 'MAYO';
                    break;
                case '06':
                    $string2 = 'JUNIO';
                    break;
                case '07':
                    $string2 = 'JULIO';
                    break;
                case '08':
                    $string2 = 'AGOSTO';
                    break;
                case '09':
                    $string2 = 'SEPTIEMBRE';
                    break;
                case '10':
                    $string2 = 'OCTUBRE';
                    break;
                case '11':
                    $string2 = 'NOVIEMBRE';
                    break;
                case '12':
                    $string2 = 'DICIEMBRE';
                    break;
            }
            return $string2;
        }
    }

    if (! function_exists('getDia'))
    {
        function getDia($fecha){
            $nfecha = explode("/", $fecha);
            $dia = $nfecha[0];
            return $dia;
        }
    }

    // dd/MMM/YYYY
    if (! function_exists('parserDate'))
    {
        function parserDate($fecha){
            $nfecha = explode("/", $fecha);
            $dia = $nfecha[0];
            $mes = $nfecha[1];
            $anio = $nfecha[2];
            $string2 = '';
            $string2.= $dia.'/';
            switch($mes){
                case '01':
                    $string2 .= 'ENE';
                    break;
                case '02':
                    $string2 .= 'FEB';
                    break;
                case '03':
                    $string2 .= 'MAR';
                    break;
                case '04':
                    $string2 .= 'ABR';
                    break;
                case '05':
                    $string2 .= 'MAY';
                    break;
                case '06':
                    $string2 .= 'JUN';
                    break;
                case '07':
                    $string2 .= 'JUL';
                    break;
                case '08':
                    $string2 .= 'AGO';
                    break;
                case '09':
                    $string2 .= 'SEP';
                    break;
                case '10':
                    $string2 .= 'OCT';
                    break;
                case '11':
                    $string2 .= 'NOV';
                    break;
                case '12':
                    $string2 .= 'DIC';
                    break;
            }
            $string2 .='/'.$anio;
            return $string2;
        }
    }

    // dd/MMM/YYYY 12:00:00
    if (! function_exists('parserDatetime'))
    {
        function parserDatetime($datetime){
            $ndatetime = explode (" ",$datetime);
            $fecha = $ndatetime[0];
            $time = $ndatetime[1];
            $nfecha = explode("-", $fecha);
            $anio = $nfecha[0];
            $mes = $nfecha[1];
            $dia = $nfecha[2];
            $string2 = '';
            $string2.= $dia.'/';
            switch($mes){
                case '00':
                    $string2 .= '00';
                    break;
                case '01':
                    $string2 .= 'ENE';
                    break;
                case '02':
                    $string2 .= 'FEB';
                    break;
                case '03':
                    $string2 .= 'MAR';
                    break;
                case '04':
                    $string2 .= 'ABR';
                    break;
                case '05':
                    $string2 .= 'MAY';
                    break;
                case '06':
                    $string2 .= 'JUN';
                    break;
                case '07':
                    $string2 .= 'JUL';
                    break;
                case '08':
                    $string2 .= 'AGO';
                    break;
                case '09':
                    $string2 .= 'SEP';
                    break;
                case '10':
                    $string2 .= 'OCT';
                    break;
                case '11':
                    $string2 .= 'NOV';
                    break;
                case '12':
                    $string2 .= 'DIC';
                    break;
            }
            $string2 .='/'.$anio.' '.$time;
            return $string2;
        }
    }

    if (! function_exists('createSelect'))
    {
	  function createSelect($name,$values,$selected = NULL,$clase,$leyenda=''){
		$html = '<select name="'.$name.'" class="'.$clase.'">';
          if ($leyenda==''){
              $html .= '<option value="" >Seleccione</option>';
          } else {
              $html .= '<option value="" >'.$leyenda.'</option>';
          }
		foreach($values as $k=>$v){
			if($k == $selected){
				$html .= '<option value="'.$k.'" selected="selected">'.$v.'</option>';
			} else {
				$html .= '<option value="'.$k.'">'.$v.'</option>';
			}		
		}	
		$html .='</select>';
		return $html;
		}
    }

    if (! function_exists('createSelectResult'))
    {
	    function createSelectResult($name,$values,$selected = NULL,$clase,$leyenda=''){

            $html = '<select id="'.$name.'" name="'.$name.'" class="'.$clase.'">';

            if ($leyenda==''){
                $html .= '<option value="" >Seleccione</option>';
            } else {
                $html .= '<option value="" >'.$leyenda.'</option>';
            }

		    foreach($values->result() as $valor){
			    if($valor->id == $selected){
				    $html .= '<option value="'.$valor->id.'" selected="selected">'.$valor->titulo.'</option>';
			    }else{
				    $html .= '<option value="'.$valor->id.'">'.$valor->titulo.'</option>';
			    }		
		    }	
            $html .='</select>';
            return $html;
        }
    }

if (! function_exists('createSelectResultFront'))
{
    function createSelectResultFront($name,$values,$selected = NULL,$clase,$leyenda='',$idS=''){
        $html = '<select id="'.$idS.'" name="'.$name.'" class="'.$clase.'">';
        if ( $leyenda==''){
            $html .= '<option value="" >Todas</option>';
        } else {
            $html .= '<option value="" >'.$leyenda.'</option>';
        }

        if (isset($values) && ($values != '')){
            if (count($values)>0){
                foreach($values->result() as $valor){
                    if($valor->id == $selected){
                        $html .= '<option value="'.$valor->id.'" selected="selected">'.$valor->titulo.'</option>';
                    }else{
                        $html .= '<option value="'.$valor->id.'">'.$valor->titulo.'</option>';
                    }
                }
            }
        }
        $html .='</select>';
        return $html;
    }
}

    if (! function_exists('createSelectResult2'))
    {
        function createSelectResult2($name,$values,$leyenda,$selected = NULL,$clase,$id){
            $html = '<select id="'.$id.'" name="'.$name.'" class="'.$clase.'">';
            if($leyenda!=''){
                $html .= '<option value="">'.$leyenda.'</option>';
            }else{
                $html .= '<option value="">Selecciona una opcion</option>';
            }
            foreach($values->result() as $valor){
                if($valor->id == $selected){
                    $html .= '<option value="'.$valor->id.'" selected="selected">'.$valor->titulo.'</option>';
                }else{
                    $html .= '<option value="'.$valor->id.'">'.$valor->titulo.'</option>';
                }
            }
            $html .='</select>';
            return $html;
        }
    }

//Drop_down_urls
if (! function_exists('createSelectResultURL'))
{
	  function createSelectResultURL($name,$values,$selected = NULL,$clase){
		$html = '<select id="'.$name.'" name="'.$name.'" class="'.$clase.'">';
		$html .= '<option value="todas" >Todas</option>';
		foreach($values->result() as $valor){
			if($valor->url == $selected){
				$html .= '<option value="'.$valor->url.'" selected="selected">'.$valor->titulo.'</option>';
			}else{
				$html .= '<option value="'.$valor->url.'">'.$valor->titulo.'</option>';
			}		
		}	
		$html .='</select>';
		return $html;
		}
}

if (! function_exists('createChecks'))
{
	function createChecks($values,$key,$value,$checked =array(),$clase){
		$html ="";
		foreach($values->result() as $evento)
		{
			if(in_array($evento->$key,$checked))
			{
			 
				$html.= '<input type="checkbox" name="evento[]" value="'.$evento->$key.'" checked="checked" class="'.$clase.'"/>'.$evento->$value.'<br />';
			}else{
				$html.= '<input type="checkbox" name="evento[]" value="'.$evento->$key.'" class="'.$clase.'"/>'.$evento->$value.'<br />';
			}
		}
	return $html;
	}
}

if (! function_exists('getThumb'))
{

	function getThumb($imagen)
	{
		$thumb='';
		if($imagen!=''){
			$nimagen = explode(".", $imagen);
			$imagenname = $nimagen[0];
			$imagenext = $nimagen[1];
			$imagenname = $imagenname.'_thumb';
			$thumb   	= $imagenname.'.'.$imagenext;
		}
		return $thumb;
	}
}

if (! function_exists('createRadios'))
{
    function createRadios($name,$values,$selected = NULL,$clase){
        $html = '';
        foreach($values as $k=>$v){
            if($v == $selected){
                $html .= '<input type="radio" name="'.$name.'" value="'.$v.'" checked="checked" />'.$v.'<br/>';
            }else{
                $html .= '<input type="radio" name="'.$name.'" value="'.$v.'"  />'.$v.'<br/>';
            }
        }
        return $html;
    }
}

    if (! function_exists('createRadiosLabel'))
    {
        function createRadiosLabel($name,$values,$selected = NULL,$clase){
            $html = '';
            $count = 0;
            foreach($values as $k=>$v){
                $count++;
                if($k == $selected){
                    $html .= '<input type="radio" name="'.$name.'" value="'.$k.'" id="'.$name.'-'.$count.'" checked="checked" /> <label for="'.$name.'-'.$count.'">'.$v.'</label>';
                }else{
                    $html .= '<input type="radio" name="'.$name.'" value="'.$k.'"  id="'.$name.'-'.$count.'" /><label for="'.$name.'-'.$count.'">'.$v.'</label>';
                }
            }
            return $html;
        }
    }



if (! function_exists('showErrorsJGrowl'))
{
	function showErrorsJGrowl($val_error)
	{
		if($val_error!="")
		{
			$errore_array = explode("</p>", $val_error);
			$i=0;
			foreach($errore_array as $error_solo)
			{
				$i==0;
				if($i==0){
					$error = substr($error_solo,3);
				}else{
					$error = substr($error_solo,4);
				}
				$i++;
				if($error!="")
				{
						//echo "<script type='text/javascript'>$(function(){ $.jGrowl('$error',{sticky:true}); 	});</script>";
				    echo "<script type='text/javascript'>$(function(){
	                        $.pnotify({title: 'Aviso',text: '$error',hide: false,icon: 'picon icon16 entypo-icon-warning white',opacity: 0.95,history: false,sticker: false});});
	                    </script>";
                }
			}
		}
	}
}
if (! function_exists('convertirMes'))
{
	function convertirMes($mes){
		switch($mes){
				case 1:$mes='ENERO';break;case 2:$mes='FEBRERO';break;case 3:$mes='MARZO';break;case 4:$mes='ABRIL';break;case 5:$mes='MAYO';break;case 6:$mes='JUNIO';break;case 7:$mes='JULIO';break;case 8:$mes='AGOSTO';break;case 9:$mes='SEPTIEMBRE';break;case 10:$mes='OCTUBRE';break;case 11:$mes='NOVIEMBRE';break;case 12:$mes='DICIEMBRE';break;
		}
		return $mes;
	}
	
}
if (! function_exists('convertMes'))
{
	function convertMes($fecha)
	{
		if($fecha!="")
		{
			$f_array = explode('-',$fecha);
			switch($f_array[1]){
				case '01':
					$f_return = $f_array[2].'-Ene-'.$f_array[0];
				break;
				case '02':
					$f_return = $f_array[2].'-Feb-'.$f_array[0];
				break;
				case '03':
					$f_return = $f_array[2].'-Mar-'.$f_array[0];
				break;
				case '04':
					$f_return = $f_array[2].'-Abr-'.$f_array[0];
				break;
				case '05':
					$f_return = $f_array[2].'-May-'.$f_array[0];
				break;
				case '06':
					$f_return = $f_array[2].'-Jun-'.$f_array[0];
				break;
				case '07':
					$f_return = $f_array[2].'-Jul-'.$f_array[0];
				break;
				case '08':
					$f_return = $f_array[2].'-Ago-'.$f_array[0];
				break;
				case '09':
					$f_return = $f_array[2].'-Sep-'.$f_array[0];
				break;
				case '10':
					$f_return = $f_array[2].'-Oct-'.$f_array[0];
				break;
				case '11':
					$f_return = $f_array[2].'-Nov-'.$f_array[0];
				break;
				case '12':
					$f_return = $f_array[2].'-Dic-'.$f_array[0];
				break;
			}
			return $f_return;
		}
	}
}
if (! function_exists('h_money_format'))
{
	function h_money_format($format, $number)
{
    $regex  = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?'.
              '(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/';
    if (setlocale(LC_MONETARY, 0) == 'C') {
        setlocale(LC_MONETARY, '');
    }
    $locale = localeconv();
    preg_match_all($regex, $format, $matches, PREG_SET_ORDER);
    foreach ($matches as $fmatch) {
        $value = floatval($number);
        $flags = array(
            'fillchar'  => preg_match('/\=(.)/', $fmatch[1], $match) ?
                           $match[1] : ' ',
            'nogroup'   => preg_match('/\^/', $fmatch[1]) > 0,
            'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ?
                           $match[0] : '+',
            'nosimbol'  => preg_match('/\!/', $fmatch[1]) > 0,
            'isleft'    => preg_match('/\-/', $fmatch[1]) > 0
        );
        $width      = trim($fmatch[2]) ? (int)$fmatch[2] : 0;
        $left       = trim($fmatch[3]) ? (int)$fmatch[3] : 0;
        $right      = trim($fmatch[4]) ? (int)$fmatch[4] : $locale['int_frac_digits'];
        $conversion = $fmatch[5];

        $positive = true;
        if ($value < 0) {
            $positive = false;
            $value  *= -1;
        }
        $letter = $positive ? 'p' : 'n';

        $prefix = $suffix = $cprefix = $csuffix = $signal = '';

        $signal = $positive ? $locale['positive_sign'] : $locale['negative_sign'];
        switch (true) {
            case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+':
                $prefix = $signal;
                break;
            case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+':
                $suffix = $signal;
                break;
            case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+':
                $cprefix = $signal;
                break;
            case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+':
                $csuffix = $signal;
                break;
            case $flags['usesignal'] == '(':
            case $locale["{$letter}_sign_posn"] == 0:
                $prefix = '(';
                $suffix = ')';
                break;
        }
        if (!$flags['nosimbol']) {
            $currency = $cprefix .
                        ($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) .
                        $csuffix;
        } else {
            $currency = '';
        }
        $space  = $locale["{$letter}_sep_by_space"] ? ' ' : '';

        $value = number_format($value, $right, $locale['mon_decimal_point'],
                 $flags['nogroup'] ? '' : $locale['mon_thousands_sep']);
        $value = @explode($locale['mon_decimal_point'], $value);

        $n = strlen($prefix) + strlen($currency) + strlen($value[0]);
        if ($left > 0 && $left > $n) {
            $value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0];
        }
        $value = implode($locale['mon_decimal_point'], $value);
        if ($locale["{$letter}_cs_precedes"]) {
            $value = $prefix . $currency . $space . $value . $suffix;
        } else {
            $value = $prefix . $value . $space . $currency . $suffix;
        }
        if ($width > 0) {
            $value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ?
                     STR_PAD_RIGHT : STR_PAD_LEFT);
        }

        $format = str_replace($fmatch[0], $value, $format);
    }
    return $format;
	}

    //funciones

}


if (! function_exists('showEmbedVideo'))
{
    function showEmbedVideo($string,$width = 609,$height = 457){
        $html ='';
        $ytarray=explode("/", $string);
        if ($ytarray[2] == 'www.youtube.com'){

           $stringCode = explode('"',$ytarray[4]);
           $ytcode = $stringCode[0];
           $html = "<iframe src=\"http://www.youtube.com/embed/$ytcode\" width=\"$width\" height=\"$height\" frameborder=\"0\" allowfullscreen></iframe>";
        }


        else {
            if ($ytarray[2] == 'player.vimeo.com'){
                $stringCode = explode('"',$ytarray[4]);
                $ytcode = $stringCode[0];
                $html ="<iframe src=\"http://player.vimeo.com/video/$ytcode\" width=\"$width\" height=\"$height\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>";

            }
            else {
                $ytcode = $ytarray[3];
                $html ="<iframe src=\"http://player.vimeo.com/video/$ytcode\" width=\"$width\" height=\"$height\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>";
            }
        }

        if ($ytarray[2] == 'youtu.be'){

            $ytcode = $ytarray[3];
            //  echo $ytcode;

            $html = "<iframe src=\"http://www.youtube.com/embed/$ytcode\" width=\"$width\" height=\"$height\" frameborder=\"0\" allowfullscreen></iframe>";
        }
        return $html;
    }
}

if (! function_exists('showEmbedIssuu'))
{
    function showEmbedIssuu($string,$width = 525,$height = 371){

        $ytarray=explode("/", $string);
        $string1 = explode('#',$ytarray[3]);
        $string2 = explode('"',$ytarray[4]);
        $code = $string1[1].'/'.$string2[0];
        $html ="<iframe width=\"$width\" height=\"$height\" src=\"//e.issuu.com/embed.html#$code\" frameborder=\"0\" allowfullscreen></iframe>";
        return $html;
    }
}


if (! function_exists('html2text'))
{
    function html2text($html){
        $text = $html;
        static $search = array(
            '@<script.+?</script>@usi',  // Strip out javascript content
            '@<style.+?</style>@usi',    // Strip style content
            '@<!--.+?-->@us',            // Strip multi-line comments including CDATA
            '@</?[a-z].*?\>@usi',         // Strip out HTML tags
        );
        $text = preg_replace($search, ' ', $text);
        // normalize common entities
        $text = normalizeEntities($text);
        // decode other entities
        $text = html_entity_decode($text, ENT_QUOTES, 'utf-8');
        // normalize possibly repeated newlines, tabs, spaces to spaces
        $text = preg_replace('/\s+/u', ' ', $text);
        $text = trim($text);
        // we must still run htmlentities on anything that comes out!
        // for instance:
        // <<a>script>alert('XSS')//<<a>/script>
        // will become
        // <script>alert('XSS')//</script>
        return $text;
    }
}


if (! function_exists('getRevista'))
{
    //funciona para las revistas para el link largo que contiene div o el que contiene issuu.com
    function getRevista($string){
        $html = "";
        $string = "issuu.com/whoshungrymagazine/docs/wh_no3_test?e=1216661/6189282";
        $yt = strip_tags($string);
        $yt1 = substr($yt,0,9);
        if ($yt1 == "issuu.com"){
            $ytarray = explode("e=",$string);
            $yt = $ytarray[1];
            $sin = strip_tags($yt);
            echo $html = '<iframe width="525" height="321" src="//e.issuu.com/embed.html#'.$sin.'" frameborder="0" allowfullscreen></iframe>';
        } else{
            $normal = html_entity_decode($string);
            echo $normal;
        }

    }

}

if (!function_exists('construir_url_seo')) {
    function construir_url_seo($id, $nombre)
    {
        return $id . "-" . str_replace(" ", "_", $nombre);
    }
}
if (!function_exists('obtenerId')) {
    function obtenerId($id)
    {
        $s= explode('-',$id);
        return $id = $s[0];
    }
}

if (! function_exists('getAIds')){
    function getAIds($string){
        $a = explode(',',$string);
        return $a;
    }
}

if (! function_exists('unionIds')){
    function unionIds($array){
        $stringSubs = '';
        if ($array!=''):
            foreach($array as $k => $v):
                if ($v != 'multiselect-all'){
                    $stringSubs .= $v.',';
                }
            endforeach;
            $stringSubs = substr($stringSubs,0,-1);
        endif;
        return $stringSubs;
    }
}





