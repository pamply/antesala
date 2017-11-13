<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class catalogo extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->fv = 'catalogo';
        $this->mainView = 'catalogo';
        $this->data = array(
            'meta_tags' => array(
                'meta_description' => 'Somos una empresa que contribuye a mejorar la calidad de vida de las personas a través de los servicios relacionados en la construcción. ',
                'meta_keywords' => 'BARCAM, Inmobiliaria, Acabados, Constructora',
                'meta_robots' => $this->meta_robots,
                'meta_rating' => $this->meta_rating,
                'meta_distribution' => $this->meta_distribution,
                'meta_copyright' => $this->meta_copyright,
                'meta_author' => $this->meta_author
            ),
            'titulo' => '',
            'fjs' => array(),
            'raw_fjs' => '',
            'raw_js' => "",
            'js' => array(''),
            'css' => array('css/inicio.css')
        );
        $this->load->helper(array('tools','url','date','text','html2text'));
        $this->load->model(array('mpropiedad'));

    }

    public function index(){
        $data = array();
        $data['propiedades'] = $this->mpropiedad->getRecents();
        $data['sliders'] = $this->mpropiedad->getSliders();
        $this->data['contenido'] = $this->load->view($this->mainView.'/index_view',$data,true);
        $this->load->view('templates/main_template',$this->data);
    }


}
