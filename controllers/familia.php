<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class familia extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->fv = 'familia';
        $this->mainView = 'familia';
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
        $this->load->view('templates/familia_template',$this->data);
    }

}
