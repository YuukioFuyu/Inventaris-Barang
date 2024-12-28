<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Informasi Controller
*| --------------------------------------------------------------------------
*| For see your board
*|
*/
class Informasi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->is_allowed('menu_informasi');
		
		$data = [];
		$this->render('backend/informasi', $data);
	}
}

/* End of file Informasi.php */
/* Location: ./application/controllers/Informasi.php */