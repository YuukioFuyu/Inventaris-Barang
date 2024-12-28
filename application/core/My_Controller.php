<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/Jwt/BeforeValidException.php';
require_once APPPATH . '/libraries/Jwt/ExpiredException.php';
require_once APPPATH . '/libraries/Jwt/SignatureInvalidException.php';
require_once APPPATH . '/libraries/Jwt/JWT.php';
require_once APPPATH . '/libraries/REST_Controller.php';

use \Firebase\JWT\JWT;
#[AllowDynamicProperties]
class MY_Controller extends CI_Controller {

    public $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache"); 

        if (installation_complete()) {
            date_default_timezone_set(get_option('timezone', 'asia/jakarta'));
            load_extensions();
            $this->load->library(['aauth', 'cc_html', 'cc_page_element', 'cc_app']);
        }
    }

    /**
    * Response JSON
    * 
    * @param Array $data
    * @param String $status
    *
    * @return JSON
    */
    public function response($data, $status = 200)
    {
        die(json_encode($data));

        $this->output
            ->set_content_type('application/json')
            ->set_status_header($status)
            ->set_output(json_encode($data));
    }

    /**
    * Render pagination
    * 
    * @param Array $config 
    *
    * @return HTML
    */
    public function pagination($config = [])
    {
        $this->load->library('pagination');
        
        $config = [
            'suffix'           => isset($_GET)?'?'.http_build_query($_GET):'',
            'base_url'         => site_url($config['base_url']),
            'total_rows'       => $config['total_rows'],
            'per_page'         => $config['per_page'],
            'uri_segment'      => $config['uri_segment'],
            'num_links'        => 1,
            'num_tag_open'     => '<li>',
            'num_tag_close'    => '</li>',
            'full_tag_open'    => '<ul class="pagination">',
            'full_tag_close'   => '</ul>',
            'first_link'       => 'First',
            'first_tag_open'   => '<li>',
            'first_tag_close'  => '</li>',
            'last_link'        => 'Last',
            'last_tag_open'    => '<li>',
            'last_tag_close'   => '</li>',
            'next_link'        => 'Next',
            'next_tag_open'    => '<li>',
            'next_tag_close'   => '</li>',
            'prev_link'        => 'Prev',
            'prev_tag_open'    => '<li>',
            'prev_tag_close'   => '</li>',
            'cur_tag_open'     => '<li class="active"><a href="#">',
            'cur_tag_close'    => '</a></li>',
        ];

        $this->pagination->initialize($config);
        
        return  '<center>'.$this->pagination->create_links().'</center>';
    }

    /**
    * Valid number
    * 
    * @param String $str 
    *
    * @return boolean
    */
    public function valid_number($str)
    {
       $this->form_validation->set_message('valid_number','The %s field may only contain number characters.');

       if (preg_match("/[0-9]/", $str)) {
        return true;
       }

       return false;
    }

    /**
    * Regular expression validation
    * 
    * @param String $str 
    * @param String $val 
    *
    * @return boolean
    */
    public function regex($str, $val = null)
    {
       $this->form_validation->set_message('regex','The %s field must be in accordance with the pattern.');

       if ($ret = preg_match("/".$val."/", $str)) {
        return true;
       }

       return false;
    }

    /**
    * datetime validation
    * 
    * @param String $str 
    *
    * @return boolean
    */
    public function valid_datetime($str)
    {
       $this->form_validation->set_message('valid_datetime','The %s field may only contain date time.');

       if ($ret = preg_match("[(\d{4})\-(\d{2})\-(\d{2}) (\d{2}):(\d{2})]", $str)) {
        return true;
       }

       return false;
    }

    /**
    * Date validation
    * 
    * @param String $str 
    *
    * @return boolean
    */
    public function valid_date($str)
    {
       $this->form_validation->set_message('valid_date','The %s field may only contain date.');

       if ($ret = preg_match("[(\d{4})\-(\d{2})\-(\d{2})]", $str)) {
        return true;
       }

       return false;
    }

    /**
    * Group validation
    * 
    * @param String $str 
    *
    * @return boolean
    */
    public function valid_group($str)
    {
       $str = json_decode($str);
       $this->form_validation->set_message('valid_group','The %s field may only contain array.');

       if (is_array($str)) {
         return true;
       }

       return false;
    }

    /**
    * Valid regex validation
    * 
    * @param String $str 
    *
    * @return boolean
    */
    public function valid_regex($str) {
       $this->form_validation->set_message('valid_regex','The %s field pattern "'.$str.'" is not valid.');

       if (@preg_match($str, null) === false) {
        return false;
       }

       return true;
    }
    
    /**
    * Valid regex validation
    * 
    * @param String $str 
    *
    * @return boolean
    */
    public function valid_alpha_numeric_spaces_underscores($str) {
       $this->form_validation->set_message('valid_alpha_numeric_spaces_underscores','The %s field input only alpha numeric spaces and underscores.');

        return (bool) preg_match('/^[A-Z0-9 _]+$/i', $str);
    }

    /**
    * Valid disallowed chars
    * 
    * @param String $str 
    *
    * @return boolean
    */
    public function valid_disallowed_chars($str) {
       $this->form_validation->set_message('valid_disallowed_chars','The %s character '.$chars.' dis allowed.');

       if (preg_match('(\')/i', $str)) {
        return false;
       }
       return true;
    }
    
    /**
    * Valid regex validation
    * 
    * @param String $str 
    *
    * @return boolean
    */
    public function valid_json($str) {
       $this->form_validation->set_message('valid_json','The %s field input not valid json format.');

        json_decode($str);

        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
    * Valid multiple value validation
    * 
    * @param String $str 
    *
    * @return boolean
    */
    public function valid_multiple_value($str) {
       $this->form_validation->set_message('valid_multiple_value','The %s field input not valid multiple value ex val1, val2, val3, more.');

        return (count(explode(',', $str)));
    }

    /**
    * Valid table is avaiable
    * 
    * @param String $str 
    *
    * @return boolean
    */
    public function valid_table_avaiable($str) {
       $this->form_validation->set_message('valid_table_avaiable','The %s is not valid.');
       $tables = $this->db->list_tables();

       return in_array($str, $tables);
    }

    /**
    * Valid captcha
    * 
    * @param String $str 
    *
    * @return boolean
    */
    public function valid_captcha($str) {
       $this->form_validation->set_message('valid_captcha','You must submit %s word that appears in the %s image.');

       $expiration = time() - 7200;

       $sql = 'SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
       $binds = array($str, $this->input->ip_address(), $expiration);
       $query = $this->db->query($sql, $binds);
       $row = $query->row();

       if ($row->count == 0) {
            return false;
       }

       return true;
    }

    /**
    * Valid extension list
    * 
    * @param String $str 
    *
    * @return boolean
    */
    public function valid_extension_list($str) {
       $this->load->helper('file');

       $mimes = get_mimes();
       $mime_arr = [];
       $ret = TRUE;
       $mime_not_valid = [];

       foreach ($mimes as $key => $value) {
           $mime_arr[] = $key;
       }
       if (strpos($str, ',') === FALSE)
        {
            $mime_not_valid[] = $str;
            $ret = in_array(strtolower(trim($str)), $mime_arr);
        }

        foreach (explode(',', $str) as $extension)
        {
            if (trim($extension) !== '' && in_array(strtolower(trim($extension)), $mime_arr) === FALSE)
            {
                $mime_not_valid[] = $extension;
                $ret = FALSE;
            }
        }

        $this->form_validation->set_message('valid_extension_list','The %s extension "'.implode(',', $mime_not_valid).'" is not valid.');

        return $ret;
    }

    /**
    * Validation max selected option
    * 
    * @param String $str 
    *
    * @return boolean
    */
    public function valid_max_selected_option($str, $val = 2)
    {

       $field_match = $this->check_field_has_rules('valid_max_selected_option\['.$val.'\]', $str);
       $this->form_validation->set_message('valid_max_selected_option','The %s field selected options maximum is "'.$val.'".');

       if ($field_match) {
           $field = $this->input->post($field_match);

           if (is_array($field)) {
             if (count($field) <= $val) {
                return true;
             }
           }
       }

       return false;
    }

    /**
    * Validation min selected option
    * 
    * @param String $str 
    *
    * @return boolean
    */
    public function valid_min_selected_option($str, $val = 2, $additional = 55)
    {
       $field_match = $this->check_field_has_rules('valid_min_selected_option\['.$val.'\]', $str);

       if ($field_match) {
           $field = $this->input->post($field_match);

           $this->form_validation->set_message('valid_min_selected_option','The %s field selected options minimum is "'.$val.'".');

           if (is_array($field)) {
             if (count($field) < $val) {
                return false;
             }
           }
       }

       return true;
    }

    /**
    * Check field has rules
    * 
    * @param String $str 
    *
    * @return boolean
    */
    public function check_field_has_rules($rule_name = null, $post_data = null)
    {
        foreach ($this->form_validation->_field_data as $field_name => $option) {
            if (isset($option['rules'])) {
                foreach ($option['rules'] as $rule) {
                    if (preg_match("/".$rule_name."/", $rule)) {
                        if (is_array($option['postdata'])) {
                            if (in_array($post_data, $option['postdata'])) {
                                return str_replace('[]', '', $field_name);
                            } 
                        }
                    }
                }
            }
        }

        return false;
    }
}

