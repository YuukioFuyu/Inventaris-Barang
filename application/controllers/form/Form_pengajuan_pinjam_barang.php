<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Form Pengajuan Pinjam Barang Controller
*| --------------------------------------------------------------------------
*| Form Pengajuan Pinjam Barang site
*|
*/
class Form_pengajuan_pinjam_barang extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_form_pengajuan_pinjam_barang');
	}

	/**
	* Submit Form Pengajuan Pinjam Barangs
	*
	*/
	public function submit()
	{
		$this->form_validation->set_rules('nik_nidn_nim', 'NIK/NIDN/NIM', 'trim|required');
		$this->form_validation->set_rules('nama_peminjam', 'Nama Peminjam', 'trim|required');
		$this->form_validation->set_rules('no_telp_hp', 'No Telp / Hp', 'trim|required');
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
		$this->form_validation->set_rules('dipakai_di', 'Dipakai Di', 'trim|required');
		$this->form_validation->set_rules('digunakan_untuk', 'Digunakan Untuk', 'trim|required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
		$this->form_validation->set_rules('tanggal_kembali', 'Tanggal Kembali', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'nik_nidn_nim' => $this->input->post('nik_nidn_nim'),
				'nama_peminjam' => $this->input->post('nama_peminjam'),
				'no_telp_hp' => $this->input->post('no_telp_hp'),
				'nama_barang' => $this->input->post('nama_barang'),
				'dipakai_di' => $this->input->post('dipakai_di'),
				'digunakan_untuk' => $this->input->post('digunakan_untuk'),
				'jumlah' => $this->input->post('jumlah'),
				'tanggal_pinjam' => date('Y-m-d H:i:s'),
				'tanggal_kembali' => $this->input->post('tanggal_kembali'),
			];

			
			$save_form_pengajuan_pinjam_barang = $this->model_form_pengajuan_pinjam_barang->store($save_data);

			$this->data['success'] = true;
			$this->data['id'] 	   = $save_form_pengajuan_pinjam_barang;
			$this->data['message'] = 'Your data has been successfully submitted';
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	
}


/* End of file form_pengajuan_pinjam_barang.php */
/* Location: ./application/controllers/Form Pengajuan Pinjam Barang.php */