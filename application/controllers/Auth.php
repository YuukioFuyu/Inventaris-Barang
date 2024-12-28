<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*| --------------------------------------------------------------------------
*| Auth Controller
*| --------------------------------------------------------------------------
*| For authentication
*|
*/
class Auth extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* Login user
	*
	*/
	public function login()
	{
		$data = [];
		$this->config->load('site');

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run()) {
			if ($this->aauth->login($this->input->post('username'), $this->input->post('password'), $this->input->post('remember'))) {
				redirect('/dashboard','refresh');
			} else {
				$data['error'] = $this->aauth->print_errors(TRUE);
			}
		} else {
			$data['error'] = validation_errors();
		}

		$this->template->build('backend/app-menu/login', $data);
	}

	/**
	* Register user member
	*
	*/
	public function register()
	{
		$data = [];

		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[aauth_users.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[aauth_users.email]');
		$this->form_validation->set_rules('agree', 'Kotak Centang Persetujuan', 'trim|required');
		$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|callback_valid_captcha');

		$this->form_validation->set_message('is_unique', 'Username yang sudah digunakan');

		if ($this->form_validation->run()) {
			$save_data = [
				'full_name' => $this->input->post('full_name')
			];
			$save_user = $this->aauth->create_user($this->input->post('email'), $this->input->post('password'), $this->input->post('username'), $save_data);

			if ($save_user) {
				set_message('Akun Anda berhasil dibuat. Silahkan menghubungi Administrator untuk menentukan Hak Akses Anda!');
				$this->aauth->add_member($save_user, 4);
				redirect('login', 'refresh');
			} else {
				$data['error'] = $this->aauth->print_errors();
			}
		} else {
			$data['error'] = validation_errors();
		}

		$this->template->build('backend/app-menu/register_member', $data);
	}

	/**
	* User forgot password
	*
	* @var String $id 
	*/
	public function forgot_password()
	{
		$data = [];

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|callback_valid_captcha');

		$this->form_validation->set_message('is_unique', 'User already used');

		if ($this->form_validation->run()) {
			//custom your action
		} else {
			$data['error'] = validation_errors();
		}

		$this->template->build('backend/app-menu/forgot_password', $data);
	}

	/**
	* User session logout
	*
	*/
	public function logout()
	{
		$this->aauth->logout();
		redirect('/');
	}
}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */