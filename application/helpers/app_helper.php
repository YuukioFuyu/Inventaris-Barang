<?php

if(!function_exists('get_mysql_version')) {
	function get_mysql_version() {
		$mysql_info = explode(' ', mysqli_get_client_info());
		$mysql_version = isset($mysql_info[1]) ? $mysql_info[1] : false;
		$mysql_version_number = explode('-', $mysql_version)[0];

		if ($mysql_version_number) {
			return $mysql_version_number;
		} else if (isset($mysql_info[0])) {
			return (int)substr($mysql_info[0], 0, 3);
		}

		return 5;
	}
}

if(!function_exists('get_database_config')) {
	function get_database_config($param = '') {
		if(file_exists($file_path = APPPATH.'/config/database.php'))
		{
			include($file_path);
		}

		if(isset($db[$active_group][$param])) {
			return $db[$active_group][$param];
		}
	}
}

if(!function_exists('redirect_back')) {
	function redirect_back($url = '')
	{
	    if(isset($_SERVER['HTTP_REFERER']))
	    {
	        header('Location: '.$_SERVER['HTTP_REFERER']);
	    }
	    else
	    {
	        redirect($url);
	    }
	    exit;
	}
}

if(!function_exists('db_get_all_data')) {
	function db_get_all_data($table_name = null, $where = false) {
		$ci =& get_instance();
		if ($where) {
			$ci->db->where($where);
		}
	  	$query = $ci->db->get($table_name);

	    return $query->result();
	}
}

if(!function_exists('is_image')) {
	function is_image($filename = '') {
		$array = explode('.', $filename);
		$extension = strtolower(end($array));
		$list_image_ext = ['', 'png', 'jpg', 'jpeg', 'gif'];

		if (array_search($extension, $list_image_ext)) {
			return TRUE;
		}

		return FALSE;
	}
}

if(!function_exists('clean_snake_case')) {
	function clean_snake_case($text = '') {
		$text = preg_replace('/_/', ' ', $text);

		return $text;
	}
}

if(!function_exists('get_group_user')) {
	function get_group_user($id_user = '') {
		return get_user_groups($id_user);
	}
}

if(!function_exists('get_user_data')) {
	function get_user_data($field_name = '') {
		$ci =& get_instance();
		$user_id = $ci->session->userdata('id');
		if ($user_id) {
			if (empty($field_name)) {
				return $ci->aauth->get_user($user_id);
			} else {
				return $ci->aauth->get_user($user_id)->$field_name;
			}
		}

		return false;
	}
}

if(!function_exists('is_allowed')) {
	function is_allowed($permission, Closure $func) {
		$ci =& get_instance();
		$reflection = new ReflectionFunction($func);
		$arguments  = $reflection->getParameters();


		if ($ci->aauth->is_allowed($permission)) {
			call_user_func($func, $arguments);
		} else {
			ob_start();
			call_user_func($func, $arguments);
			$buffer = ob_get_contents();
			ob_end_clean();

		}
	}
}

if(!function_exists('message_flash')) {
	function message_flash($message, $type) {
		$ci =& get_instance();
		$ci->session->set_flashdata('f_message', $message);
		$ci->session->set_flashdata('f_type', $type);
	}
}

if(!function_exists('display_menu_module')) {
	function display_menu_module($parent, $level, $menu_type) {
		$ci =& get_instance();
		$ci->load->database();
		$ci->load->model('model_menu');
		$menu_type_id = $ci->model_menu->get_id_menu_type_by_flag($menu_type);
	    $result = $ci->db->query("SELECT a.id, a.label, a.link, Deriv1.Count FROM `menu` a  LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM `menu` GROUP BY parent) Deriv1 ON a.id = Deriv1.parent WHERE a.menu_type_id = ".$menu_type_id." AND a.parent=" . $parent." order by `sort` ASC")->result();

		$ret = '';
	    if ($result) {
		    $ret .= '<ol class="dd-list">';
		   	foreach ($result as $row) {
		        if ($row->Count > 0) {
		        	$ret .= '<li class="dd-item dd3-item" data-id="'.$row->id.'">
		                                          <div class="dd-handle dd3-handle"></div><div class="dd3-content">'._ent($row->label);

		            if ($ci->aauth->is_allowed('menu_delete')) {
				            $ret .= '<span class="pull-right"><a class="remove-data" href="javascript:void()" data-href="'.site_url('menu/delete/'.$row->id).'"><i class="fa fa-trash btn-action"></i></a>
				                </span';
		            }

		            if ($ci->aauth->is_allowed('menu_update')) {
				            $ret .= '<span class="pull-right"><a href="'.site_url('menu/edit/'.$row->id).'"><i class="fa fa-pencil btn-action"></i></a>
		                        </span>';
		            }

		            $ret .= '</div>';
					$ret .= display_menu_module($row->id, $level + 1, $menu_type);
					$ret .= "</li>";
		        } elseif ($row->Count==0) {
		            $ret .= '<li class="dd-item dd3-item" data-id="'.$row->id.'">
		                                          <div class="dd-handle dd3-handle"></div><div class="dd3-content">'._ent($row->label);

		            if ($ci->aauth->is_allowed('menu_delete')) {
				            $ret .= '<span class="pull-right"><a class="remove-data" href="javascript:void()" data-href="'.site_url('menu/delete/'.$row->id).'"><i class="fa fa-trash btn-action"></i></a>
				                </span';
		            }

		            if ($ci->aauth->is_allowed('menu_update')) {
				            $ret .= '<span class="pull-right"><a href="'.site_url('menu/edit/'.$row->id).'"><i class="fa fa-pencil btn-action"></i></a>
		                        </span>';
		            }

					$ret .= '</div></li>';
		        }
		    }
		    $ret .= "</ol>";
	    }

	    return $ret;
	}
}

