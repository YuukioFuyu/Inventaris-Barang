<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Supplier Controller
*| --------------------------------------------------------------------------
*| Supplier site
*|
*/
class Supplier extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_supplier');
	}

	/**
	* show all Suppliers
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('supplier_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['suppliers'] = $this->model_supplier->get($filter, $field, $this->limit_page, $offset);
		$this->data['supplier_counts'] = $this->model_supplier->count_all($filter, $field);

		$config = [
			'base_url'     => 'supplier/index/',
			'total_rows'   => $this->model_supplier->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Supplier List');
		$this->render('backend/app-menu/supplier/supplier_list', $this->data);
	}
	
	/**
	* Add new suppliers
	*
	*/
	public function add()
	{
		$this->is_allowed('supplier_add');

		$this->template->title('Supplier New');
		$this->render('backend/app-menu/supplier/supplier_add', $this->data);
	}

	/**
	* Add New Suppliers
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('supplier_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		$this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama_supplier' => $this->input->post('nama_supplier'),
				'alamat_lengkap' => $this->input->post('alamat_lengkap'),
				'no_telp' => $this->input->post('no_telp'),
			];

			
			$save_supplier = $this->model_supplier->store($save_data);

			if ($save_supplier) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_supplier;
					$this->data['message'] = 'Data telah berhasil disimpan. '.anchor('supplier/edit/' . $save_supplier, 'Edit supplier').' atau  '.anchor('supplier', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil disimpan. '.anchor('supplier/edit/' . $save_supplier, 'Edit supplier'), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('supplier');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Tidak ada data yang diubah';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('supplier');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Suppliers
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('supplier_update');

		$this->data['supplier'] = $this->model_supplier->find($id);

		$this->template->title('Supplier Update');
		$this->render('backend/app-menu/supplier/supplier_update', $this->data);
	}

	/**
	* Update Suppliers
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('supplier_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama_supplier' => $this->input->post('nama_supplier'),
				'alamat_lengkap' => $this->input->post('alamat_lengkap'),
				'no_telp' => $this->input->post('no_telp'),
			];

			
			$save_supplier = $this->model_supplier->change($id, $save_data);

			if ($save_supplier) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = 'Data telah berhasil diperbarui. '.anchor('supplier', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil diperbarui. ', 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('supplier');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Anda tidak melakukan perubahan data';
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = 'Tidak ada data yang diubah';
					$this->data['redirect'] = base_url('supplier');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Suppliers
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('supplier_delete');

		$this->load->helper('file');

		if ($id !== null) {
			$arr_id = array($id);
		} else {
			$arr_id = $this->input->get('id');
		}

		if (empty($arr_id)) {
			set_message('Tidak ada item yang dipilih untuk dihapus.', 'error');
			redirect('supplier');
			return;
		}

		$remove = false;

		foreach ($arr_id as $id) {
			$remove = $this->_remove($id);
		}

		if ($remove) {
            set_message('Data supplier berhasil dihapus.', 'success');
		} else {
            set_message('Kesalahan menghapus data supplier.', 'error');
		}

		redirect('supplier');
	}

		/**
	* View view Suppliers
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('supplier_view');

		$this->data['supplier'] = $this->model_supplier->find($id);

		$this->template->title('Supplier Detail');
		$this->render('backend/app-menu/supplier/supplier_view', $this->data);
	}
	
	/**
	* delete Suppliers
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$supplier = $this->model_supplier->find($id);

		
		
		return $this->model_supplier->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('supplier_export');

		$this->model_supplier->export('supplier', 'supplier');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('supplier_export');

		$this->model_supplier->pdf('supplier', 'supplier');
	}
}


/* End of file supplier.php */
/* Location: ./application/controllers/Supplier.php */