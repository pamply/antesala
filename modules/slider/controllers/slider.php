<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class slider extends MX_Controller {

	public $data, $user;

	public function __construct()
	{
		parent::__construct();
        $this->fv = 'slider';
		$this->load->helper(array('url','captcha'));
		$this->load->model(array('mslider_principal'));

    }

	public function index()
	{
        $data = array();
        $view = 'index_view';
        $data['slider'] = $this->mslider_principal->getAll();
        $this->load->view('slider/'.$view,$data);

	}



}