if(!function_exists('display_menu_admin')) {
	function display_menu_admin($parent, $level) {
		$ci =& get_instance();
		$ci->load->database();
		$ci->load->model('model_menu');
	    $result = $ci->db->query("SELECT a.id, a.label,a.icon_color, a.type, a.link,a.icon, Deriv1.Count FROM `menu` a  LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM `menu` GROUP BY parent) Deriv1 ON a.id = Deriv1.parent WHERE a.menu_type_id = 1 AND a.parent=" . $parent." order by `sort` ASC")->result();

		$ret = '';
	    if ($result) {
	    	if (($level > 1) AND ($parent > 0) ) {
		    	$ret .= '<ul class="treeview-menu">';
	    	} else {
	    		$ret = '';
	    	}
		   	foreach ($result as $row) {
		   		$perms = 'menu_'.strtolower(str_replace(' ', '_', $row->label));

		   		$links = explode('/', $row->link);

				$segments = array_slice($ci->uri->segment_array(), 0, count($links));
				
		   		if (implode('/', $segments) == implode('/', $links)) {
		   			$active = 'active';
		   		} else {
		   			$active = '';
		   		}
		   		if ($row->type == 'label') {
		        	$ret .= '<li class="header">'._ent($row->label).'</li>';
		   		} else {
			        if ($row->Count > 0) {
			        	if ($ci->aauth->is_allowed($perms)) {
				        	$ret .= '<li class="'.$active.'"> 
										        	<a href="'.site_url($row->link).'">';

							if ($parent) {
								$ret .= '<i class="fa fa-circle-o '._ent($row->icon_color).'"></i> <span>'._ent($row->label).'</span>
									            <span class="pull-right-container">
									              <i class="fa fa-angle-left pull-right"></i>
									            </span>
									          </a>';
							} else {
								$ret .= '<i class="fa '._ent($row->icon).' '._ent($row->icon_color).'"></i> <span>'._ent($row->label).'</span>
									            <span class="pull-right-container">
									              <i class="fa fa-angle-left pull-right"></i>
									            </span>
									          </a>';
							}

							$ret .= display_menu_admin($row->id, $level + 1);
							$ret .= "</li>";
						}
			        } elseif ($row->Count==0) {
			           if ($ci->aauth->is_allowed($perms)) {
							$ret .= '<li class="'.$active.'"> 
										        	<a href="'.site_url($row->link).'">';

							if ($parent) {
								$ret .= '<i class="fa fa-circle-o '._ent($row->icon_color).'"></i> <span>'._ent($row->label).'</span>
									            <span class="pull-right-container"></i>
									            </span>
									          </a>';
							} else {
								$ret .= '<i class="fa '._ent($row->icon).' '._ent($row->icon_color).'"></i> <span>'._ent($row->label).'</span>
									            <span class="pull-right-container"></i>
									            </span>
									          </a>';
							}

							$ret .= "</li>";
						}
			        }
		   		}
		    }
		    if ($level != 1) {
		    	$ret .= '</ul>';
	    	}
	    }

	    return $ret;
	}
}

if(!function_exists('set_message')) {
	function set_message($message = null, $type = 'success') {
		$ci =& get_instance();

		$ci->session->set_flashdata('f_message', $message);
        $ci->session->set_flashdata('f_type', $type);
	}
}

