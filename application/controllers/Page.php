<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Page Controller
*| --------------------------------------------------------------------------
*| For default controller
*|
*/
class Page extends Front
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('simple_html_dom');
	}

	/**
	* Index page
	*
	*/
	public function index()
	{
		$this->template->build('home');
	}

	/**
	* Index page
	*
	*/
	public function landing()
	{
		$this->load->model('model_page');
		$page_id = get_option('landing_page_id', 1);
		
		$page = $this->model_page->find($page_id);

		if ($page) {
			$this->detail($page->link);
		}
	}

	/**
	* Detail page
	*
	* @var String $slug
	*/
	public function detail($slug)
	{
		$this->load->model('model_page');

		$page = $this->model_page->get_page_by_slug($slug, 'frontend');

		if (!$page) {
			show_404();
		}

		$this->register_unparse_html($page);
		$page->content = $this->cc_page_element->unParseHtml($page->content);
		$data['page'] = $page;

		if ($page->template == 'default') {
			$this->template->build('page', $data);
		} else {
			echo $page->content;
		}
	}

	/**
	* Register unparse HTML
	*
	* @var Object $page
	*/
	private function register_unparse_html($page) {

		$this->cc_page_element->registerUnParseHtml(function($html){
			return str_replace('{base_url}', BASE_URL, $html);
		});

		$this->cc_page_element->registerUnParseHtml(function($html){
			return preg_replace('/<div class=".*(.widged-cover).*".*\>/i', '', $html);
		});

		$this->cc_page_element->registerUnParseHtml(function($html){
			$html =  preg_replace_callback(
				'/\{form_builder\(([0-9]{0,11})\)\}/',
				function($matches) {
					if (isset($matches[1])) {
						return form_builder($matches[1]);
					}
				}, $html);

			return $html;
		});


		$this->cc_page_element->registerUnParseHtml(function($html) {
			$html = str_replace('<script_widged class="display-none"','<script', $html);
			$html = str_replace('</script_widged','</script', $html);

			return $html;
		});
		
		$this->cc_page_element->registerUnParseHtml(function($content) use ($page){
			$script_js['top'] = [];
			$script_js['bottom'] = [];
			$css_top = [];
			$content_template = [];

			$html = str_get_html($content);

			foreach($html->find('cc-element[cc-id=script]') as $scripts) {
			    $scripts_list = str_get_html($scripts->innertext);

			    foreach($scripts_list->find('script') as $script) {
			    	$placement = 'top';

			    	if ($script->placement) {
			    		$placement = $script->placement;
			    	}
			    	if ($script->src) {
			    		$script_js[$placement][$script->src] = $script->outertext;
			    	} else {
			    		$script_js[$placement][] = $script->outertext;
			    	}
			    }

				$scripts_list->outertext = null;
			}

			foreach($html->find('cc-element[cc-id=style]') as $styles) {
				$styles_list = str_get_html($styles->innertext);

			    foreach($styles_list->find('style,link') as $style) {
			    	if ($style->href) {
			    		$css_top[$style->href] = $style->outertext;
			    	} else {
			    		$css_top[] = $style->outertext;
			    	}
			    }

				$styles_list->outertext = null;
			}

			foreach($html->load($html->save())->find('cc-element[cc-id=content]') as $contents) {
			    $content_template[] = $contents->innertext;
				$contents->outertext = null;
			}
			$this->data = [
				'css_top' 		=> $css_top,
				'script_top' 	=> $script_js['top'],
				'script_bottom' => $script_js['bottom'],
				'html_body' 	=> $content_template,
				'title' 		=> $page->title,
				'page'			=> $page
			];

			$render = $this->load->view('core_template/page/page_html_formatter', $this->data, true);

			return $render;
		});
	}
}


/* End of file Page.php */
/* Location: ./application/controllers/Page.php */


/**
*| --------------------------------------------------------------------------
*| Page Controller
*| --------------------------------------------------------------------------
*| Page site
*|
*/
class Page extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_page');

		$this->cc_page_element->registerParseHtml(function($html) {
			return str_replace(BASE_URL, '{base_url}', $html);
		});
	}

	/**
	* show all Pages
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('page_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pages'] = $this->model_page->get($filter, $field, $this->limit_page, $offset);
		$this->data['page_counts'] = $this->model_page->count_all($filter, $field);

		$config = [
			'base_url'     => 'page/index/',
			'total_rows'   => $this->model_page->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 3,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Page List');
		$this->render('backend/app-menu/page/page_list', $this->data);
	}
	
	/**
	* Add new pages
	*
	*/
	public function add()
	{
		$this->is_allowed('page_add');

		$this->template->title('Page New');
		$this->render('backend/app-menu/page/page_add', $this->data);
	}

	/**
	* Add New Pages
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('page_add', false)) {
			return $this->response([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
		}

		$content = $this->input->post('content');
		$fresh_content = $this->input->post('plate');

		$this->form_validation->set_rules('title', 'Title', 'trim|required|alpha_numeric_spaces|is_unique[page.title]');
		$this->form_validation->set_rules('type', 'Type', 'trim|required');
		$this->form_validation->set_rules('page_image_name', 'Image', 'trim');
		$this->form_validation->set_rules('link', 'Link', 'trim|required|alpha_dash');
		$this->form_validation->set_rules('content', 'Content', 'trim|required');
		$this->form_validation->set_rules('template', 'Template', 'trim|required');
		$this->form_validation->set_rules('content', 'Page Content', 'trim|required');

		if ($this->form_validation->run()) {

			$content = $this->cc_page_element->parseHtml($content);
			$date = new Datetime;

			$save_data = [
				'title' => $this->input->post('title'),
				'type' => $this->input->post('type'),
				'link' => $this->input->post('link'),
				'content' => $content,
				'fresh_content' => $fresh_content,
				'keyword' => $this->input->post('keyword'),
				'description' => $this->input->post('description'),
				'template' => $this->input->post('template'),
				'created_at' => $date->format('Y-m-d H:i:s')
			];

			$save_page = $this->model_page->store($save_data);

			if ($save_page) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_page;
					$this->data['message'] = 'Data telah berhasil disimpan. '.anchor('page/edit/' . $save_page, 'Edit page').' atau  '.anchor('page', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil disimpan. '.anchor('page/edit/' . $save_page, 'Edit page'), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('page');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Tidak ada data yang diubah';
				} else {
					set_message('Tidak ada data yang diubah.', 'error');

            		$this->data['success'] = false;
					$this->data['redirect'] = base_url('page');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		return $this->response($this->data);
	}

	/**
	* Update view Pages
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('page_update');

		$page = $this->model_page->find($id);

		$page->fresh_content = str_replace('{base_url}', BASE_URL, $page->fresh_content);

		$this->data['page'] = $page;

		$this->template->title('Page Update');
		$this->render('backend/app-menu/page/page_update', $this->data);
	}

	/**
	* Generate Preview
	*
	* @var String
	*/
	public function preview()
	{
		$this->is_allowed('page_add');

		$content = $this->input->post('content');
		$preview_name = $this->input->post('preview_name');

		$page = new stdClass;
		$page->template = 'blank';
		$page->title 	= 'preview';
		$this->register_unparse_html($page);

		$content_html = $this->cc_page_element->unParseHtml($content);

		return $this->response([
			'success' => true,
			'preview_html' => $content_html
			]);
		exit;
	}

	/**
	* Update Pages
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('page_update', false)) {
			return $this->response([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
		}
		
		$content = $this->input->post('content');
		$fresh_content = $this->input->post('plate');

		$this->form_validation->set_rules('title', 'Title', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('type', 'Type', 'trim|required');
		$this->form_validation->set_rules('page_image_name', 'Image', 'trim');
		$this->form_validation->set_rules('link', 'Link', 'trim|required|alpha_dash');
		$this->form_validation->set_rules('content', 'Content', 'trim|required');
		$this->form_validation->set_rules('template', 'Template', 'trim|required');
		$this->form_validation->set_rules('content', 'Page Content', 'trim|required');

		if ($this->form_validation->run()) {

			$content = $this->cc_page_element->parseHtml($content);
			$date = new Datetime;

			$save_data = [
				'title' => $this->input->post('title'),
				'type' => $this->input->post('type'),
				'link' => $this->input->post('link'),
				'content' => $content,
				'fresh_content' => $fresh_content,
				'keyword' => $this->input->post('keyword'),
				'description' => $this->input->post('description'),
				'template' => $this->input->post('template'),
				'created_at' => $date->format('Y-m-d H:i:s')
			];
			
			$save_page = $this->model_page->change($id, $save_data);

			if ($save_page) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = 'Data telah berhasil diperbarui. '.anchor('page', ' Kembali ke daftar');
				} else {
					set_message('Data telah berhasil diperbarui. ', 'success');
            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('page');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Anda tidak melakukan perubahan data';
				} else {
					set_message('Anda tidak melakukan perubahan data.', 'error');
					
            		$this->data['success'] = false;
					$this->data['redirect'] = base_url('page');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		return $this->response($this->data);
	}
	
	/**
	* delete Pages
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('page_delete');

		$this->load->helper('file');

		if ($id !== null) {
			$arr_id = array($id);
		} else {
			$arr_id = $this->input->get('id');
		}

		if (empty($arr_id)) {
			set_message('Tidak ada item yang dipilih untuk dihapus.', 'error');
			redirect('page');
			return;
		}

		$remove = false;

		foreach ($arr_id as $id) {
			$remove = $this->_remove($id);
		}

		if ($remove) {
            set_message('Data page berhasil dihapus.', 'success');
		} else {
            set_message('Kesalahan menghapus data page.', 'error');
		}

		redirect('page');
	}

	/**
	* View view Pages
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('page_view');

		$this->data['page'] = $this->model_page->find($id);

		$this->template->title('Page Detail');
		$this->render('backend/app-menu/page/page_view', $this->data);
	}
	
	/**
	* Detail detail Pages
	*
	* @var $id String
	*/
	public function detail($slug = null)
	{
		$this->is_allowed('page_detail');

		$page = $this->model_page->get_page_by_slug($slug, 'backend');

		if (!$page) {
			show_404();
		}

		$content = $page->content;

		$this->register_unparse_html($page);

		$content = $this->cc_page_element->unParseHtml($content);

		$this->data['content'] = $content;
		$this->data['page'] = $page;
		
		if ($page->template == 'blank') {
			echo $content;
		} else {
			$this->template->title($page->title);
			$this->render('backend/app-menu/page/page_detail', $this->data);
		}
	}

	/**
	* Register unparse HTML
	*
	* @var Object $page
	*/
	public function register_unparse_html($page) 
	{
		$this->load->helper('simple_html_dom');
		$this->cc_page_element->registerUnParseHtml(function($html){
			return str_replace('{base_url}', BASE_URL, $html);
		});
		
		$this->cc_page_element->registerUnParseHtml(function($html){
			return preg_replace('/<div class=".*(.widged-cover).*".*\>/i', '', $html);
		});

		$this->cc_page_element->registerUnParseHtml(function($html){
			$html =  preg_replace_callback(
				'/\{form_builder\(([0-9]{0,11})\)\}/',
				function($matches) {
					if (isset($matches[1])) {
						return form_builder($matches[1]);
					}
				}, $html);

			return $html;
		});

		$this->cc_page_element->registerUnParseHtml(function($html) {
			$html = str_replace('<script_widged class="display-none"','<script', $html);
			$html = str_replace('</script_widged','</script', $html);

			return $html;
		});
		
		$this->cc_page_element->registerUnParseHtml(function($content) use ($page){
			$script_js['top'] = [];
			$script_js['bottom'] = [];
			$css_top = [];
			$content_template = [];

			$html = str_get_html($content);

			foreach($html->find('cc-element[cc-id=script]') as $scripts) {
			    $scripts_list = str_get_html($scripts->innertext);

			    foreach($scripts_list->find('script') as $script) {
			    	$placement = 'top';

			    	if ($script->placement) {
			    		$placement = $script->placement;
			    	}
			    	if ($script->src) {
			    		$script_js[$placement][$script->src] = $script->outertext;
			    	} else {
			    		$script_js[$placement][] = $script->outertext;
			    	}
			    }

				$scripts_list->outertext = null;
			}

			foreach($html->find('cc-element[cc-id=style]') as $styles) {
				$styles_list = str_get_html($styles->innertext);

			    foreach($styles_list->find('style,link') as $style) {
			    	if ($style->href) {
			    		$css_top[$style->href] = $style->outertext;
			    	} else {
			    		$css_top[] = $style->outertext;
			    	}
			    }

				$styles_list->outertext = null;
			}
			foreach($html->find('cc-element[cc-id=content]') as $contents) {
			    $content_template[] = $contents->innertext;
				$contents->outertext = null;
			}

			$this->data = [
				'css_top' 		=> $css_top,
				'script_top' 	=> $script_js['top'],
				'script_bottom' => $script_js['bottom'],
				'html_body' 	=> $content_template,
				'title' 		=> $page->title,
				'page'			=> $page
			];

			$render = $this->load->view('core_template/page/page_html_formatter', $this->data, true);

			return $render;
		});
	}
	
	/**
	* Get element Pages
	*
	*/
	public function get_html()
	{
		if (!$this->is_allowed('page_add', false)) {
			return $this->response([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
		}

		$url = $this->input->get('url');
		$base_element = $this->input->get('base_element');

		if (!$url) {
			return $this->response([
				'success' => false,
				'message' => 'Url is required'
				]);
			exit;
		}

		$content = file_get_contents($url);

		if (!$content) {
			return $this->response([
				'success' => false,
				'message' => 'Element not found'
				]);
			exit;
		}

		$this->cc_page_element->registerUnParseHtml(function($html) use ($content, $base_element) {
			$html = str_replace('{base_element}', $base_element, $content);

			return $html;
		});
		$this->cc_page_element->registerUnParseHtml(function($html) {
			$html = str_replace('<script', '<script_widged class="display-none"', $html);
			$html = str_replace('</script', '</script_widged', $html);

			return $html;
		});
		$content = $this->cc_page_element->unParseHtml($content);

		return $this->response([
			'success' => true,
			'content' => $content
			]);
		exit;
	}
	
	/**
	* delete Pages
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$page = $this->model_page->find($id);

		if (!empty($page->image)) {
			$path = FCPATH . '/uploads/page/' . $page->image;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}

		
		return $this->model_page->remove($id);
	}
	
	/**
	* Upload Image Page
	* @return JSON
	*/
	public function upload_image_file()
	{
		if (!$this->is_allowed('page_add', false)) {
			return $this->response([
				'success' => false,
				'message' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
		}

		$uuid = $this->input->post('qquuid');

		$response = json_decode($this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'page',
			'allowed_types' => 'jpg|png|jpeg|gif|svg',
			'max_size' 	 	=> 2000,
		]));

		if ($response->success) {

			if (!is_dir(FCPATH . '/uploads/page/')) {
				mkdir(FCPATH . '/uploads/page/');
			}
			$image_name = $response->uploadName;

			if (!empty($image_name)) {
				$image_name_copy = date('YmdHis') . '-' . $image_name;

				rename($response->previewLink, 
						FCPATH . 'uploads/page/' . $image_name_copy);

				if (!is_file(FCPATH . '/uploads/page/' . $image_name_copy)) {
					return $this->response([
						'success' => false,
						'message' => 'Kesalahan mengunggah gambar'
						]);
					exit;
				}

				$response->thumbnailUrl = base_url('uploads/page/'.$image_name_copy);

				return $this->response($response);
			}
		} else {
			return $this->response($response);
		}
	}

	/**
	* Delete Image Page	* 
	* @return JSON
	*/
	public function delete_image_file($uuid)
	{
		if (!$this->is_allowed('page_delete', false)) {
			return $this->response([
				'success' => false,
				'error' => 'Maaf, Anda tidak memiliki izin untuk mengakses'
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'image', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'page',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/page/'
        ]);
	}

	/**
	* Get Image Page	* 
	* @return JSON
	*/
	public function get_image_file($id)
	{
		if (!$this->is_allowed('page_update', false)) {
			return $this->response([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$page = $this->model_page->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'image', 
            'table_name'        => 'page',
            'primary_key'       => 'id',
            'upload_path'       => 'uploads/page/',
            'delete_endpoint'   => 'page/delete_image_file'
        ]);
	}
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('page_export');

		$this->model_page->export('page', 'page');
	}
}


/* End of file page.php */
/* Location: ./application/controllers/Page.php */