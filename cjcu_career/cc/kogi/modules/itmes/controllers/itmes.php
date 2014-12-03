<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class itmes extends Front_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
		$this->load->model('itmes_model', null, true);
		$this->lang->load('itmes');
		
		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		Template::set('records', $this->itmes_model->find_all());
		Template::render();
	}
	
	//--------------------------------------------------------------------



}