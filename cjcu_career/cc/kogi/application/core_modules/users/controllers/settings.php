<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
	Copyright (c) 2011 Lonnie Ezell

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:
	
	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.
	
	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/

class Settings extends Admin_Controller {

	//--------------------------------------------------------------------
	
	public function __construct() 
	{
		parent::__construct();
		
		$this->auth->restrict('Site.Settings.View');
		$this->auth->restrict('Bonfire.Users.View');
		Assets::add_css('flick/jquery-wijmo.css');
		$this->load->model('roles/role_model');
		Assets::add_css('flick/jquery.ui.autocomplete.css');
		$this->lang->load('users');
		
	}
	
	//--------------------------------------------------------------------

	public function _remap($method) 
	{ 
		if (method_exists($this, $method))
		{
			$this->$method();
		}
	}
	
	//--------------------------------------------------------------------
	
	public function index() 
	{
		$offset = $this->uri->segment(4);
	
		Assets::add_js($this->load->view('settings/users_js', null, true), 'inline');
		
		$total_users = $this->user_model->count_all();
	
		$this->pager['base_url'] = site_url(SITE_AREA .'/settings/users/index');
		$this->pager['total_rows'] = $total_users;
		$this->pager['per_page'] = $this->limit;
		$this->pager['uri_segment']	= 4;
		
		$this->pagination->initialize($this->pager);
		
		// Was a filter set?
		if ($this->input->post('filter_submit') && $this->input->post('filter_by_role_id'))
		{
			$role_id = $this->input->post('filter_by_role_id');
			
			$this->db->where('role_id', $role_id);
			Template::set('filter', $role_id);
		}
		
		if (config_item('auth.use_usernames'))
		{ 
			$this->db->order_by('username', 'asc');
		} else
		{
			$this->db->order_by('email', 'asc');
		}
	
		Template::set('users', $this->user_model->find_all());
		Template::set('total_users', $total_users);
		Template::set('deleted_users', $this->user_model->count_all(true));
		Template::set('roles', $this->role_model->select('role_id, role_name, default')->find_all());
		
		Template::set('user_count', $this->user_model->count_all());
		
		Template::set('login_attempts', $this->user_model->get_login_attempts($this->limit) );
	
		$this->load->helper('ui/ui');
	
		Template::set('toolbar_title', lang('us_user_management'));
		Template::render();
	}
	
	//--------------------------------------------------------------------
	
	public function create() 
	{
		$this->auth->restrict('Bonfire.Users.Add');
	
		$this->load->config('address');
		$this->load->helper('address');
	
		if ($this->input->post('submit'))
		{
			if ($id = $this->save_user())
			{
				$user = $this->user_model->find($id);
				$log_name = $this->settings_lib->item('auth.use_own_names') ? $this->auth->user_name() : ($this->settings_lib->item('auth.use_usernames') ? $user->username : $user->email);
				$this->activity_model->log_activity($this->auth->user_id(), lang('us_log_create').' '. $user->role_name . ': '.$log_name, 'users');
				
				Template::set_message('使用者新增成功', 'success');
				Template::redirect(SITE_AREA .'/settings/users');
			}
			else 
			{
				Template::set_message('出現錯誤，請參考以下資訊: '. $this->user_model->error);
			}
		}
		
		Template::set('roles', $this->role_model->select('role_id, role_name, default')->find_all());
		Template::set('dept',$this->get_dept());
		Template::set('toolbar_title', lang('us_create_user'));
		Template::set_view('settings/user_form');
		Template::render();
	}
	
	//--------------------------------------------------------------------
	
	public function edit() 
	{
		$this->auth->restrict('Bonfire.Users.Manage');
		$this->load->config('address');
		$this->load->helper('address');
		Assets::add_js($this->load->view('settings/users_js', null, true), 'inline');
		$user_id = $this->uri->segment(5);
		if (empty($user_id))
		{
			Template::set_message(lang('us_empty_id'), 'error');
			redirect(SITE_AREA .'/settings/users');			
		}
		
		if ($this->input->post('submit'))
		{
			if ($this->save_user('update', $user_id))
			{
				$user = $this->user_model->find($user_id);
				$log_name = $this->settings_lib->item('auth.use_own_names') ? $this->auth->user_name() : ($this->settings_lib->item('auth.use_usernames') ? $user->username : $user->email);
				$this->activity_model->log_activity($this->auth->user_id(), lang('us_log_edit') .': '.$log_name, 'users');
			
				Template::set_message('資料更新成功', 'success');
			}
			else 
			{
				Template::set_message('發生錯誤，請參考以下資訊: '. $this->user_model->error);
			}
		}
		
		$user = $this->user_model->find($user_id);
		if (isset($user) && has_permission('Permissions.'.$user->role_name.'.Manage'))
		{
			Template::set('user', $user);
			Template::set('roles', $this->role_model->select('role_id, role_name, default')->find_all());
			Template::set_view('settings/user_form');
		}
		else
		{
			Template::set_message(sprintf(lang('us_unauthorized'),$user->role_name), 'error');
			redirect(SITE_AREA .'/settings/users');			
		}
		Template::set('dept',$this->get_dept());
		Template::set('toolbar_title', lang('us_edit_user'));
		Template::set_block('sub_nav', 'settings/_sub_nav');
		Template::render();
	}
	//--------------------------------------------------------------------
	
