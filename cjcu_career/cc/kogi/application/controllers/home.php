<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Front_Controller {

	//--------------------------------------------------------------------
	
	public function index() 
	{
		$this->load->helper('form');
		if (!class_exists('User_model'))
		{
			$this->load->model('users/User_model', 'user_model');
		}
		$this->load->library('users/auth');
		if ($this->auth->is_logged_in() === FALSE)
		{
			$this->auth->logout();
			redirect('login');
		}
		Template::render();
	}
}