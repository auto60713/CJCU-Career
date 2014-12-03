<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class developer extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('Shipment.Developer.View');
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
		Assets::add_js($this->load->view('developer/js', null, true), 'inline');
		
		Template::set('records', $this->shipment_model->find_all());
		Template::set('toolbar_title', "Manage shipment");
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: create()
		
		Creates a shipment object.
	*/
	public function create() 
	{
		$this->auth->restrict('Shipment.Developer.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_shipment())
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('shipment_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'shipment');
					
				Template::set_message(lang("shipment_create_success"), 'success');
				Template::redirect(SITE_AREA .'/developer/shipment');
			}
			else 
			{
				Template::set_message(lang('shipment_create_failure') . $this->shipment_model->error, 'error');
			}
		}
	
		Template::set('toolbar_title', lang('shipment_create_new_button'));
		Template::set('toolbar_title', lang('shipment_create') . ' shipment');
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: edit()
		
		Allows editing of shipment data.
	*/
	public function edit() 
	{
		$this->auth->restrict('Shipment.Developer.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang('shipment_invalid_id'), 'error');
			redirect(SITE_AREA .'/developer/shipment');
		}
	
		if ($this->input->post('submit'))
		{
			if ($this->save_shipment('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('shipment_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'shipment');
					
				Template::set_message(lang('shipment_edit_success'), 'success');
			}
			else 
			{
				Template::set_message(lang('shipment_edit_failure') . $this->shipment_model->error, 'error');
			}
		}
		
		Template::set('shipment', $this->shipment_model->find($id));
	
		Template::set('toolbar_title', lang('shipment_edit_heading'));
		Template::set('toolbar_title', lang('shipment_edit') . ' shipment');
		Template::render();		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: delete()
		
		Allows deleting of shipment data.
	*/
	public function delete() 
	{	
		$this->auth->restrict('Shipment.Developer.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->shipment_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('shipment_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'shipment');
					
				Template::set_message(lang('shipment_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('shipment_delete_failure') . $this->shipment_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA .'/developer/shipment');
	}
	
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	/*
		Method: save_shipment()
		
		Does the actual validation and saving of form data.
		
		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.
		
		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_shipment($type='insert', $id=0) 
	{	
					
		$this->form_validation->set_rules('method','Method','required|max_length[20]');			
		$this->form_validation->set_rules('fee','Fee','required|max_length[3]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['method']        = $this->input->post('method');
		$data['fee']        = $this->input->post('fee');
		
		if ($type == 'insert')
		{
			$id = $this->shipment_model->insert($data);
			
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
			$return = $this->shipment_model->update($id, $data);
		}
		
		return $return;
	}

	//--------------------------------------------------------------------



}