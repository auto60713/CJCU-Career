<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class news extends Front_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
		$this->load->model('news_model', null, true);
		$this->lang->load('news');
		
		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		$sticky=$this->news_model->where('sticky',1)->find_all();
		if(!isset($sticky)){
			$sticky='no data';
		}
		ob_start();
		echo json_encode($sticky);
	}
	
	//--------------------------------------------------------------------

	/*公告一覽*/
	public function lists() 
	{
		$catalog_id = (int)$this->uri->segment(3);
		$records=$this->news_model->where('catalog',$catalog_id)->find_all();
		if(!isset($records)){
			redirect(base_url().'../index.php');
		}
		ob_start();
		echo json_encode($records);
	}

	//--------------------------------------------------------------------

	/*公告內容*/
	public function detail($id='') 
	{
		$id = (int)$this->uri->segment(3);
		$records=$this->news_model->find($id);
		if(!isset($records)){
			redirect(base_url().'../index.php');
		}
		ob_start();
		echo json_encode($records);
	}
	
	//--------------------------------------------------------------------


}