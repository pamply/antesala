<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class footer extends MX_Controller {

	public $data, $user;
	
	public function __construct()
	{
		parent::__construct();
        $this->fv = 'footer';			
		$this->load->helper(array('url','captcha'));


    }
	
	public function index()
	{

        $view = 'index_view';
        $cData[''] = '';
        $this->load->view('footer/'.$view,$cData);

	}


}
