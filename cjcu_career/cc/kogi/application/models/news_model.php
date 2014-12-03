<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends BF_Model {

	protected $table		= "nc_announcement";
	protected $key			= "id";
	protected $soft_deletes	= true;
	protected $date_format	= "datetime";
	protected $set_created	= true;
	protected $set_modified = false;
	protected $created_field = "created_date";
	
	
	public function __construct() 
	{
		parent::__construct();
	}
	
	public function find_all_array()
	{
		$query=$this->db->get('nc_announcement');
		return $query->result_array();
	}
	
}
