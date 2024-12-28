<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

  protected $CI;

	public function __construct($rules = array())
    {
        parent::__construct($rules);
        $this->CI =& get_instance();
    }
}