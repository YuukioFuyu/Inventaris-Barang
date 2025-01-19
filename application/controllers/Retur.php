<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Retur Controller
*| --------------------------------------------------------------------------
*| Retur site
*|
*/
class Retur extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_retur');
	}

	/**
	* show all Returs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('retur_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['returs'] = $this->model_retur->get($filter, $field, $this->limit_page, $offset);
		$this->data['retur_counts'] = $this->model_retur->count_all($filter, $field);

		$config = [
			'base_url'     => 'retur/index/',
			'total_rows'   => $this->model_retur->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Return List');
		$this->render('backend/app-menu/retur/retur_list', $this->data);
	}
	
	/**
	* Add new returs
	*
	*/
	public function add()
	{
		$this->is_allowed('retur_add');

		$this->template->title('Return New');
		$this->render('backend/app-menu/retur/retur_add', $this->data);
	}

	/**
	* Add New Returs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('retur_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		$this->form_validation->set_rules('nomor_surat', 'Nomor Surat', 'trim|required');
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
		$this->form_validation->set_rules('penerima_barang', 'Penerima Barang', 'trim|required');
		

		if ($this->form_validation->run()) {
			$retur_berkas_uuid = $this->input->post('retur_berkas_uuid');
			$retur_berkas_name = $this->input->post('retur_berkas_name');
		
			$save_data = [
				'nomor_surat' => $this->input->post('nomor_surat'),
				'nama_barang' => $this->input->post('nama_barang'),
				'jumlah' => $this->input->post('jumlah'),
				'penerima_barang' => $this->input->post('penerima_barang'),
				'deskripsi' => $this->input->post('deskripsi'),
			];

			if (!is_dir(FCPATH . '/uploads/retur/')) {
				mkdir(FCPATH . '/uploads/retur/');
			}

			if (!empty($retur_berkas_name)) {
				$retur_berkas_name_copy = date('YmdHis') . '-' . $retur_berkas_name;

				rename(FCPATH . 'uploads/tmp/' . $retur_berkas_uuid . '/' . $retur_berkas_name, 
						FCPATH . 'uploads/retur/' . $retur_berkas_name_copy);

				if (!is_file(FCPATH . '/uploads/retur/' . $retur_berkas_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Kesalahan mengunggah file'
						]);
					exit;
				}

				$save_data['berkas'] = $retur_berkas_name_copy;
			}
		
			
			$save_retur = $this->model_retur->store($save_data);

			if ($save_retur) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_retur;
					$this->data['message'] = 'Data telah berhasil disimpan. '.anchor('retur/edit/' . $save_retur, 'Edit retur').' atau  '.anchor('retur', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil disimpan. '.anchor('retur/edit/' . $save_retur, 'Edit retur'), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('retur');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Tidak ada data yang diubah';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('retur');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Returs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('retur_update');

		$this->data['retur'] = $this->model_retur->find($id);

		$this->template->title('Return Update');
		$this->render('backend/app-menu/retur/retur_update', $this->data);
	}

	/**
	* Update Returs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('retur_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nomor_surat', 'Nomor Surat', 'trim|required');
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
		$this->form_validation->set_rules('penerima_barang', 'Penerima Barang', 'trim|required');
		
		if ($this->form_validation->run()) {
			$retur_berkas_uuid = $this->input->post('retur_berkas_uuid');
			$retur_berkas_name = $this->input->post('retur_berkas_name');
		
			$save_data = [
				'nomor_surat' => $this->input->post('nomor_surat'),
				'nama_barang' => $this->input->post('nama_barang'),
				'jumlah' => $this->input->post('jumlah'),
				'penerima_barang' => $this->input->post('penerima_barang'),
				'deskripsi' => $this->input->post('deskripsi'),
			];

			if (!is_dir(FCPATH . '/uploads/retur/')) {
				mkdir(FCPATH . '/uploads/retur/');
			}

			if (!empty($retur_berkas_uuid)) {
				$retur_berkas_name_copy = date('YmdHis') . '-' . $retur_berkas_name;

				rename(FCPATH . 'uploads/tmp/' . $retur_berkas_uuid . '/' . $retur_berkas_name, 
						FCPATH . 'uploads/retur/' . $retur_berkas_name_copy);

				if (!is_file(FCPATH . '/uploads/retur/' . $retur_berkas_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Kesalahan mengunggah file'
						]);
					exit;
				}

				$save_data['berkas'] = $retur_berkas_name_copy;
			}
		
			
			$save_retur = $this->model_retur->change($id, $save_data);

			if ($save_retur) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = 'Data telah berhasil diperbarui. '.anchor('retur', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil diperbarui. ', 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('retur');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Anda tidak melakukan perubahan data';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('retur');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Returs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('retur_delete');

		$this->load->helper('file');

		if ($id !== null) {
			$arr_id = array($id);
		} else {
			$arr_id = $this->input->get('id');
		}

		if (empty($arr_id)) {
			set_message('Tidak ada item yang dipilih untuk dihapus.', 'error');
			redirect('retur');
			return;
		}

		$remove = false;

		foreach ($arr_id as $id) {
			$remove = $this->_remove($id);
		}

		if ($remove) {
            set_message('Data retur berhasil dihapus.', 'success');
		} else {
            set_message('Kesalahan menghapus data retur.', 'error');
		}

		redirect('retur');
	}

		/**
	* View view Returs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('retur_view');

		$this->data['retur'] = $this->model_retur->find($id);

		$this->template->title('Return Detail');
		$this->render('backend/app-menu/retur/retur_view', $this->data);
	}
	
	/**
	* delete Returs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$retur = $this->model_retur->find($id);

		if (!empty($retur->berkas)) {
			$path = FCPATH . '/uploads/retur/' . $retur->berkas;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_retur->remove($id);
	}
	
	/**
	* Upload Image Retur	* 
	* @return JSON
	*/
	public function upload_berkas_file()
	{
		if (!$this->is_allowed('retur_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'retur',
		]);
	}

	/**
	* Delete Image Retur	* 
	* @return JSON
	*/
	public function delete_berkas_file($uuid)
	{
		if (!$this->is_allowed('retur_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'berkas', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'retur',
            'primary_key'       => 'id_retur',
            'upload_path'       => 'uploads/retur/'
        ]);
	}

	/**
	* Get Image Retur	* 
	* @return JSON
	*/
	public function get_berkas_file($id)
	{
		if (!$this->is_allowed('retur_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$retur = $this->model_retur->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'berkas', 
            'table_name'        => 'retur',
            'primary_key'       => 'id_retur',
            'upload_path'       => 'uploads/retur/',
            'delete_endpoint'   => 'retur/delete_berkas_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('retur_export');

		$this->model_retur->export('retur', 'retur');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('retur_export');

		$this->model_retur->pdf('retur', 'retur');
	}
}


/* End of file retur.php */
/* Location: ./application/controllers/Retur.php */