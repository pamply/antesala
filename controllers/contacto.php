<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class contacto extends MY_Controller
    {

        public $data, $user;

        public function __construct()
        {
            parent::__construct();
            $this->fv = 'contacto';
            $this->mainView = 'contacto';
            $this->data = array(
                /* Parametros SEO */
                'meta_tags' => array(
                    'meta_description' => '',
                    'meta_keywords' => '',
                    'meta_title' => '',
                    'meta_url' => '',
                    'meta_type' => 'website',
                    'meta_image' => '',
                    'meta_locale' => 'mx_MX',
                    'meta_site_name' => '',
                    'meta_robots' => $this->meta_robots,
                    'meta_rating' => $this->meta_rating,
                    'meta_distribution' => $this->meta_distribution,
                    'meta_copyright' => $this->meta_copyright,
                    'meta_author' => $this->meta_author
                ),
                'titulo' => 'Antesala - Inmobiliaria',
                'fjs' => array(),
                'raw_fjs' => '',
                'raw_js' => "",
                'js' => array('js/daterangepicker.js'),
                'css' => array('css/daterangepicker.css')
            );
            $this->load->helper(array('url', 'tools', 'captcha'));


        }

        public function index($id = null)
        {
            if ($id != null){
                $cData['selected'] = $id;

            }else{
                $cData['selected'] = '';
            }
            $cData['success'] = false;
            $cData['alert'] = false;
            $cData['error'] = false;

            $sesion = $this->session->userdata('ADW');
            if(!isset($sesion)){
                $this->session->set_userdata('ADW',false);
            }

            $rText = randomNumber(4);
            $cData['rText'] = $rText;

            if (!isset($_POST['nombre']) || ($_POST['nombre'] == '')) {
                $this->session->set_userdata('contacto_ctmptxt', $rText);
            }

            $cData['rutaCaptcha'] = $this->config->item('base_www') . 'captcha/';
            $cData['imgCaptcha'] = $this->config->item('base_ourl') . 'uploads/captcha/';

            if (isset($_POST['nombre'])) {
                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('<span class="form-required">', '</span>');

                if ($this->form_validation->run($this->fv) == FALSE) {

                    $rText = randomNumber(4);
                    $cData['rText'] = $rText;
                    $cData['rutaCaptcha'] = $this->config->item('base_www') . 'captcha/';
                    $cData['imgCaptcha'] = $this->config->item('base_ourl') . 'uploads/captcha/';
                    $this->session->set_userdata('contacto_ctmptxt', $rText);
                    $this->data['contenido'] = $this->load->view($this->mainView.'/index_view',$cData,true);
                    $this->load->view('templates/contacto_template',$this->data);
                } else {
                    if (strtolower($this->session->userdata('contacto_ctmptxt')) == strtolower($this->input->post('ctmptxt', TRUE))) {

                        $nombre   = $this->input->post('nombre',true);
                        $apellido = $this->input->post("apellido",true);
                        $correo_conv   = $this->input->post('correo',true);
                        $telefono = $this->input->post('telefono',true);
                        $estado   = $this->input->post('estado',true);
                        $pais   = $this->input->post('pais',true);
                        $correo   = strtolower($correo_conv);
                        $msg  = $this->input->post('mensaje',true);
                        $comonos  = $this->input->post('comonos',true);



                        $mensaje = '';

                        $mensaje.="".
                            "--<br>".
                            "Nombre: ".$nombre." ".$apellido."<br>".
                            "Email: ".$correo."<br>".
                            "Teléfono: ".$telefono."<br>".
                            "País: ".$pais."<br>".
                            "Estado/Ciudad: ".$estado."<br>".
                            "¿Cómo se enteró de nosotros?: ".$comonos."<br>".
                            "Comentarios o Sugerencias: ".$msg."<br>".
                            "--seccion--";

                        $recibido = $this->email_contacto($mensaje);
                        //echo $mensaje;

                        if(isset($recibido) && $recibido == true){

                            $this->email_recibido($correo);

                            $this->session->set_userdata('ADW',true);
                            $cData['lasesion'] = $this->session->userdata('ADW');
                            $cData['success'] = true;
                            $this->data['contenido'] = $this->load->view($this->mainView.'/index_view',$cData,true);
                            $this->load->view('templates/contacto_template',$this->data);

                        }else{

                            $cData['alert'] = true;
                            $this->data['contenido'] = $this->load->view($this->mainView.'/index_view',$cData,true);
                            $this->load->view('templates/main',$this->data);
                        }

                    } else {

                        $cData['error'] = true;

                        $rText = randomNumber(4);
                        $cData['rText'] = $rText;
                        $cData['rutaCaptcha'] = $this->config->item('base_www') . 'captcha/';
                        $cData['imgCaptcha'] = $this->config->item('base_ourl') . 'uploads/captcha/';

                        $this->data['contenido'] = $this->load->view($this->mainView.'/index_view',$cData,true);
                        $this->load->view('templates/contacto_template',$this->data);

                        $this->session->set_userdata('contacto_ctmptxt', $rText);
                    }

                }

            }else{

                $this->data['contenido'] = $this->load->view($this->mainView.'/index_view',$cData,true);
                $this->load->view('templates/contacto_template',$this->data);

            }

        }

        public function email_contacto(){
            $nombre = $this->input->post('nombre');
            $apellido = $this->input->post('apellido');
            $telefono = $this->input->post('telefono');
            $celular = $this->input->post('celular');
            $correo = $this->input->post('correo');
            $fecha = $this->input->post('fecha');
            $hora = $this->input->post('hora');
            $mensajeForm = $this->input->post('mensaje');

            $this->load->library('form_validation');
            $this->form_validation->set_rules('nombre','Nombre','required|xss');
            $this->form_validation->set_rules('apellido','Apellido','required|xss');
            $this->form_validation->set_rules('telefono','Teléfono','numeric|xss');
            $this->form_validation->set_rules('celular','Celular','required|xss');
            $this->form_validation->set_rules('correo','Correo','required|xss');
            $this->form_validation->set_rules('fecha','Fecha','xss');
            $this->form_validation->set_rules('hora','Hora','xss');
            $this->form_validation->set_rules('mensaje','Mensaje','required|xss');

            if ($this->form_validation->run($this->fv) == FALSE ){
                $jData['error1'] = validation_errors();
                $jData['error'] = 1;
                $data = json_encode($jData);
                echo $data;
            }else{

                $liga="http://www.antesala.com.mx/emailresources";
                //$liga="../emailresources";
$cuerpo='
<span class="lato-light" style="color: #6e6d6d; font-size: 18px; text-decoration: none;">Gracias por ponerte en contacto con nosotros.</span><br>
                  <span class="lato-light" style="color: #6e6d6d; font-size: 18px; text-decoration: none;">
                  Hemos recibido tu correo, en breve nos </span><br>
                  <span class="lato-light" style="color: #6e6d6d; font-size: 18px; text-decoration: none;">
                  comunicaremos contigo.
                  </span><br>
                  <br>
                  <br>
                  <br>';
//echo
$mensaje = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Email</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
<link href="https://fonts.googleapis.com/css?family=Lato:300,700" rel="stylesheet" type="text/css">
<style>


body, tr, td, span, div, p, a, li {
    -moz-text-size-adjust:none !important;
    -webkit-text-size-adjust:none !important;
    margin:0px !important;
    -ms-text-size-adjust:none !important;
    white-space: wrap;
}
.lato-light{
  font-family: "lato" sans-serif !important;
  font-weight: 300;
}
.lato-bold{
  font-family: "lato" sans-serif !important;
  font-weight: 700;
}
td img {
    display: block;
}
.ReadMsgBody {
    width: 100%;
}
.ExternalClass * {
    line-height: 100%;
}
 @media only screen and (max-width:480px) {
  #logosim{
    padding:0!important;
  }
*[class="code4email_wrapper"] {
 width: 100% !important;
}
*[class="code4email_main_table"] {
 width: 320px !important;
}
*[class="code4email_hide"] {
 display: none !important;
}
*[class="code4email_hide"] {
 display: none !important;
}
*[class="code4email_center"] {
 text-align: center !important;
 padding:10px !important;
 height:20px !important;
}
*[class="code4email_clear"] {
 width: 100% !important;
 clear: both !important;
 float: left !important;
}
*[class="code4email_br"] {
 display:block !important;
 width: 1px !important;
 height:6px !important;
 clear: both !important;
}
*[class="code4email_text_p10"] {
 padding: 0px 10px 10px 10px !important;
 height:20px !important;
}
*[class="code4email_w20"] {
 width: 20px !important;
}
*[class="code4email_h20"] {
 height: 20px !important;
}
*[class="code4email_h20_center"] {
 height: 20px !important;
 text-align: center !important;
}
}
 @media only screen and (min-width:480px) and (max-width:599px) {
*[class="code4email_wrapper"] {
 width: 100% !important;
}
*[class="code4email_main_table"] {
 width: 480px !important;
}
*[class="code4email_hide"] {
 display: none !important;
}
*[class="code4email_hide"] {
 display: none !important;
}
*[class="code4email_center"] {
 text-align: center !important;
 padding:10px !important;
 height:20px !important;
}
*[class="code4email_clear"] {
 width: 100% !important;
 clear: both !important;
 float: left !important;
}
*[class="code4email_br"] {
 display:block !important;
 width: 1px !important;
 height:6px !important;
 clear: both !important;
}
*[class="code4email_text_p10"] {
 padding: 0px 10px 10px 10px !important;
 height:20px !important;
}
*[class="code4email_w20"] {
 width: 20px !important;
}
*[class="code4email_h20"] {
 height: 20px !important;
}
*[class="code4email_h20_center"] {
 height: 20px !important;
 text-align: center !important;
}
}
</style>
</head>
<body marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" bgcolor="#FFFFFE" style="-moz-text-size-adjust:none !important; padding:0px !important; -webkit-text-size-adjust:none !important; margin:0px ! important; -ms-text-size-adjust:none !important; white-space: wrap;">
<table class="code4email_wrapper" width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center" valign="top" bgcolor="#FFFFFE"><table class="code4email_wrapper" align="center" border="0" cellpadding="0" cellspacing="0" width="650" style="width:650px;">

        <tr>
          <td>
          <a href="'.$liga.'/../" target="_blank">
              <table   height="17px" background="'.$liga.'/header.png" class="code4email_wrapper"  width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                  <td align="" valign="middle" width="650" height="17" style="margin:0px; padding:0px; height:17px; width: 15%;">
                  <br>
                  <br><br><br>
                  <br><br><br>
                  <br><br>
                  </td>
                  <td align="left">

                  </td>
                </tr>

              </table>
              </a>
          </td>
        </tr>
        <tr>
          <td align="left" valign="top" style="line-height:12px; padding:0px; margin:0px; font-size:12px; width:650px;">
          <table  background="'.$liga.'/footer.png" class="code4email_wrapper" align="center" border="0" cellpadding="0" cellspacing="0" width="650" style="width:650px;">
              <tr>
                <td colspan="3" align="right" style="padding-top:12px;padding-right:15px;">
                  <a href="https://www.instagram.com/antesalainmobiliaria/" style="display:inline-table;"><img src="'.$liga.'/icon-instagram.png" /></a>
                  <a href="https://www.facebook.com/Antesala-Inmobiliaria-1655079281375203/" style="display:inline-table;"><img src="'.$liga.'/face.png" /></a>
                </td>
              </tr>
              <tr>
                <td align="left" valign="top" width="58" height="91" style="margin:0px; padding:0px; height:91px; width:58px; line-height:12px; font-size:12px;" class="code4email_hide">&nbsp;</td>
                <td align="left" valign="middle" width="600" height="91" style="width:630px; margin:0px; height:91px; padding-bottom:25px; padding-top:50px; font-family: Arial, Helvetica, sans-serif; color: #333333; font-size: 14px; mso-line-height-rule:exactly; white-space: wrap; line-height:20px;" class="code4email_center"><span style="color: #5b5b5f; font-size: 14px; text-decoration: none;" class="lato-light">
                  <span class="lato-light" style="font-size:37px;color:#fff">¡Hola!</span> <br><br>
                  '.$cuerpo.'
                  <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                </td>
                <td align="left" valign="top" width="58" height="91" style="margin:0px; padding:0px; height:91px; width:58px; line-height:12px; font-size:12px;" class="code4email_hide">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" style="padding-left: 35px;padding-bottom: 15px;">
                  <table>
                      <tr>
                        <td align="right">
                          <img src="'.$liga.'/marker.png">
                        </td>
                        <td align="left" style="padding-left:12px;width:200px;">
                          <span class="lato-light" style="color: #fff; font-size: 15px; text-decoration: none;line-height:22px;">
                            Dirección: Calle 48 #287 <br>por 73 y 75
                            Cordemex. Mérida Yuc.
                          </span>
                        </td>
                        <td align="right" style="width: 390px;">

                        </td>
                      </tr>
                       <tr>
                        <td align="right">
                          <img src="'.$liga.'/phone.png">
                        </td>
                        <td align="left" style="padding-left:12px;width:200px;">
                          <span class="lato-light" style="color: #fff; font-size: 15px; text-decoration: none;">
                            Cel: 9991 09 72 58
                          </span>
                        </td>
                        <td align="right" style="width: 390px;">

                        </td>
                      </tr>
                  </table>
                </td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <!--SOCIAL MEDIA STARTS HERE-->
        <td align="left" valign="top">


          <!--SOCIAL MEDIA STARTS HERE-->
              <table   class="code4email_wrapper"  width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                  <td  valign="middle" width="650" height="50" style="margin:0px; padding:0px; height:291px; width: 15%;">


                  </td>
                  <td align="left">

                  </td>
                  <td rowspan="2">

                  </td>
                </tr>


              </table>
            </td>

  </tr>
</table>
</body>
</html>';

                $this->load->library('email');

                $this->email->set_mailtype("html");
                $this->email->from('ventas@antesala.com.mx', 'Antesala');
                $this->email->to($correo);
                $this->email->subject('Antesala - Mensaje de Contacto');
                $this->email->message($mensaje);
                $this->email->send();
                $this->email->clear(true);

                //enviar correo de notificacion al staff
                $staff=$this->email_recibido($nombre,$apellido,$telefono,$celular,$correo,$fecha,$hora,$mensajeForm);
                if($staff){
                    $jData['error'] = 0;
                }else{
                    $jData['error'] = 1;
                }
                $data = json_encode($jData);
                echo $data;
            }

        }

        public function email_recibido($nombre=null,$apellido=null,$telefono=null,$celular=null,$correo=null,$fecha=null,$hora=null,$mensaje=null){


                //enviando correo
                $this->load->library('email');

                $mensaje = "".
                    "Nuevo Correo de Contacto.
                    <br> nombre: ".$nombre." ".$apellido."
                    <br>telefono: ".$telefono."
                    <br>celular: ".$celular."
                    <br>correo: ".$correo."
                    <br>mensaje: ".$mensaje."
                    <br>---Cita---
                    <br>fecha: ".$fecha."
                    <br>hora: ".$hora."
                    ";

                $this->load->library('email');
                $correo = "agonzalez@antesala.com.mx";
                $this->email->set_mailtype("html");
                $this->email->from('ventas@antesala.com.mx', 'Antesala');
                $this->email->to($correo);
                $this->email->subject('Antesala - Mensaje de Contacto Recibido');
                $this->email->message($mensaje);
                $this->email->send();
                $this->email->clear(true);

                $correo = "jesus@navegantes.mx";
                $this->email->set_mailtype("html");
                $this->email->from('ventas@antesala.com.mx', 'Antesala');
                $this->email->to($correo);
                $this->email->subject('Antesala - Mensaje de Contacto Recibido');
                $this->email->message($mensaje);
                $this->email->send();
                $this->email->clear(true);

                $correo = "ventas@antesala.com.mx";
                $this->email->set_mailtype("html");
                $this->email->from('Antesala');
                $this->email->to($correo);
                $this->email->subject('Antesala - Mensaje de Contacto Recibido');
                $this->email->message($mensaje);
                $this->email->send();
                $this->email->clear(true); 

                $correo = "jcan@antesala.com.mx";
                $this->email->set_mailtype("html");
                $this->email->from('Antesala');
                $this->email->to($correo);
                $this->email->subject('Antesala - Mensaje de Contacto Recibido');
                $this->email->message($mensaje);
                $this->email->send();
                $this->email->clear(true);   

                $correo = "aviles1189@gmail.com";
                $this->email->set_mailtype("html");
                $this->email->from('ventas@antesala.com.mx', 'Antesala');
                $this->email->to($correo);
                $this->email->subject('Antesala - Mensaje de Contacto Recibido');
                $this->email->message($mensaje);
                $this->email->send();
                $this->email->clear(true);

            return true;

        }



    }
