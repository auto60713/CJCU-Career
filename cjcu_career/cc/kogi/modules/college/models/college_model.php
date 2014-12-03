<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class College_model extends BF_Model {

	protected $table = "nc_college";
	protected $key = "id";
	protected $soft_deletes = false;
	protected $date_format = "datetime";
	protected $set_created = false;
	protected $set_modified = false;

	public function __construct() {
		parent::__construct();
	}

	public function find_dept($id) {
		
		$this -> db -> join('dept', 'dept.college_id = college.id');
		$this->db->where('college_id',$id);
		
		return parent::find_all();
	}
	public function delete($id,$purge=true) 
	{
		$id=$this->uri->segment(5);
		if ($purge === true)
		{
			// temporarily set the soft_deletes to true.
			$this->soft_deletes = false;
		}
		$this->db->where('dept.college_id',$id);
		$this->db->delete('dept');
		return parent::delete($id);
	}
}
