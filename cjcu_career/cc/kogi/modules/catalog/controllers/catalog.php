<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class catalog extends Front_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
		$this->load->model('catalog_model', null, true);
		$this->lang->load('catalog');
		
		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		$records=$this->catalog_model->find_all();
		if(!isset($records)){
			redirect(base_url().'../index.html');
		}
		ob_start();
		echo json_encode($records);
	}
	
	//--------------------------------------------------------------------



}