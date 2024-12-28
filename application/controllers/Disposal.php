<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Disposal Controller
*| --------------------------------------------------------------------------
*| Disposal site
*|
*/
class Disposal extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_disposal');
	}

	/**
	* show all Disposals
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('disposal_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['disposals'] = $this->model_disposal->get($filter, $field, $this->limit_page, $offset);
		$this->data['disposal_counts'] = $this->model_disposal->count_all($filter, $field);

		$config = [
			'base_url'     => 'disposal/index/',
			'total_rows'   => $this->model_disposal->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Disposal List');
		$this->render('backend/app-menu/disposal/disposal_list', $this->data);
	}
	
	/**
	* Add new disposals
	*
	*/
	public function add()
	{
		$this->is_allowed('disposal_add');

		$this->template->title('Disposal New');
		$this->render('backend/app-menu/disposal/disposal_add', $this->data);
	}

	/**
	* Add New Disposals
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('disposal_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		$this->form_validation->set_rules('nomor_surat', 'Nomor Surat', 'trim|required');
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
		

		if ($this->form_validation->run()) {
			$disposal_berkas_uuid = $this->input->post('disposal_berkas_uuid');
			$disposal_berkas_name = $this->input->post('disposal_berkas_name');
		
			$save_data = [
				'nomor_surat' => $this->input->post('nomor_surat'),
				'nama_barang' => $this->input->post('nama_barang'),
				'jumlah' => $this->input->post('jumlah'),
				'deskripsi' => $this->input->post('deskripsi'),
			];

			if (!is_dir(FCPATH . '/uploads/disposal/')) {
				mkdir(FCPATH . '/uploads/disposal/');
			}

			if (!empty($disposal_berkas_name)) {
				$disposal_berkas_name_copy = date('YmdHis') . '-' . $disposal_berkas_name;

				rename(FCPATH . 'uploads/tmp/' . $disposal_berkas_uuid . '/' . $disposal_berkas_name, 
						FCPATH . 'uploads/disposal/' . $disposal_berkas_name_copy);

				if (!is_file(FCPATH . '/uploads/disposal/' . $disposal_berkas_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Kesalahan mengunggah file'
						]);
					exit;
				}

				$save_data['berkas'] = $disposal_berkas_name_copy;
			}
		
			
			$save_disposal = $this->model_disposal->store($save_data);

			if ($save_disposal) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_disposal;
					$this->data['message'] = 'Data telah berhasil disimpan. '.anchor('disposal/edit/' . $save_disposal, 'Edit disposal').' atau  '.anchor('disposal', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil disimpan. '.anchor('disposal/edit/' . $save_disposal, 'Edit disposal'), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('disposal');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Tidak ada data yang diubah';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('disposal');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Disposals
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('disposal_update');

		$this->data['disposal'] = $this->model_disposal->find($id);

		$this->template->title('Disposal Update');
		$this->render('backend/app-menu/disposal/disposal_update', $this->data);
	}

	/**
	* Update Disposals
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('disposal_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nomor_surat', 'Nomor Surat', 'trim|required');
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
		
		if ($this->form_validation->run()) {
			$disposal_berkas_uuid = $this->input->post('disposal_berkas_uuid');
			$disposal_berkas_name = $this->input->post('disposal_berkas_name');
		
			$save_data = [
				'nomor_surat' => $this->input->post('nomor_surat'),
				'nama_barang' => $this->input->post('nama_barang'),
				'jumlah' => $this->input->post('jumlah'),
				'deskripsi' => $this->input->post('deskripsi'),
			];

			if (!is_dir(FCPATH . '/uploads/disposal/')) {
				mkdir(FCPATH . '/uploads/disposal/');
			}

			if (!empty($disposal_berkas_uuid)) {
				$disposal_berkas_name_copy = date('YmdHis') . '-' . $disposal_berkas_name;

				rename(FCPATH . 'uploads/tmp/' . $disposal_berkas_uuid . '/' . $disposal_berkas_name, 
						FCPATH . 'uploads/disposal/' . $disposal_berkas_name_copy);

				if (!is_file(FCPATH . '/uploads/disposal/' . $disposal_berkas_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Kesalahan mengunggah file'
						]);
					exit;
				}

				$save_data['berkas'] = $disposal_berkas_name_copy;
			}
		
			
			$save_disposal = $this->model_disposal->change($id, $save_data);

			if ($save_disposal) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = 'Data telah berhasil diperbarui. '.anchor('disposal', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil diperbarui. ', 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('disposal');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Anda tidak melakukan perubahan data';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('disposal');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Disposal
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('disposal_delete');

		$this->load->helper('file');

		if ($id !== null) {
			$arr_id = array($id);
		} else {
			$arr_id = $this->input->get('id');
		}

		if (empty($arr_id)) {
			set_message('Tidak ada item yang dipilih untuk dihapus.', 'error');
			redirect('disposal');
			return;
		}

		$remove = false;

		foreach ($arr_id as $id) {
			$remove = $this->_remove($id);
		}

		if ($remove) {
            set_message('Data disposal berhasil dihapus.', 'success');
		} else {
            set_message('Kesalahan menghapus data disposal.', 'error');
		}

		redirect('disposal');
	}

		/**
	* View view Disposals
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('disposal_view');

		$this->data['disposal'] = $this->model_disposal->find($id);

		$this->template->title('Disposal Detail');
		$this->render('backend/app-menu/disposal/disposal_view', $this->data);
	}
	
	/**
	* delete Disposals
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$disposal = $this->model_disposal->find($id);

		if (!empty($disposal->berkas)) {
			$path = FCPATH . '/uploads/disposal/' . $disposal->berkas;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_disposal->remove($id);
	}
	
	/**
	* Upload Image Disposal	* 
	* @return JSON
	*/
	public function upload_berkas_file()
	{
		if (!$this->is_allowed('disposal_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'disposal',
		]);
	}

	/**
	* Delete Image Disposal	* 
	* @return JSON
	*/
	public function delete_berkas_file($uuid)
	{
		if (!$this->is_allowed('disposal_delete', false)) {
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
            'table_name'        => 'disposal',
            'primary_key'       => 'id_disposal',
            'upload_path'       => 'uploads/disposal/'
        ]);
	}

	/**
	* Get Image Disposal	* 
	* @return JSON
	*/
	public function get_berkas_file($id)
	{
		if (!$this->is_allowed('disposal_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$disposal = $this->model_disposal->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'berkas', 
            'table_name'        => 'disposal',
            'primary_key'       => 'id_disposal',
            'upload_path'       => 'uploads/disposal/',
            'delete_endpoint'   => 'disposal/delete_berkas_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('disposal_export');

		$this->model_disposal->export('disposal', 'disposal');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('disposal_export');

		$this->model_disposal->pdf('disposal', 'disposal');
	}
}


/* End of file disposal.php */
/* Location: ./application/controllers/Disposal.php */