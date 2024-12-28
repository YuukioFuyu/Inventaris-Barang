<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*| --------------------------------------------------------------------------
*| Web Controller
*| --------------------------------------------------------------------------
*| For default controller
*|
*/
class Web extends Front
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (installation_complete()) {
			$this->home();
		} else {
			redirect('wizzard/setup','refresh');
		}
	}

	public function home() 
	{
		$this->template->build('home');
	}
}


/* End of file Web.php */
/* Location: ./application/controllers/Web.php */