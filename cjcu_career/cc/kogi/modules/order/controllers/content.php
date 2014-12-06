<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Order.Content.View');
		$this->load->model('order_model', null, true);
		$this->lang->load('order');
		$this->load->model('orderstatus/orderstatus_model', null, true);
		$this->load->model('itmes/itmes_model', null, true);
		$this->load->model('shipment/shipment_model', null, true);
		//Assets::add_css('flick/jquery-wijmo.css');
		//Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
		//Assets::add_css('jquery-ui-timepicker.css');
		//Assets::add_js('jquery-ui-timepicker-addon.js');
	}

	//--------------------------------------------------------------------

	/*
		Method: index()

		Displays a list of form data.
	*/
	public function index()
	{
		Assets::add_js($this->load->view('content/js', null, true), 'inline');
		$this->load->helper('ui/ui');
		if (!$this->auth->has_permission('Order.Content.Users')){
			if ($this->auth->has_permission('Order.Content.As')){
				Template::set('records', $this->order_model->order_by("id","desc")->where('deleted','0')->find_all());
				Template::set('records_softdel', $this->order_model->order_by("created_on","desc")->where('deleted','1')->find_all());
				Template::set('records_ready', $this->order_model->order_by("created_on","desc")->where('status','4')->where('deleted','0')->find_all());
			}
			if ($this->auth->has_permission('Order.Content.Career')){
				Template::set('records', $this->order_model->order_by("id","desc")->where('deleted','0')->find_all());
				Template::set('records_softdel', $this->order_model->order_by("created_on","desc")->where('deleted','1')->find_all());
				Template::set('records_ready', $this->order_model->order_by("created_on","desc")->where('status','4')->where('deleted','0')->find_all());
			}
			if ($this->auth->has_permission('Order.Content.Regis')){
				Template::set('records', $this->order_model->order_by("id","desc")->where('deleted','0')->find_all());
				Template::set('records_softdel', $this->order_model->order_by("created_on","desc")->where('deleted','1')->find_all());
				Template::set('records_ready', $this->order_model->order_by("created_on","desc")->where('status','4')->where('deleted','0')->find_all());
			}
		
		}else{
			Template::set('records', $this->order_model->order_by("id","desc")->where('deleted','0')->where('user_id',$this->auth->user_id())->find_all());
		}
		Template::set('toolbar_title', lang('order_manage'));
		Template::render();
	}

	//--------------------------------------------------------------------

	/*
		Method: create()

		Creates a order object.
	*/
	public function create()
	{
		$this->auth->restrict('Order.Content.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_order())
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('order_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'order');
				if($this->save_order_items()){
					$this->save_order_history('1',lang('order_success'));
					if($this->email('hung@kogi.ws','訂單已成立')){
						Template::set_message(lang("order_create_success"), 'success');
						Template::redirect(SITE_AREA .'/content/order/success');
					}
					
				}
				
			}
			else
			{
				Template::set_message(lang('order_create_failure') . $this->order_model->error, 'error');
			}
		}
		Template::set('lidm',substr(number_format(time() * mt_rand(),0,'',''),0,10));
		Assets::add_js($this->load->view('content/ajaxfileupload_js', null, true), 'inline');
		Assets::add_js($this->load->view('content/shopping_js', null, true), 'inline');
		Assets::add_js($this->load->view('content/Validform_js', null, true), 'inline');
		Template::set('toolbar_title', lang('order_create_new_button'));
		Template::set('toolbar_title', lang('order_create') . ' order');
		Template::set('items',$this->itmes_model->find_all());
		Template::set('shipment_items',$this->shipment_model->find_all());
		Template::render();

	}

	//--------------------------------------------------------------------

	/*
		Method: edit()

		Allows editing of order data.
	*/
	public function edit()
	{
		$this->auth->restrict('Order.Content.Edit');

		$id = (int)$this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('order_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/order');
		}

		if ($this->input->post('submit'))
		{
			if ($this->save_order('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('order_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'order');

				Template::set_message(lang('order_edit_success'), 'success');
				Template::redirect(SITE_AREA .'/content/order');

			}
			else
			{
				Template::set_message(lang('order_edit_failure') . $this->order_model->error, 'error');
				Template::redirect(SITE_AREA .'/content/order');
			}
		}
		$lidm_serial=$this->order_model->find($id);
		Template::set('order', $this->order_model->find($id));
		Template::set('query',$this->query_items($lidm_serial->lidm));
		Template::set('order_status',$this->orderstatus_model->find_all());
		Template::set('toolbar_title', lang('order_edit_heading'));
		Template::set('toolbar_title', lang('order_edit') . ' order');
		Template::render();
	}

	//--------------------------------------------------------------------

	/*
		Method: delete()

		Allows deleting of order data.
	*/
	public function delete()
	{
		$this->auth->restrict('Order.Content.Delete');

		$id = $this->uri->segment(5);

		if (!empty($id))
		{
			if ($this->order_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('order_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'order');

				Template::set_message(lang('order_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('order_delete_failure') . $this->order_model->error, 'error');
			}
		}

		redirect(SITE_AREA .'/content/order');
	}

	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_order()

		Does the actual validation and saving of form data.

		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.

		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_order($type='insert', $id=0)
	{

		$this->form_validation->set_rules('lidm','Order ID','required|unique[nc_order.lidm,nc_order.id]|max_length[17]');
		//$this->form_validation->set_rules('modified_on','Modified On','max_length[14]');
		//$this->form_validation->set_rules('remark','Remark','max_length[1000]');
		//$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want

		if (!empty($_SERVER['HTTP_CLIENT_IP']))
		{
		  $ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
		  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
		  $ip=$_SERVER['REMOTE_ADDR'];
		}
		if ($type=='insert') {
			$order_qty_sum=0;
			$orders=$this->input->post('order');
			foreach ($orders as $order) {
				$order_qty_sum=$order_qty_sum+$order['qty'];
			}
			if($order_qty_sum==0){
				return FALSE;
			}
		}
		
		$data = array();
		$data['lidm']        = $this->input->post('lidm');
		$data['ip']        = $ip;
		$data['email']        = $this->input->post('email');
		$data['address']        = $this->input->post('address');
		$data['tel']			= $this->input->post('tel');
		$data['pic-userfile']			= $this->input->post('pic-userfile');
		$data['order_remark']			= $this->input->post('order_remark');
		$data['shipment_fee']	= $this->input->post('shippment_fee');
		if($this->input->post('status')==0){
			$data['status']        = 1;
		}else{
			$data['status']        = $this->input->post('status');
		}

		if($this->input->post('remark')==0){
			$data['remark']        = '無';
		}else{
			$data['remark']=$this->input->post('remark');
		}
		if($type=='insert'){
			$data['amount']		   = $this->input->post('total_price_with_shipping');
		}else{
			$data['amount']		   = $this->input->post('amount');
		}
		
		$data['user_id']	   = $this->auth->user_id();
		if ($type == 'insert')
		{
			$id = $this->order_model->insert($data);

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
			$return = $this->order_model->update($id, $data);
			$this->email('hung@kogi.ws','訂單狀態改變');
		}

		return $return;
	}
	//--------------------------------------------------------------------
	private function save_order_items($order=array())
	{
		$datas=array();
		$datas=$this->input->post('order');
		foreach ($datas as $data) {
			
				if($data['qty']!=0){
					$this->db->insert('nc_order_item', $data);
					
				}
			
		}
		return TRUE;
	}
	//--------------------------------------------------------------------
	private function save_order_history($status=0,$history="insert")
	{
		$data = array('history' => $history ,'status' => $status);

		if($this->db->insert('nc_order_history', $data)){
			return TRUE;
		}else{
			return FALSE;
		}
		

	}
	//--------------------------------------------------------------------
	private function query_items($lidm=''){
		$query = $this->db->get_where('nc_order_item', array('lidm' => $lidm));
		$find_id=$query->result();

		foreach ($find_id as $key => $found) {
			$single_query=$this->db->get_where('nc_items', array('id' => $found->item_id));
			$output[$key]=$single_query->result_array();
		}
		return $output;
	}
	//--------------------------------------------------------------------
	public function signal($id='',$code=''){

		$this->auth->restrict('Order.Content.Edit');
		$id=$this->uri->segment(5);
		$code=$this->uri->segment(6);
		$this->db->where('id',$id);
		$this->db->set('status',$code);
		if($this->db->update('nc_order')){
			$this->email('hung@kogi.ws','訂單狀態已改變');
			Template::set_message(lang('order_edit_success'), 'success');
			redirect(SITE_AREA .'/content/order');

		}else{
			Template::set_message(lang('order_create_failure') . $this->order_model->error, 'error');
			redirect(SITE_AREA .'/content/order');
		}
	}
	public function query_item_detail($id){
		$id=$this->uri->segment(5);
		$result=$this->itmes_model->find($id);
		$conv=get_object_vars($result);
		$output=json_encode($conv);
		ob_start();
		echo $output;
	}
	public function uploads() 
		{
			$this->auth->restrict('Order.Content.Create');
			$config=array();
			$config['upload_path'] = './doc_img/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '2048';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			$this->load->library('upload',$config);
			//$this->upload->initialize($config);
 
        //foreach($_FILES as $key)
       // {
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
				//}
			
		}
	public function success()
	{

		Template::set('toolbar_title', lang('order_success_heading'));
		Template::render();
	}
	private function email($email='',$title=''){
		require_once(BASEPATH."phpmailer/class.phpmailer.php");
		$mail = new PHPMailer();
					$mail->IsSMTP();
					$mail->Host = "smtp.gmail.com";
					$mail->Port = 465;
					$mail->SMTPAuth = true;
					$mail->SMTPSecure = "ssl";
					$mail->SetLanguage('zh', 'phpmailer/language/'); // 設定語言
					$mail->Username = "amicus.hongamicus@gmail.com";
					$mail->Password = "D4GY85l4A08g56QWE";
					$mail->AddAddress('amicus.hongamicus@gmail.com');
					$mail->AddAddress($email);

					$mail->CharSet="UTF-8";
					$mail->Encoding = "base64";
					$mail->IsHTML(true);
					$mail->WordWrap = 50;
					$mail->From = 'amicus.hongamicus@gmail.com';        
					$mail->FromName = "TEST";
					$mail->Subject="TEST";
					
					$mail->Body ='<p>---------------------------------------------------------------</p>'.
								  '<p>'.$title.'</p>'.
								  '<p>---------------------------------------------------------------</p>';

					if(!$mail->Send())
					{
					alert($mail->ErrorInfo);
					exit;
					}
		return TRUE;
	}

}
