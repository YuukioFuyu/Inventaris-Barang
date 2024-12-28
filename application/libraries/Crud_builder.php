<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Librarry for crud generator
* @author Muhamad Ridwan
* @since 2016
*/
class Crud_builder
{
	var $crud = [];

	public function __construct($config = [])
	{
		$this->ci =& get_instance();
		$this->initialize($config);
	}

	/**
	 * Initialize preferences
	 *
	 * @access	public
	 * @param	array
	 * @return	void
	 */
	public function initialize($config = [])
	{
		foreach ($config as $key => $val)
		{
			$this->{$key} = $val;
		}
	}

	/**
	 * Initialize preferences
	 *
	 * @access	public
	 * @return	array
	 */
	public function getAllField()
	{
		$fields = [];
		foreach ($this->crud as $contains)
		{
			$fields[] = array_keys($contains)[0];
		}
		return $fields;
	}

	/**
	 * Validate all crud
	 *
	 * @access	public
	 * @return	string
	 */
	public function validateAll()
	{
		$this->ci->load->library('form_validation');
		$fields = [];
		$this->errors = [];
		$list_relation_type = $this->getFieldRelationType();
		$list_inputable_validation = $this->getInputableValidation();
		$list_all_validation = $this->getAllValidation();
		$list_all_inputable_validation_rule = $this->getInputableValidationRule();
		$list_all_field_custom_value = $this->getFieldCustomValue();
		$list_all_field_custom_value_type = $this->getFieldCustomValueType();
		$list_input_name = [];

		foreach ($this->crud as $contains)
		{
			$field_name = array_keys($contains)[0];
			if (!isset($contains[$field_name]['input_type'])) {
				$this->errors[] = 'The '.ucwords(clean_snake_case($field_name)).' input type must be selected.';
				return $this;
			}

			if (isset($contains[$field_name]['input_name'])) {
				if (!preg_match('/^[a-z0-9_]+$/i', $contains[$field_name]['input_name'])) {
					$this->errors[] = 'The '.ucwords(clean_snake_case($contains[$field_name]['input_label'])).' input name must be alpha numeric and underscores lowercase.';
					return $this;
				}
			}

			if (isset($contains[$field_name]['input_name'])) {
				if ($contains[$field_name]['input_type'] != 'heading') {
					if (in_array($contains[$field_name]['input_name'], $list_input_name)) {
						$this->errors[] = 'The '.ucwords(clean_snake_case($contains[$field_name]['input_label'])).' field name must be different than any other field name.';
						return $this;
					}
					$list_input_name[] = $contains[$field_name]['input_name'];
				}
			}

			if (isset($contains[$field_name]['custom_attributes'])) {
				foreach ($contains[$field_name]['custom_attributes'] as $idx => $field_option) {
					$error = false;
					if (empty( $field_option['value']) 
					OR empty( $field_option['label'])  )
					{
						$error = true;
					}
				}
				if ($error) {
					$this->errors[] = 'The '.ucwords(clean_snake_case($contains[$field_name]['input_label'])).' attributes value and label must be filled.';
				}
			}

			$input_type = $contains[$field_name]['input_type'];

			if (in_array($input_type, $list_all_field_custom_value_type)) {
				foreach ($contains[$field_name]['custom_option'] as $idx => $field_option) {
					$error = false;
					if (empty( $field_option['value']) 
					OR empty( $field_option['label'])  )
					{
						$error = true;
					}
				}
				if ($error) {
					$this->errors[] = 'The '.ucwords(clean_snake_case($field_name)).' option value and label must be filled.';
				}
			}

			if (empty($input_type)) {
				$this->errors[] = 'The '.ucwords(clean_snake_case($field_name)).' input type can\'t be empty.';
			}
			if (in_array($input_type, $list_relation_type)) {
				if (empty($contains[$field_name]['relation_table']) 
					OR empty($contains[$field_name]['relation_value']) 
					OR empty($contains[$field_name]['relation_label']) )
				{
					$this->errors[] = 'The '.ucwords(clean_snake_case($field_name)).' relation table, value and label must be filled.';
				}
			}

			if (isset($contains[$field_name]['validation']['rules'])) {
				foreach ($contains[$field_name]['validation']['rules'] as $rule => $value) {
					if (in_array($rule, $list_inputable_validation)) {
						$this->ci->form_validation->reset_validation();
						$this->ci->form_validation->set_data($contains[$field_name]['validation']['rules']);

						if (isset($list_all_inputable_validation_rule[$rule])) {
							
							$this->ci->form_validation->set_rules(
								$rule, 
								ucwords(clean_snake_case($rule)), 
								$list_all_inputable_validation_rule[$rule]);
						}

						if (!$this->ci->form_validation->run()) {
							$this->errors[] = ucwords(clean_snake_case($field_name)).', '.validation_errors();

							return $this;
						}
						
						if (empty($value)) {
							$this->errors[] = 'The '.ucwords(clean_snake_case($field_name)).' rule '.clean_snake_case($rule).', value must be filled.';
						}

					}
					if (!in_array($rule, $list_all_validation)) {
						$this->errors[] = 'The '.ucwords(clean_snake_case($field_name)).' rule '.clean_snake_case($rule).' is not valid.';
					}
					if (in_array($rule, ['max_width', 'max_height'])) {
						if (!isset($contains[$field_name]['validation']['rules']['max_width']) 
							OR !isset($contains[$field_name]['validation']['rules']['max_height'])) 
						{
							$this->errors[] = 'The '.ucwords(clean_snake_case($field_name)).' rule '.implode(', ', ['max_width', 'max_height']).' , must be define and filled.';
						}
					}
				}
			}
		}
		return $this;
	}

