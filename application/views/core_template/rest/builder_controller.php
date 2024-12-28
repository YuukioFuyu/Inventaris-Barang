{php_open_tag}
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class <?= ucfirst($table_name); ?> extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_{table_name}');
	}

	/**
	 * @api {get} /{table_name}/all Get all {table_name}s.
	 * @apiVersion 0.1.0
	 * @apiName All<?= ucwords(str_replace(' ', '', clean_snake_case($table_name))); ?> 
	 * @apiGroup {table_name}
	 * @apiHeader {String} X-Api-Key {table_name_uc_no_space}s unique access-key.
	 <?php if ($x_token == 'yes'):
	 ?>* @apiHeader {String} X-Token {table_name_uc_no_space}s unique token.
	 <?php endif; 
	 ?>* @apiPermission {table_name_uc_no_space} Cant be Accessed permission name : api_{table_name}_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of {table_name_uc_no_space}s.
	 * @apiParam {String} [Field="All Field"] Optional field of {table_name_uc_no_space}s : <?= implode(', ', $show_in_column); ?>.
	 * @apiParam {String} [Start=0] Optional start index of {table_name_uc_no_space}s.
	 * @apiParam {String} [Limit=10] Optional limit data of {table_name_uc_no_space}s.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of {table_name}.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoData{table_name_uc_no_space} {table_name_uc_no_space} data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_{table_name}_all'<?= $x_token != 'yes' ? ', false' : ''; ?>);

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['<?= implode("', '", $show_in_column); ?>'];
		${table_name}s = $this->model_api_{table_name}->get($filter, $field, $limit, $start, $select_field);

		<?php if ($files = $this->crud_builder->getFieldFile()): 
		?>${table_name}_arr = [];

		foreach (${table_name}s as ${table_name}) {
			<?php foreach ($files as $file){ 
				if (in_array($file, $show_in_column)) {
			?>${table_name}-><?=$file;?>  = BASE_URL.'uploads/{table_name}/'.${table_name}-><?=$file;?>;
			<?php } 
				}
			?>${table_name}_arr[] = ${table_name};
		}

		$data['{table_name}'] = ${table_name}_arr;
		<?php else: 
		?>$data['{table_name}'] = ${table_name}s;
		<?php endif; ?>
		
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data {table_name_uc_no_space}',
			'data'	 	=> $data
		], API::HTTP_OK);
	}

	
	/**
	 * @api {get} /{table_name}/detail Detail {table_name_uc_no_space}.
	 * @apiVersion 0.1.0
	 * @apiName Detail{table_name_uc_no_space}
	 * @apiGroup {table_name}
	 * @apiHeader {String} X-Api-Key {table_name_uc_no_space}s unique access-key.
	 <?php if ($x_token == 'yes'):
	 ?>* @apiHeader {String} X-Token {table_name_uc_no_space}s unique token.
	 <?php endif; 
	 ?>* @apiPermission {table_name_uc_no_space} Cant be Accessed permission name : api_{table_name}_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of {table_name_uc_no_space}s.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of {table_name}.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError {table_name_uc_no_space}NotFound {table_name_uc_no_space} data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_{table_name}_detail'<?= $x_token != 'yes' ? ', false' : ''; ?>);

		$this->requiredInput(['{primary_key}']);

		$id = $this->get('{primary_key}');

		$select_field = ['<?= implode("', '", $show_in_column); ?>'];
		$data['{table_name}'] = $this->model_api_{table_name}->find($id, $select_field);

		if ($data['{table_name}']) {
			<?php if ($files = $this->crud_builder->getFieldFile()): 
			foreach ($files as $file){ 
				if (in_array($file, $show_in_column)) {
			?>$data['{table_name}']-><?= $file; ?> = BASE_URL.'uploads/{table_name}/'.$data['{table_name}']-><?= $file; ?>;
			<?php } 
			}
			endif; ?>

			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail {table_name_uc_no_space}',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> true,
				'message' 	=> '{table_name_uc_no_space} not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /{table_name}/add Add {table_name_uc_no_space}.
	 * @apiVersion 0.1.0
	 * @apiName Add{table_name_uc_no_space}
	 * @apiGroup {table_name}
	 * @apiHeader {String} X-Api-Key {table_name_uc_no_space}s unique access-key.
	 <?php if ($x_token == 'yes'):
	 ?>* @apiHeader {String} X-Token {table_name_uc_no_space}s unique token.
	 <?php endif; 
	 ?>* @apiPermission {table_name_uc_no_space} Cant be Accessed permission name : api_{table_name}_add
	 *
 	<?php
 	$files = $this->crud_builder->getFieldFile();
 	foreach ($this->crud_builder->getFieldShowInAddForm() as $input) {
			$mandatory = $this->crud_builder->getFieldValidation($input, 'required');
			$check_mandatory = function($input) use ($mandatory) {
				if ($mandatory) {
					return ucwords($input);
				} else {
					return '['.ucwords($input).']';
				}
			};
			if (!$this->crud_builder->getFieldFile($input)) {
				if ($this->crud_builder->isMultipleInput($input)) {
					$multiple = '[]';
				} else {
					$multiple = '';
				}
			?> * @apiParam {<?= in_array($input, $files) ? 'File' : 'String'; ?>} <?= $check_mandatory($input); ?> <?= $mandatory ? 'Mandatory' : 'Optional'; ?> <?= $input; ?> of {table_name_uc_no_space}s. <?= $this->crud_builder->parseValidationFile($input, null, null); ?> 
	<?php
			} else {
			?> * @apiParam {<?= in_array($input, $files) ? 'File' : 'String'; ?>} <?= $check_mandatory($input); ?> <?= $mandatory ? 'Mandatory' : 'Optional'; ?> <?= $input; ?> of {table_name_uc_no_space}s. <?= $this->crud_builder->parseValidationFile($input, null, null); ?> 
	<?php
			}
	} 
	?> *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function add_post()
	{
		$this->is_allowed('api_{table_name}_add'<?= $x_token != 'yes' ? ', false' : ''; ?>);

		<?php $file_avaiable = false; foreach ($this->crud_builder->getFieldValidation() as $input => $rules):
			if (in_array($input, $this->crud_builder->getFieldShowInAddForm())) {
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
				if (!$this->crud_builder->getFieldFile($input)) {
					
					if ($this->crud_builder->isMultipleInput($input)) {
						$multiple = '[]';
					} else {
						$multiple = '';
					}
				?>$this->form_validation->set_rules('<?= $input.$multiple; ?>', '<?= ucwords(clean_snake_case($input)); ?>', 'trim<?= build_rules('|', $rules_arr); ?>');
		<?php
				} else {
					$file_avaiable = true;
				}
			}
		endforeach; 
		?>

		if ($this->form_validation->run()) {

			$save_data = [
			<?php 
			foreach ($this->crud_builder->getFieldShowInAddForm(true, true) as $input => $option):
				if (in_array($option['input_type'], $this->crud_builder->getInputMultiple())) { 
				?>
	'<?= $input; ?>' => implode(',', (array) $this->input->post('<?= $input; ?>')),
<?php } elseif ($option['input_type'] == 'timestamp') { ?>
	'<?= $input; ?>' => date('Y-m-d H:i:s'),
<?php } else { ?>
	'<?= $input; ?>' => $this->input->post('<?= $input; ?>'),
<?php } ?>
			<?php endforeach; ?>];
			<?php 
			if ($file_avaiable) { 
			?>if (!is_dir(FCPATH . '/uploads/{table_name}')) {
				mkdir(FCPATH . '/uploads/{table_name}');
			}
			<?php } ?>

			<?php foreach ($this->crud_builder->getFieldFile() as $file): 
				$max_size = $this->crud_builder->getFieldValidation($file, 'max_size');
				$max_height = $this->crud_builder->getFieldValidation($file, 'max_height');
				$max_width = $this->crud_builder->getFieldValidation($file, 'max_width');
				$allowed_extension = $this->crud_builder->getFieldValidation($file, 'allowed_extension');
				$required = $this->crud_builder->getFieldValidation($file, 'required') ? 'true' : 'false';
				$allowed_extension = str_replace(',', '|', $allowed_extension);

	if (in_array($file, $show_in_update)) {
			?>$config = [
				'upload_path' 	=> './uploads/{table_name}/',
				<?php if ($allowed_extension){ 
			?>'allowed_types' => '<?= $allowed_extension; ?>',
<?php } 
			?><?php if ($max_size){ 
			?>
			'max_size' 	 	=> <?= $max_size; ?>,
<?php } 
			?><?php if ($max_width){ 
			?>
				'max_width' 	=> <?= $max_width; ?>,
<?php } 
			?><?php if ($max_height){ 
			?>
				'max_height' 	=> <?= $max_height; ?>,
			<?php } 
			?>
	'required' 		=> <?= $required; 
			?>

			];
			
			if ($upload = $this->upload_file('<?= $file; ?>', $config)){
				$upload_data = $this->upload->data();
				$save_data['<?= $file; ?>'] = $upload['file_name'];
			}

			<?php 
			}
			endforeach; 

			?>$save_{table_name} = $this->model_api_{table_name}->store($save_data);

			if ($save_{table_name}) {
				$this->response([
					'status' 	=> true,
					'message' 	=> 'Your data has been successfully stored into the database'
				], API::HTTP_OK);

			} else {
				$this->response([
					'status' 	=> false,
					'message' 	=> 'Data not change'
				], API::HTTP_NOT_ACCEPTABLE);
			}

		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	/**
	 * @api {post} /{table_name}/update Update {table_name_uc_no_space}.
	 * @apiVersion 0.1.0
	 * @apiName Update{table_name_uc_no_space}
	 * @apiGroup {table_name}
	 * @apiHeader {String} X-Api-Key {table_name_uc_no_space}s unique access-key.
	 <?php if ($x_token == 'yes'):
	 ?>* @apiHeader {String} X-Token {table_name_uc_no_space}s unique token.
	 <?php endif; ?>* @apiPermission {table_name_uc_no_space} Cant be Accessed permission name : api_{table_name}_update
	 *
	<?php
 	$files = $this->crud_builder->getFieldFile();
 	foreach ($this->crud_builder->getFieldShowInUpdateForm() as $input) {
			$mandatory = $this->crud_builder->getFieldValidation($input, 'required');
			$check_mandatory = function($input) use ($mandatory) {
				if ($mandatory) {
					return ucwords($input);
				} else {
					return '['.ucwords($input).']';
				}
			};
			if (!$this->crud_builder->getFieldFile($input)) {
				if ($this->crud_builder->isMultipleInput($input)) {
					$multiple = '[]';
				} else {
					$multiple = '';
				}
			?> * @apiParam {<?= in_array($input, $files) ? 'File' : 'String'; ?>} <?= $check_mandatory($input); ?> <?= $mandatory ? 'Mandatory' : 'Optional'; ?> <?= $input; ?> of {table_name_uc_no_space}s. <?= $this->crud_builder->parseValidationFile($input, null, null); ?> 
	<?php
			} else {
			?> * @apiParam {<?= in_array($input, $files) ? 'File' : 'String'; ?>} <?= $check_mandatory($input); ?> <?= $mandatory ? 'Mandatory' : 'Optional'; ?> <?= $input; ?> of {table_name_uc_no_space}s. <?= $this->crud_builder->parseValidationFile($input, null, null); ?> 
	<?php
			}
	} 
	?> * @apiParam {Integer} {primary_key} Mandatory {primary_key} of <?= ucwords(clean_snake_case($table_name)); ?>.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function update_post()
	{
		$this->is_allowed('api_{table_name}_update'<?= $x_token != 'yes' ? ', false' : ''; ?>);

		
		<?php $file_avaiable = false; foreach ($this->crud_builder->getFieldValidation() as $input => $rules):
			if (in_array($input, $this->crud_builder->getFieldShowInUpdateForm())) {
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
				if (!$this->crud_builder->getFieldFile($input)) {
					if ($this->crud_builder->isMultipleInput($input)) {
						$multiple = '[]';
					} else {
						$multiple = '';
					}
				?>$this->form_validation->set_rules('<?= $input.$multiple; ?>', '<?= ucwords(clean_snake_case($input)); ?>', 'trim<?= build_rules('|', $rules_arr); ?>');
		<?php
				} else {
					$file_avaiable = true;
				}
			}
		endforeach; 
		?>

		if ($this->form_validation->run()) {

			$save_data = [
			<?php 
			foreach ($this->crud_builder->getFieldShowInUpdateForm(true, true) as $input => $option):
				if (in_array($option['input_type'], $this->crud_builder->getInputMultiple())) { 
				?>
	'<?= $input; ?>' => implode(',', (array) $this->input->post('<?= $input; ?>')),
<?php } elseif ($option['input_type'] == 'timestamp') { ?>
	'<?= $input; ?>' => date('Y-m-d H:i:s'),
<?php } else { ?>
	'<?= $input; ?>' => $this->input->post('<?= $input; ?>'),
<?php } ?>
			<?php endforeach; ?>];
			<?php 
			if ($file_avaiable) { 
			?>if (!is_dir(FCPATH . '/uploads/{table_name}')) {
				mkdir(FCPATH . '/uploads/{table_name}');
			}
			<?php } ?>

			<?php foreach ($this->crud_builder->getFieldFile() as $file): 
				$max_size = $this->crud_builder->getFieldValidation($file, 'max_size');
				$max_height = $this->crud_builder->getFieldValidation($file, 'max_height');
				$max_width = $this->crud_builder->getFieldValidation($file, 'max_width');
				$allowed_extension = $this->crud_builder->getFieldValidation($file, 'allowed_extension');
				$required = $this->crud_builder->getFieldValidation($file, 'required') ? 'true' : 'false';
				$allowed_extension = str_replace(',', '|', $allowed_extension);

				if (in_array($file, $show_in_update)) {
			?>$config = [
				'upload_path' 	=> './uploads/{table_name}/',
				<?php if ($allowed_extension){ 
			?>'allowed_types' => '<?= $allowed_extension; ?>',
<?php } 
			?><?php if ($max_size){ 
			?>
			'max_size' 	 	=> <?= $max_size; ?>,
<?php } 
			?><?php if ($max_width){ 
			?>
				'max_width' 	=> <?= $max_width; ?>,
<?php } 
			?><?php if ($max_height){ 
			?>
				'max_height' 	=> <?= $max_height; ?>,
			<?php } 
			?>
	'required' 		=> <?= $required; 
			?>

			];
			
			if ($upload = $this->upload_file('<?= $file; ?>', $config)){
				$upload_data = $this->upload->data();
				$save_data['<?= $file; ?>'] = $upload['file_name'];
			}

			<?php 
			}
			endforeach; 

			?>$save_{table_name} = $this->model_api_{table_name}->change($this->post('{primary_key}'), $save_data);

			if ($save_{table_name}) {
				$this->response([
					'status' 	=> true,
					'message' 	=> 'Your data has been successfully updated into the database'
				], API::HTTP_OK);

			} else {
				$this->response([
					'status' 	=> false,
					'message' 	=> 'Data not change'
				], API::HTTP_NOT_ACCEPTABLE);
			}

		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}
	
	/**
	 * @api {post} /{table_name}/delete Delete {table_name_uc_no_space}. 
	 * @apiVersion 0.1.0
	 * @apiName Delete{table_name_uc_no_space}
	 * @apiGroup {table_name}
	 * @apiHeader {String} X-Api-Key {table_name_uc_no_space}s unique access-key.
	 <?php if ($x_token == 'yes'):
	 ?>* @apiHeader {String} X-Token {table_name_uc_no_space}s unique token.
	 <?php endif; ?>
	 * @apiPermission {table_name_uc_no_space} Cant be Accessed permission name : api_{table_name}_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of {table_name_uc_no_space}s .
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function delete_post()
	{
		$this->is_allowed('api_{table_name}_delete'<?= $x_token != 'yes' ? ', false' : ''; ?>);

		${table_name} = $this->model_api_{table_name}->find($this->post('{primary_key}'));

		if (!${table_name}) {
			$this->response([
				'status' 	=> false,
				'message' 	=> '{table_name_uc_no_space} not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_{table_name}->remove($this->post('{primary_key}'));

			<?php foreach ($files = $this->crud_builder->getFieldFile() as $file): 
			?>if (!empty(${table_name}-><?= $file; ?>)) {
				$path = FCPATH . '/uploads/{table_name}/' . ${table_name}-><?= $file; ?>;

				if (is_file($path)) {
					$delete_file = unlink($path);
				}
			}

		<?php endforeach; ?>}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> '{table_name_uc_no_space} deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> '{table_name_uc_no_space} not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

}

/* End of file {table_name_uc_no_space}.php */
/* Location: ./application/controllers/api/{table_name_uc_no_space}.php */