/**
* Admin controller
*
* This class will be extended with administrator class modules
*/
class Admin extends MY_Controller
{
    public $limit_page = 10;

    public function __construct()
    {
        parent::__construct();  
        
        if (!installation_complete()) {
            redirect('');
        }      
    }


    /**
    * render admin page
    * 
    * @param String $view 
    * @param Array $data 
    * @param Boolean $bool 
    *
    * @return JSON
    */
    public function render($view = '', $data = array(), $bool = FALSE)
    {
        $this->template->enable_parser(false);
        $this->template->set_partial('content', $view, $data);
        $this->template->build('backend/main_layout', $data);
    }

    /**
    * User is allowed
    * 
    * @param String $perm 
    * @param Boolean $redirect 
    *
    * @return JSON
    */
    public function is_allowed($perm, $redirect = true)
    {
        if (!$this->aauth->is_loggedin()) {
            if ($redirect) {
                redirect('login','refresh');
            } else {
                return false;
            }
        } else {
            if ($this->aauth->is_allowed($perm)) {
                return true;
            } else {
                if ($redirect) {
                    $this->session->set_flashdata('f_message', 'Maaf, Anda tidak memiliki izin untuk mengakses ');
                    $this->session->set_flashdata('f_type', 'warning');
                    redirect('dashboard','refresh');
                }
                return false;
            }
        }

    }

    /**
    * Upload Files tmp
    * 
    * @param Array $data 
    *
    * @return JSON
    */
    public function upload_file($data = [])
    {
        $default = [
            'uuid'          => '', 
            'allowed_types' => '*', 
            'max_size'      => '', 
            'max_width'     => '', 
            'max_height'    => '', 
            'upload_path'   => './uploads/tmp/',
            'input_files'   => 'qqfile',
            'table_name'    => '',
        ];

        foreach ($data as $key => $value) {
            if (isset($default[$key])) {
                $default[$key] = $value;
            }
        }

        $dir = FCPATH . $default['upload_path'] . $default['uuid'];
        if (!is_dir($dir)) {
            mkdir($dir);
        }

        if (empty($default['file_name'])) {
            $default['file_name'] = date('Y-m-d').$default['table_name'].date('His');
        }

        $config = [
            'upload_path'       => $default['upload_path'] . $default['uuid'] . '/',
            'allowed_types'     => $default['allowed_types'],
            'max_size'          => $default['max_size'],
            'max_width'         => $default['max_width'],
            'max_height'        => $default['max_height'],
            'file_name'         => $default['file_name']
        ];
        
        $this->load->library('upload', $config);
        $this->load->helper('file');

        if ( ! $this->upload->do_upload('qqfile')){
            $result = [
                'success'   => false,
                'error'     =>  $this->upload->display_errors()
            ];

            return json_encode($result);
        } else {
            $upload_data = $this->upload->data();

            $result = [
                'uploadName'    => $upload_data['file_name'],
                'previewLink'  => $dir.'/'.$upload_data['file_name'],
                'success'       => true,
            ];

            return json_encode($result);
        }
    }

    /**
    * Delete Files tmp
    * 
    * @param Array $data 
    *
    * @return JSON
    */
    public function delete_file($data = [])
    {
        $default = [
            'uuid'              => '', 
            'delete_by'         => '', 
            'field_name'        => 'image', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'test',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/blog/'
        ];

        foreach ($data as $key => $value) {
            if (isset($default[$key])) {
                $default[$key] = $value;
            }
        }

        if (!empty($default['uuid'])) {
            $this->load->helper('file');
            $delete_file = false;

            if ($default['delete_by'] == 'id') {
                $row = $this->db->get_where($default['table_name'], [$default['primary_key'] => $default['uuid']])->row();
                if ($row) {
                    $path = FCPATH . $default['upload_path'] . $row->{$default['field_name']};
                }

                if (isset($default['uuid'])) {
                    if (is_file($path)) {
                        $delete_file = unlink($path);
                        $this->db->where($default['primary_key'], $default['uuid']);
                        $this->db->update($default['table_name'], [$default['field_name'] => '']);
                    }
                }
            } else {
                $path = FCPATH . $default['upload_path_tmp'] . $default['uuid'] . '/';
                $delete_file = delete_files($path, true);
            }

            if (isset($default['uuid'])) {
                if (is_dir($path)) {
                    rmdir($path);
                }
            }

            if (!$delete_file) {
                $result = [
                    'error' =>  'Error delete file'
                ];

                return json_encode($result);
            } else {
                $result = [
                    'success' => true,
                ];

                return json_encode($result);
            }
        }
    }

