<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class college extends Front_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
		$this->load->model('college_model', null, true);
		$this->lang->load('college');
		
		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		Template::set('records', $this->college_model->find_all());
		Template::render();
	}
	
	//--------------------------------------------------------------------



}