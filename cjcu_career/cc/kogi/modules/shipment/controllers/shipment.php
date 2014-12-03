<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class shipment extends Front_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
		$this->load->model('shipment_model', null, true);
		$this->lang->load('shipment');
		
		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		Template::set('records', $this->shipment_model->find_all());
		Template::render();
	}
	
	//--------------------------------------------------------------------



}