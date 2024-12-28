<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Rest Controller
*| --------------------------------------------------------------------------
*| rest site
*|
*/
class Rest extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_rest');
	}

	/**
	* show all rests
	*
	* @var String $offset 
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('rest_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['rests'] = $this->model_rest->get($filter, $field, $this->limit_page, $offset);
		$this->data['rest_counts'] = $this->model_rest->count_all($filter, $field);

		$config = [
			'base_url'     => 'rest/index/',
			'total_rows'   => $this->model_rest->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Rest List');
		$this->render('backend/app-menu/rest/rest_list', $this->data);
	}

	/**
	* show all rests
	*
	*/
	public function add()
	{
		$this->is_allowed('rest_add');
		$this->template->title('Rest New');

		$directories = directory_map(APPPATH . '/controllers/api/');
		$directories = array_map(function($val) {
			return strtolower(str_replace('.php', '', $val));
		}, $directories);
		$tables = array_diff($this->db->list_tables(), $directories);

		$tables = array_diff($tables, get_table_not_allowed_for_builder());	

		$this->data['tables'] = $tables;

		$this->render('backend/app-menu/rest/rest_add', $this->data);
	}

	/**
	* Add New rests
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('rest_add', false)) {
			return $this->response([
				'success' => false,
				'message' => 'Sorry you do not have rest to access'
				]);
			exit;
		}

		$this->form_validation->set_rules('table_name', 'Table', 'trim|required|callback_valid_table_avaiable');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('primary_key', 'Primary Key of Table', 'trim|required');

		echo $this->save_rest();
	}


	/**
	* Update view rests
	*
	* @var String $id 
	*/
	public function edit($id)
	{
		$this->is_allowed('rest_edit');

		$this->data = [
			'rest' => $this->model_rest->find($id),
			'rest_field' => $this->model_rest->get_rest_field($id),
			'rest_field_validation' => $this->model_rest->get_rest_field_validation($id),
		];
		$this->template->title('Rest Update');
		$this->render('backend/app-menu/rest/rest_update', $this->data);
	}

	/**
	* Update rests
	*
	* @var String $id 
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('rest_update', false)) {
			return $this->response([
				'success' => false,
				'message' => 'Sorry you do not have rest to access'
				]);
			exit;
		}

		$this->form_validation->set_rules('subject', 'Subject', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('primary_key', 'Primary Key of Table', 'trim|required');

		echo $this->save_rest();
	}

	public function save_rest()
	{
		if ($this->form_validation->run()) {
			$this->load->library('parser');
			$this->load->helper('file');
			$this->load->helper('directory');
			$this->load->library('crud_builder', [
				'crud' => $_POST['rest']
				]);

			$this->data = [
				'php_open_tag' 				=> '<?php',
				'php_close_tag' 			=> '?>',
				'php_open_tag_echo' 		=> '<?=',
				'table_name'				=> $this->input->post('table_name'),
				'table_name_uc_no_space'	=> clean_snake_case(ucwords($this->input->post('table_name'))),
				'primary_key'				=> $this->input->post('primary_key'),
				'subject'					=> $this->input->post('subject'),
				'non_input_able_validation' => $this->crud_builder->getNonInputableValidation(),
				'input_able_validation'		=> $this->crud_builder->getInputableValidation(),
				'show_in_add'				=> $this->crud_builder->getFieldShowInAddForm(),
				'show_in_column'			=> $this->crud_builder->getFieldShowInColumn(),
				'show_in_update'			=> $this->crud_builder->getFieldShowInUpdateForm(),
				'x_api_key'					=> $this->input->post('x_api_key'),
				'x_token'					=> $this->input->post('x_token'),
			];

			if ($this->input->post('title')) {
				$this->data['title'] = $this->input->post('title');
			} else {
				$this->data['title'] = $this->input->post('subject');
			}

			$table_name = $this->input->post('table_name');

			$controller_path = FCPATH . '/application/controllers/api/';
			$model_path = FCPATH . '/application/models/';

			$validate = $this->crud_builder->validateAll();

			if ($validate->isError()) {
				return $this->response([
					'success' => false,
					'message' => $validate->getErrorMessage()
					]);
				exit;
			}

			$template_rest_path = 'core_template/rest/';

			$builder_list = $this->parser->parse($template_rest_path.'builder_controller', $this->data, true);
			write_file($controller_path.ucwords($table_name).'.php', $builder_list);

			$builder_list = $this->parser->parse('core_template/rest/builder_model', $this->data, true);
			write_file($model_path.'Model_api_'.$table_name.'.php', $builder_list);
			
			$api_doc = $this->parser->parse('core_template/apidoc/api_data', $this->data, true);
			write_file(FCPATH.'apidoc/module/'.$table_name.'.json', $api_doc);

			$this->generate_apidoc();

			$this->aauth->create_perm('api_'.$table_name.'_all');
			$this->aauth->create_perm('api_'.$table_name.'_detail');
			$this->aauth->create_perm('api_'.$table_name.'_add');
			$this->aauth->create_perm('api_'.$table_name.'_update');
			$this->aauth->create_perm('api_'.$table_name.'_delete');

			$save_data = [
				'table_name' 			=> $this->input->post('table_name'),
				'primary_key'			=> $this->input->post('primary_key'),
				'subject' 				=> $this->input->post('subject'),
				'x_api_key' 			=> $this->input->post('x_api_key') ? $this->input->post('x_api_key') : 'no',
				'x_token' 				=> $this->input->post('x_token') ? $this->input->post('x_token') : 'no',
			];

			if ($id_rest = $this->model_rest->rest_exist($this->input->post('table_name'))) {
				$this->model_rest->change($id_rest, $save_data);
			} else {
				$id_rest = $this->model_rest->store($save_data);
			}
			$save_data_field = [];
			$this->db->delete('rest_field', ['rest_id' => $id_rest]);
			$this->db->delete('rest_field_validation', ['rest_id' => $id_rest]);

			foreach ($this->input->post('rest') as $val) {
				$field_name = array_keys($val)[0];
				$input_type = isset($val[$field_name]['input_type']) ? $val[$field_name]['input_type'] : '';
				$show_in_column = isset($val[$field_name]['show_in_column']) ? $val[$field_name]['show_in_column'] : '';
				$show_in_add_form = isset($val[$field_name]['show_in_add_form']) ? $val[$field_name]['show_in_add_form'] : '';
				$show_in_add_form = isset($val[$field_name]['show_in_add_form']) ? $val[$field_name]['show_in_add_form'] : '';
				$show_in_update_form = isset($val[$field_name]['show_in_update_form']) ? $val[$field_name]['show_in_update_form'] : '';
				$show_in_detail_page = isset($val[$field_name]['show_in_detail_page']) ? $val[$field_name]['show_in_detail_page'] : '';

				$save_data_field = [
					'rest_id' 				=> $id_rest,
					'field_name' 			=> $field_name,
					'input_type' 			=> $input_type,
					'show_column' 			=> $show_in_column,
					'show_add_api' 			=> $show_in_add_form,
					'show_update_api' 		=> $show_in_update_form,
					'show_detail_api' 		=> $show_in_detail_page,
				];

				$this->db->insert('rest_field', $save_data_field);

				$rest_field_id = $this->db->insert_id();

				$save_data_rule = [];

				if (isset($val[$field_name]['validation']['rules'])) {
					foreach ($val[$field_name]['validation']['rules'] as $rule => $value) {
						$save_data_rule[] = [
							'rest_field_id' 	=> $rest_field_id, 
							'rest_id' 			=> $id_rest,
							'validation_name' 	=> $rule, 
							'validation_value'	=> $value
						];
					}
				}

				if (count($save_data_rule)) {
					$this->db->insert_batch('rest_field_validation', $save_data_rule);
				}
			}


			if ($this->input->post('save_type') == 'stay') {
				$this->response['success'] = true;
				$this->response['message'] = 'Your data has been successfully saved into the database. '.anchor('rest', ' Go back to list').' or '.anchor('rest/view/'.$id_rest, ' View');
			} else {
				set_message('Your data has been successfully saved into the database. '.anchor('rest/view/'.$id_rest, ' View'), 'success');
        		$this->response['success'] = true;
				$this->response['redirect'] = site_url('rest');
			}
		} else {
			$this->response['success'] = false;
			$this->response['message'] = validation_errors();
		}

		return json_encode($this->response);
	}

	/**
	* Generate apidoc
	*
	* @return void
	*/
	public function generate_apidoc()
	{
		$this->load->helper('file');
		$this->load->helper('directory');

		$contents = '';
		$dir_map = directory_map(FCPATH.'apidoc/module/');
		$i=0;
		foreach ($dir_map as $module) {
			$i++;
			if (is_file(FCPATH.'apidoc/module/'.$module)) {
				$contents .= read_file(BASE_URL.'apidoc/module/'.$module).($i<count($dir_map) ? ',' : '');
			}
		}

		$this->data['api_doc'] = $contents;
		$api_doc_js = $this->parser->parse('core_template/apidoc/api_data_js', $this->data, true);
		write_file(FCPATH.'apidoc/api_data.js', $api_doc_js);

	}

	/**
	* View view rests
	*
	* @var String $id 
	*/
	public function view($id)
	{
		$this->is_allowed('rest_view');
		
		$this->data = [
			'rest' => $this->model_rest->find($id),
			'rest_field' => $this->model_rest->get_rest_field($id),
			'rest_field_validation' => $this->model_rest->get_rest_field_validation($id),
		];

		$this->template->title('Rest Detail');
		$this->render('backend/app-menu/rest/rest_view', $this->data);
	}

	/**
	* Rest tool
	*
	*/
	public function tool($segment = null)
	{
		$this->is_allowed('rest_view');

		$this->data = [
			'methods' => ['get', 'post', 'put', 'patch', 'delete', 'head', 'options']
		];
		$this->template->title('Rest Tool');
		$this->render('backend/app-menu/rest/rest_tool', $this->data);
	}

	/**
	* delete rests
	*
	* @var String $id
	*/
	public function delete($id = null)
	{
		$this->is_allowed('rest_delete');

		$this->load->helper('file');

		if ($id !== null) {
			$arr_id = array($id);
		} else {
			$arr_id = $this->input->get('id');
		}

		if (empty($arr_id)) {
			set_message('Tidak ada item yang dipilih untuk dihapus.', 'error');
			redirect('rest');
			return;
		}

		$remove = false;

		foreach ($arr_id as $id) {
			$remove = $this->_remove($id);
		}

		if ($remove) {
            set_message('Data rest berhasil dihapus.', 'success');
		} else {
            set_message('Kesalahan menghapus data rest.', 'error');
		}

		$this->generate_apidoc();
		
		redirect('rest');
	}

	/**
	* delete rests
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$rest = $this->model_rest->find($id);

		if ($rest->table_name) {
			$controller_path = FCPATH . '/application/controllers/api/'.ucwords($rest->table_name).'.php';
			$model_path = FCPATH . '/application/models/Model_api_'.$rest->table_name.'.php';
			$apidoc_path = FCPATH.'/apidoc/module/'.$rest->table_name.'.json';
			
			if (is_file($controller_path)) {
				unlink($controller_path);
			}
			if (is_file($model_path)) {
				unlink($model_path);
			}
			if (is_file($apidoc_path)) {
				unlink($apidoc_path);
			}

			$table_name = $rest->table_name;

			$this->db->where_in('name', [
				'api_'.$table_name.'_all', 
				'api_'.$table_name.'_add', 
				'api_'.$table_name.'_update', 
				'api_'.$table_name.'_detail', 
				'api_'.$table_name.'_delete']
			);
			$this->db->delete('aauth_perms');
			$this->db->delete('rest_field', ['rest_id' => $id]);
			$this->db->delete('rest_field_validation', ['rest_id' => $id]);
		}

		return $this->model_rest->remove($id);
	}

	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('rest_export');

		$this->model_rest->export('rest', 'rest');
	}

	/**
	* Get field data
	*
	* @return String
	*/
	public function get_field_data($table)
	{
		$this->data['html'] = $this->load->view('backend/app-menu/rest/rest_field_data.php', ['table' => $table], true);
		$this->data['subject'] = ucwords(clean_snake_case($table));
		$this->data['success'] = true;

		return $this->response($this->data);

	}

	/**
	* Get rest test all
	*
	* @return html
	*/
	public function get_rest_test_all($id)
	{
		$this->data = [
			'rest' => $this->model_rest->find($id)
		];

		$this->data['html'] = $this->load->view('backend/app-menu/rest/rest_test_all.php', $this->data, true);
		$this->data['success'] = true;

		return $this->response($this->data);

	}

	/**
	* Get rest test detail
	*
	* @return html
	*/
	public function get_rest_test_detail($id)
	{
		$this->data = [
			'rest' => $this->model_rest->find($id)
		];

		$this->data['html'] = $this->load->view('backend/app-menu/rest/rest_test_detail.php', $this->data, true);
		$this->data['success'] = true;

		return $this->response($this->data);

	}

	/**
	* Get rest test detail
	*
	* @return html
	*/
	public function get_rest_test_delete($id)
	{
		$this->data = [
			'rest' => $this->model_rest->find($id)
		];

		$this->data['html'] = $this->load->view('backend/app-menu/rest/rest_test_delete.php', $this->data, true);
		$this->data['success'] = true;

		return $this->response($this->data);

	}

	/**
	* Get rest test add
	*
	* @return html
	*/
	public function get_rest_test_add($id)
	{
		$this->data = [
			'rest' => $this->model_rest->find($id),
			'rest_field' => $this->model_rest->get_rest_field_in_api($id, 'show_add_api'),
			'rest_field_validation' => $this->model_rest->get_rest_field_validation($id),
		];

		$this->data['html'] = $this->load->view('backend/app-menu/rest/rest_test_add.php', $this->data, true);
		$this->data['success'] = true;

		return $this->response($this->data);

	}

	/**
	* Get rest test update
	*
	* @return html
	*/
	public function get_rest_test_update($id)
	{
		$this->data = [
			'rest' => $this->model_rest->find($id),
			'rest_field' => $this->model_rest->get_rest_field_in_api($id, 'show_update_api'),
			'rest_field_validation' => $this->model_rest->get_rest_field_validation($id),
		];

		$this->data['html'] = $this->load->view('backend/app-menu/rest/rest_test_update.php', $this->data, true);
		$this->data['success'] = true;

		return $this->response($this->data);

	}

	/**
	* Get resource
	*
	* @return JSON
	*/
	public function get_resource()
	{
		$api_path = APPPATH . 'controllers/api/';
		$clasess = directory_map($api_path);
		$resources = [];
		$methods = ['all', 'add', 'update', 'delete'];
		$filter = $this->input->get('term');

		foreach ($clasess as $class) {
			if (substr(strrchr($class,'.'),1) == 'php') {
				foreach ($methods as $method) {
					$resources[] = '{api_endpoint}' . basename(strtolower($class), '.php') . '/' . $method;
				}
			}
		}

		$resources = array_merge($resources, [
			'{api_endpoint}user/login',
			'{api_endpoint}user/request_token',
			'{api_endpoint}user/update_profile',
			'{api_endpoint}user/profile',
		]);

		$filter = preg_quote($filter, '~'); 
		$data = preg_grep('~' . $filter . '~', $resources);
		$data = array_slice($data, 0, 10);

		return $this->response($data);
	}

}

/* End of file Rest.php */
/* Location: ./application/controllers/Rest.php */