{php_open_tag}
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| <?= ucwords(clean_snake_case($table_name)); ?> Controller
*| --------------------------------------------------------------------------
*| <?= ucwords(clean_snake_case($table_name)); ?> site
*|
*/
class <?= ucwords($table_name); ?> extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_{table_name}');
	}

	/**
	* show all <?= ucwords(clean_snake_case($table_name)); ?>s
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('{table_name}_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['{table_name}s'] = $this->model_{table_name}->get($filter, $field, $this->limit_page, $offset);
		$this->data['{table_name}_counts'] = $this->model_{table_name}->count_all($filter, $field);

		$config = [
			'base_url'     => '{table_name}/index/',
			'total_rows'   => $this->model_{table_name}->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('<?= ucwords(clean_snake_case($title)); ?> List');
		$this->render('backend/app-menu/form_builder/{table_name}/{table_name}_list', $this->data);
	}

	/**
	* Update view <?= ucwords(clean_snake_case($table_name)); ?>s
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('{table_name}_update');

		$this->data['{table_name}'] = $this->model_{table_name}->find($id);

		$this->template->title('<?= ucwords(clean_snake_case($title)); ?> Update');
		$this->render('backend/app-menu/form_builder/{table_name}/{table_name}_update', $this->data);
	}

	/**
	* Update <?= ucwords(clean_snake_case($table_name)); ?>s
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('{table_name}_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Sorry you do not have permission to access'
				]);
			exit;
		}
		
		<?php foreach ($this->crud_builder->getFieldValidation() as $input => $rules):
				$rules_arr = [];
				foreach ($rules as $rule => $val) {
					if (!in_array($rule, ['allowed_extension', 'max_width', 'max_height', 'max_size'])) {
						if (in_array($rule, $this->crud_builder->getCallBackValidation())) {
							$call_back = 'callback_';
						} else {
							$call_back = '';
						}
						if (in_array($rule, $non_input_able_validation)) {
							$rules_arr[] = $call_back.$rule;
						} else {
							$rules_arr[] = $call_back.$rule.'['.$val.']';
						}
					}
				}
				if ($this->crud_builder->getFieldFile($input)) {
					?>$this->form_validation->set_rules('{table_name}_<?= $field_all[$input]['input_name']; ?>_name', '<?= ucwords(clean_snake_case($field_all[$input]['input_label'])); ?>', 'trim<?= build_rules('|', $rules_arr); ?>');
		<?php
				} else {
				if ($this->crud_builder->isMultipleInput($input)) {
					$multiple = '[]';
				} else {
					$multiple = '';
				}
				?>$this->form_validation->set_rules('<?= $field_all[$input]['input_name'].$multiple; ?>', '<?= ucwords(clean_snake_case($field_all[$input]['input_label'])); ?>', 'trim<?= build_rules('|', $rules_arr); ?>');
		<?php
				}
		endforeach; 
		?>

		if ($this->form_validation->run()) {
		<?php 
		foreach ($this->crud_builder->getFieldFile() as $file):
		?>
	${table_name}_<?= $field_all[$file]['input_name']; ?>_uuid = $this->input->post('{table_name}_<?= $field_all[$file]['input_name']; ?>_uuid');
			${table_name}_<?= $field_all[$file]['input_name']; ?>_name = $this->input->post('{table_name}_<?= $field_all[$file]['input_name']; ?>_name');
		<?php 
		endforeach; 
		?>

			$save_data = [
			<?php foreach ($this->crud_builder->getFieldAllForm(true, true) as $input => $option):
				if (in_array($option['input_type'], $this->crud_builder->getInputMultiple())) { 
				?>
	'<?= $option['input_name']; ?>' => implode(',', (array) $this->input->post('<?= $option['input_name']; ?>')),
<?php } elseif ($option['input_type'] == 'timestamp') { ?>
	'<?= $option['input_name']; ?>' => date('Y-m-d H:i:s'),
<?php } else { 
	  if (!in_array($option['input_type'], $this->crud_builder->getNonInputType())) { ?>
	'<?= $option['input_name']; ?>' => $this->input->post('<?= $option['input_name']; ?>'),
<?php } 
	}
?>
			<?php endforeach; ?>];

			<?php 
			if ($this->crud_builder->getFieldFile()) { 
				?>if (!is_dir(FCPATH . '/uploads/{table_name}/')) {
				mkdir(FCPATH . '/uploads/{table_name}/');
			}

			<?php	
			}
			foreach ($this->crud_builder->getFieldFile() as $file):
			?>
if (!empty(${table_name}_<?= $field_all[$file]['input_name']; ?>_uuid)) {
				${table_name}_<?= $field_all[$file]['input_name']; ?>_name_copy = date('YmdHis') . '-' . ${table_name}_<?= $field_all[$file]['input_name']; ?>_name;

				rename(FCPATH . 'uploads/tmp/' . ${table_name}_<?= $field_all[$file]['input_name']; ?>_uuid . '/' . ${table_name}_<?= $field_all[$file]['input_name']; ?>_name, 
						FCPATH . 'uploads/{table_name}/' . ${table_name}_<?= $field_all[$file]['input_name']; ?>_name_copy);

				if (!is_file(FCPATH . '/uploads/{table_name}/' . ${table_name}_<?= $field_all[$file]['input_name']; ?>_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['<?= $field_all[$file]['input_name']; ?>'] = ${table_name}_<?= $field_all[$file]['input_name']; ?>_name_copy;
			}
		
			<?php 
			endforeach; 
			?>

			$save_{table_name} = $this->model_{table_name}->change($id, $save_data);

			if ($save_{table_name}) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = 'Your data has been successfully updated into the database. '.anchor('{table_name}', ' Go back to list');
				} else {
					set_message('Your data has been successfully updated into the database. ', 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('{table_name}');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Your data not change';
				} else {
					set_message('Your data not change.', 'error');
					
            		$this->data['success'] = false;
					$this->data['message'] = 'Your data not change';
					$this->data['redirect'] = base_url('{table_name}');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	* delete <?= ucwords(clean_snake_case($table_name)); ?>s
	*
	* @var $id String
	*/
	public function delete($id)
	{
		$this->is_allowed('{table_name}_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id);
			}
		}

		if ($remove) {
            set_message('<?= ucwords(clean_snake_case($table_name)); ?> has been deleted.', 'success');
		} else {
            set_message('Error delete {table_name}.', 'error');
		}

		redirect('{table_name}');
	}

	/**
	* View view <?= ucwords(clean_snake_case($table_name)); ?>s
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('{table_name}_view');

		$this->data['{table_name}'] = $this->model_{table_name}->find($id);

		$this->template->title('<?= ucwords(clean_snake_case($title)); ?> Detail');
		$this->render('backend/app-menu/form_builder/{table_name}/{table_name}_view', $this->data);
	}

	/**
	* delete <?= ucwords(clean_snake_case($table_name)); ?>s
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		${table_name} = $this->model_{table_name}->find($id);

		<?php foreach ($files = $this->crud_builder->getFieldFile() as $file): 
		?>if (!empty(${table_name}-><?= $field_all[$file]['input_name']; ?>)) {
			$path = FCPATH . '/uploads/{table_name}/' . ${table_name}-><?= $field_all[$file]['input_name']; ?>;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}

		<?php endforeach; ?>

		return $this->model_{table_name}->remove($id);
	}
	<?php foreach ($this->crud_builder->getFieldFile() as $file): 
		$max_size = $this->crud_builder->getFieldValidation($file, 'max_size');
		$max_height = $this->crud_builder->getFieldValidation($file, 'max_height');
		$max_width = $this->crud_builder->getFieldValidation($file, 'max_width');
		$allowed_extension = $this->crud_builder->getFieldValidation($file, 'allowed_extension');
		$allowed_extension = str_replace(',', '|', $allowed_extension);
	?>

	/**
	* Upload Image <?= ucwords(clean_snake_case($table_name)); ?>
	* 
	* @return JSON
	*/
	public function upload_<?= $field_all[$file]['input_name']; ?>_file()
	{
		if (!$this->is_allowed('{table_name}_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Sorry you do not have permission to access'
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> '{table_name}',
<?php if ($allowed_extension): 
			?>
			'allowed_types' => '<?= $allowed_extension; ?>',
<?php endif; 
			?><?php if ($max_size): 
			?>
			'max_size' 	 	=> <?= $max_size; ?>,
<?php endif; 
			?><?php if ($max_width): 
			?>
			'max_width' 	=> <?= $max_width; ?>,
<?php endif; 
			?><?php if ($max_height): 
			?>
			'max_height' 	=> <?= $max_height; ?>,
			<?php endif; ?>		]);
	}

	/**
	* Delete Image <?= ucwords(clean_snake_case($table_name)); ?>
	* 
	* @return JSON
	*/
	public function delete_<?= $field_all[$file]['input_name']; ?>_file($uuid)
	{
		if (!$this->is_allowed('{table_name}_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => 'Sorry you do not have permission to access'
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => '<?= $field_all[$file]['input_name']; ?>', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => '{table_name}',
            'primary_key'       => '{primary_key}',
            'upload_path'       => 'uploads/{table_name}/'
        ]);
	}

	/**
	* Get Image <?= ucwords(clean_snake_case($table_name)); ?>
	* 
	* @return JSON
	*/
	public function get_<?= $field_all[$file]['input_name']; ?>_file($id)
	{
		if (!$this->is_allowed('{table_name}_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		${table_name} = $this->model_{table_name}->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => '<?= $field_all[$file]['input_name']; ?>', 
            'table_name'        => '{table_name}',
            'primary_key'       => '{primary_key}',
            'upload_path'       => 'uploads/{table_name}/',
            'delete_endpoint'   => '{table_name}/delete_<?= $field_all[$file]['input_name']; ?>_file'
        ]);
	}
	<?php endforeach; ?>

	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('{table_name}_export');

		$this->model_{table_name}->export('{table_name}', '{table_name}');
	}
}


/* End of file {table_name}.php */
/* Location: ./application/controllers/<?= ucwords(clean_snake_case($table_name)); ?>.php */