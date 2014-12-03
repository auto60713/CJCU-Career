<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class settings extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();
		Assets::add_js($this->load->view('settings/ajaxfileupload_js', null, true), 'inline');
		Assets::add_css('flick/jquery.ui.all.css');
		Assets::add_css('jquery-ui-timepicker.css');
		Assets::add_js('jquery-ui-timepicker-addon.js');
		$this->auth->restrict('News.Settings.View');
		$this->load->model('news_model', null, true);
		$this->load->model('catalog/catalog_model', null, true);
		$this->lang->load('news');
		
		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		Assets::add_js($this->load->view('settings/js', null, true), 'inline');
		
		Template::set('records', $this->news_model->find_all());
		Template::set('toolbar_title', "新聞稿管理");
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: create()
		
		Creates a News object.
	*/
	public function create() 
	{
		$this->auth->restrict('News.Settings.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_news())
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('news_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'news');
					
				Template::set_message(lang("news_create_success"), 'success');
				Template::redirect(SITE_AREA .'/settings/news');
			}
			else 
			{
				Template::set_message(lang('news_create_failure') . $this->news_model->error, 'error');
			}
		}
		Template::set('catalogs',$this->catalog_model->find_all());
		Template::set('toolbar_title', lang('news_create_new_button'));
		Template::set('toolbar_title', lang('news_create') . ' News');
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: edit()
		
		Allows editing of News data.
	*/
	public function edit() 
	{
		$this->auth->restrict('News.Settings.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang('news_invalid_id'), 'error');
			redirect(SITE_AREA .'/settings/news');
		}
	
		if ($this->input->post('submit'))
		{
			if ($this->save_news('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('news_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'news');
					
				Template::set_message(lang('news_edit_success'), 'success');
			}
			else 
			{
				Template::set_message(lang('news_edit_failure') . $this->news_model->error, 'error');
			}
		}
		
		Template::set('news', $this->news_model->find($id));
		Template::set('catalogs',$this->catalog_model->find_all());
		Template::set('toolbar_title', lang('news_edit_heading'));
		Template::set('toolbar_title', lang('news_edit') . ' News');
		Template::render();		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: delete()
		
		Allows deleting of News data.
	*/
	public function delete() 
	{	
		$this->auth->restrict('News.Settings.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->news_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('news_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'news');
					
				Template::set_message(lang('news_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('news_delete_failure') . $this->news_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA .'/settings/news');
	}
	
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	/*
		Method: save_news()
		
		Does the actual validation and saving of form data.
		
		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.
		
		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_news($type='insert', $id=0) 
	{	
					
		$this->form_validation->set_rules('title','Title','required|max_length[120]');			
		$this->form_validation->set_rules('catalog','文章分類','required');
		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['title']			= $this->input->post('title');
		$data['content']        = $this->input->post('content');
		$data['pic']			= $this->input->post('pic');
		$data['sticky']			= $this->input->post('sticky');
		$data['published']		= $this->input->post('published');
		$data['created_date']		= $this->input->post('created_date');
		$data['catalog']		= $this->input->post('catalog');
		if (empty($data['created_date'])) {
			$data['created_date'] = date("Y-m-d H:i:s");
		}

		if ($type == 'insert')
		{
			$id = $this->news_model->insert($data);
			
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
			$return = $this->news_model->update($id, $data);
		}
		
		return $return;
	}

	//--------------------------------------------------------------------
	public function uploads() 
		{
			$this->auth->restrict('Barcode.Settings.Edit');
			$config=array();
			$config['upload_path'] = './product_img/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '2048';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			$this->load->library('upload',$config);

				if ( ! $this->upload->do_upload())
					{
						
						$status = array("error"=>"上傳失敗", "msg"=>""); 
						ob_start();
						echo json_encode($status);

					}
				else
					{
						$path=$this->upload->data();
						
						$image_config['image_library'] = 'gd2';
						$image_config['source_image'] = $path['full_path'];
						$image_config['create_thumb'] = FALSE;
						$image_config['maintain_ratio'] = FALSE;
						//$image_config['width']=450;
						//$image_config['height'] = 300;
						$this->load->library('image_lib', $image_config);
						
								if ( ! $this->image_lib->resize())
								{
								    $status = array("error"=>"縮圖程序失敗", "msg"=>""); 
								    ob_start();
								    echo json_encode($status);
								}
								else {
									$data= array('pic'=>$path['file_name']);
								}
						$status = array("error"=>"", "msg"=>$data['pic']); 
						ob_start();
						echo json_encode($status);
					}
			}
	public function publish($id='',$published='')
	{
		$this->auth->restrict('News.Settings.Edit');

		$id = (int)$this->uri->segment(5);
		$published = (int)$this->uri->segment(6);
		if(empty($published))
		{
			if(!empty($id)){

				$this->db->where('id',$id);
				$this->db->set('published',1);

				if($this->db->update('nc_announcement')){
					Template::set_message(lang('news_edit_success'), 'success');
					Template::redirect(SITE_AREA .'/settings/news');
				}else{
					Template::set_message(lang('news_edit_failure'), 'error');
					Template::redirect(SITE_AREA .'/settings/news');
				}
			}
		}else if($published==1){
			if(!empty($id)){

				$this->db->where('id',$id);
				$this->db->set('published',0);

				if($this->db->update('nc_announcement')){
					Template::set_message(lang('news_edit_success'), 'success');
					Template::redirect(SITE_AREA .'/settings/news');
				}else{
					Template::set_message(lang('news_edit_failure'), 'error');
					Template::redirect(SITE_AREA .'/settings/news');
				}
			}
		}
	}
	public function sticky($id='',$cancel='')
	{
		$this->auth->restrict('News.Settings.Edit');

		$id = (int)$this->uri->segment(5);
		$cancel = $this->uri->segment(6);
			if(!empty($id)){
				//if($this->pre_sticky()){
					$this->db->where('id',$id);
					if($cancel=='cancel'){
						$this->db->set('sticky',0);
					}else{
						$this->db->set('sticky',1);
					}
					
					if($this->db->update('nc_announcement')){
						Template::set_message(lang('news_edit_success'), 'success');
						Template::redirect(SITE_AREA .'/settings/news');
					}else{
						Template::set_message(lang('news_edit_failure'), 'error');
						Template::redirect(SITE_AREA .'/settings/news');
					}
				//}else{
				//	Template::set_message('資料庫初始化失敗，請聯繫系統管理員', 'error');
				//	Template::redirect(SITE_AREA .'/settings/news');
				//}
			}
		
	}
	private function pre_sticky(){
		$this->db->where('sticky',1)->set('sticky',0);
		if($this->db->update('nc_announcement')){
			return true;
		}else{
			return false;
		}
	}


}