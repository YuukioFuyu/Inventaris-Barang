<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*| --------------------------------------------------------------------------
*| Captcha Controller
*| --------------------------------------------------------------------------
*| Captcha site
*|
*/
class Captcha extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* show all Captchas
	*
	* @var $offset String
	*/
	public function reload($old_captcha = null)
	{
		$cap_image_name = $old_captcha.'.jpg';
		$cap_image_path = FCPATH . 'captcha/' . $cap_image_name;
		$cap_time = explode('.', $old_captcha);

		if (isset($cap_time[0])) {
			$cap_time = $cap_time[0];
		} else {
			$cap_time = '';
		}

		if (is_file($cap_image_path)) {
			unlink($cap_image_path);
		} 
		$this->db->where('captcha_time', $cap_time)->delete('captcha');

		$cap = get_captcha();

		$this->response([
			'success' => true,
			'image' => $cap['image'],
			'captcha' => $cap
		]);
	}
}