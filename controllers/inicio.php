<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class inicio extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->fv = 'inicio';
        $this->mainView = 'inicio';
        $this->data = array(
            /* Parametros SEO */
            'meta_tags' => array(
                'meta_description' => '',
                'meta_keywords' => '',
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
            'js' => array(''),
            'css' => array('')
        );
        /* Tools */
        $this->load->helper(array('tools','url','date','text','html2text'));

        /* Modelos */
        $this->load->model(array('mpropiedad','mnewsletter'));

        /* Lbrerias */
        // $this->load->library(array('email','session'));

        /* Debugging */
        //   $this->output->enable_profiler(true);
    }

    public function index(){
        $data = array();

        $this->data['contenido'] = $this->load->view($this->mainView.'/index_view',$data,true);
        $this->load->view('templates/main_template',$this->data);
    }

    public function newsletterRes(){
        $nombre = $this->input->post('nombre');
        $correo = $this->input->post('correo');

        $jData['error'] = 1;
        if($correo!=''&& $nombre!=''){
            $pData['nombre'] = $nombre;
            $pData['correo'] = $correo;
            $pData['status'] = 1;

            if($this->mnewsletter->checkMail($correo)){
                //el correo ya existe
            }else{
                $id = $this->mnewsletter->insertar($pData);
            }

            //enviando correo
            $this->load->library('email');

            $mensaje = "".
                "Nuevo suscriptor. <br> nombre: ".$nombre." <br>correo: ".$correo;

                $this->load->library('email');
                $this->email->set_mailtype("html");
                $this->email->from('ventas@antesala.com.mx', 'Antesala');
                $this->email->to("pedro@navegantes");
                $this->email->subject('Antesala - Newsletter');
                $this->email->message($mensaje);

                $this->email->send();
                $this->email->clear(true);

                $this->email->set_mailtype("html");
                $this->email->from('ventas@antesala.com.mx', 'Antesala');
                $this->email->to('jesus@navegantes.mx');
                $this->email->subject('Antesala - Newsletter');
                $this->email->message($mensaje);
                $this->email->send();

                $this->email->clear();
                $this->email->set_mailtype("html");
                $this->email->from('ventas@antesala.com.mx', 'Antesala');
                $this->email->to('aviles1189@gmail.com');
                $this->email->subject('Antesala - Newsletter');
                $this->email->message($mensaje);
                $this->email->send();


                $this->email->clear();
                $this->email->set_mailtype("html");
                $this->email->from('Antesala');
                $this->email->to('ventas@antesala.com.mx');
                $this->email->subject('Antesala - Newsletter');
                $this->email->message($mensaje);
                $this->email->send();

            $jData['error'] = 0;
        }
        $data = json_encode($jData);
        echo $data;


    }


}
