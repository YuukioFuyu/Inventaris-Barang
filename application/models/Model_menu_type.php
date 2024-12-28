<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Model_menu_type extends MY_Model {

	private $primary_key 	= 'id';
	private $table_name 	= 'menu_type';
	private $field_search 	= array('name', 'definition');

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}
}

/* End of file Model_menu_type.php */
/* Location: ./application/models/Model_menu_type.php */