	/**
	 * Print error
	 *
	 * @access	public
	 * @return	mixed string | boolean
	 */
	public function getErrorMessage($delimiter = '<br>')
	{
		$errors = false;
		if (isset($this->errors) AND count($this->errors)) {
			foreach ($this->errors as $error) {
				$errors .= $error.$delimiter;
			}
		}
		return $errors;
	}
	/**
	 * Print error
	 *
	 * @access	public
	 * @return	mixed string | boolean
	 */
	public function isError()
	{
		$errors = false;
		if (isset($this->errors) AND count($this->errors)) {
			return true;
		}
		return $errors;
	}

	/**
	 * Get fiedl in column
	 *
	 * @access	public
	 * @return	array
	 */
	public function getFieldShowInColumn()
	{
		$fields = [];
		foreach ($this->crud as $contains)
		{
			$field = array_keys($contains)[0];
			if (isset($contains[$field]['show_in_column']) AND $contains[$field]['show_in_column']) {
				$fields[] = $field;
			}
		}
		return $fields;
	}

	/**
	 * Get fiedl in column
	 *
	 * @access	public
	 * @param array $with_options
	 * @return	array
	 */
	public function getFieldShowInAddForm($with_options = false, $except_input_file = false)
	{
		$fields = [];
		foreach ($this->crud as $contains)
		{
			$field = array_keys($contains)[0];
			if (isset($contains[$field]['show_in_add_form']) AND $contains[$field]['show_in_add_form']) {
				if (!$except_input_file) {
					if ($with_options) {
						$fields[$field] = $contains[$field];
					} else {
						$fields[] = $field;
					}
				} else {
					if (!$this->getFieldFile($field)) {
						if ($with_options) {
							$fields[$field] = $contains[$field];
						} else {
							$fields[] = $field;
						}
					}
				}
			}
		}
		return $fields;
	}

	/**
	 * Get fiedl in column
	 *
	 * @access	public
	 * @return	array
	 */
	public function getFieldShowInUpdateForm($with_options = false, $except_input_file = false)
	{
		$fields = [];
		foreach ($this->crud as $contains)
		{
			$field = array_keys($contains)[0];
			if (isset($contains[$field]['show_in_update_form']) AND $contains[$field]['show_in_update_form']) {
				if (!$except_input_file) {
					if ($with_options) {
						$fields[$field] = $contains[$field];
					} else {
						$fields[] = $field;
					}
				} else {
					if (!$this->getFieldFile($field)) {
						if ($with_options) {
							$fields[$field] = $contains[$field];
						} else {
							$fields[] = $field;
						}
					}
				}
			}
		}
		return $fields;
	}