    /**
    * Get Files
    * 
    * @param Array $data 
    *
    * @return JSON
    */
    public function get_file($data = [])
    {
        $default = [
            'uuid'              => '', 
            'delete_by'         => '', 
            'field_name'        => 'image', 
            'table_name'        => 'test',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/blog/',
            'delete_endpoint'   => 'blog/delete_image_file'
        ];

        foreach ($data as $key => $value) {
            if (isset($default[$key])) {
                $default[$key] = $value;
            }
        }
        
        $row = $this->db->get_where($default['table_name'], [$default['primary_key'] => $default['uuid']])->row();

        if (!$row) {
            $result = [
                'error' =>  'Error getting file'
            ];

            return json_encode($result);
        } else {
            if (!empty($row->{$default['field_name']})) {
                if (strpos($row->{$default['field_name']}, ',')) {
                    foreach (explode(',', $row->{$default['field_name']}) as $filename) {
                        $result[] = [
                            'success'               => true,
                            'thumbnailUrl'          => check_is_image_ext(base_url($default['upload_path'] . $filename)),
                            'id'                    => 0,
                            'name'                  => $row->{$default['field_name']},
                            'uuid'                  => $row->{$default['primary_key']},
                            'deleteFileEndpoint'    => base_url($default['delete_endpoint']),
                            'deleteFileParams'      => ['by' => $default['delete_by']]
                        ];
                    }
                } else {
                    $result[] = [
                        'success'               => true,
                        'thumbnailUrl'          => check_is_image_ext(base_url($default['upload_path'] . $row->{$default['field_name']})),
                        'id'                    => 0,
                        'name'                  => $row->{$default['field_name']},
                        'uuid'                  => $row->{$default['primary_key']},
                        'deleteFileEndpoint'    => base_url($default['delete_endpoint']),
                        'deleteFileParams'      => ['by' => $default['delete_by']]
                    ];
                }

                return json_encode($result);
            }
        }
    }
}

class Front extends MY_Controller
{
    public $active_theme;

    public function __construct()
    {
        parent::__construct();

        if (installation_complete()) {
            $this->active_theme = get_option('active_theme');
            $this->register_template();
        }

        define('BASE_THEME', BASE_URL . 'cc-content/themes/' . $this->active_theme . '/');

        $this->template->set_theme('cicool');
    }

    public function register_template()
    {
       if (installation_complete()) {
            $this->cc_app->onEvent('front_head', function(){
                return $this->template->build('header', [], true);
            });
            $this->cc_app->onEvent('front_footer', function(){
                return $this->template->build('footer', [], true);
            });
            $this->cc_app->onEvent('front_navigation', function(){
                return $this->template->build('navigation', [], true);
            });
        } 
    }

    /**
    * Render front page
    * 
    * @param String $view 
    * @param Array $data 
    * @param Boolean $bool 
    *
    * @return JSON
    */
    public function render($view = '', $data = array(), $bool = FALSE)
    {
        $this->template->enable_parser(false);
        $this->template->set_partial('content', $view, $data);
        $this->template->build('backend/main_layout', $data);

        $this->template->initialize([
            'theme_location' => 'cc-content/themes/'
            ]);
        $this->template->set_theme('cicool');

        $this->template->build('home');
    }
}



class API extends REST_Controller
{
    public $limit_page = 10;
    
    public function __construct()
    {
        parent::__construct();
        $this->config->set_item('csrf_protection', false);
        $this->form_validation->set_error_delimiters('', '');
        $this->load->model('model_user');
    }

    /**
    * Login user
    *
    * @param String $username
    * @param String $pass
    *
    * @return boolean
    */
    public function login($username = null, $pass = null)
    {
        return $this->aauth->login($username, $pass, false, null, false);
    }

    /**
    * Print response
    *
    * @param Array $additional_data
    * @param String $message
    * @param Boolean $status
    * @param Int $http_status
    *
    * @return boolean
    */
    public function responses($additional_data = [], $message = null, $status = true,  $http_status = 200)
    {
        $data['error'] = $status;
        $data['message'] = $message;

        if (is_array($additional_data) AND count($additional_data)) {
            $data['data'] = $additional_data;
        }

        return $this->response($data, API::HTTP_NOT_ACCEPTABLE);
    }