if(!function_exists('form_builder')) {
	function form_builder($id = 0) {
		$ci =& get_instance();
		
		$model_form = $ci->load->model('model_form');
		$form = $ci->model_form->find($id);

		if ($form) {
			$form_name = strtolower($form->table_name);
			$ci->template->title($form->title);

			return $ci->load->view('public/'.$form_name.'/' .$form_name, [], true);
		} else {
			return false;
		}
	}
}

if(!function_exists('get_icon_file')) {
	function get_icon_file($file_name = '') {
		$extension_list = [
			'avi' => ['avi'], 
			'css' => ['css'], 
			'csv' => ['csv'], 
			'eps' => ['eps'], 
			'html' => ['html', 'htm'], 
			'jpg' => ['jpg', 'jpeg'], 
			'mov' => ['mov', 'mp4', '3gp'], 
			'mp3' => ['mp3'], 
			'pdf' => ['pdf'], 
			'png' => ['png'], 
			'ppt' => ['ppt', 'pptx'], 
			'rar' => ['rar'], 
			'raw' => ['raw'], 
			'ttf' => ['ttf'],
			'txt' => ['txt'], 
			'wav' => ['wav'], 
			'xls' => ['xls', 'xlsx'], 
			'zip' => ['zip'], 
			'doc' => ['docx', 'doc']
		];

		$file_name_arr = explode('.', $file_name);
		if (is_array($file_name_arr)) {
			foreach ($extension_list as $ext => $list_ext) {
				if (in_array(end($file_name_arr), $list_ext)) {
					return BASE_ASSET . 'img/icon/' . $ext . '.png'; 
				}
			}
		}

		return BASE_ASSET . 'img/icon/any.png';
	}
}

if(!function_exists('check_is_image_ext')) {
	function check_is_image_ext($file_name = '') {
		$extension_list = [
			'jpg' => ['jpg', 'jpeg'], 
			'png' => ['png']
		];

		$file_name_arr = explode('.', $file_name);
		if (is_array($file_name_arr)) {
			foreach ($extension_list as $ext => $list_ext) {
				if (in_array(end($file_name_arr), $list_ext)) {
					return $file_name;
				}
			}
		}

		return get_icon_file($file_name);
	}
}

if(!function_exists('build_rules')) {
	function build_rules($delimiter = '|', $rules = []) {
		if (count($rules)) {
			return $delimiter.implode($delimiter, $rules);
		}
	}
}

if(!function_exists('_ent')) {
	function _ent($string = null) {
		return htmlentities($string);
	}
}

if(!function_exists('dd')) {
	function dd($array) {
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}
}

if(!function_exists('get_captcha')) {
	function get_captcha($string = null) {
		$ci =& get_instance();
		$ci->load->helper('captcha');

		$vals = array(
		        'img_path'      => 'captcha/',
		        'img_url'       => base_url('/captcha/'),
		        'font_path'     => 'font/captcha.ttf',
		        'img_width'     => '150',
		        'img_height'    => 30,
		        'expiration'    => 7200,
		        'word_length'   => 4,
		        'font_size'     => 15,
		        'img_id'        => 'image-captcha',
		        'pool'          => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',

		        // White background and border, black text and red grid
		        'colors'        => array(
		                'background' => array(255, 255, 255),
		                'border' => array(255, 255, 255),
		                'text' => array(0, 0, 0),
		                'grid' => array(255, 50, 50)
		        )
		);

		$cap = create_captcha($vals);
		$expiration = time() - 7200; // Two hour limit
		$ci->db->where('captcha_time < ', $expiration)
		        ->delete('captcha');


		$data = array(
		        'captcha_time'  => $cap['time'],
		        'ip_address'    => $ci->input->ip_address(),
		        'word'          => $cap['word']
		);

		$query = $ci->db->insert_string('captcha', $data);
		$ci->db->query($query);


		return $cap;
	}
}

