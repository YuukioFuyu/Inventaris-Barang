<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Jabatan Controller
*| --------------------------------------------------------------------------
*| Jabatan site
*|
*/
class Jabatan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_jabatan');
	}

	/**
	* show all Jabatans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('jabatan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['jabatans'] = $this->model_jabatan->get($filter, $field, $this->limit_page, $offset);
		$this->data['jabatan_counts'] = $this->model_jabatan->count_all($filter, $field);

		$config = [
			'base_url'     => 'jabatan/index/',
			'total_rows'   => $this->model_jabatan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Jabatan List');
		$this->render('backend/app-menu/jabatan/jabatan_list', $this->data);
	}
	
	/**
	* Add new jabatans
	*
	*/
	public function add()
	{
		$this->is_allowed('jabatan_add');

		$this->template->title('Jabatan New');
		$this->render('backend/app-menu/jabatan/jabatan_add', $this->data);
	}

	/**
	* Add New Jabatans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('jabatan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|max_length[50]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'jabatan' => $this->input->post('jabatan'),
			];

			
			$save_jabatan = $this->model_jabatan->store($save_data);

			if ($save_jabatan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_jabatan;
					$this->data['message'] = 'Data telah berhasil disimpan. '.anchor('jabatan/edit/' . $save_jabatan, 'Edit jabatan').' atau  '.anchor('jabatan', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil disimpan. '.anchor('jabatan/edit/' . $save_jabatan, 'Edit jabatan'), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('jabatan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Tidak ada data yang diubah';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('jabatan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Jabatans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('jabatan_update');

		$this->data['jabatan'] = $this->model_jabatan->find($id);

		$this->template->title('Jabatan Update');
		$this->render('backend/app-menu/jabatan/jabatan_update', $this->data);
	}

	/**
	* Update Jabatans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('jabatan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}
		
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|max_length[50]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'jabatan' => $this->input->post('jabatan'),
			];

			
			$save_jabatan = $this->model_jabatan->change($id, $save_data);

			if ($save_jabatan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = 'Data telah berhasil diperbarui. '.anchor('jabatan', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil diperbarui. ', 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('jabatan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Anda tidak melakukan perubahan data';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('jabatan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Jabatans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('jabatan_delete');

		$this->load->helper('file');

		if ($id !== null) {
			$arr_id = array($id);
		} else {
			$arr_id = $this->input->get('id');
		}

		if (empty($arr_id)) {
			set_message('Tidak ada item yang dipilih untuk dihapus.', 'error');
			redirect('jabatan');
			return;
		}

		$remove = false;

		foreach ($arr_id as $id) {
			$remove = $this->_remove($id);
		}

		if ($remove) {
            set_message('Data jabatan berhasil dihapus.', 'success');
		} else {
            set_message('Kesalahan menghapus data jabatan.', 'error');
		}

		redirect('jabatan');
	}

		/**
	* View view Jabatans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('jabatan_view');

		$this->data['jabatan'] = $this->model_jabatan->find($id);

		$this->template->title('Jabatan Detail');
		$this->render('backend/app-menu/jabatan/jabatan_view', $this->data);
	}
	
	/**
	* delete Jabatans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$jabatan = $this->model_jabatan->find($id);

		
		
		return $this->model_jabatan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('jabatan_export');

		$this->model_jabatan->export('jabatan', 'jabatan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('jabatan_export');

		$this->model_jabatan->pdf('jabatan', 'jabatan');
	}
}


/* End of file jabatan.php */
/* Location: ./application/controllers/Jabatan.php */