    /**
    * Encode data
    *
    * @param Array $additional_data
    * @param Int $key
    * @return String
    */
    public function jwtEncode($additional_data = [], $key = false)
    {
        if (!$key) {
            $key = $this->jwtGetKey();
        }
        $date = new DateTime();

        $token['data'] = $additional_data;
        $token['iat'] = $date->getTimestamp();
        $token['exp'] = $date->getTimestamp() + $this->config->item('sess_expiration');

        return JWT::encode($token, $key);
    }

    /**
    * Get Token data from request
    *
    * @return String
    */
    public function jwtGetToken()
    {
        return $this->getHeader('X-Token');
    }

    /**
    * Get Key data from request
    *
    * @return String
    */
    public function jwtGetKey()
    {
        $this->config->load('rest');
        return $this->getHeader($this->config->item('rest_key_name'));
    }

    /**
    * Get Key data from request
    *
    * @param String $key
    * @return MIxed String | Array
    */
    public function getHeader($key)
    {
        $headers = getallheaders();

        if (isset($headers[$key])) {
            return $headers[$key];
        }

        return false;
    }

    /**
    * Get user data by token
    *
    * @param String $token
    *
    * @return Mixed boolean | Array
    */
    public function getUser($token = null)
    {
        $data_user = JWT::decode($token, $this->jwtGetKey(), array('HS256'));

        if (isset($data_user->data->id)) {
            $id = $data_user->data->id;
            $user = $this->model_user->find($id);

            return $user;
        }

        return false;
    }

    /**
    * User is allowed
    * 
    * @param String $perm 
    * @param Boolean $redirect 
    *
    * @return JSON
    */
    public function is_allowed($perm, $required_token = true)
    {
        if ($required_token) {
            $user = $this->getUser($this->jwtGetToken());
        } else {
            $user = true;
        }

        if (!$user) {
            $this->response([
                'status'    => false,
                'message'   => 'You are not allowed to access.',
            ], API::HTTP_NOT_ACCEPTABLE);
        } else {
            if (!isset($user->id)) {
                return true;
            }
            
            if ($this->aauth->is_allowed($perm, $user->id)) {
                return true;
            } else {
                 $this->response([
                    'status'    => false,
                    'message'   => 'You are not allowed to access.',
                ], API::HTTP_NOT_ACCEPTABLE);

                return false;
            }
        }
    }

    /**
    * Get user data
    *
    * @param  String $field_name
    *
    * @return Mixed String | Array
    */
    public function getUserData($field_name = false)
    {
        $user = $this->getUser($this->jwtGetToken());

        if (!$user) {
            if ($field_name) {
                if (isset($user->$field_name)) {
                    return $user->$field_name;
                }
            } else {
                return $user;
            }
        }

        return false;
    }

    /**
    * User is allowed
    * 
    * @param String $perm 
    * @param Boolean $redirect 
    *
    * @return JSON
    */
    public function requiredInput($input_name = null)
    {
        $errors = [];

        if (is_array($input_name)) {
            foreach ($input_name as $name) {
                if (!isset($_GET[$name]) OR empty($_GET[$name])) {
                    $errors[] = 'Parameter '.$name. ' is required';
                }
            }
        }

        if (count($errors)) {
            $this->response([
                'status'    => false,
                'message'   => implode("\n", $errors),
            ], API::HTTP_NOT_ACCEPTABLE);
        }
    }

    /**
    * Upload file
    *
    * @param String $input_name
    * @param Array $data
    *
    * @return Boolean
    */
    public function upload_file($input_name, $data)
    {
        $default = [
            'allowed_types' => '*', 
            'max_size'      => '', 
            'max_width'     => '', 
            'max_height'    => '', 
            'upload_path'   => './uploads/user/',
            'table_name'    => '',
            'required'      => false,
        ];

        foreach ($data as $key => $value) {
            if (isset($default[$key])) {
                $default[$key] = $value;
            }
        }
        
        $this->load->library('upload', $default);

        if ($default['required']) {
            if (!isset($_FILES[$input_name]) OR empty($_FILES[$input_name]['name'])) {
                $this->response([
                    'status'    => false,
                    'message'   => $input_name.' tidak boleh kosong.'
                ], API::HTTP_NOT_ACCEPTABLE);
            }
        }

        if (isset($_FILES[$input_name]) AND !empty($_FILES[$input_name]['name'])) {
            if ( ! $this->upload->do_upload($input_name)){
                $this->response([
                    'status'    => false,
                    'message'   =>  $this->upload->display_errors()
                ], API::HTTP_NOT_ACCEPTABLE);
            } else {
                $upload_data = $this->upload->data();

                return ['file_name' => $upload_data['file_name']];
            }
        }

        return false;
    }
}

/* End of file My_Controller.php */
/* Location: ./application/core/My_Controller.php */