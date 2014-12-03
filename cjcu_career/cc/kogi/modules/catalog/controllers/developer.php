<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class developer extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('Catalog.Developer.View');
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
		Assets::add_js($this->load->view('developer/js', null, true), 'inline');
		
		Template::set('records', $this->catalog_model->find_all());
		Template::set('toolbar_title', "管理文章分類");
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: create()
		
		Creates a catalog object.
	*/
	public function create() 
	{
		$this->auth->restrict('Catalog.Developer.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_catalog())
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('catalog_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'catalog');
					
				Template::set_message(lang("catalog_create_success"), 'success');
				Template::redirect(SITE_AREA .'/developer/catalog');
			}
			else 
			{
				Template::set_message(lang('catalog_create_failure') . $this->catalog_model->error, 'error');
			}
		}
	
		Template::set('toolbar_title', lang('catalog_create_new_button'));
		Template::set('toolbar_title', lang('catalog_create') . '文章分類');
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: edit()
		
		Allows editing of catalog data.
	*/
	public function edit() 
	{
		$this->auth->restrict('Catalog.Developer.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang('catalog_invalid_id'), 'error');
			redirect(SITE_AREA .'/developer/catalog');
		}
	
		if ($this->input->post('submit'))
		{
			if ($this->save_catalog('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('catalog_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'catalog');
					
				Template::set_message(lang('catalog_edit_success'), 'success');
			}
			else 
			{
				Template::set_message(lang('catalog_edit_failure') . $this->catalog_model->error, 'error');
			}
		}
		
		Template::set('catalog', $this->catalog_model->find($id));
	
		Template::set('toolbar_title', lang('catalog_edit_heading'));
		Template::set('toolbar_title', lang('catalog_edit') . '文章分類');
		Template::render();		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: delete()
		
		Allows deleting of catalog data.
	*/
	public function delete() 
	{	
		$this->auth->restrict('Catalog.Developer.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->catalog_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('catalog_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'catalog');
					
				Template::set_message(lang('catalog_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('catalog_delete_failure') . $this->catalog_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA .'/developer/catalog');
	}
	
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	/*
		Method: save_catalog()
		
		Does the actual validation and saving of form data.
		
		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.
		
		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_catalog($type='insert', $id=0) 
	{	
					
		$this->form_validation->set_rules('catalog','Catalog','required|max_length[20]');			
		$this->form_validation->set_rules('sort','Sort','max_length[2]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['catalog']        = $this->input->post('catalog');
		$data['sort']        = $this->input->post('sort');
		
		if ($type == 'insert')
		{
			$id = $this->catalog_model->insert($data);
			
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
			$return = $this->catalog_model->update($id, $data);
		}
		
		return $return;
	}

	//--------------------------------------------------------------------



}