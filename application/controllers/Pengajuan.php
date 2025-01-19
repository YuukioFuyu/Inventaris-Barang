<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pengajuan Controller
*| --------------------------------------------------------------------------
*| Pengajuan site
*|
*/
class Pengajuan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pengajuan');
	}

	/**
	* show all Pengajuans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('pengajuan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pengajuans'] = $this->model_pengajuan->get($filter, $field, $this->limit_page, $offset);
		$this->data['pengajuan_counts'] = $this->model_pengajuan->count_all($filter, $field);

		$config = [
			'base_url'     => 'pengajuan/index/',
			'total_rows'   => $this->model_pengajuan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Peminjaman List');
		$this->render('backend/app-menu/pengajuan/pengajuan_list', $this->data);
	}
	
	/**
	* Add new pengajuans
	*
	*/
	public function add()
	{
		$this->is_allowed('pengajuan_add');

		$this->template->title('Peminjaman New');
		$this->render('backend/app-menu/pengajuan/pengajuan_add', $this->data);
	}

	/**
	* Add New Pengajuans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('pengajuan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		$this->form_validation->set_rules('departemen', 'Departemen', 'trim|required');
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'trim|required');
		$this->form_validation->set_rules('keperluan', 'Keperluan', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'departemen' => $this->input->post('departemen'),
				'nama_barang' => $this->input->post('nama_barang'),
				'jumlah' => $this->input->post('jumlah'),
				'lokasi' => $this->input->post('lokasi'),
				'keperluan' => $this->input->post('keperluan'),
				'tgl_pinjam' => date('Y-m-d H:i:s'),
			];

			
			$save_pengajuan = $this->model_pengajuan->store($save_data);

			if ($save_pengajuan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pengajuan;
					$this->data['message'] = 'Data telah berhasil disimpan. '.anchor('pengajuan/edit/' . $save_pengajuan, 'Edit pengajuan').' atau  '.anchor('pengajuan', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil disimpan. '.anchor('pengajuan/edit/' . $save_pengajuan, 'Edit pengajuan'), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('pengajuan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Tidak ada data yang diubah';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('pengajuan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pengajuans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('pengajuan_update');

		$this->data['pengajuan'] = $this->model_pengajuan->find($id);

		$this->template->title('Peminjaman Update');
		$this->render('backend/app-menu/pengajuan/pengajuan_update', $this->data);
	}

	/**
	* Update Pengajuans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('pengajuan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}
		
		$this->form_validation->set_rules('departemen', 'Departemen', 'trim|required');
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'trim|required');
		$this->form_validation->set_rules('keperluan', 'Keperluan', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'departemen' => $this->input->post('departemen'),
				'nama_barang' => $this->input->post('nama_barang'),
				'jumlah' => $this->input->post('jumlah'),
				'lokasi' => $this->input->post('lokasi'),
				'keperluan' => $this->input->post('keperluan'),
				'tgl_pinjam' => date('Y-m-d H:i:s'),
			];

			
			$save_pengajuan = $this->model_pengajuan->change($id, $save_data);

			if ($save_pengajuan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = 'Data telah berhasil diperbarui. '.anchor('pengajuan', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil diperbarui. ', 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('pengajuan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Anda tidak melakukan perubahan data';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('pengajuan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pengajuans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('pengajuan_delete');

		$this->load->helper('file');

		if ($id !== null) {
			$arr_id = array($id);
		} else {
			$arr_id = $this->input->get('id');
		}

		if (empty($arr_id)) {
			set_message('Tidak ada item yang dipilih untuk dihapus.', 'error');
			redirect('pengajuan');
			return;
		}

		$remove = false;

		foreach ($arr_id as $id) {
			$remove = $this->_remove($id);
		}

		if ($remove) {
            set_message('Data pengajuan berhasil dihapus.', 'success');
		} else {
            set_message('Kesalahan menghapus data pengajuan.', 'error');
		}

		redirect('pengajuan');
	}

		/**
	* View view Pengajuans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('pengajuan_view');

		$this->data['pengajuan'] = $this->model_pengajuan->find($id);

		$this->template->title('Peminjaman Detail');
		$this->render('backend/app-menu/pengajuan/pengajuan_view', $this->data);
	}
	
	/**
	* delete Pengajuans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$pengajuan = $this->model_pengajuan->find($id);

		
		
		return $this->model_pengajuan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pengajuan_export');

		$this->model_pengajuan->export('pengajuan', 'pengajuan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pengajuan_export');

		$this->model_pengajuan->pdf('pengajuan', 'pengajuan');
	}
}


/* End of file pengajuan.php */
/* Location: ./application/controllers/Pengajuan.php */