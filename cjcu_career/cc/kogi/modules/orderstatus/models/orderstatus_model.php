<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Orderstatus_model extends BF_Model {

	protected $table		= "nc_order_status";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= false;
	protected $set_modified = false;

}