if(!function_exists('display_block_element')) {
	function display_block_element() {
		$ci =& get_instance();
		$ci->load->database();
	    $result = $ci->db->query("SELECT * FROM `page_block_element` GROUP BY `group_name` ")->result();
	    $childs = $ci->db->query("SELECT * FROM `page_block_element`")->result();
	    $child_list = [];

	    foreach ($childs as $row) {
	    	$child_list[$row->group_name][] = $row;
	    }

	    $ret = null;

	    foreach ($result as $row) {
	    	$ret .= '<li><a href="#">'.ucwords($row->group_name).'</a>';
	    	if (isset($child_list[$row->group_name])) {
	    		$ret .= '<ul>';
	    		foreach ($child_list[$row->group_name] as $child) {
	    			$ret .= '<li class="block-item" data-src="'.$child->content.'" data-block-name="'.$child->block_name.'">
				                <div class="nav-content-wrapper noselect">
				                  <i class="fa fa-gear"></i>
				                  <div class="tool-nav delete">
				                    <i class="fa fa-trash"></i> <span class="info-nav">Delete</span>
				                  </div>
				                  <div class="tool-nav source">
				                    <i class="fa fa-code"></i> <span class="info-nav">Source</span>
				                  </div>
				                  <div class="tool-nav copy">
				                    <i class="fa fa-copy"></i> <span class="info-nav">Copy</span>
				                  </div>
				                  <div class="tool-nav handle">
				                    <i class="fa fa-arrows"></i> <span class="info-nav">Move</span>
				                  </div>
				                </div>
				              <img src="'.BASE_ASSET.'img/header10.png" data-src="aadas/asdasd.html" class="preview-only">
				              <div id="element'.$child->id.'" class="block-content"><div class="edit"></div></div>
				            </li>';
	    		}

	    		$ret .= '</ul>';
	    	}
	    	$ret .= '</li>';
	    }
	    return $ret;
	}
}

if(!function_exists('get_extensions')) {
	function get_extensions($type = false) {
		$ci =& get_instance();
		$ci->load->helper('directory');

		$ext_path = FCPATH . 'cc-content/extensions/';

		$dir = directory_map($ext_path);

		$list_extension = [];

		foreach ($dir as $dirname => $childs) {
			if (is_file($ext_path . $dirname . '/ext.json')) {
				$ext_info = file_get_contents($ext_path . $dirname . '/ext.json');
				$ext_info_array = json_decode($ext_info);
				$ext_info_array->path = $ext_path . $dirname;
				$ext_info_array->dirname = $dirname;
				$list_extension[$ext_info_array->type][] = $ext_info_array;
			}
		}

		if ($type !== false) {
			if (isset($list_extension[$type])) {
				return $list_extension[$type];
			}
		} else {
			return $list_extension;
		}

		return false;
	}
}

if(!function_exists('get_page_element')) {
	function get_page_element($group = false) {
		$ci =& get_instance();

		$ci->cc_page_element->get_page_element();
	}
}

if(!function_exists('load_extensions')) {
	function load_extensions() {

		$ci =& get_instance();
		$ci->load->helper('directory');

		$list_extensions = get_extensions();
		if (!is_array($list_extensions)) {
			return false;
		}

		$ext_load = null;
		$cc_core = get_instance();
		$current_uri = $ci->uri->uri_string;

		foreach ($list_extensions as $type => $extensions) {
			foreach ($extensions as $ext) {
				if (isset($ext->loader)) {
					if (isset($ext->routes)) {
						foreach ($ext->routes as $route) {


							// Convert wildcards to RegEx
							$route = str_replace(array(':any', ':num'), array('[^/]+', '[0-9]+'), $route);

							if (preg_match('#^'.$route.'$#', $current_uri, $matches)) {
								foreach ($ext->loader as $filename) {
									if (is_file($ext->path.$filename)) {
										if ($ci->input->method()) {
											include  $ext->path.$filename;
										}
									}
								}
							}

						}
					} else {
						foreach ($ext->loader as $filename) {
							if (is_file($ext->path.$filename)) {
								if ($ci->input->method() == 'get') {
									include  $ext->path.$filename;
								} else {
									ob_start();
									include  $ext->path.$filename;
									$buffer = ob_get_contents();
									ob_end_clean();
								}
							}
						}
					}
				}
			}
		}
		return false;
	}
}

if(!function_exists('url_extension')) {
	function url_extension($ext = null) {
		return BASE_URL . 'cc-content/extensions/' . $ext;
	}
}

if(!function_exists('get_option')) {
	function get_option($option_name = null, $default = null) {
		$ci =& get_instance();
		$ci->load->library('cc_app');
		return $ci->cc_app->getOption($option_name, $default);
	}
}

if(!function_exists('add_option')) {
	function add_option($option_name = null, $option_value = null) {
		$ci =& get_instance();
		$ci->load->library('cc_app');
		return $ci->cc_app->addOption($option_name, $option_value);
	}
}

if(!function_exists('set_option')) {
	function set_option($option_name = null, $option_value = null) {
		$ci =& get_instance();
		return $ci->cc_app->setOption($option_name, $option_value);
	}
}