	/**
	 * Get fiedl in column
	 *
	 * @access	public
	 * @return	array
	 */
	public function getFieldShowInDetailPage($with_options = false)
	{
		$fields = [];
		foreach ($this->crud as $contains)
		{
			$field = array_keys($contains)[0];
			if (isset($contains[$field]['show_in_detail_page']) AND $contains[$field]['show_in_detail_page']) {
				if ($with_options) {
					$fields[$field] = $contains[$field];
				} else {
					$fields[] = $field;
				}
			}
		}
		return $fields;
	}

	/**
	 * Check field is relation
	 *
	 * @access	public
	 * @param String $field_name
	 * @return	mixed array | string
	 */
	public function getFieldRelation($field_name = null)
	{
		$fields = [];
		foreach ($this->crud as $contains)
		{
			$field = array_keys($contains)[0];
			if (isset($contains[$field]['relation_table']) AND !empty($contains[$field]['relation_table'])) {
				if (isset($contains[$field]['relation_value']) AND !empty($contains[$field]['relation_value'])) {
					if (isset($contains[$field]['relation_label']) AND !empty($contains[$field]['relation_label'])) {
						$fields[$field] = [
							'relation_table' => $contains[$field]['relation_table'],
							'relation_value' => $contains[$field]['relation_value'],
							'relation_label' => $contains[$field]['relation_label'],
						];
					}
				}
			}
		}

		if (!empty($field_name)) {
			if (isset($fields[$field_name])) {
				return $fields[$field_name];
			}
			return false;
		}

		return $fields;
	}

	/**
	 * field file
	 *
	 * @access	public
	 * @param String $field_name
	 * @return	mixed array | string
	 */
	public function getFieldFile($field_name = null)
	{
		return $this->getFieldByType('file', $field_name);
	}

	/**
	 * field file multiple
	 *
	 * @access	public
	 * @param String $field_name
	 * @return	mixed array | string
	 */
	public function getFieldFileMultiple($field_name = null)
	{
		return $this->getFieldByType('file_multiple', $field_name);
	}

	/**
	 * Check field
	 *
	 * @access	public
	 * @param String $input_type
	 * @param String $field_name
	 * @return	array 
	 */
	public function getFieldByType($input_type = null, $field_name = null)
	{
		$fields = [];
		foreach ($this->crud as $contains)
		{
			$field = array_keys($contains)[0];
			
			if (isset($contains[$field]['input_type']) AND ($contains[$field]['input_type']) == $input_type) {
				$fields[$field] = $field;
			}
		}
		if (!empty($field_name)) {
			if (isset($fields[$field_name])) {
				return $fields[$field_name];
			}
			return false;
		}

		return $fields;
	}

	/**
	 * Check field is multiple
	 *
	 * @access	public
	 * @param String $field_name
	 * @return	array 
	 */
	public function isMultipleInput($field_name = null)
	{
		$fields = [];
		$list_input_multiple = $this->getInputMultiple();
		foreach ($this->crud as $contains)
		{
			if (isset($contains[$field_name]['input_type']) AND in_array($contains[$field_name]['input_type'], $list_input_multiple)) {
				return true;
			}
		}

		return false;
	}
	/**
	 * Gte field multiple
	 *
	 * @access	public
	 * @return	array 
	 */
	public function getInputMultiple()
	{
		$list_input_multiple = ['select_multiple', 'checkboxes', 'custom_checkbox', 'custom_select_multiple'];

		return $list_input_multiple;
	}


