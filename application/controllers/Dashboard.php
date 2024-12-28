<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Dashboard Controller
*| --------------------------------------------------------------------------
*| For see your board
*|
*/
class Dashboard extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (!$this->aauth->is_loggedin()) {
			redirect('login','refresh');
		}

		$this->load->model('model_departemen');
		$jumlah_departemen = $this->model_departemen->count_all();

		$this->load->model('model_supplier');
		$jumlah_supplier = $this->model_supplier->count_all();

		$this->load->model('model_jenis_pengadaan');
		$jumlah_jenis_pengadaan = $this->model_jenis_pengadaan->count_all();

		$this->load->model('model_kategori');
		$jumlah_kategori_barang = $this->model_kategori->count_all();

		$this->load->model('model_barang');
		$barang_by_category = $this->model_barang->get_barang_by_category();
		$donut_chart_data = [];
		foreach ($barang_by_category as $item) {
			$donut_chart_data[] = [
				'label' => $item->kategori,
				'value' => (int)$item->total
			];
		}

		$this->load->model('Model_pengadaan');
		$bar_chart_data = $this->Model_pengadaan->get_pengadaan_summary();

		$this->load->model('Model_pengajuan');
		$line_chart_data_peminjaman = $this->Model_pengajuan->get_peminjaman_summary();

		$this->load->model('Model_pengembalian');
		$line_chart_data_pengembalian = $this->Model_pengembalian->get_pengembalian_summary();

		$data['jumlah_departemen'] = $jumlah_departemen;
		$data['jumlah_supplier'] = $jumlah_supplier;
		$data['jumlah_jenis_pengadaan'] = $jumlah_jenis_pengadaan;
		$data['jumlah_kategori_barang'] = $jumlah_kategori_barang;
		$data['donut_chart_data'] = json_encode($donut_chart_data);
		$data['bar_chart_data'] = json_encode($bar_chart_data);
		$data['line_chart_data_peminjaman'] = json_encode($line_chart_data_peminjaman);
		$data['line_chart_data_pengembalian'] = json_encode($line_chart_data_pengembalian);

		$this->render('backend/dashboard', $data);
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */