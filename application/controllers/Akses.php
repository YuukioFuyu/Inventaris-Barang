<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Access Controller
*| --------------------------------------------------------------------------
*| access site
*|
*/
class Akses extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model([
			'model_akses',
			'model_group'
		]);
	}

	/**
	* show all access
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('akses_list');

		$this->data['groups'] = $this->model_group->find_all();

		$this->template->title('Akses List');
		$this->render('backend/app-menu/akses/akses_list', $this->data);
	}

	/**
	* Update accesss
	*
	* @var String $id 
	*/
	public function save()
	{
		if (!$this->is_allowed('akses_update', false)) {
			return $this->response([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
		}

		$permissions = $this->input->post('id');
		$group_id = $this->input->post('group_id');

		$this->db->delete('aauth_perm_to_group', ['group_id' => $group_id]);
		if (count($permissions)) {
			$data = [];
			foreach ($permissions as $perms) {
				$data[] = [
					'perm_id' => $perms,
					'group_id' => $group_id,
				];
			}
			$save_akses = $this->db->insert_batch('aauth_perm_to_group', $data);
		} else {
			$save_akses = true;
		}

		if ($save_akses) {
			$this->data = [
				'success' => true,
				'message' => 'Data telah berhasil diperbarui. ',
			];
		} else {
			$this->data = [
				'success' => false,
				'message' => 'Data not change ',
			];
		}

		return $this->response($this->data);
	}

	/**
	* Get Access group
	*
	* @var String $group_id 
	*/
	public function get_akses_group($group_id)
	{
		if (!$this->is_allowed('akses_list', false)) {
			echo '<center>Maaf, Anda tidak memiliki izin untuk mengakses</center>';
			exit;
		}
		$group_perms_groupping = [];

		$group_perms = $this->model_group->get_permission_group($group_id);
		foreach(db_get_all_data('aauth_perms') as $perms) { 

			$group_name = 'other';
			$perm_tmp_arr = explode('_', $perms->name);

			if (isset($perm_tmp_arr[0]) AND !empty($perm_tmp_arr[0])) {
				$group_name =  strtolower($perm_tmp_arr[0]);
			} 
			$group_perms_groupping[$group_name][] = $perms;
		}

		foreach($group_perms_groupping as $group_name => $childs) { ?>
			
			<li>
				<label class="text-green toggle-select-all-akses" title="click to toggle check group" data-target=".<?= $group_name; ?>"><b><?= ucwords($group_name); ?></b></label>
			</li>
			<?php foreach($childs as $perms) { ?>
			<li>
				<label>
					<input type="checkbox" class="flat-red check <?= $group_name; ?>" name="id[]" value="<?= $perms->id; ?>" <?= array_search($perms->id, $group_perms) ? 'checked' : ''; ?>>
					<?= _ent(ucwords(clean_snake_case($perms->name))); ?>
				</label>
			</li>
			<?php }
		}
	}
}


/* End of file Akses.php */
/* Location: ./application/controllers/Akses.php */