	/**
	 * Get validatio field
	 *
	 * @access	public
	 * @param String $field_name
	 * @return	mixed array | string
	 */
	public function getFieldValidation($field_name = null, $validation_name = null)
	{
		$fields = [];
		foreach ($this->crud as $contains)
		{
			$field = array_keys($contains)[0];
			if (isset($contains[$field]['validation']['rules'])) {
				if (!in_array($contains[$field]['input_type'], $this->getNonInputType())) {
					if (!in_array($contains[$field]['input_type'], $this->getFieldNotShowInValidation())) {
						$fields[$field] = $contains[$field]['validation']['rules'];
					}
				}
			}
		}

		if (!empty($field_name)) {
			if (isset($fields[$field_name])) {
				if (!empty($validation_name)) {
					if (isset($fields[$field_name][$validation_name])) {
						if (in_array($validation_name, $this->getInputableValidation())) {
							return empty($fields[$field_name][$validation_name]) ? false : $fields[$field_name][$validation_name];
						} else {
							return empty($fields[$field_name][$validation_name]) ? true : $fields[$field_name][$validation_name];
						}
					}
				} else {
					return $fields[$field_name];
				}
			}
		} else {
			return $fields;
		}
		
		return false;
	}

	/**
	 * Get inputable validation
	 *
	 * @access	public
	 * @return	mixed array 
	 */
	public function getInputableValidation()
	{
		$result_arr = [];
		$result = $this->ci->db->get_where('crud_input_validation', ['input_able' => 'yes'])->result();

		foreach ($result as $row) {
			$result_arr[] = $row->validation;
		}

		return $result_arr;
	}

	/**
	 * Get inputable validation rule
	 *
	 * @access	public
	 * @return	mixed array 
	 */
	public function getInputableValidationRule()
	{
		$result_arr = [];

		$result = $this->ci->db->query('SELECT * FROM `crud_input_validation` WHERE input_able  = "yes" AND input_validation != ""')->result();

		foreach ($result as $row) {
			$result_arr[$row->validation] = $row->input_validation;
		}

		return $result_arr;
	}

	/**
	 * Get inputable validation
	 *
	 * @access	public
	 * @return	mixed array 
	 */
	public function getFieldRelationType()
	{
		$result_arr = [];
		$result = $this->ci->db->get_where('crud_input_type', ['relation' => 1])->result();

		foreach ($result as $row) {
			$result_arr[] = $row->type;
		}

		return $result_arr;
	}
	
	/**
	 * Get inputable validation
	 *
	 * @access	public
	 * @return	mixed array 
	 */
	public function getCallBackValidation()
	{
		$result_arr = [];
		$result = $this->ci->db->get_where('crud_input_validation', ['call_back' => 'yes'])->result();

		foreach ($result as $row) {
			$result_arr[] = $row->validation;
		}

		return $result_arr;
	}
	
	/**
	 * Get non inputable validation
	 *
	 * @access	public
	 * @return	mixed array 
	 */
	public function getNonInputableValidation()
	{
		$result_arr = [];
		$result = $this->ci->db->get_where('crud_input_validation', ['input_able' => 'no'])->result();

		foreach ($result as $row) {
			$result_arr[] = $row->validation;
		}

		return $result_arr;
	}
	
	/**
	 * Get non inputable validation
	 *
	 * @access	public
	 * @return	mixed array 
	 */
	public function getAllValidation()
	{
		$result_arr = [];
		$result = $this->ci->db->get('crud_input_validation')->result();

		foreach ($result as $row) {
			$result_arr[] = $row->validation;
		}

		return $result_arr;
	}

