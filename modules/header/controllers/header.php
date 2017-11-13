<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class header extends MX_Controller {

	public $data,$user;
	
	public function __construct()
	{
		parent::__construct();		
		$this->load->model(array('mtipopropiedad'));		
		$this->load->helper(array('url','tools'));

	}
	
	public function index()
	{
	    $data['seccion'] = $seccion = $this->uri->segment(1);
	    $data['menu'] = $seccion = $this->uri->segment(2);
	    $data['q'] = $this->mtipopropiedad->getAll();
	    $view = 'index_view';
		$this->load->view('header/'.$view,$data);
	}


}