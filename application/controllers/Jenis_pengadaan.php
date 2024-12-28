<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Jenis Pengadaan Controller
*| --------------------------------------------------------------------------
*| Jenis Pengadaan site
*|
*/
class Jenis_pengadaan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_jenis_pengadaan');
	}

	/**
	* show all Jenis Pengadaans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('jenis_pengadaan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['jenis_pengadaans'] = $this->model_jenis_pengadaan->get($filter, $field, $this->limit_page, $offset);
		$this->data['jenis_pengadaan_counts'] = $this->model_jenis_pengadaan->count_all($filter, $field);

		$config = [
			'base_url'     => 'jenis_pengadaan/index/',
			'total_rows'   => $this->model_jenis_pengadaan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Jenis Pengadaan List');
		$this->render('backend/app-menu/jenis_pengadaan/jenis_pengadaan_list', $this->data);
	}
	
	/**
	* Add new jenis_pengadaans
	*
	*/
	public function add()
	{
		$this->is_allowed('jenis_pengadaan_add');

		$this->template->title('Jenis Pengadaan New');
		$this->render('backend/app-menu/jenis_pengadaan/jenis_pengadaan_add', $this->data);
	}

	/**
	* Add New Jenis Pengadaans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('jenis_pengadaan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		$this->form_validation->set_rules('jenis_pengadaan', 'Jenis Pengadaan', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'jenis_pengadaan' => $this->input->post('jenis_pengadaan'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_jenis_pengadaan = $this->model_jenis_pengadaan->store($save_data);

			if ($save_jenis_pengadaan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_jenis_pengadaan;
					$this->data['message'] = 'Data telah berhasil disimpan. '.anchor('jenis_pengadaan/edit/' . $save_jenis_pengadaan, 'Edit jenis pengadaan').' atau  '.anchor('jenis_pengadaan', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil disimpan. '.anchor('jenis_pengadaan/edit/' . $save_jenis_pengadaan, 'Edit jenis pengadaan'), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('jenis_pengadaan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Tidak ada data yang diubah';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('jenis_pengadaan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Jenis Pengadaans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('jenis_pengadaan_update');

		$this->data['jenis_pengadaan'] = $this->model_jenis_pengadaan->find($id);

		$this->template->title('Jenis Pengadaan Update');
		$this->render('backend/app-menu/jenis_pengadaan/jenis_pengadaan_update', $this->data);
	}

	/**
	* Update Jenis Pengadaans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('jenis_pengadaan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}
		
		$this->form_validation->set_rules('jenis_pengadaan', 'Jenis Pengadaan', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'jenis_pengadaan' => $this->input->post('jenis_pengadaan'),
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_jenis_pengadaan = $this->model_jenis_pengadaan->change($id, $save_data);

			if ($save_jenis_pengadaan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = 'Data telah berhasil diperbarui. '.anchor('jenis_pengadaan', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil diperbarui. ', 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('jenis_pengadaan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Anda tidak melakukan perubahan data';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('jenis_pengadaan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Jenis Pengadaans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('jenis_pengadaan_delete');

		$this->load->helper('file');

		if ($id !== null) {
			$arr_id = array($id);
		} else {
			$arr_id = $this->input->get('id');
		}

		if (empty($arr_id)) {
			set_message('Tidak ada item yang dipilih untuk dihapus.', 'error');
			redirect('jenis_pengadaan');
			return;
		}

		$remove = false;

		foreach ($arr_id as $id) {
			$remove = $this->_remove($id);
		}

		if ($remove) {
            set_message('Data jenis pengadaan berhasil dihapus.', 'success');
		} else {
            set_message('Kesalahan menghapus data jenis pengadaan.', 'error');
		}

		redirect('jenis_pengadaan');
	}

		/**
	* View view Jenis Pengadaans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('jenis_pengadaan_view');

		$this->data['jenis_pengadaan'] = $this->model_jenis_pengadaan->find($id);

		$this->template->title('Jenis Pengadaan Detail');
		$this->render('backend/app-menu/jenis_pengadaan/jenis_pengadaan_view', $this->data);
	}
	
	/**
	* delete Jenis Pengadaans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$jenis_pengadaan = $this->model_jenis_pengadaan->find($id);

		
		
		return $this->model_jenis_pengadaan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('jenis_pengadaan_export');

		$this->model_jenis_pengadaan->export('jenis_pengadaan', 'jenis_pengadaan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('jenis_pengadaan_export');

		$this->model_jenis_pengadaan->pdf('jenis_pengadaan', 'jenis_pengadaan');
	}
}


/* End of file jenis_pengadaan.php */
/* Location: ./application/controllers/Jenis Pengadaan.php */