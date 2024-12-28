<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Group Controller
*| --------------------------------------------------------------------------
*| group site
*|
*/
class Group extends Admin	
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_group');
	}

	/**
	* show all groups
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('group_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['groups'] = $this->model_group->get($filter, $field, $this->limit_page, $offset);
		$this->data['group_counts'] = $this->model_group->count_all($filter, $field);

		$config = [
			'base_url'     => 'group/index/',
			'total_rows'   => $this->model_group->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Group List');
		$this->render('backend/app-menu/group/group_list', $this->data);
	}

	/**
	* show all groups
	*
	*/
	public function add()
	{
		$this->is_allowed('group_add');

		$this->template->title('Group New');
		$this->render('backend/app-menu/group/group_add', $this->data);
	}

	/**
	* Add New groups
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('group_add', false)) {
			return $this->response([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
		}

		$this->form_validation->set_rules('name', 'Nama', 'trim|required|is_unique[aauth_groups.name]');


		if ($this->form_validation->run()) {
			
			$save_data = [
				'name' 			=> $this->input->post('name'),
				'definition' 	=> $this->input->post('definition'),
			];

			$save_group = $this->model_group->store($save_data);

			if ($save_group) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['message'] = 'Data telah berhasil disimpan. '.anchor('group/edit/' . $save_group, 'Edit grup').' atau  '.anchor('group', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil disimpan. '.anchor('group/edit/' . $save_group, 'Edit grup'));

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('group');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Data not change';
				} else {
            		$this->data['success'] = false;
					$this->data['message'] = 'Data not change';
					$this->data['redirect'] = base_url('group');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		return $this->response($this->data);
	}


	/**
	* Update view groups
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('group_update');

		$this->data['group'] = $this->model_group->find($id);

		$this->template->title('Group Update');
		$this->render('backend/app-menu/group/group_update', $this->data);
	}

	/**
	* Update groups
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('group_update', false)) {
			return $this->response([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
		}

		$this->form_validation->set_rules('name', 'Nama', 'trim|required');

		if ($this->form_validation->run()) {
			
			$save_data = [
				'name' 			=> $this->input->post('name'),
				'definition' 	=> $this->input->post('definition'),
			];

			$save_group = $this->model_group->change($id, $save_data);

			if ($save_group) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = 'Data telah berhasil diperbarui. '.anchor('group', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil diperbarui. ', 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('group');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Your data not change';
				} else {
					$this->data['message'] = 'Data not change';
            		$this->data['success'] = false;
					$this->data['redirect'] = base_url('group');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		return $this->response($this->data);
	}

	/**
	* delete groups
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('group_delete');

		$this->load->helper('file');

		if ($id !== null) {
			$arr_id = array($id);
		} else {
			$arr_id = $this->input->get('id');
		}

		if (empty($arr_id)) {
			set_message('Tidak ada item yang dipilih untuk dihapus.', 'error');
			redirect('group');
			return;
		}

		$remove = false;

		foreach ($arr_id as $id) {
			$remove = $this->_remove($id);
		}

		if ($remove) {
            set_message('Group has been deleted.', 'success');
		} else {
            set_message('Error delete group.', 'error');
		}

		redirect('group');
	}

	/**
	* View view groups
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('group_view');

		$this->data['group'] = $this->model_group->find($id);

		$this->template->title('Group Detail');
		$this->render('backend/app-menu/group/group_view', $this->data);
	}

	/**
	* delete groups
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		return $this->model_group->remove($id);
	}

	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('group_export');

		$this->model_group->export('aauth_groups', 'group');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('group_export');

		$this->model_group->pdf('aauth_groups', 'group');
	}
}

/* End of file Group.php */
/* Location: ./application/controllers/Group.php */