	public function view() 
	{
		$this->auth->restrict('Bonfire.Users.Manage');
		$this->load->config('address');
		$this->load->helper('address');
		
		$user_id = $this->uri->segment(5);
		if (empty($user_id))
		{
			Template::set_message(lang('us_empty_id'), 'error');
			redirect(SITE_AREA .'/settings/users');			
		}	
		$user = $this->user_model->find($user_id);
		if (isset($user) && has_permission('Permissions.'.$user->role_name.'.Manage'))
		{
			Template::set('user', $user);
			Template::set('roles', $this->role_model->select('role_id, role_name, default')->find_all());
			Template::set_view('settings/view');
		}
		else
		{
			Template::set_message(sprintf(lang('us_unauthorized'),$user->role_name), 'error');
			redirect(SITE_AREA .'/settings/users');			
		}
		
		Template::set('toolbar_title', '檢視');		
		Template::set('dept', $this->get_dept());
		Template::set_block('sub_nav', 'settings/_sub_nav');
		Template::render();
	}

	//--------------------------------------------------------------------
	
	public function delete() 
	{	
		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			$this->auth->restrict('Bonfire.Users.Manage');
		
			$user = $this->user_model->find($id);
			if (isset($user) && has_permission('Permissions.'.$user->role_name.'.Manage') && $user->id != $this->auth->user_id())
			{
				if ($this->user_model->delete($id))
				{
					$user = $this->user_model->find($id);
					$log_name = $this->settings_lib->item('auth.use_own_names') ? $this->auth->user_name() : ($this->settings_lib->item('auth.use_usernames') ? $user->username : $user->email);
					$this->activity_model->log_activity($this->auth->user_id(), lang('us_log_delete') . ': '.$log_name, 'users');
					Template::set_message('使用者刪除成功', 'success');
				}
				else
				{
					Template::set_message('發生錯誤，請參考以下資訊: '. $this->user_model->error, 'success');
				}							
			}
			else
			{
				if ($user->id == $this->auth->user_id())
				{
					Template::set_message(lang('us_self_delete'), 'error');
				}
				else
				{
					Template::set_message(sprintf(lang('us_unauthorized'),$user->role_name), 'error');	
				}				
			}
		}
		else
		{
			Template::set_message(lang('us_empty_id'), 'error');
		}
		
