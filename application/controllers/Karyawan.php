<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Karyawan Controller
*| --------------------------------------------------------------------------
*| Karyawan site
*|
*/
class Karyawan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_karyawan');
	}

	/**
	* show all Karyawans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('karyawan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['karyawans'] = $this->model_karyawan->get($filter, $field, $this->limit_page, $offset);
		$this->data['karyawan_counts'] = $this->model_karyawan->count_all($filter, $field);

		$config = [
			'base_url'     => 'karyawan/index/',
			'total_rows'   => $this->model_karyawan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Data Peminjam List');
		$this->render('backend/app-menu/karyawan/karyawan_list', $this->data);
	}
	
	/**
	* Add new karyawans
	*
	*/
	public function add()
	{
		$this->is_allowed('karyawan_add');

		$this->template->title('Data Peminjam New');
		$this->render('backend/app-menu/karyawan/karyawan_add', $this->data);
	}

	/**
	* Add New Karyawans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('karyawan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('telp', 'Telp', 'trim|required');
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				'telp' => $this->input->post('telp'),
				'nik' => $this->input->post('nik'),
				'jabatan' => $this->input->post('jabatan'),
			];

			
			$save_karyawan = $this->model_karyawan->store($save_data);

			if ($save_karyawan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_karyawan;
					$this->data['message'] = 'Data telah berhasil disimpan. '.anchor('karyawan/edit/' . $save_karyawan, 'Edit karyawan').' atau  '.anchor('karyawan', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil disimpan. '.anchor('karyawan/edit/' . $save_karyawan, 'Edit karyawan'), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('karyawan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Tidak ada data yang diubah';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('karyawan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Karyawans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('karyawan_update');

		$this->data['karyawan'] = $this->model_karyawan->find($id);

		$this->template->title('Data Peminjam Update');
		$this->render('backend/app-menu/karyawan/karyawan_update', $this->data);
	}

	/**
	* Update Karyawans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('karyawan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('telp', 'Telp', 'trim|required');
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				'telp' => $this->input->post('telp'),
				'nik' => $this->input->post('nik'),
				'jabatan' => $this->input->post('jabatan'),
			];

			
			$save_karyawan = $this->model_karyawan->change($id, $save_data);

			if ($save_karyawan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = 'Data telah berhasil diperbarui. '.anchor('karyawan', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil diperbarui. ', 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('karyawan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Anda tidak melakukan perubahan data';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('karyawan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Karyawans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('karyawan_delete');

		$this->load->helper('file');

		if ($id !== null) {
			$arr_id = array($id);
		} else {
			$arr_id = $this->input->get('id');
		}

		if (empty($arr_id)) {
			set_message('Tidak ada item yang dipilih untuk dihapus.', 'error');
			redirect('karyawan');
			return;
		}

		$remove = false;

		foreach ($arr_id as $id) {
			$remove = $this->_remove($id);
		}

		if ($remove) {
            set_message('data karyawan berhasil dihapus.', 'success');
		} else {
            set_message('Kesalahan menghapus data karyawan.', 'error');
		}

		redirect('karyawan');
	}

		/**
	* View view Karyawans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('karyawan_view');

		$this->data['karyawan'] = $this->model_karyawan->find($id);

		$this->template->title('Data Peminjam Detail');
		$this->render('backend/app-menu/karyawan/karyawan_view', $this->data);
	}
	
	/**
	* delete Karyawans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$karyawan = $this->model_karyawan->find($id);

		
		
		return $this->model_karyawan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('karyawan_export');

		$this->model_karyawan->export('karyawan', 'karyawan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('karyawan_export');

		$this->model_karyawan->pdf('karyawan', 'karyawan');
	}
}


/* End of file karyawan.php */
/* Location: ./application/controllers/Karyawan.php */