	/**
	 * Parse info
	 *
	 * @access	public
	 * @param String $field_name
	 */
	public function parseValidationFile($field_name = null, $validation_prefix = '<b>', $validation_suffix = '</b>', $field_label = null)
	{
		if (empty($field_label)) {
			$field_label = $field_name;
		}
		$input_able_validation = $this->getInputableValidation();
		$non_input_able_validation = $this->getNonInputableValidation();
		$all_validation = $this->getAllValidation();
		$parse = null;
		$parse_arr = [];
		$format_non_inputable = [];
		$format_inputable = [];
		$ignore_validation = ['max_width', 'max_height', 'max_size', 'regex', 'allowed_extension', 'required', 'xss_clean'];

		foreach ($all_validation as $validation) {
			$$validation = $this->getFieldValidation($field_name, $validation);
		}

		foreach ($non_input_able_validation as $validation) {
			if ($$validation) {
				$format_non_inputable[] = $validation;
			}
		}

		$format_non_inputable_rule = [];
		foreach ($format_non_inputable as $val) {
			if (!in_array($val, $ignore_validation)) {
				$format_non_inputable_rule[] =  ucwords(clean_snake_case($val));
			}
		}

		if (count($format_non_inputable_rule)) {
			$parse_arr[] = $validation_prefix.'Format '.ucwords(clean_snake_case($field_label)).' must</b> '.implode(', ', $format_non_inputable_rule);
		}

		foreach ($input_able_validation as $validation) {
			if ($$validation) {
				$validation_value = $this->getFieldValidation($field_name, $validation);
				if ($validation_value) {
					$format_inputable[$validation] = $validation_value;
				}
			}
		}

		
		$format_inputable_rule = [];
		foreach ($format_inputable as $key => $value) {
			if (!in_array($key, $ignore_validation)) {
				$format_inputable_rule[] = ucwords(clean_snake_case($key)) . ' : '.$value;
			}
		}
		if (count($format_inputable_rule)) {
			$parse_arr[] = $validation_prefix.'Input '.ucwords(clean_snake_case($field_label)).''.$validation_suffix.' '.implode(', ', $format_inputable_rule);
		}

		if ($allowed_extension) {
			$parse_arr[] = $validation_prefix.'Extension file must'.$validation_suffix.' '.strtoupper($allowed_extension);
		}

		if ($max_width AND $max_height) {
			$parse_arr[] = $validation_prefix.'Max dimension'.$validation_suffix.' '.$max_width.' * '.$max_height;
		}

		if ($max_size) {
			$parse_arr[] = $validation_prefix.'Max size file'.$validation_suffix.'  '.$max_size.' kb';
		}

		if ($regex) {
			$parse_arr[] = $validation_prefix.'Input format should fit pattern'.$validation_suffix.'  '.$regex;
		}

		if (count($parse_arr)) {
			return implode(',  ', $parse_arr).'.';
		}

	}

	/**
	 * Get validatio field
	 *
	 * @access	public
	 * @param String $field_name
	 * @return	mixed array | string
	 */
	public function getFieldAndOptios($field_name = null)
	{
		$fields = [];
		foreach ($this->crud as $contains)
		{
			$field = array_keys($contains)[0];
			if (isset($contains[$field])) {
				$fields[$field] = $contains[$field];
			}
		}

		if (!empty($field_name)) {
			if (isset($fields[$field_name])) {
				return $fields[$field_name];
			}
			return false;
		}

		return $fields;
	}

	/**
	 * Check field is custom value
	 *
	 * @access	public
	 * @param String $field_name
	 * @return	mixed array | string
	 */
	public function getFieldCustomValue($field_name = null)
	{
		$fields = [];
		foreach ($this->crud as $contains)
		{
			$field = array_keys($contains)[0];
			
			if (isset($contains[$field]['custom_option'])) {
				$fields[$field] = $contains[$field]['custom_option'];
			}
			
		}

		if (!empty($field_name)) {
			if (isset($fields[$field_name])) {
				return $fields[$field_name];
			}
			return false;
		}

		return $fields;
	}

	/**
	 * Get all field
	 * this return ignore non input file ex : heading, captcha
	 * @access	public
	 * @param array $with_options
	 * @return	array
	 */
	public function getFieldAll($with_options = false, $except_input_file = false)
	{
		$fields = [];
		foreach ($this->crud as $contains)
		{
			$field = array_keys($contains)[0];
			if ($except_input_file === false) {
				if ($with_options) {
					if (!in_array($contains[$field]['input_type'], $this->getNonInputType())) {
						$fields[$field] = $contains[$field];
					}
				} else {
					if (!in_array($contains[$field]['input_type'], $this->getNonInputType())) {
						$fields[] = $field;
					}
				}
			} else {
				if (!$this->getFieldFile($field)) {
					if ($with_options) {
						if (!in_array($contains[$field]['input_type'], $this->getNonInputType())) {
							$fields[$field] = $contains[$field];
						}
					} else {
						if (!in_array($contains[$field]['input_type'], $this->getNonInputType())) {
							$fields[] = $field;
						}
					}
				}
			}
		}

		return $fields;
	}