		redirect(SITE_AREA .'/settings/users');
	}
	
	//--------------------------------------------------------------------
	
	public function deleted() 
	{
		$this->db->where('users.deleted !=', 0);
		Template::set('users', $this->user_model->find_all(true));
	
		Template::render();
	}
	
	//--------------------------------------------------------------------
	
	public function purge() 
	{
		$user_id = $this->uri->segment(5);
		
		// Handle a single-user purge
		if (!empty($user_id) && is_numeric($user_id))
		{
			$this->user_model->delete($user_id, true);	
		}
		// Handle purging all deleted users...
		else
		{
			// Find all deleted accounts
			$users = $this->user_model->where('users.deleted', 1)
									  ->find_all(true);
		
			if (is_array($users))
			{
				foreach ($users as $user)
				{
					$this->user_model->delete($user->id, true);
				}
			}
		}
		
		Template::set_message('清除成功', 'success');
		
		Template::redirect(SITE_AREA .'/settings/users');
	}
	
	//--------------------------------------------------------------------
	
	public function restore() 
	{
		$id = $this->uri->segment(5);
		
		if ($this->user_model->update($id, array('users.deleted'=>0)))
		{
			Template::set_message('使用者還原成功', 'success');
		}
		else
		{
			Template::set_message('發生錯誤，請參考以下資訊: '. $this->user_model->error, 'error');
		}
		
		Template::redirect(SITE_AREA .'/settings/users');
	}
	
	//--------------------------------------------------------------------
	
	
	//--------------------------------------------------------------------
	// !HMVC METHODS
	//--------------------------------------------------------------------
	
	public function access_logs($limit=15) 
	{
		$logs = $this->user_model->get_access_logs($limit);
		
		return $this->load->view('settings/access_logs', array('access_logs' => $logs), true);
	}
	
	//--------------------------------------------------------------------
	
	
		
	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	public function unique_email($str) 
	{	
		if ($this->user_model->is_unique('email', $str))
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('unique_email', lang('us_email_in_use'));
			return false;
		}
	}
	
	//--------------------------------------------------------------------
	
	private function save_user($type='insert', $id=0) 
	{
		$db_prefix = $this->db->dbprefix;
		
		if ($type == 'insert')
		{
			$this->form_validation->set_rules('email', 'Email', 'required|trim|callback_unique_email|valid_email|max_length[120]|xss_clean');
			$this->form_validation->set_rules('password', '密碼', 'required|trim|strip_tags|max_length[40]|xss_clean');
			$this->form_validation->set_rules('pass_confirm', '重新輸入密碼', 'required|trim|strip_tags|matches[password]|xss_clean');
		} else 
		{
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|max_length[120]|xss_clean');
			$this->form_validation->set_rules('password', '密碼', 'trim|strip_tags|max_length[40]|xss_clean');
			$this->form_validation->set_rules('pass_confirm', '重新輸入密碼', 'trim|strip_tags|matches[password]|xss_clean');
		}
		
		if ($this->settings_lib->item('auth.use_usernames'))
		{
			$_POST['id'] = $id;
			$this->form_validation->set_rules('username', '使用者帳號', 'required|trim|strip_tags|max_length[30]|unique['.$db_prefix.'users.username,'.$db_prefix.'users.id]|xsx_clean');
		}
		
		$required = false;
		if ($this->settings_lib->item('auth.use_own_names'))
		{
			$required = 'required|';
		} 
		$this->form_validation->set_rules('first_name', lang('us_first_name'), $required.'trim|strip_tags|max_length[20]|xss_clean');
		$this->form_validation->set_rules('last_name', lang('us_last_name'), $required.'trim|strip_tags|max_length[20]|xss_clean');
		
		if  ( ! $this->settings_lib->item('auth.use_extended_profile'))
		{
			$this->form_validation->set_rules('street1', 'Street 1', 'trim|strip_tags|xss_clean');
			$this->form_validation->set_rules('street2', 'Street 2', 'trim|strip_tags|xss_clean');
			$this->form_validation->set_rules('city', 'City', 'trim|strip_tags|xss_clean');
			$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|strip_tags|max_length[20]|xss_clean');
		}
		if ($this->form_validation->run() === false)
		{
			return false;
		}
		
		if ($type == 'insert')
		{
			return $this->user_model->insert($_POST);
		}
		else	// Update
		{	
			return $this->user_model->update($id, $_POST);
		}
	}
	
	//--------------------------------------------------------------------
	private function uploads() 
	{
		$this->auth->restrict('Bonfire.Users.Manage');
		$config=array();
		$config['upload_path'] = './user_img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2048';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$this->load->library('upload',$config);
		
		if ($this->input->post('upload'))
		{
			$user_id = $this->input->post('id');
			
			if ( ! $this->upload->do_upload())
				{
					Template::set_message($this->upload->display_errors() , 'error');
					redirect(SITE_AREA .'/settings/users/'); 
				}
			else
				{
					$path=$this->upload->data();
					
					$image_config['image_library'] = 'gd2';
					$image_config['source_image'] = $path['full_path'];
					$image_config['create_thumb'] = FALSE;
					$image_config['maintain_ratio'] = TRUE;
					$image_config['width'] = 128;
					$image_config['height'] = 128;
					$this->load->library('image_lib', $image_config);
					
							if ( ! $this->image_lib->resize())
							{
							    Template::set_message($this->image_lib->display_errors(),'error');
							}
							else {
								$data= array('photo'=>$path['file_name']);
								$this->db->where('id',$user_id);
		 						$this->db->update('users',$data);
							}
					Template::set_message('上傳成功！', 'success');
					redirect(SITE_AREA .'/settings/users/'); 
				}
		}		
	}
	private function get_dept()
	{
		$query = $this->db->get('dept');
		
		if ($query->num_rows() > 0)
		{
		  return $query->result_array();
		}
		else {
			return null;
		}
	}
}

// End User Admin class