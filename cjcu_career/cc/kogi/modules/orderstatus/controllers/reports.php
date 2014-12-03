<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class reports extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('Orderstatus.Reports.View');
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
		Assets::add_js($this->load->view('reports/js', null, true), 'inline');
		
		Template::set('records', $this->orderstatus_model->find_all());
		Template::set('toolbar_title', "Manage orderstatus");
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: create()
		
		Creates a orderstatus object.
	*/
	public function create() 
	{
		$this->auth->restrict('Orderstatus.Reports.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_orderstatus())
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('orderstatus_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'orderstatus');
					
				Template::set_message(lang("orderstatus_create_success"), 'success');
				Template::redirect(SITE_AREA .'/reports/orderstatus');
			}
			else 
			{
				Template::set_message(lang('orderstatus_create_failure') . $this->orderstatus_model->error, 'error');
			}
		}
	
		Template::set('toolbar_title', lang('orderstatus_create_new_button'));
		Template::set('toolbar_title', lang('orderstatus_create') . ' orderstatus');
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: edit()
		
		Allows editing of orderstatus data.
	*/
	public function edit() 
	{
		$this->auth->restrict('Orderstatus.Reports.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang('orderstatus_invalid_id'), 'error');
			redirect(SITE_AREA .'/reports/orderstatus');
		}
	
		if ($this->input->post('submit'))
		{
			if ($this->save_orderstatus('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('orderstatus_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'orderstatus');
					
				Template::set_message(lang('orderstatus_edit_success'), 'success');
			}
			else 
			{
				Template::set_message(lang('orderstatus_edit_failure') . $this->orderstatus_model->error, 'error');
			}
		}
		
		Template::set('orderstatus', $this->orderstatus_model->find($id));
	
		Template::set('toolbar_title', lang('orderstatus_edit_heading'));
		Template::set('toolbar_title', lang('orderstatus_edit') . ' orderstatus');
		Template::render();		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: delete()
		
		Allows deleting of orderstatus data.
	*/
	public function delete() 
	{	
		$this->auth->restrict('Orderstatus.Reports.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->orderstatus_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('orderstatus_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'orderstatus');
					
				Template::set_message(lang('orderstatus_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('orderstatus_delete_failure') . $this->orderstatus_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA .'/reports/orderstatus');
	}
	
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	/*
		Method: save_orderstatus()
		
		Does the actual validation and saving of form data.
		
		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.
		
		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_orderstatus($type='insert', $id=0) 
	{	
					
		$this->form_validation->set_rules('name','Name','required|max_length[20]');			
		$this->form_validation->set_rules('description','Description','max_length[255]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['name']        = $this->input->post('name');
		$data['description']        = $this->input->post('description');
		
		if ($type == 'insert')
		{
			$id = $this->orderstatus_model->insert($data);
			
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
			$return = $this->orderstatus_model->update($id, $data);
		}
		
		return $return;
	}

	//--------------------------------------------------------------------



}