	/**
	 * Get all field
	 *
	 * @access	public
	 * @param array $with_options
	 * @return	array
	 */
	public function getFieldAllForm($with_options = false, $except_input_file = false)
	{
		$fields = [];
		foreach ($this->crud as $contains)
		{
			$field = array_keys($contains)[0];
			if (!$except_input_file) {
				if ($with_options) {
					$fields[$field] = $contains[$field];
				} else {
					$fields[] = $field;
				}
			} else {
				if (!$this->getFieldFile($field)) {
					if ($with_options) {
						$fields[$field] = $contains[$field];
					} else {
						$fields[] = $field;
					}
				}
			}
		}
		return $fields;
	}

	/**
	 * Get all field label
	 *
	 * @access	public
	 * @return	array
	 */
	public function getFieldAllLabel()
	{
		$fields = [];
		foreach ($this->crud as $contains)
		{
			$field = array_keys($contains)[0];
			if (!in_array($contains[$field]['input_type'], $this->getNonInputType())) {
				$fields[] = strtolower($contains[$field]['input_label']);
			}
		}
		return $fields;
	}

	/**
	 * Get all field label
	 *
	 * @access	public
	 * @return	array
	 */
	public function getFieldAllName()
	{
		$fields = [];
		foreach ($this->crud as $contains)
		{
			$field = array_keys($contains)[0];
			if (!in_array($contains[$field]['input_type'], $this->getNonInputType())) {
				$fields[] = strtolower($contains[$field]['input_name']);
			}
		}
		return $fields;
	}

	/**
	 * Get field non input
	 *
	 * @access	public
	 * @return	array
	 */
	public function getNonInputType()
	{
		return ['heading', 'captcha'];
	}	

	/**
	 * Get not show in validation
	 *
	 * @access	public
	 * @return	array
	 */
	public function getFieldNotShowInValidation()
	{
		return ['timestamp', 'current_user_username', 'current_user_id'];
	}

	/**
	 * Get not show in add form 
	 *
	 * @access	public
	 * @return	array
	 */
	public function getFieldNotShowInAddForm()
	{
		return ['timestamp', 'current_user_username', 'current_user_id'];
	}

	/**
	 * Get not show in update form 
	 *
	 * @access	public
	 * @return	array
	 */
	public function getFieldNotShowInUpdateForm()
	{
		return ['timestamp', 'current_user_username', 'current_user_id'];
	}

	/**
	 * Get not show in form component 
	 *
	 * @access	public
	 * @return	array
	 */
	public function getFieldNotShowInFormComponent()
	{
		return ['current_user_username', 'current_user_id'];
	}

	/**
	 * Get field custom value
	 *
	 * @access	public
	 * @return	mixed array 
	 */
	public function getFieldCustomValueType()
	{
		$result_arr = [];
		$result = $this->ci->db->get_where('crud_input_type', ['custom_value' => 1])->result();

		foreach ($result as $row) {
			$result_arr[] = $row->type;
		}

		return $result_arr;
	}
	
	/**
	 * Parse all attributes
	 *
	 * @access	public
	 * @return	String 
	 */
	public function parseAttributes($attributes = [])
	{
		$return = null;

		foreach ($attributes as $attribute) {
			$return .= $attribute['label'].' = "'.$attribute['value'].'" ';
		}
		
		return $return;
	}

	/**
	 * Get all type data
	 *
	 * @access	public
	 * @return	Array 
	 */
	public function getListTypeData()
	{
		
		return [
    		'VARCHAR' 	=> ['input', 'select', 'password', 'email', 'yes_no', 'true_false'],
    		'INT' 		=> ['number'],
    		'DATETIME' 	=> ['datetime'],
    		'DATE' 		=> ['date'],
    		'YEAR' 		=> ['year'],
    		'TIME' 		=> ['time'],
    		'TEXT' 		=> ['textarea', 'editor_wysiwyg', 'file', 'select_multiple', 'checkboxes', 'address_map', 'custom_option', 'custom_checkbox', 'custom_select_multiple', 'custom_select'],
    	];
	}

}

/* End of file Crud.php */
/* Location: ./application/libraries/Crud.php */