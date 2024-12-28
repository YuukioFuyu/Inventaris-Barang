<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Barang Controller
*| --------------------------------------------------------------------------
*| Barang site
*|
*/
class Barang extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_barang');
	}

	/**
	* show all Barangs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('barang_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['barangs'] = $this->model_barang->get($filter, $field, $this->limit_page, $offset);
		$this->data['barang_counts'] = $this->model_barang->count_all($filter, $field);

		$config = [
			'base_url'     => 'barang/index/',
			'total_rows'   => $this->model_barang->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Barang List');
		$this->render('backend/app-menu/barang/barang_list', $this->data);
	}
	
	/**
	* Add new barangs
	*
	*/
	public function add()
	{
		$this->is_allowed('barang_add');

		$this->template->title('Barang New');
		$this->render('backend/app-menu/barang/barang_add', $this->data);
	}

	/**
	* Add New Barangs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('barang_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
		$this->form_validation->set_rules('merek', 'Merek', 'trim|required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
		$this->form_validation->set_rules('barang_gambar_name', 'Gambar', 'trim');
		

		if ($this->form_validation->run()) {
			$barang_gambar_uuid = $this->input->post('barang_gambar_uuid');
			$barang_gambar_name = $this->input->post('barang_gambar_name');
		
			$save_data = [
				'nama_barang' => $this->input->post('nama_barang'),
				'merek' => $this->input->post('merek'),
				'kategori' => $this->input->post('kategori'),
				'satuan' => $this->input->post('satuan'),
				'keterangan' => $this->input->post('keterangan'),
			];

			if (!is_dir(FCPATH . '/uploads/barang/')) {
				mkdir(FCPATH . '/uploads/barang/');
			}

			if (!empty($barang_gambar_name)) {
				$barang_gambar_name_copy = date('YmdHis') . '-' . $barang_gambar_name;

				rename(FCPATH . 'uploads/tmp/' . $barang_gambar_uuid . '/' . $barang_gambar_name, 
						FCPATH . 'uploads/barang/' . $barang_gambar_name_copy);

				if (!is_file(FCPATH . '/uploads/barang/' . $barang_gambar_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Kesalahan mengunggah gambar'
						]);
					exit;
				}

				$save_data['gambar'] = $barang_gambar_name_copy;
			}
		
			
			$save_barang = $this->model_barang->store($save_data);

			if ($save_barang) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_barang;
					$this->data['message'] = 'Data telah berhasil disimpan. '.anchor('barang/edit/' . $save_barang, 'Edit barang').' atau  '.anchor('barang', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil disimpan. '.anchor('barang/edit/' . $save_barang, 'Edit barang'), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('barang');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Tidak ada data yang diubah';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('barang');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Barangs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('barang_update');

		$this->data['barang'] = $this->model_barang->find($id);

		$this->template->title('Barang Update');
		$this->render('backend/app-menu/barang/barang_update', $this->data);
	}

	/**
	* Update Barangs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('barang_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
		$this->form_validation->set_rules('merek', 'Merek', 'trim|required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
		$this->form_validation->set_rules('barang_gambar_name', 'Gambar', 'trim');
		
		if ($this->form_validation->run()) {
			$barang_gambar_uuid = $this->input->post('barang_gambar_uuid');
			$barang_gambar_name = $this->input->post('barang_gambar_name');
		
			$save_data = [
				'nama_barang' => $this->input->post('nama_barang'),
				'merek' => $this->input->post('merek'),
				'kategori' => $this->input->post('kategori'),
				'satuan' => $this->input->post('satuan'),
				'keterangan' => $this->input->post('keterangan'),
			];

			if (!is_dir(FCPATH . '/uploads/barang/')) {
				mkdir(FCPATH . '/uploads/barang/');
			}

			if (!empty($barang_gambar_uuid)) {
				$barang_gambar_name_copy = date('YmdHis') . '-' . $barang_gambar_name;

				rename(FCPATH . 'uploads/tmp/' . $barang_gambar_uuid . '/' . $barang_gambar_name, 
						FCPATH . 'uploads/barang/' . $barang_gambar_name_copy);

				if (!is_file(FCPATH . '/uploads/barang/' . $barang_gambar_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Kesalahan mengunggah gambar'
						]);
					exit;
				}

				$save_data['gambar'] = $barang_gambar_name_copy;
			}
		
			
			$save_barang = $this->model_barang->change($id, $save_data);

			if ($save_barang) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = 'Data telah berhasil diperbarui. '.anchor('barang', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil diperbarui. ', 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('barang');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Anda tidak melakukan perubahan data';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('barang');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Barangs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('barang_delete');

		$this->load->helper('file');

		if ($id !== null) {
			$arr_id = array($id);
		} else {
			$arr_id = $this->input->get('id');
		}
	
		if (empty($arr_id)) {
			set_message('Tidak ada item yang dipilih untuk dihapus.', 'error');
			redirect('barang');
			return;
		}
	
		$remove = false;
	
		foreach ($arr_id as $id) {
			$remove = $this->_remove($id);
		}

		if ($remove) {
            set_message('Data barang berhasil dihapus.', 'success');
		} else {
            set_message('Kesalahan menghapus data barang.', 'error');
		}

		redirect('barang');
	}

		/**
	* View view Barangs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('barang_view');

		$this->data['barang'] = $this->model_barang->find($id);

		$this->template->title('Barang Detail');
		$this->render('backend/app-menu/barang/barang_view', $this->data);
	}
	
	/**
	* delete Barangs
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$barang = $this->model_barang->find($id);

		if (!empty($barang->gambar)) {
			$path = FCPATH . '/uploads/barang/' . $barang->gambar;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_barang->remove($id);
	}
	
	/**
	* Upload Image Barang	* 
	* @return JSON
	*/
	public function upload_gambar_file()
	{
		if (!$this->is_allowed('barang_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'barang',
			'allowed_types' => 'jpg|png|JPG|PNG|JPEG|jpeg',
		]);
	}

	/**
	* Delete Image Barang	* 
	* @return JSON
	*/
	public function delete_gambar_file($uuid)
	{
		if ($uuid === null) {
			echo json_encode([
				'success' => false,
				'error' => 'UUID parameter is missing'
			]);
			exit;
		}
		
		if (!$this->is_allowed('barang_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'gambar', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'barang',
            'primary_key'       => 'id_barang',
            'upload_path'       => 'uploads/barang/'
        ]);
	}

	/**
	* Get Image Barang	* 
	* @return JSON
	*/
	public function get_gambar_file($id)
	{
		if (!$this->is_allowed('barang_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$barang = $this->model_barang->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'gambar', 
            'table_name'        => 'barang',
            'primary_key'       => 'id_barang',
            'upload_path'       => 'uploads/barang/',
            'delete_endpoint'   => 'barang/delete_gambar_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('barang_export');

		$this->model_barang->export('barang', 'barang');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('barang_export');

		$this->model_barang->pdf('barang', 'barang');
	}
}


/* End of file barang.php */
/* Location: ./application/controllers/Barang.php */