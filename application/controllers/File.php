<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| File Controller
*| --------------------------------------------------------------------------
*| user site
*|
*/
class File extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_user');
	}

	/**
	* download file
	*
	* @var $file_path String
	* @var $file_name String
	*/
	public function download($file_path = null, $file_name = null)
	{
		$this->load->helper('download');

		// Tentukan direktori yang aman
		$safe_directory = FCPATH . '/uploads/siswa/';
		$path = realpath($safe_directory . $file_name);

		// Pastikan file yang diminta berada di dalam direktori yang aman
		if ($path === false || strpos($path, $safe_directory) !== 0) {
			show_404(); // Tampilkan halaman 404 jika file tidak valid
		}

		force_download($file_name, $path);
	}
}