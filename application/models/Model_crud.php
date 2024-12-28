<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Model_crud extends MY_Model {

	private $primary_key 	= 'id';
	private $table_name 	= 'crud';
	private $field_search 	= array('table_name', 'subject', 'title');

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}

	public function count_all($q = '', $field = '')
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "(" . $field . " LIKE '%" . $q . "%' ";
	            } else if ($iterasi == $num) {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%') ";
	            } else {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }
        } else {
        	$where .= "(" . $field . " LIKE '%" . $q . "%' )";
        }

        $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get($q = '', $field = '', $limit = 0, $offset = 0)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "(" . $field . " LIKE '%" . $q . "%' ";
	            } else if ($iterasi == $num) {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%') ";
	            } else {
	                $where .= "OR " . $field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }
        } else {
        	$where .= "(" . $field . " LIKE '%" . $q . "%' )";
        }

        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by($this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function get_input_type()
	{
		$this->db->group_by('validation_group');
		$result = $this->db->get('crud_input_type');

		$validation_group = '';
		foreach ($result->result() as $row) {
			$validation_group .= $row->validation_group. ' ';
		}

		return $validation_group;

	}

	public function crud_exist($table_name = '')
	{
		$result = $this->db->get_where($this->table_name, ['table_name' => $table_name])->row();

		if ($result) {
			return $result->id;
		}

		return false;
	}

	public function get_crud_field($id)
	{
		$this->db->order_by('sort', 'asc');
		$result = $this->db->get_where('crud_field', ['crud_id' => $id])->result();

		return $result;
	}

	public function get_crud_field_validation($id)
	{
		$validations = [];

		$this->db->join('crud_input_validation', 'crud_input_validation.validation = crud_field_validation.validation_name', 'LEFT');
		$result = $this->db->get_where('crud_field_validation', ['crud_id' => $id])->result();

		foreach ($result as $row) {
			$validations[$row->crud_field_id][] = $row; 
		}

		return $validations;
	}

	public function get_crud_field_option($id)
	{
		$validations = [];

		$result = $this->db->get_where('crud_custom_option', ['crud_id' => $id])->result();

		foreach ($result as $row) {
			$validations[$row->crud_field_id][] = $row; 
		}

		return $validations;
	}

}

/* End of file Model_crud.php */
/* Location: ./application/models/Model_crud.php */