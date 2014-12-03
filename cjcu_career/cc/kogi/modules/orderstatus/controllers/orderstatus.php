<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class orderstatus extends Front_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
		$this->load->model('orderstatus_model', null, true);
		$this->lang->load('orderstatus');
		
		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		Template::set('records', $this->orderstatus_model->find_all());
		Template::render();
	}
	
	//--------------------------------------------------------------------



}