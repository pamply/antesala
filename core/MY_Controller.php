<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class MY_Controller extends MX_Controller {
        public $data, $vParameters;
        public function __construct(){
            parent::__construct();
            /* Parametros SEO */
            $this->meta_description = '';
            $this->meta_keywords    = '';
            $this->meta_robots = 'index,follow';
            $this->meta_rating = 'GENERAL';
            $this->meta_distribution  = 'GLOBAL';
            $this->meta_copyright = 'Barcam';
            $this->meta_author = 'NAVEGANTE';
            $this->data['meta_tags'] = array(
                'meta_description' => $this->meta_description,
                'meta_keywords' => $this->meta_keywords ,
                'meta_robots' => $this->meta_robots,
                'meta_rating' => $this->meta_rating,
                'meta_distribution' => $this->meta_distribution,
                'meta_copyright' => $this->meta_copyright,
                'meta_author' => $this->meta_author
            );
            $this->data['vistaClase'] = 'index';

        }
    }
