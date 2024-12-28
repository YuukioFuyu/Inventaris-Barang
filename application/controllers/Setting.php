<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Setting Controller
*| --------------------------------------------------------------------------
*| setting site
*|
*/
class Setting extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_setting');
	}

	/**
	* show all setting
	*
	* @var String $offset
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('setting');
		$this->load->model('model_page');

		$this->data = [
			'times' => [
				['label' => '15 Minutes', 'value' => '900'],
				['label' => '30 Minutes', 'value' => '1800'],
				['label' => '1 Hours', 'value' => '3600'],
				['label' => '2 Hours', 'value' => '7200'],
				['label' => '4 Hours', 'value' => '14400'],
				['label' => '6 Hours', 'value' => '21600'],
				['label' => '8 Hours', 'value' => '28800'],
				['label' => '12 Hours', 'value' => '43200'],
				['label' => '1 Days', 'value' => '86400'],
				['label' => '1 Week', 'value' => '604800'],
				['label' => '1 Month', 'value' => '2592000'],
				['label' => '6 Month', 'value' => '15552000'],
				['label' => '1 Years', 'value' => '31104000'],
				['label' => 'Always', 'value' => '0']
			],
			'pages' => $this->model_page->find_all()
		];

		$this->template->title('Setting List');
		$this->render('backend/app-menu/setting/setting_general', $this->data);
	}

	/**
	* Update settings
	*
	*/
	public function save()
	{
		if (!$this->is_allowed('setting_update', false)) {
			return $this->response([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk melakukan mengatur sistem web'
				]);
		}

		$this->load->helper('file');

		$this->form_validation->set_rules('site_name', 'Site Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('encryption_key', 'Encryption Key', 'trim|required');
		$this->form_validation->set_rules('sess_expiration', 'Encryption Key', 'trim|numeric');
		$this->form_validation->set_rules('sess_time_to_update', 'Session Time to Update', 'trim|numeric');
		$this->form_validation->set_rules('global_xss_filtering', 'Global XSS Filtering', 'trim|required');
		$this->form_validation->set_rules('csrf_token_name', 'CSRF Token Name', 'trim|required');
		$this->form_validation->set_rules('csrf_cookie_name', 'CSRF Cookie Name', 'trim|required');
		$this->form_validation->set_rules('csrf_expire', 'CSRF Expire', 'trim|required');
		$this->form_validation->set_rules('sess_cookie_name', 'Session Cookie Name', 'trim|required');
		$this->form_validation->set_rules('permitted_uri_chars', 'Permitted URI Chars', 'trim|required');
		$this->form_validation->set_rules('landing_page_id', 'Default landing page', 'trim|required');

		if ($this->form_validation->run()) {
			set_option('site_name', $this->input->post('site_name'));
			set_option('email', $this->input->post('email'));
			set_option('author', $this->input->post('author'));
			set_option('site_organization', $this->input->post('site_organization'));
			set_option('site_description', $this->input->post('site_description'));
			set_option('keywords', $this->input->post('keywords'));
			set_option('landing_page_id', $this->input->post('landing_page_id'));

			$logo_uuid = $this->input->post('logo_uuid');
    		$logo_name = $this->input->post('logo_name');
			$existing_logo = get_option('site_logo');

			if (!empty($logo_uuid)) {
				if (!empty($existing_logo)) {
					$old_logo_path = FCPATH . '/uploads/logo/' . $existing_logo;
					if (file_exists($old_logo_path)) {
						unlink($old_logo_path);
					}
				}
			
				$logo_name_copy = date('YmdHis') . '-' . $logo_name;
			
				if (!is_dir(FCPATH . '/uploads/logo')) {
					mkdir(FCPATH . '/uploads/logo', 0777, true);
				}
			
				@rename(FCPATH . '/uploads/tmp/' . $logo_uuid . '/' . $logo_name, 
					FCPATH . '/uploads/logo/' . $logo_name_copy);
				
				set_option('site_logo', $logo_name_copy);
			} else {
				$logo_name_copy = $existing_logo;
			}			

			$data = [
				'php_tag_open' 					=> '<?php',
				'permitted_uri_chars'			=> addslashes($this->input->post('permitted_uri_chars')),
				'url_suffix'					=> addslashes($this->input->post('url_suffix')),
				'encryption_key'				=> addslashes($this->input->post('encryption_key')),
				'sess_expiration'				=> addslashes($this->input->post('sess_expiration')),
				'sess_time_to_update'			=> addslashes($this->input->post('sess_time_to_update')),
				'global_xss_filtering'			=> addslashes($this->input->post('global_xss_filtering')),
				'csrf_token_name'				=> addslashes($this->input->post('csrf_token_name')),
				'csrf_cookie_name'				=> addslashes($this->input->post('csrf_cookie_name')),
				'csrf_expire'					=> addslashes($this->input->post('csrf_expire')),
				'sess_cookie_name'				=> addslashes($this->input->post('sess_cookie_name'))
			];

			$config_template = $this->parser->parse('core_template/config_template.txt', $data, TRUE);
			write_file(FCPATH . '/application/config/config.php', $config_template);

			$config_template = $this->parser->parse('core_template/setting/routes_landing.php', $data, TRUE);
			write_file(FCPATH . '/application/routes/routes_landing.php', $config_template);

			$this->response['success'] = true;
			$this->response['message'] = 'Pengaturan sistem web telah berhasil diperbarui. ';
		} else {
			$this->response['success'] = false;
			$this->response['message'] = validation_errors();
		}

		return $this->response($this->response);
	}

	/**
	* Upload Organization Logo
	* 
	* @return JSON
	*/
	public function upload_logo_file()
	{
		if (!$this->is_allowed('setting_update', false)) {
			return $this->response([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
			]);
		}

		$uuid = $this->input->post('qquuid');
		
		$tmp_path = FCPATH . '/uploads/tmp/' . $uuid;
		if (!is_dir($tmp_path)) {
			mkdir($tmp_path, 0777, true);
		}

		$config = [
			'upload_path'   => $tmp_path . '/',
			'allowed_types' => 'png|jpeg|jpg|gif',
			'max_size'      => '2048'
		];
		
		$this->load->library('upload', $config);
		$this->load->helper('file');

		if (!$this->upload->do_upload('qqfile')) {
			$result = [
				'success' => false,
				'error'   => $this->upload->display_errors()
			];

			return $this->response($result);
		} else {
			$upload_data = $this->upload->data();
			$result = [
				'uploadName' => $upload_data['file_name'],
				'success'    => true,
			];

			return $this->response($result);
		}
	}

	/**
	 * Get Organization Logo
	 * 
	 * @return JSON
	 */
	public function get_logo_file()
	{
		if (!$this->is_allowed('setting_update', false)) {
			return $this->response([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
			]);
		}

		$logo = get_option('site_logo');

		if (!empty($logo)) {
			$result[] = [
				'success'             => true,
				'thumbnailUrl'        => base_url('uploads/logo/' . $logo),
				'id'                  => 0,
				'name'                => $logo,
				'uuid'                => $logo,
				'deleteFileEndpoint'  => base_url('setting/delete_logo_file'),
				'deleteFileParams'    => ['by' => 'id']
			];

			return $this->response($result);
		} else {
			return $this->response(['success' => false, 'message' => 'Logo tidak ditemukan.']);
		}
	}

	/**
	 * Delete Organization Logo
	 * 
	 * @return JSON
	 */
	public function delete_logo_file($uuid)
	{
		if (!$this->is_allowed('setting_update', false)) {
			return $this->response([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
			]);
		}

		if (!empty($uuid)) {
			$this->load->helper('file');

			$existing_logo = get_option('site_logo');
			if (!empty($existing_logo)) {
				$logo_path = FCPATH . '/uploads/logo/' . $existing_logo;

				if (file_exists($logo_path)) {
					unlink($logo_path);

					set_option('site_logo', null);

					return $this->response([
						'success' => true,
						'message' => 'Logo berhasil dihapus'
					]);
				} else {
					return $this->response([
						'success' => false,
						'message' => 'Logo tidak ditemukan di server'
					]);
				}
			}
		}

		return $this->response([
			'success' => false,
			'message' => 'UUID logo tidak valid'
		]);
	}
}


/* End of file Setting.php */
/* Location: ./application/controllers/Setting.php */