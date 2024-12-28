<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Model_form extends MY_Model {

	private $primary_key 	= 'id';
	private $table_name 	= 'form';
	private $field_search 	= array('subject', 'title');

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

	public function form_exist($id = '')
	{
		$result = $this->db->get_where($this->table_name, ['id' => $id])->row();

		if ($result) {
			return $result->id;
		}

		return false;
	}

	public function get_form_field($id)
	{
		$this->db->order_by('sort', 'asc');
		$result = $this->db->get_where('form_field', ['form_id' => $id])->result();

		return $result;
	}

	public function get_form_field_validation($id)
	{
		$validations = [];

		$this->db->join('crud_input_validation', 'crud_input_validation.validation = form_field_validation.validation_name', 'LEFT');
		$result = $this->db->get_where('form_field_validation', ['form_id' => $id])->result();

		foreach ($result as $row) {
			$validations[$row->form_field_id][] = $row; 
		}

		return $validations;
	}

	public function get_form_field_option($id)
	{
		$field_options = [];

		$result = $this->db->get_where('form_custom_option', ['form_id' => $id])->result();

		foreach ($result as $row) {
			$field_options[$row->form_field_id][] = $row; 
		}

		return $field_options;
	}

	public function get_form_custom_attribute($id)
	{
		$attributes = [];

		$result = $this->db->get_where('form_custom_attribute', ['form_id' => $id])->result();

		foreach ($result as $row) {
			$attributes[$row->form_field_id][] = $row; 
		}

		return $attributes;
	}


	public function get_form_custom_option($id)
	{
		$options = [];

		$result = $this->db->get_where('form_custom_option', ['form_id' => $id])->result();

		foreach ($result as $row) {
			$options[$row->form_field_id][] = $row; 
		}

		return $options;
	}

}

/* End of file Model_form.php */
/* Location: ./application/models/Model_form.php */