if(!function_exists('delete_option')) {
	function delete_option($option_name = null) {
		$ci =& get_instance();
		return $ci->cc_app->deleteOption($option_name);
	}
}

if(!function_exists('option_exists')) {
	function option_exists($option_name = null) {
		$ci =& get_instance();
		return $ci->cc_app->optionExists($option_name);
	}
}

if(!function_exists('theme_url')) {
	function theme_url($url_additional = null) {
		$ci =& get_instance();
        $active_theme = get_option('active_theme', 'cicool');

        return BASE_URL . 'cc-content/themes/' . $active_theme . '/' . $url_additional;
	}
}

if(!function_exists('theme_asset')) {
	function theme_asset() {
        return theme_url('asset/');
	}
}


if(!function_exists('site_name')) {
	function site_name() {
        return get_option('site_name');
	}
}

if(!function_exists('installation_complete')) {
	function installation_complete() {
		return is_file(FCPATH . '/application/config/site.php');
	}
}

if(!function_exists('get_menu')) {
	function get_menu($menu_type = null) {
		$ci =& get_instance();
		$ci->load->database();
		$ci->load->model('model_menu');

		$menu_type_id = $ci->model_menu->get_id_menu_type_by_flag($menu_type);

		$menus = $ci->db
			->where(['menu_type_id' =>  $menu_type_id])
			->order_by('sort', 'ASC')
			->get('menu')
			->result();

		$menu_parents = $ci->db
			->where( ['menu_type_id' => $menu_type_id, 'parent' => 0])
			->order_by('sort', 'ASC')
			->get('menu')
			->result();
		

		$new = array();
		foreach ($menus as $a){
		    $new[$a->parent][] = $a;
		}

		$news = array();
		$menus_tree = array();
		foreach ($menus as $a){
		    $news[$a->parent][] = $a;
		}

		foreach ($menu_parents as $new) {
			$menus_tree = array_merge($menus_tree, create_tree($news, array($new)));
		}
		return $menus_tree;
	}
}

if(!function_exists('create_tree')) {
	function create_tree(&$list, $parent) {

	    $tree = array();
	    foreach ($parent as $k=>$l){
	        if(isset($list[$l->id])){

	            $l->children = create_tree($list, $list[$l->id]);
	        }
	        $tree[] = $l;
	    } 
	    return $tree;
	}
}

if(!function_exists('get_header')) {
	function get_header() {
		$ci =& get_instance();
		return $ci->cc_app->getHeader();
	}
}

if(!function_exists('get_footer')) {
	function get_footer() {
		$ci =& get_instance();
		return $ci->cc_app->getFooter();
	}
}

if(!function_exists('get_navigation')) {
	function get_navigation() {
		$ci =& get_instance();
		return $ci->cc_app->getNavigation();
	}
}

if(!function_exists('generate_key')) {
	function generate_key($length = 40) {
		$ci =& get_instance();
        $salt = base_convert(bin2hex($ci->security->get_random_bytes(64)), 16, 36);
        if ($salt === FALSE)
        {
            $salt = hash('sha256', time() . mt_rand());
        }
        $ci->load->config('config');

        $new_key = substr($salt, 0, $length);
        return $new_key;
	}
}

if(!function_exists('get_table_not_allowed_for_builder')) {
	function get_table_not_allowed_for_builder() {
		return [
			'aauth_group_to_group',
			'aauth_groups',
			'aauth_login_attempts',
			'aauth_perm_to_group',
			'aauth_perm_to_user',
			'aauth_perms',
			'aauth_pms',
			'aauth_user',
			'aauth_user_to_group',
			'aauth_user_variables',
			'aauth_users',
			'captcha',
			'cc_options',
			'cc_session',
			'crud',
			'crud_custom_option',
			'crud_field',
			'crud_field_validation',
			'crud_input_type',
			'crud_input_validation',
			'form',
			'form_custom_attribute',
			'form_custom_option',
			'form_field',
			'form_field_validation',
			'keys',
			'menu',
			'menu_icon',
			'menu_type',
			'migrations',
			'page',
			'page_block_element',
			'rest',
			'rest_field',
			'rest_field_validation',
			'rest_input_type',
			'cc_log',
			'cc_block_client',
			'cc_block',
			'cc_visitor'
		];
	}
}

if(!function_exists('app')) {
	function app() {
		return get_instance();
	}
}

if (!function_exists('getallheaders'))
{
    function getallheaders()
    {
           $headers = '';
       foreach ($_SERVER as $name => $value)
       {
           if (substr($name, 0, 5) == 'HTTP_')
           {
               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
           }
       }
       return $headers;
    }
} 