<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('Itmes.Content.View');
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
		Assets::add_js($this->load->view('content/js', null, true), 'inline');
		
		Template::set('records', $this->itmes_model->find_all());
		Template::set('toolbar_title', lang('itmes_manage'));
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: create()
		
		Creates a itmes object.
	*/
	public function create() 
	{
		$this->auth->restrict('Itmes.Content.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_itmes())
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('itmes_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'itmes');
					
				Template::set_message(lang("itmes_create_success"), 'success');
				Template::redirect(SITE_AREA .'/content/itmes');
			}
			else 
			{
				Template::set_message(lang('itmes_create_failure') . $this->itmes_model->error, 'error');
			}
		}
	
		Template::set('toolbar_title', lang('itmes_create_new_button'));
		Template::set('toolbar_title', lang('itmes_create') . '申請項目');
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: edit()
		
		Allows editing of itmes data.
	*/
	public function edit() 
	{
		$this->auth->restrict('Itmes.Content.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang('itmes_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/itmes');
		}
	
		if ($this->input->post('submit'))
		{
			if ($this->save_itmes('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('itmes_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'itmes');
					
				Template::set_message(lang('itmes_edit_success'), 'success');
			}
			else 
			{
				Template::set_message(lang('itmes_edit_failure') . $this->itmes_model->error, 'error');
			}
		}
		
		Template::set('itmes', $this->itmes_model->find($id));
	
		Template::set('toolbar_title', lang('itmes_edit_heading'));
		Template::set('toolbar_title', lang('itmes_edit') . '申請項目');
		Template::render();		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: delete()
		
		Allows deleting of itmes data.
	*/
	public function delete() 
	{	
		$this->auth->restrict('Itmes.Content.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->itmes_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('itmes_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'itmes');
					
				Template::set_message(lang('itmes_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('itmes_delete_failure') . $this->itmes_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA .'/content/itmes');
	}
	
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	/*
		Method: save_itmes()
		
		Does the actual validation and saving of form data.
		
		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.
		
		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_itmes($type='insert', $id=0) 
	{	
					
		$this->form_validation->set_rules('name','Name','required|max_length[30]');			
		$this->form_validation->set_rules('price','Price','required|max_length[11]');			
		$this->form_validation->set_rules('working_day','Working Day','required|max_length[2]');			
		$this->form_validation->set_rules('notice','Notice','max_length[50]');			
		$this->form_validation->set_rules('remark','Remark','max_length[100]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['name']        = $this->input->post('name');
		$data['price']        = $this->input->post('price');
		$data['working_day']        = $this->input->post('working_day');
		$data['notice']        = $this->input->post('notice');
		$data['remark']        = $this->input->post('remark');
		
		if ($type == 'insert')
		{
			$id = $this->itmes_model->insert($data);
			
			if (is_numeric($id))
			{
				$return = $id;
			} else
			{
				$return = FALSE;
			}
		}
		else if ($type == 'update')
		{
			$return = $this->itmes_model->update($id, $data);
		}
		
		return $return;
	}

	//--------------------------------------------------------------------



}