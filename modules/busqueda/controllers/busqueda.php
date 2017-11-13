<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class busqueda extends MX_Controller {

	public $data, $user;
	
	public function __construct()
	{
		parent::__construct();
        $this->fv = 'busqueda';
		$this->load->helper(array('url','captcha'));
        $this->load->model(array('mtipopropiedad'));
        $this->load->model(array('moperacion'));
        $this->load->model(array('mestado'));

    }
	
	public function index()
	{

        $view = 'index_view';
        $cData[''] = '';
        $cData['seccion'] = $seccion = $this->uri->segment(1);
        $cData['tipo_propiedad'] = $this->mtipopropiedad->getAll();
        $cData['tipo_operacion'] = $this->moperacion->getAll();
        $cData['estado'] = $this->mestado->getAll();
        $cData['maxPrice'] = $this->mpropiedad->getMaxPrice()->row()->precio;
        $cData['minPrice'] = $this->mpropiedad->getMinPrice()->row()->precio;
        $this->load->view('busqueda/'.$view,$cData);

	}



}
