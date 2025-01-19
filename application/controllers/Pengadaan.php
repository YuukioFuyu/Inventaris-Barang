<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pengadaan Controller
*| --------------------------------------------------------------------------
*| Pengadaan site
*|
*/
class Pengadaan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pengadaan');
	}

	/**
	* show all Pengadaans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('pengadaan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pengadaans'] = $this->model_pengadaan->get($filter, $field, $this->limit_page, $offset);
		$this->data['pengadaan_counts'] = $this->model_pengadaan->count_all($filter, $field);

		$config = [
			'base_url'     => 'pengadaan/index/',
			'total_rows'   => $this->model_pengadaan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pengadaan List');
		$this->render('backend/app-menu/pengadaan/pengadaan_list', $this->data);
	}
	
	/**
	* Add new pengadaans
	*
	*/
	public function add()
	{
		$this->is_allowed('pengadaan_add');

		$this->template->title('Pengadaan New');
		$this->render('backend/app-menu/pengadaan/pengadaan_add', $this->data);
	}

	/**
	* Add New Pengadaans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('pengadaan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		$this->form_validation->set_rules('tanggal_pengadaan', 'Tanggal Pengadaan', 'trim|required');
		$this->form_validation->set_rules('supplier', 'Supplier', 'trim|required');
		$this->form_validation->set_rules('jenis_pengadaan', 'Jenis Pengadaan', 'trim|required');
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'tanggal_pengadaan' => $this->input->post('tanggal_pengadaan'),
				'supplier' => $this->input->post('supplier'),
				'jenis_pengadaan' => $this->input->post('jenis_pengadaan'),
				'keterangan' => $this->input->post('keterangan'),
				'nama_barang' => $this->input->post('nama_barang'),
				'deskripsi_barang' => $this->input->post('deskripsi_barang'),
				'harga' => $this->input->post('harga'),
				'jumlah' => $this->input->post('jumlah'),
			];

			
			$save_pengadaan = $this->model_pengadaan->store($save_data);

			if ($save_pengadaan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pengadaan;
					$this->data['message'] = 'Data telah berhasil disimpan. '.anchor('pengadaan/edit/' . $save_pengadaan, 'Edit pengadaan').' atau  '.anchor('pengadaan', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil disimpan. '.anchor('pengadaan/edit/' . $save_pengadaan, 'Edit pengadaan'), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('pengadaan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Tidak ada data yang diubah';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('pengadaan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pengadaans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('pengadaan_update');

		$this->data['pengadaan'] = $this->model_pengadaan->find($id);

		$this->template->title('Pengadaan Update');
		$this->render('backend/app-menu/pengadaan/pengadaan_update', $this->data);
	}

	/**
	* Update Pengadaans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('pengadaan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}
		
		$this->form_validation->set_rules('tanggal_pengadaan', 'Tanggal Pengadaan', 'trim|required');
		$this->form_validation->set_rules('supplier', 'Supplier', 'trim|required');
		$this->form_validation->set_rules('jenis_pengadaan', 'Jenis Pengadaan', 'trim|required');
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'tanggal_pengadaan' => $this->input->post('tanggal_pengadaan'),
				'supplier' => $this->input->post('supplier'),
				'jenis_pengadaan' => $this->input->post('jenis_pengadaan'),
				'keterangan' => $this->input->post('keterangan'),
				'nama_barang' => $this->input->post('nama_barang'),
				'deskripsi_barang' => $this->input->post('deskripsi_barang'),
				'harga' => $this->input->post('harga'),
				'jumlah' => $this->input->post('jumlah'),
			];

			
			$save_pengadaan = $this->model_pengadaan->change($id, $save_data);

			if ($save_pengadaan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = 'Data telah berhasil diperbarui. '.anchor('pengadaan', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil diperbarui. ', 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('pengadaan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Anda tidak melakukan perubahan data';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('pengadaan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pengadaans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('pengadaan_delete');

		$this->load->helper('file');

		if ($id !== null) {
			$arr_id = array($id);
		} else {
			$arr_id = $this->input->get('id');
		}

		if (empty($arr_id)) {
			set_message('Tidak ada item yang dipilih untuk dihapus.', 'error');
			redirect('pengadaan');
			return;
		}

		$remove = false;

		foreach ($arr_id as $id) {
			$remove = $this->_remove($id);
		}

		if ($remove) {
            set_message('Data pengadaan berhasil dihapus.', 'success');
		} else {
            set_message('Kesalahan menghapus data pengadaan.', 'error');
		}

		redirect('pengadaan');
	}

		/**
	* View view Pengadaans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('pengadaan_view');

		$this->data['pengadaan'] = $this->model_pengadaan->find($id);

		$this->template->title('Pengadaan Detail');
		$this->render('backend/app-menu/pengadaan/pengadaan_view', $this->data);
	}
	
	/**
	* delete Pengadaans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$pengadaan = $this->model_pengadaan->find($id);

		
		
		return $this->model_pengadaan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pengadaan_export');

		$this->model_pengadaan->export('pengadaan', 'pengadaan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pengadaan_export');

		$this->model_pengadaan->pdf('pengadaan', 'pengadaan');
	}
}


/* End of file pengadaan.php */
/* Location: ./application/controllers/Pengadaan.php */