<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Error extends MY_Controller {
        public function __construct(){
            parent::__construct();
            $this->fv = 'error';
            $this->mainView = 'error';
            $this->data = array(
                /* Parametros SEO */
                'meta_tags' => array(
                    'meta_description' => '',
                    'meta_keywords' => 'Antesala, Inmobiliaria',
                    'meta_robots' => $this->meta_robots,
                    'meta_rating' => $this->meta_rating,
                    'meta_distribution' => $this->meta_distribution,
                    'meta_copyright' => $this->meta_copyright,
                    'meta_author' => $this->meta_author
                ),
                'titulo' => 'Antesala - Página no encontrada',
                'fjs' => array(),
                'raw_fjs' => '',
                'raw_js' => '',
                'js' => array(),
                'css' => array('css/error_404.css')
            );

            // Tools
            $this->load->helper(array('tools','url','date','text'));
            // Modelos
             $this->load->model(array());
            // Lbrerias
            // $this->load->library(array('email','session'));
            // Debugging
            // $this->output->enable_profiler(TRUE);
	    }

        public function error_404(){
            // $this->output->set_status_header('404');
            $this->data['contenido']= $this->load->view('errors/404_view',null,true);
            $this->load->view('templates/error_template',$this->data);
	    }
    }