<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Mutasi Controller
*| --------------------------------------------------------------------------
*| Mutasi site
*|
*/
class Mutasi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_mutasi');
	}

	/**
	* show all Mutasis
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('mutasi_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['mutasis'] = $this->model_mutasi->get($filter, $field, $this->limit_page, $offset);
		$this->data['mutasi_counts'] = $this->model_mutasi->count_all($filter, $field);

		$config = [
			'base_url'     => 'mutasi/index/',
			'total_rows'   => $this->model_mutasi->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Mutasi List');
		$this->render('backend/app-menu/mutasi/mutasi_list', $this->data);
	}
	
	/**
	* Add new mutasis
	*
	*/
	public function add()
	{
		$this->is_allowed('mutasi_add');

		$this->template->title('Mutasi New');
		$this->render('backend/app-menu/mutasi/mutasi_add', $this->data);
	}

	/**
	* Add New Mutasis
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('mutasi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		$this->form_validation->set_rules('id_penempatan', 'Id Penempatan', 'trim|required');
		$this->form_validation->set_rules('tanggal_mutasi', 'Tanggal Mutasi', 'trim|required');
		$this->form_validation->set_rules('departemen', 'Departemen', 'trim|required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'trim|required');
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'id_penempatan' => $this->input->post('id_penempatan'),
				'tanggal_mutasi' => $this->input->post('tanggal_mutasi'),
				'keterangan' => $this->input->post('keterangan'),
				'departemen' => $this->input->post('departemen'),
				'lokasi' => $this->input->post('lokasi'),
				'nama_barang' => $this->input->post('nama_barang'),
			];

			
			$save_mutasi = $this->model_mutasi->store($save_data);

			if ($save_mutasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_mutasi;
					$this->data['message'] = 'Data telah berhasil disimpan. '.anchor('mutasi/edit/' . $save_mutasi, 'Edit mutasi').' atau  '.anchor('mutasi', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil disimpan. '.anchor('mutasi/edit/' . $save_mutasi, 'Edit mutasi'), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('mutasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Tidak ada data yang diubah';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('mutasi');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Mutasis
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('mutasi_update');

		$this->data['mutasi'] = $this->model_mutasi->find($id);

		$this->template->title('Mutasi Update');
		$this->render('backend/app-menu/mutasi/mutasi_update', $this->data);
	}

	/**
	* Update Mutasis
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('mutasi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}
		
		$this->form_validation->set_rules('id_penempatan', 'Id Penempatan', 'trim|required');
		$this->form_validation->set_rules('tanggal_mutasi', 'Tanggal Mutasi', 'trim|required');
		$this->form_validation->set_rules('departemen', 'Departemen', 'trim|required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'trim|required');
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'id_penempatan' => $this->input->post('id_penempatan'),
				'tanggal_mutasi' => $this->input->post('tanggal_mutasi'),
				'keterangan' => $this->input->post('keterangan'),
				'departemen' => $this->input->post('departemen'),
				'lokasi' => $this->input->post('lokasi'),
				'nama_barang' => $this->input->post('nama_barang'),
			];

			
			$save_mutasi = $this->model_mutasi->change($id, $save_data);

			if ($save_mutasi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = 'Data telah berhasil diperbarui. '.anchor('mutasi', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil diperbarui. ', 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('mutasi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Anda tidak melakukan perubahan data';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('mutasi');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Mutasis
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('mutasi_delete');

		$this->load->helper('file');

		if ($id !== null) {
			$arr_id = array($id);
		} else {
			$arr_id = $this->input->get('id');
		}

		if (empty($arr_id)) {
			set_message('Tidak ada item yang dipilih untuk dihapus.', 'error');
			redirect('mutasi');
			return;
		}

		$remove = false;

		foreach ($arr_id as $id) {
			$remove = $this->_remove($id);
		}

		if ($remove) {
            set_message('Data mutasi berhasil dihapus.', 'success');
		} else {
            set_message('Kesalahan menghapus data mutasi.', 'error');
		}

		redirect('mutasi');
	}

		/**
	* View view Mutasis
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('mutasi_view');

		$this->data['mutasi'] = $this->model_mutasi->find($id);

		$this->template->title('Mutasi Detail');
		$this->render('backend/app-menu/mutasi/mutasi_view', $this->data);
	}
	
	/**
	* delete Mutasis
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$mutasi = $this->model_mutasi->find($id);

		
		
		return $this->model_mutasi->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('mutasi_export');

		$this->model_mutasi->export('mutasi', 'mutasi');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('mutasi_export');

		$this->model_mutasi->pdf('mutasi', 'mutasi');
	}
}


/* End of file mutasi.php */
/* Location: ./application/controllers/Mutasi.php */