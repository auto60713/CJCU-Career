<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class settings extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('College.Settings.View');
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
		Assets::add_js($this->load->view('settings/js', null, true), 'inline');
		//Template::set('dept',$this->college_model->find_dept(1));
		Template::set('records', $this->college_model->find_all());
		Template::set('toolbar_title', "使用者單位維護");
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: create()
		
		Creates a college object.
	*/
	public function create() 
	{
		$this->auth->restrict('College.Settings.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_college())
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('college_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'college');
					
				Template::set_message(lang("college_create_success"), 'success');
				Template::redirect(SITE_AREA .'/settings/college');
			}
			else 
			{
				Template::set_message(lang('college_create_failure') . $this->college_model->error, 'error');
			}
		}
	
		Template::set('toolbar_title', lang('college_create_new_button'));
		Template::set('toolbar_title', lang('college_create') . ' college');
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: edit()
		
		Allows editing of college data.
	*/
	public function edit() 
	{
		$this->auth->restrict('College.Settings.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang('college_invalid_id'), 'error');
			redirect(SITE_AREA .'/settings/college');
		}
	
		if ($this->input->post('submit'))
		{
			if ($this->save_college('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('college_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'college');
					
				Template::set_message(lang('college_edit_success'), 'success');
				redirect(SITE_AREA .'/settings/college');
			}
			else 
			{
				Template::set_message(lang('college_edit_failure') . $this->college_model->error, 'error');
				
			}
		}
		
		Template::set('college', $this->college_model->find($id));
		Template::set('dept',$this->college_model->find_dept($id));
		Template::set('toolbar_title', lang('college_edit_heading'));
		Template::set('toolbar_title', lang('college_edit') . ' college');
		Template::render();		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: delete()
		
		Allows deleting of college data.
	*/
	public function delete() 
	{	
		$this->auth->restrict('College.Settings.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->college_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('college_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'college');
					
				Template::set_message(lang('college_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('college_delete_failure') . $this->college_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA .'/settings/college');
	}
	
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	/*
		Method: save_college()
		
		Does the actual validation and saving of form data.
		
		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.
		
		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_college($type='insert', $id=0) 
	{	
					
		$this->form_validation->set_rules('name','Name','required|max_length[50]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['name']        = $this->input->post('name');
		$data['college_description']        = $this->input->post('college_description');
		if ($type == 'insert')
		{
			$id = $this->college_model->insert($data);
			
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
			$return = $this->college_model->update($id, $data);
		}
		
		return $return;
	}

	//--------------------------------------------------------------------
	public function add_dept() 
	{
		$this->auth->restrict('College.Settings.Create');
		$check_id = $this->uri->segment(5);
		if ($this->input->post('submit'))
		{
			if ($seg=$this->save_dept())
			{
				Template::set_message('系所新增成功', 'success');
				redirect(SITE_AREA .'/settings/college/edit/'.$seg);
			}
			else 
			{
				Template::set_message('錯誤', 'error');
				redirect(SITE_AREA .'/settings/college');
			}
		}
		
		Template::set('check',$check_id);
		Template::render();	
	}
	
	//--------------------------------------------------------------------
	private function save_dept()
	{
		$data = array();
		$data['id']=0;
		$data['dept_name']   = $this->input->post('dept_name');
		$data['college_id'] =$this->input->post('id');
		if($this->db->insert('dept', $data))
		{
			return $data['college_id'];
		}
		else
		{	
		return FALSE;
		}
	}
	//--------------------------------------------------------------------
	
	public function edit_deptname()
	{
		$this->auth->restrict('College.Settings.Edit');
		$check_id = (int)$this->uri->segment(5);
		if ($this->input->post('submit'))
		{
			if ($id=$this->modify_dept_single())
			{
				Template::set_message('系所資料編輯成功', 'success');
				redirect(SITE_AREA .'/settings/college/edit/'.$id);
			}
			else 
			{
				Template::set_message('錯誤', 'error');
				redirect(SITE_AREA .'/settings/college');
			}
		}
		Template::set('dept',$this->dept_single($check_id));
		Template::render();	
	}
	//--------------------------------------------------------------------
	private function dept_single($id='')
	{
		$get=$this->db->get_where('nc_dept', array('id' => $id));
		if($get->num_rows() ==1)
		{
		return $get->row();
		}
		else {
			return NULL;
		}
	}
	private function modify_dept_single()
	{
		$this->auth->restrict('College.Settings.Edit');
		$dept=array(
			'dept_name'=>$this->input->post('dept_name'),
			'college_id' =>$this->input->post('college_id')
		);
		$this->db->where('id', $this->input->post('id'));
		if($this->db->update('nc_dept', $dept))
		{
		return $dept['college_id'];
		}
		else 
		{
			return NULL;
		}
	}
	//--------------------------------------------------------------------
	public function del_dept()
	{
		$this->auth->restrict('College.Settings.Delete');
		$check_id = (int)$this->uri->segment(5);
		$college=(int)$this->uri->segment(6);
		$this->db->where('id',$check_id);
		if($this->db->delete('nc_dept'))
		{
			Template::set_message('系所資料編輯成功', 'success');
			redirect(SITE_AREA .'/settings/college/edit/'.$college);
		}
		else {
			Template::set_message('錯誤', 'error');
				redirect(SITE_AREA .'/settings/college/edit/'.$college);
		}
	}
}