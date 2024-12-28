<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Lokasi Controller
*| --------------------------------------------------------------------------
*| Lokasi site
*|
*/
class Lokasi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_lokasi');
	}

	/**
	* show all Lokasis
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('lokasi_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['lokasis'] = $this->model_lokasi->get($filter, $field, $this->limit_page, $offset);
		$this->data['lokasi_counts'] = $this->model_lokasi->count_all($filter, $field);

		$config = [
			'base_url'     => 'lokasi/index/',
			'total_rows'   => $this->model_lokasi->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Lokasi List');
		$this->render('backend/app-menu/lokasi/lokasi_list', $this->data);
	}
	
	/**
	* Add new lokasis
	*
	*/
	public function add()
	{
		$this->is_allowed('lokasi_add');

		$this->template->title('Lokasi New');
		$this->render('backend/app-menu/lokasi/lokasi_add', $this->data);
	}

	/**
	* Add New Lokasis
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('lokasi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		$this->form_validation->set_rules('nama_lokasi', 'Nama Lokasi', 'trim|required');
		$this->form_validation->set_rules('departemen', 'Departemen', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama_lokasi' => $this->input->post('nama_lokasi'),
				'departemen' => $this->input->post('departemen'),
			];

			
			$save_lokasi = $this->model_lokasi->store($save_data);

			if ($save_lokasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_lokasi;
					$this->data['message'] = 'Data telah berhasil disimpan. '.anchor('lokasi/edit/' . $save_lokasi, 'Edit lokasi').' atau  '.anchor('lokasi', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil disimpan. '.anchor('lokasi/edit/' . $save_lokasi, 'Edit lokasi'), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('lokasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Tidak ada data yang diubah';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('lokasi');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Lokasis
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('lokasi_update');

		$this->data['lokasi'] = $this->model_lokasi->find($id);

		$this->template->title('Lokasi Update');
		$this->render('backend/app-menu/lokasi/lokasi_update', $this->data);
	}

	/**
	* Update Lokasis
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('lokasi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nama_lokasi', 'Nama Lokasi', 'trim|required');
		$this->form_validation->set_rules('departemen', 'Departemen', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama_lokasi' => $this->input->post('nama_lokasi'),
				'departemen' => $this->input->post('departemen'),
			];

			
			$save_lokasi = $this->model_lokasi->change($id, $save_data);

			if ($save_lokasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = 'Data telah berhasil diperbarui. '.anchor('lokasi', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil diperbarui. ', 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('lokasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Anda tidak melakukan perubahan data';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('lokasi');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Lokasis
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('lokasi_delete');

		$this->load->helper('file');

		if ($id !== null) {
			$arr_id = array($id);
		} else {
			$arr_id = $this->input->get('id');
		}

		if (empty($arr_id)) {
			set_message('Tidak ada item yang dipilih untuk dihapus.', 'error');
			redirect('lokasi');
			return;
		}

		$remove = false;

		foreach ($arr_id as $id) {
			$remove = $this->_remove($id);
		}

		if ($remove) {
            set_message('Data lokasi berhasil dihapus.', 'success');
		} else {
            set_message('Kesalahan menghapus data lokasi.', 'error');
		}

		redirect('lokasi');
	}

		/**
	* View view Lokasis
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('lokasi_view');

		$this->data['lokasi'] = $this->model_lokasi->find($id);

		$this->template->title('Lokasi Detail');
		$this->render('backend/app-menu/lokasi/lokasi_view', $this->data);
	}
	
	/**
	* delete Lokasis
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$lokasi = $this->model_lokasi->find($id);

		
		
		return $this->model_lokasi->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('lokasi_export');

		$this->model_lokasi->export('lokasi', 'lokasi');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('lokasi_export');

		$this->model_lokasi->pdf('lokasi', 'lokasi');
	}
}


/* End of file lokasi.php */
/* Location: ./application/controllers/Lokasi.php */